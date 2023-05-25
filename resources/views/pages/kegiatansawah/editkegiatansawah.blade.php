@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card-header mt-3">
            <a href="/viewkegiatansawah" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>

            <h5 class="card-title mt-3">Form Edit Data Kegiatan Penanaman Bawang</h5>
            <p class="mt-1" style="font-size: 16px;">Silakan mengubah formulir di bawah ini dengan data kegiatan penanaman bawang yang baru.</p>
        </div>

        <form action="/updatekegiatansawah/{{ $kegiatansawahs->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Alamat Lokasi Sawah -->
            <div class="form-group mt-3">
                <label for="lokasisawah_id">Keterangan Lokasi Sawah *</label>
                <select class="form-control form-control-lg  @error('lokasisawah_id') is-invalid @enderror" id="lokasisawah_id" name="lokasisawah_id">
                    <option selected disabled>--- pilih Keterangan Lokasi Sawah ---</option>
                    @foreach ($lokasisawahs as $lokasi)
                        <option value="{{ $lokasi->id }}" {{ $lokasi->id == $kegiatansawahs->lokasisawah_id ? 'selected' : '' }}>{{ $lokasi->lokasisawah_keterangan }}</option>
                    @endforeach
                </select>
                @error('lokasisawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kabupaten -->
            <div class="form-group">
                <label for="lokasisawah_id">Kabupaten *</label>
                <select class="form-control form-control-lg @error('lokasisawah_id') is-invalid @enderror" id="lokasisawah_id" name="kabupaten_nama">
                    <option selected disabled>--- pilih Kabupaten ---</option>
                    @foreach ($lokasisawahs as $lokasi)
                        <option value="{{ $lokasi->id }}" {{ $lokasi->id == $kegiatansawahs->lokasisawah_id ? 'selected' : '' }}>{{ $lokasi->kabupaten_nama }}</option>
                    @endforeach
                </select>
                @error('lokasisawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Waktu Tanam -->
            <div class="form-group mt-3">
                <label for="ks_waktu_tanam">Waktu Tanam *</label>

                <input type="date" name="ks_waktu_tanam" class="form-control form-control-lg @error('ks_waktu_tanam') is-invalid @enderror" id="ks_waktu_tanam" placeholder=" " value="{{ old('ks_waktu_tanam', $kegiatansawahs->ks_waktu_tanam) }}">

                @error('ks_waktu_tanam')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Metode Pengairan -->
            <div class="form-group">
                <label for="ks_metode_pengairan">Metode Pengairan *</label>

                <div class="form-check @error('ks_metode_pengairan') is-invalid @enderror mt-1" value="{{ old('ks_metode_pengairan') }}">
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Sumur"> Sumur<br> -->
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Sumur" {{ (is_array(old('ks_metode_pengairan')) && in_array('Sumur', old('ks_metode_pengairan'))) || in_array('Sumur', explode(',', $kegiatansawahs->ks_metode_pengairan)) ? 'checked' : '' }}> Sumur<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Irigasi"> Irigasi<br> -->
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Irigasi" {{ (is_array(old('ks_metode_pengairan')) && in_array('Irigasi', old('ks_metode_pengairan'))) || in_array('Irigasi', explode(',', $kegiatansawahs->ks_metode_pengairan)) ? 'checked' : '' }}> Irigasi<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Tadah Hujan"> Tadah Hujan<br> -->
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Tadah Hujan" {{ (is_array(old('ks_metode_pengairan')) && in_array('Tadah Hujan', old('ks_metode_pengairan'))) || in_array('Tadah Hujan', explode(',', $kegiatansawahs->ks_metode_pengairan)) ? 'checked' : '' }}> Tadah Hujan<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Mata Air"> Mata Air<br> -->
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Mata Air" {{ (is_array(old('ks_metode_pengairan')) && in_array('Mata Air', old('ks_metode_pengairan'))) || in_array('Mata Air', explode(',', $kegiatansawahs->ks_metode_pengairan)) ? 'checked' : '' }}> Mata Air<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Sungai"> Sungai<br> -->
                        <input class="" type="checkbox" name="ks_metode_pengairan[]" value="Sungai" {{ (is_array(old('ks_metode_pengairan')) && in_array('Sungai', old('ks_metode_pengairan'))) || in_array('Sungai', explode(',', $kegiatansawahs->ks_metode_pengairan)) ? 'checked' : '' }}> Sungai<br>
                    </div>
                </div>

                @error('ks_metode_pengairan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Varietas Bawang Merah -->
            <div class="form-group">
                <label for="varietasbawang_id">Varietas Bawang Merah *</label>
                <select class="form-control form-control-lg @error('varietasbawang_id') is-invalid @enderror" id="varietasbawang_id" name="varietasbawang_id">
                    <option selected disabled>--- pilih Varietas Bawang Merah yang digunakan ---</option>
                    @foreach ($varietasbawangs as $varietasbawang)
                        <option value="{{ $varietasbawang->id }}" {{ $varietasbawang->id == $kegiatansawahs->varietasbawang_id ? 'selected' : '' }}>{{ $varietasbawang->varietasbawang_nama }}</option>
                    @endforeach
                </select>
                @error('varietasbawang_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Bibit -->
            <div class="form-group">
                <label for="ks_jumlah_bibit">Jumlah Bibit *</label>

                <input type="number" step="0.01" name="ks_jumlah_bibit" class="form-control form-control-lg @error('ks_jumlah_bibit') is-invalid @enderror" value="{{ $kegiatansawahs->ks_jumlah_bibit }}">
                <div class="form-check">
                    <!-- <div class="">
                        <input class="inputan" type="radio" id="kilogram" name="stnBibit" value="Kilogram">
                        <label>Kilogram</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="kuintal" name="stnBibit" value="Kuintal">
                        <label>Kuintal</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="ton" name="stnBibit" value="Ton">
                        <label>Ton</label>
                    </div> -->
                    <div class="">
                        <input class="inputan" type="radio" id="kilogram" name="stnBibit" value="Kilogram" {{ $kegiatansawahs->stnBibit == "Kilogram" ? "checked" : "" }}>
                        <label>Kilogram</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="kuintal" name="stnBibit" value="Kuintal" {{ $kegiatansawahs->stnBibit == "Kuintal" ? "checked" : "" }}>
                        <label>Kuintal</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="ton" name="stnBibit" value="Ton" {{ $kegiatansawahs->stnBibit == "Ton" ? "checked" : "" }}>
                        <label>Ton</label>
                    </div>
                </div>

                @error('ks_jumlah_bibit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Luas Lahan -->
            <div class="form-group">
                <label for="ks_luas_lahan">Luas Lahan *</label>

                <input type="number" step="0.01" name="ks_luas_lahan" class="form-control form-control-lg @error('ks_luas_lahan') is-invalid @enderror" value="{{ $kegiatansawahs->ks_luas_lahan }}">
                <div class="form-check">
                    <!-- <div class="">
                        <input class="inputan" type="radio" id="meter" name="stnLuasLahan" value="Meter">
                        <label>Meter</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="hektar" name="stnLuasLahan" value="Hektar">
                        <label>Hektar</label>
                    </div> -->
                    <div class="">
                        <input class="inputan" type="radio" id="meter" name="stnLuasLahan" value="Meter" {{ $kegiatansawahs->stnLuasLahan == "Meter" ? "checked" : "" }}>
                        <label>Meter</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="hektar" name="stnLuasLahan" value="Hektar" {{ $kegiatansawahs->stnLuasLahan == "Hektar" ? "checked" : "" }}>
                        <label>Hektar</label>
                    </div>
                </div>

                @error('ks_luas_lahan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Lahan -->
            <div class="form-group">
                <label for="ks_status_lahan">Status Lahan *</label>

                <div class="form-check @error('ks_status_lahan') is-invalid @enderror mt-1" value="{{ old('ks_status_lahan') }}">
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_status_lahan[]" value="Sewa"> Sewa<br> -->
                        <input class="" type="checkbox" name="ks_status_lahan[]" value="Sewa" {{ (is_array(old('ks_status_lahan')) && in_array('Sewa', old('ks_status_lahan'))) || in_array('Sewa', explode(',', $kegiatansawahs->ks_status_lahan)) ? 'checked' : '' }}> Sewa<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_status_lahan[]" value="Milik Sendiri"> Milik Sendiri<br> -->
                        <input class="" type="checkbox" name="ks_status_lahan[]" value="Milik Sendiri" {{ (is_array(old('ks_status_lahan')) && in_array('Milik Sendiri', old('ks_status_lahan'))) || in_array('Milik Sendiri', explode(',', $kegiatansawahs->ks_status_lahan)) ? 'checked' : '' }}> Milik Sendiri<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_status_lahan[]" value="Bagi Hasil"> Bagi Hasil<br> -->
                        <input class="" type="checkbox" name="ks_status_lahan[]" value="Bagi Hasil" {{ (is_array(old('ks_status_lahan')) && in_array('Bagi Hasil', old('ks_status_lahan'))) || in_array('Bagi Hasil', explode(',', $kegiatansawahs->ks_status_lahan)) ? 'checked' : '' }}> Bagi Hasil<br>
                    </div>
                </div>

                @error('ks_status_lahan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Sumber Modal -->
            <div class="form-group">
                <label for="ks_sumber_modal">Sumber Modal *</label>

                <div class="form-check @error('ks_sumber_modal') is-invalid @enderror mt-1" value="{{ old('ks_sumber_modal') }}">
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_sumber_modal[]" value="Sendiri"> Sendiri<br> -->
                        <input class="" type="checkbox" name="ks_sumber_modal[]" value="Sendiri" {{ (is_array(old('ks_sumber_modal')) && in_array('Sendiri', old('ks_sumber_modal'))) || in_array('Sendiri', explode(',', $kegiatansawahs->ks_sumber_modal)) ? 'checked' : '' }}> Sendiri<br>
                    </div>
                    <div class="">
                        <!-- <input class="" type="checkbox" name="ks_sumber_modal[]" value="Pinjam"> Pinjam<br> -->
                        <input class="" type="checkbox" name="ks_sumber_modal[]" value="Pinjam" {{ (is_array(old('ks_sumber_modal')) && in_array('Pinjam', old('ks_sumber_modal'))) || in_array('Pinjam', explode(',', $kegiatansawahs->ks_sumber_modal)) ? 'checked' : '' }}> Pinjam<br>
                    </div>
                </div>

                @error('ks_sumber_modal')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Modal -->
            <div class="form-group">
                <label for="ks_jumlah_modal">Jumlah Modal *</label>

                <input type="text" name="ks_jumlah_modal" id="rupiah" class="form-control form-control-lg @error('ks_jumlah_modal') is-invalid @enderror" value="{{ old('ks_jumlah_modal', $kegiatansawahs->ks_jumlah_modal) }}">

                <script>
                    const rupiah = document.getElementById('rupiah');
                    rupiah.addEventListener('keyup', function(e) {
                        // format currency
                        let val = parseInt(this.value.replace(/[^0-9]/g, ''));
                        this.value = formatCurrency(val);
                    });

                    function formatCurrency(num) {
                        num = num.toString().replace(/\$|\,/g, '');
                        if (isNaN(num)) num = "0";
                        sign = (num == (num = Math.abs(num)));
                        num = Math.floor(num * 100 + 0.50000000001);
                        cents = num % 100;
                        num = Math.floor(num / 100).toString();
                        if (cents < 10) cents = "0" + cents;
                        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                        num = num.substring(0, num.length - (4 * i + 3)) +
                        '.' + num.substring(num.length - (4 * i + 3));
                        return (((sign) ? '' : '-') + 'Rp ' + num);
                    }
                </script>

                @error('ks_jumlah_modal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- ks panen -->
            <div class="form-group">
                <input type="hidden" name="ks_panen" value="0">
            </div>
    
            <!-- Buttom Submit dan Cancel -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-3">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection