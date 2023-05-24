@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8" style="background-color: #ffffff;">
        <div class="card-header mt-3">
            <a href="/viewlokasisawah" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>

            <h5 class="card-title mt-3">Form Edit Data Lokasi Sawah</h5>
            <p class="mt-1">Silakan mengubah formulir di bawah ini dengan data lokasi sawah yang baru.</p>
        </div>

        <form action="/updatelokasisawah/{{ $lokasisawahs->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Latitude -->
            <div class="form-group mt-3">
                <label for="iot_id">IoT ID</label>
                <input type="number" name="iot_id" class="form-control form-control-lg" id="iot_id" value="{{ $lokasisawahs->iot_id }}">
            </div>

            <!-- Latitude -->
            <div class="form-group mt-3">
                <label for="lokasisawah_latitude">Latitude</label>
                <input type="number" name="lokasisawah_latitude" class="form-control form-control-lg" id="lokasisawah_latitude" value="{{ $lokasisawahs->lokasisawah_latitude }}">
            </div>

            <!-- Longitude -->
            <div class="form-group">
                <label for="lokasisawah_longitude">Longitude</label>
                <input type="number" name="lokasisawah_longitude" class="form-control form-control-lg" id="lokasisawah_longitude" value="{{ $lokasisawahs->lokasisawah_longitude }}">
            </div>

            <!-- Kabupaten -->
            <div class="form-group">
                <label for="kabupaten_id">Kabupaten *</label>
                <select class="form-control form-control-lg @error('kabupaten_id') is-invalid @enderror" name="kabupaten_id" id="kabupaten_id">
                    <option selected disabled>--- pilih Kabupaten ---</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ $kabupaten->id == $lokasisawahs->kabupaten_id ? 'selected' : '' }}>{{ $kabupaten->kabupaten_nama }}</option>
                    @endforeach
                </select>
                @error('kabupaten_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat Lokasi Sawah -->
            <div class="form-group">
                <label for="lokasisawah_keterangan">Keterangan Lokasi Sawah</label>
                <textarea class="form-control form-control-lg" name="lokasisawah_keterangan" id="lokasisawah_keterangan" rows="3">{{ $lokasisawahs->lokasisawah_keterangan }}</textarea>
            </div>

            <!-- Button Submit dan Cancel -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-3">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection