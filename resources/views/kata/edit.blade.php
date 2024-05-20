@extends('BE.layouts.app')

@section('title', 'Artikel')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Artikel</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('/')}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route('kata.index')}}">Artikel</a></div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Artikel</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kata.update', $kata) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="kata">Kata</label>
                                        <input type="text" class="form-control" id="kata" name="kata" value="{{ $kata->kata }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kelas_kata_id">Kelas Kata</label>
                                        <select class="form-control" id="kelas_kata_id" name="kelas_kata_id" required>
                                            @foreach($kelasKata as $kk)
                                                <option value="{{ $kk->id }}" {{ $kata->kelasKata->id == $kk->id ? 'selected' : '' }}>
                                                    {{ $kk->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="sinonim">Sinonim</label>
                                        <select multiple class="form-control" id="sinonim" name="sinonim[]">
                                            @foreach($kataList as $kata)
                                                <option value="{{ $kata->id }}" {{ in_array($kata->id, $sinonimIds) ? 'selected' : '' }}>
                                                    {{ $kata->kata }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="antonim">Antonim</label>
                                        <select multiple class="form-control" id="antonim" name="antonim[]">
                                            @foreach($kataList as $kata)
                                                <option value="{{ $kata->id }}" {{ in_array($kata->id, $antonimIds) ? 'selected' : '' }}>
                                                    {{ $kata->kata }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="imbuhan">Imbuhan</label>
                                        <input type="text" class="form-control" id="imbuhan" name="imbuhan[]">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
