@extends('BE.layouts.app')

@section('title', 'General Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Search</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('/') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Search</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('kata.search') }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Masukkan kata yang ingin dicari" name="q">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Cari</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="search_type">Jenis Pencarian:</label>
                                        <select class="form-control" id="search_type" name="search_type">
                                            <option value="all">Semua</option>
                                            <option value="sinonim">Sinonim</option>
                                            <option value="antonim">Antonim</option>
                                            <option value="imbuhan">Imbuhan</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <h1>Hasil Pencarian</h1>

                                    <!-- Tampilkan jenis pencarian -->
                                    <h2>Hasil Pencarian: {{ ucfirst($searchType) }}</h2>

                                    <!-- Tampilkan hasil pencarian -->
                                    @if (!empty($results))
                                        <ul class="list-group">
                                            @foreach ($results as $result)
                                                <li class="list-group-item">{{ $result->kata }}</li>
                                                <!-- Tambahkan informasi lain yang ingin ditampilkan -->
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Tidak ada hasil ditemukan untuk "{{ request()->input('q') }}".</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
