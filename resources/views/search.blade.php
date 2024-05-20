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
                        </div>
                        <div class="card-body">
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
                        </div>
                        <div class="card-body">
                            <button id="searchButton" class="btn btn-primary">Cari</button>
                        </div>
                        <div class="card-body">
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
                        var resultHtml = '<ul>';
                        if (option == '1') {
                            resultHtml += '<li>Sinonim: ' + data.sinonims.map(item => item.kata).join(', ') + '</li>';
                            resultHtml += '<li>Antonim: ' + data.antonims.map(item => item.kata).join(', ') + '</li>';
                            resultHtml += '<li>Imbuhan: ' + data.imbuhans.map(item => item.imbuhan).join(', ') + '</li>';
                        } else if (option == '2') {
                            resultHtml += '<li>Sinonim: ' + data.map(item => item.kata).join(', ') + '</li>';
                        } else if (option == '3') {
                            resultHtml += '<li>Antonim: ' + data.map(item => item.kata).join(', ') + '</li>';
                        } else if (option == '4') {
                            resultHtml += '<li>Imbuhan: ' + data.map(item => item.imbuhan).join(', ') + '</li>';
                        }
                        resultHtml += '</ul>';
                        $('#searchResults').html(resultHtml);
                    }
                });
            }
        });
    });
 </script>
@endpush
@endsection
