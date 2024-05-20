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
                                <form action="{{ route('kata.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="kata_id">Pilih Kata</label>
                                        <select name="kata_id" id="kata_id" class="form-control select2" required>
                                            @foreach($kataList as $item)
                                                <option value="{{ $item->id }}">{{ $item->kata }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="sinonim">Sinonim</label>
                                        <select name="sinonim[]" id="sinonim" class="form-control select2" multiple>
                                            @foreach($kataList as $item)
                                                <option value="{{ $item->id }}">{{ $item->kata }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="antonim">Antonim</label>
                                        <select name="antonim[]" id="antonim" class="form-control select2" multiple>
                                            @foreach($kataList as $item)
                                                <option value="{{ $item->id }}">{{ $item->kata }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="imbuhan">Imbuhan</label>
                                        <div id="imbuhan">
                                            <input type="text" name="imbuhan[]" class="form-control mb-2">
                                        </div>
                                        <button type="button" class="btn btn-secondary" onclick="addImbuhan()">Tambah Imbuhan</button>
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

@push('scripts')
<script>
    function addImbuhan() {
        var div = document.createElement('div');
        div.innerHTML = '<input type="text" name="imbuhan[]" class="form-control mb-2">';
        document.getElementById('imbuhan').appendChild(div);
    }
</script>
@endpush
@endsection
