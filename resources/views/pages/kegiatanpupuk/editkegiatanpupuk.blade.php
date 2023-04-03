@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card-header">
            <a href="/viewkegiatanpupuk" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>

            <h5 class="card-title mt-3">Form Edit Data Kegiatan Pupuk</h5>
            <p class="mt-1">Silakan mengubah formulir di bawah ini dengan data kegiatan pupuk yang baru</p>
        </div>

        <form action="/updatekegiatanpupuk/{{ $kspupuks->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Alamat Lokasi Sawah -->
            <div class="form-group mt-3">
                <label for="lokasisawah_id">Alamat Lokasi Sawah</label>
                <select class="form-control form-control-lg  @error('lokasisawah_id') is-invalid @enderror" id="lokasisawah_id" name="lokasisawah_id">
                    <option selected disabled>--- pilih alamat lokasi sawah ---</option>
                    @foreach ($lokasisawahs as $lokasi)
                        <option value="{{ $lokasi->id }}" {{ $lokasi->id == $kspupuks->lokasisawah_id ? 'selected' : '' }}>{{ $lokasi->lokasisawah_keterangan }}</option>
                    @endforeach
                </select>
                @error('lokasisawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kabupaten -->
            <div class="form-group">
                <label for="lokasisawah_id">Kabupaten</label>
                <select class="form-control form-control-lg @error('lokasisawah_id') is-invalid @enderror" id="lokasisawah_id" name="kabupaten_nama">
                    <option selected disabled>--- pilih Kabupaten ---</option>
                    @foreach ($lokasisawahs as $lokasi)
                        <option value="{{ $lokasi->id }}" {{ $lokasi->id == $kspupuks->lokasisawah_id ? 'selected' : '' }}>{{ $lokasi->kabupaten_nama }}</option>
                    @endforeach
                </select>
                @error('lokasisawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Waktu Tanam -->
            <div class="form-group">
                <label for="kegiatansawah_id">Waktu Tanam</label>
                <select class="form-control form-control-lg @error('kegiatansawah_id') is-invalid @enderror" id="kegiatansawah_id" name="kegiatansawah_id">
                    <option selected disabled>--- pilih waktu tanam ---</option>
                    @foreach ($kegiatansawahs as $kegiatansawah)
                        <option value="{{ $kegiatansawah->id }}" {{ $kegiatansawah->id == $kspupuks->kegiatansawah_id ? 'selected' : '' }}>{{ $kegiatansawah->ks_waktu_tanam }}</option>
                    @endforeach
                </select>
                @error('kegiatansawah_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Rabuk Pupuk -->
            <div class="form-group mt-3">
                <label for="ks_pupuk_tgl_rabuk">Tanggal Rabuk Pupuk *</label>

                <input type="date" name="ks_pupuk_tgl_rabuk" class="form-control form-control-lg @error('ks_pupuk_tgl_rabuk') is-invalid @enderror" id="ks_pupuk_tgl_rabuk" placeholder=" " value="{{ old('ks_pupuk_tgl_rabuk', $kspupuks->ks_pupuk_tgl_rabuk) }}">

                @error('ks_pupuk_tgl_rabuk')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenis Pupuk -->
            <div class="form-group">
                <label for="jenispupuk_id">Jenis Pupuk</label>

                <select class="form-control form-control-lg  @error('jenispupuk_id') is-invalid @enderror" id="jenispupuk_id" name="jenispupuk_id">
                    <option selected disabled>--- pilih jenis pupuk yang digunakan ---</option>
                    @foreach ($jenispupuks as $jenispupuk)
                        <option value="{{ $jenispupuk->id }}">{{ $jenispupuk->jenispupuk_nama }}</option>
                    @endforeach
                </select>
                
                @error('jenispupuk_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Merk Pupuk -->
            <div class="form-group mt-3">
                <label for="merkpupuk_id">Merk Pupuk *</label>

                <select class="form-control form-control-lg  @error('merkpupuk_id') is-invalid @enderror" id="merkpupuk_id" name="merkpupuk_id">
                    <option selected disabled>--- pilih merk pupuk yang digunakan ---</option>
                </select>

                @error('merkpupuk_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah Takaran Pupuk -->
            <div class="form-group">
                <label for="ks_pupuk_jumlah_takaran">Jumlah Takaran Pestisida *</label>

                <input type="number" step="0.01" name="ks_pupuk_jumlah_takaran" class="form-control form-control-lg @error('ks_pupuk_jumlah_takaran') is-invalid @enderror"value="{{ $kspupuks->ks_pupuk_jumlah_takaran }}">
                <div class="form-check">
                    <div class="">
                        <input class="inputan" type="radio" id="kilogram" name="stnPupuk" value="Kilogram" {{ $kspupuks->stnPupuk == "Kilogram" ? "checked" : "" }}>
                        <label>Kilogram</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="kuintal" name="stnPupuk" value="Kuintal" {{ $kspupuks->stnPupuk == "Kuintal" ? "checked" : "" }}>
                        <label>Kuintal</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="ton" name="stnPupuk" value="Ton" {{ $kspupuks->stnPupuk == "Ton" ? "checked" : "" }}>
                        <label>Ton</label>
                    </div>
                </div>

                @error('ks_pupuk_jumlah_takaran')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keterangan Kegiatan Pupuk -->
            <div class="form-group">
                <label for="ks_pupuk_keterangan">Keterangan Kegiatan</label>
                <textarea class="form-control form-control-lg" name="ks_pupuk_keterangan" id="ks_pupuk_keterangan" rows="3">{{ $kspupuks->ks_pupuk_keterangan }}</textarea>
            </div>

            <!-- Buttom Submit dan Cancel -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-3">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Script AJAX Merk Pupuk -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
    });

   $(document).ready(function(){
        $("#jenispupuk_id").change(function(){
            var jenispupuk_id = $(this).val();

            if (jenispupuk_id == "") {
                var jenispupuk_id = 0;
            } 

            $.ajax({
                url: '{{ url("/fetch-merkpupuks/") }}/'+jenispupuk_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {                    
                    $('#merkpupuk_id').find('option:not(:first)').remove();
                
                    if (response['merkpupuks'].length > 0) {
                        $.each(response['merkpupuks'], function(key,value){
                            $("#merkpupuk_id").append("<option value='"+value['id']+"'>"+value['merkpupuk_nama']+"</option>")
                        });
                    } 
                }
            });            
        });
   });
</script>

@endsection