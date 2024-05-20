<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use App\Models\Kategori;
use App\Models\KelasKata;
use Illuminate\Http\Request;

class KataController extends Controller
{
    public function dashboard()
    {
        return view('BE.dashboard');
    }
    public function viewKategori()
    {

        $listdata = Kata::all();
        $kelasKataList = KelasKata::all();
        return view('BE.kategori', compact('listdata', 'kelasKataList'));
    }

    public function simpanKategori(Request $request)
    {
        $request->validate([
            'kata' => 'required',
            'kelas_kata_id' => 'required',
        ]);
        if (!$request->id) {
            $data = new Kata();
        } else {
            $data = Kata::findOrFail($request->id);
        }
        $data->kata = $request->kata;
        $data->kelas_kata_id = $request->kelas_kata_id;
        $data->save();
        drakify('success');
        return redirect()->route('kategori.view');
    }

    public function deleteKategori($id)
    {
        $data = Kata::find($id);
        if ($data) {
            $data->delete();
        }
        notify()->info('Data berhasil dihapus', 'Sukses');
        return redirect()->route('kategori.view')->with('pesan', 'Delete data berhasil');
    }

    public function viewKelas()
    {

        $listdata = KelasKata::all();
        return view('BE.kelas', compact('listdata'));
    }

    public function simpanKelas(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        if (!$request->id) {
            $data = new KelasKata();
        } else {
            $data = KelasKata::findOrFail($request->id);
        }
        $data->nama = $request->nama;
        $data->save();
        drakify('success');
        return redirect()->route('kelas.view');
    }

    public function deleteKelas($id)
    {
        $data = KelasKata::find($id);
        if ($data) {
            $data->delete();
        }
        notify()->info('Data berhasil dihapus', 'Sukses');
        return redirect()->route('kelas.view')->with('pesan', 'Delete data berhasil');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kata = Kata::with('kelasKata', 'sinonims', 'antonims', 'imbuhans')
        ->whereHas('kelasKata')
        ->whereHas('sinonims')
        ->whereHas('antonims')
        ->whereHas('imbuhans')
        ->get();
        return view('kata.index', compact('kata'));
    }

    public function create()
    {
        $kelasKata = KelasKata::all();
        $kataList = Kata::all(); // Untuk pilihan sinonim dan antonim
        return view('kata.create', compact('kelasKata', 'kataList'));
    }

    public function store(Request $request)
    {
        // Temukan kata yang ingin diupdate relasinya
        $kata = Kata::findOrFail($request->kata_id);

        // Simpan sinonim
        if ($request->has('sinonim')) {
            $kata->sinonims()->sync($request->sinonim);
        }

        // Simpan antonim
        if ($request->has('antonim')) {
            $kata->antonims()->sync($request->antonim);
        }

        // Simpan imbuhan
        if ($request->has('imbuhan')) {
            foreach ($request->imbuhan as $imbuhan) {
                $kata->imbuhans()->create(['imbuhan' => $imbuhan]);
            }
        }

        return redirect()->route('kata.index');
    }

    public function edit(Kata $kata)
    {
        $kelasKata = KelasKata::all();
        $kataList = Kata::all(); // Untuk pilihan sinonim dan antonim
        return view('kata.edit', compact('kata', 'kelasKata', 'kataList'));
    }

    public function update(Request $request, Kata $kata)
    {
        // Update sinonim
        if ($request->has('sinonim')) {
            $kata->sinonims()->sync($request->sinonim);
        }

        // Update antonim
        if ($request->has('antonim')) {
            $kata->antonims()->sync($request->antonim);
        }

        // Update imbuhan
        $kata->imbuhans()->delete();
        if ($request->has('imbuhan')) {
            foreach ($request->imbuhan as $imbuhan) {
                $kata->imbuhans()->create(['imbuhan' => $imbuhan]);
            }
        }

        return redirect()->route('kata.index');
    }

    public function destroy(Kata $kata)
    {
        // Hanya menghapus relasi, bukan data kata itu sendiri
        $kata->sinonims()->detach();
        $kata->antonims()->detach();
        $kata->imbuhans()->delete();
        return redirect()->route('kata.index');
    }

    // Fungsi pencarian
    public function search()
    {
        $kataList = Kata::all();
        return view('search', compact('kataList'));
    }
    public function searchResults(Request $request)
    {
        $kataId = $request->input('kata_id');
        $option = $request->input('option');

        $kata = Kata::with(['kelasKata', 'sinonims', 'antonims', 'imbuhans'])->findOrFail($kataId);
        $result = [];

        switch ($option) {
            case '2':
                $result = $kata->sinonims;
                break;
            case '3':
                $result = $kata->antonims;
                break;
            case '4':
                $result = $kata->imbuhans;
                break;
            default:
                $result = [
                    'sinonims' => $kata->sinonims,
                    'antonims' => $kata->antonims,
                    'imbuhans' => $kata->imbuhans,
                ];
                break;
        }

        return response()->json($result);
    }
    public function getKelasKata($id)
    {
        $kata = Kata::findOrFail($id);

        $kelasKata = $kata->kelasKata->nama;

        return response()->json(['kelas_kata' => $kelasKata]);
    }
}
