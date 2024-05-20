@extends('BE.layouts.app')

@section('title', 'Kategori')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Kategori</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:;" class="btn btn-primary btn-icon icon-left" style="border-radius:5px"
                                    onclick="addData()">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                                $child = 0;
                                            @endphp
                                            @foreach ($listdata as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->kata }}</td>
                                                    <td>
                                                        <a href="javascript:;" onclick="editData({{ $item->toJson() }})"
                                                            class="btn btn-info btn-sm waves-effect waves-light">
                                                            <i class="fas fa-edit align-middle"></i>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteData('{{ $item->id }}')"
                                                            class="btn btn-danger btn-sm waves-effect waves-light">
                                                            <i class="fas fa-trash align-middle"></i>
                                                        </a>
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
    <div class="modal fade modalFormCrud" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Form Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" validate method="post" action="{{ route('kategori.simpan') }}"
                    id="FormCrud">
                    @csrf
                    <input type="hidden" name="id" id="inputID">
                    <input type="hidden" value="1" name="kelas_kata_id" id="inputIDD">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="inputKey">kata</label> {{-- Corrected here --}}
                                    <input type="text" class="form-control" id="inputKey" placeholder="Kunci Kategori"
                                        name="kata" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var modalTitle = document.getElementById('modalTitle');
            var FormCrud = document.getElementById("FormCrud");

            var inputID = document.getElementById('inputID');
            var inputIDD = document.getElementById('inputIDD');
            var inputVal = document.getElementById('inputVal');

            function addData() {
                FormCrud.reset();
                modalTitle.innerHTML = "Tambah Data Baru";
                $('.modalFormCrud').modal('show');
            }

            function editData(item) {
                FormCrud.reset();
                modalTitle.innerHTML = "Ubah Data";
                inputID.value = item.id;
                inputIDD.value = item.kelas_kata_id;
                inputVal.value = item.kata;
                $('.modalFormCrud').modal('show');
            }

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
                        window.location = "{{ route('kategori.delete', ['id' => ':id']) }}".replace(':id',
                            id);
                    }
                })
            }
        </script>
    @endpush
@endsection
