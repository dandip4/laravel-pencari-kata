@extends('BE.layouts.app')

@section('title', 'Kata')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kata</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('/') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Kata</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('kata.create') }}" class="btn btn-primary btn-icon icon-left"
                                    style="border-radius:5px">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Kata</th>
                                                <th>Kelas Kata</th>
                                                <th>Sinonim</th>
                                                <th>Antonim</th>
                                                <th>Imbuhan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                                $child = 0;
                                            @endphp
                                            @foreach ($kata as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kata }}</td>
                                                    <td>{{ $item->kelasKata->nama }}</td>
                                                    <td>{{ implode(', ', $item->sinonims->pluck('kata')->toArray()) }}</td>
                                                    <td>{{ implode(', ', $item->antonims->pluck('kata')->toArray()) }}</td>
                                                    <td>{{ implode(', ', $item->imbuhans->pluck('imbuhan')->toArray()) }}</td>

                                                    <td>
                                                        <a href="{{ route('kata.edit', $item) }}"
                                                            class="btn btn-success btn-sm waves-effect waves-light">
                                                            <i class="fa fa-edit align-middle"></i>
                                                        </a>
                                                        <form id="deleteForm_{{ $item->id }}"
                                                            action="{{ route('kata.destroy', $item) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm waves-effect waves-light"
                                                                onclick="deleteData('{{ $item->id }}')">
                                                                <i class="fas fa-trash align-middle"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('scripts')
        <script>
            function deleteData(id) {
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu ingin menghapus data ini !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm_' + id).submit();

                    }
                })
            }
        </script>
    @endpush
@endsection
