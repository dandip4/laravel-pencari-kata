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
                            <h4>Cari Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-5">
                                <label for="kata_id">Pilih Kata</label>
                                <select name="kata_id" id="kata_id" class="form-control select2" required>
                                    <option value=""></option>
                                    @foreach($kataList as $kata)
                                        <option value="{{ $kata->id }}">{{ $kata->kata }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-5">
                                <label for="kelas_kata">Kelas Kata</label>
                                <input type="text" id="kelas_kata" class="form-control" disabled>
                            </div>
                            <div class="form-group col-5">
                                <div class="control-label">Toggle switches</div>
                                <div class="custom-switches-stacked mt-2">
                                    <label class="custom-switch">
                                        <input type="radio" name="option" value="1" class="custom-switch-input" checked>
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Semua</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="radio" name="option" value="2" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Sinonim</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="radio" name="option" value="3" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Antonim</span>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="radio" name="option" value="4" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Imbuhan</span>
                                    </label>
                                </div>
                            </div>
                        <div class="card-body">
                            <button id="searchButton" class="btn btn-primary">Cari</button>
                        </div>
                        <div class="card-body">
                            <h4>Hasil Pencarian</h4>
                            <div id="searchResults"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
 $(document).ready(function() {
        $('#kata_id').change(function() {
            var kataId = $(this).val();
            if (kataId) {
                $.ajax({
                    url: '/api/kata/' + kataId + '/kelas',
                    type: 'GET',
                    success: function(data) {
                        $('#kelas_kata').val(data.kelas_kata);
                    }
                });
            } else {
                $('#kelas_kata').val('');
            }
        });

        $('#searchButton').click(function() {
    var kataId = $('#kata_id').val();
    var option = $('input[name="option"]:checked').val();
    if (kataId) {
        $.ajax({
            url: '{{ route('kata.searchResults') }}',
            type: 'GET',
            data: { kata_id: kataId, option: option },
            success: function(data) {
                var resultHtml = '';
                if (option == '1') {
                    if (data.sinonims.length > 0) {
                        resultHtml += '<h5>Sinonim</h5><ul>';
                        resultHtml += data.sinonims.map(item => '<li>' + item.kata + '</li>').join('');
                        resultHtml += '</ul>';
                    } else {
                        resultHtml += '<p>No Sinonim found.</p>';
                    }
                    if (data.antonims.length > 0) {
                        resultHtml += '<h5>Antonim</h5><ul>';
                        resultHtml += data.antonims.map(item => '<li>' + item.kata + '</li>').join('');
                        resultHtml += '</ul>';
                    } else {
                        resultHtml += '<p>No Antonim found.</p>';
                    }
                    if (data.imbuhans.length > 0) {
                        resultHtml += '<h5>Imbuhan</h5><ul>';
                        resultHtml += data.imbuhans.map(item => '<li>' + item.imbuhan + '</li>').join('');
                        resultHtml += '</ul>';
                    } else {
                        resultHtml += '<p>No Imbuhan found.</p>';
                    }
                } else if (option == '2') {
                    if (data.length > 0) {
                        resultHtml += '<h5>Sinonim</h5>';
                        resultHtml += data.map(item => '<li>' + item.kata + '</li>').join('');
                        resultHtml += '';
                    } else {
                        resultHtml += '<p>No Sinonim found.</p>';
                    }
                } else if (option == '3') {
                    if (data.length > 0) {
                        resultHtml += '<h5>Antonim</h5><ul>';
                        resultHtml += data.map(item => '<li>' + item.kata + '</li>').join('');
                        resultHtml += '</ul>';
                    } else {
                        resultHtml += '<p>No Antonim found.</p>';
                    }
                } else if (option == '4') {
                    if (data.length > 0) {
                        resultHtml += '<h5>Imbuhan</h5><ul>';
                        resultHtml += data.map(item => '<li>' + item.imbuhan + '</li>').join('');
                        resultHtml += '</ul>';
                    } else {
                        resultHtml += '<p>No Imbuhan found.</p>';
                    }
                }
                $('#searchResults').html(resultHtml);
            }
        });
    }
});

    });
 </script>
@endpush
@endsection
