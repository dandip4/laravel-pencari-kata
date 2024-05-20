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
        return view('BE.kategori', compact('listdata'));
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kata = Kata::with('kelasKata', 'sinonims', 'antonims', 'imbuhans')->get();
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
        $kata = Kata::create($request->all());

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
                $kata->imbuhans()->create(['imbuhan' => $imbuhan['imbuhan']]);
            }
        }

        return redirect()->route('kata.index');
    }

    public function show(Kata $kata)
    {
        return view('kata.show', compact('kata'));
    }

    public function edit(Kata $kata)
    {
        $kelasKata = KelasKata::all();
        $kataList = Kata::all(); // Untuk pilihan sinonim dan antonim
        return view('kata.edit', compact('kata', 'kelasKata', 'kataList'));
    }

    public function update(Request $request, Kata $kata)
    {
        $kata->update($request->all());

        // Update sinonim
        $kata->sinonims()->sync($request->sinonim);

        // Update antonim
        $kata->antonims()->sync($request->antonim);

        // Update imbuhan
        $kata->imbuhans()->delete();
        if ($request->has('imbuhan')) {
            foreach ($request->imbuhan as $imbuhan) {
                $kata->imbuhans()->create(['imbuhan' => $imbuhan['imbuhan']]);
            }
        }

        return redirect()->route('kata.index');
    }

    public function destroy(Kata $kata)
    {
        $kata->delete();
        return redirect()->route('kata.index');
    }

    // Fungsi pencarian
    public function search(Request $request)
{
    $searchTerm = $request->input('q');
    $searchType = $request->input('search_type'); // Ambil jenis pencarian yang dipilih oleh pengguna

    // Mulai dengan mencari semua kata
    $query = Kata::query();

    // Filter hasil berdasarkan jenis pencarian yang dipilih
    switch ($searchType) {
        case 'sinonim':
            $query->whereHas('sinonims', function ($query) use ($searchTerm) {
                $query->where('kata', 'LIKE', '%' . $searchTerm . '%');
            });
            break;
        case 'antonim':
            $query->whereHas('antonims', function ($query) use ($searchTerm) {
                $query->where('kata', 'LIKE', '%' . $searchTerm . '%');
            });
            break;
        case 'imbuhan':
            $query->whereHas('imbuhans', function ($query) use ($searchTerm) {
                $query->where('imbuhan', 'LIKE', '%' . $searchTerm . '%');
            });
            break;
        // Jika jenis pencarian tidak dipilih atau "Semua", lanjutkan dengan pencarian normal
        default:
            $query->where('kata', 'LIKE', '%' . $searchTerm . '%');
    }

    // Ambil hasil pencarian
    $results = $query->with('kelasKata', 'sinonims', 'antonims', 'imbuhans')->get();

    // Kirim hasil pencarian dan jenis pencarian ke view
    return view('results', compact('results', 'searchType'));
}

}
