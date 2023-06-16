@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card-header mt-3">
            <a href="/viewprofilpetani" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>

            <h5 class="card-title mt-3">Form Edit Data Profil</h5>
            <p class="mt-1" style="font-size: 16px;">Silakan Bapak/Ibu dapat mengubah data profil dibawah ini</p>
        </div>

        <form action="/updateprofilpetani/{{ $data->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Petani -->
            <div class="form-group mt-3">
                <label for="pemilik_nama">Nama Petani *</label>

                <input type="text" name="pemilik_nama" class="form-control form-control-lg @error('pemilik_nama') is-invalid @enderror" id="pemilik_nama" placeholder=" " value="{{ old('pemilik_nama', $data->pemilik_nama) }}">

                @error('pemilik_nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group mt-4">
                <label for="pemilik_jeniskelamin">Jenis Kelamin *</label>
                <select id="pemilik_jeniskelamin" name="pemilik_jeniskelamin" class="form-control form-control-lg @error('pemilik_jeniskelamin') is-invalid @enderror" required>
                    <option value="" disabled selected>--- Pilih jenis kelamin ---</option>
                    <option value="Laki-laki" {{ old('pemilik_jeniskelamin', $data->pemilik_jeniskelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('pemilik_jeniskelamin', $data->pemilik_jeniskelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('pemilik_jeniskelamin')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Lahir -->
            <div class="form-group mt-4">
                <label for="pemilik_tanggal_lahir">Tanggal Lahir *</label>
                <input type="date" name="pemilik_tanggal_lahir" class="form-control form-control-lg @error('pemilik_tanggal_lahir') is-invalid @enderror" id="pemilik_tanggal_lahir" value="{{ old('pemilik_tanggal_lahir', $data->pemilik_tanggal_lahir) }}" required autofocus placeholder=" ">
                @error('pemilik_tanggal_lahir')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kontak -->
            <div class="form-group mt-3">
                <label for="pemilik_kontak">Nomor HP *</label>

                <input type="text" name="pemilik_kontak" class="form-control form-control-lg @error('pemilik_kontak') is-invalid @enderror" id="pemilik_kontak" placeholder=" " value="{{ old('pemilik_kontak', $data->pemilik_kontak) }}">

                @error('pemilik_kontak')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pendidikan -->
            <div class="form-group mt-4">
                <label for="pemilik_pendidikan">Pendidikan *</label>
                <select id="pemilik_pendidikan" name="pemilik_pendidikan" class="form-control form-control-lg @error('pemilik_pendidikan') is-invalid @enderror" required>
                    <option value="" disabled selected>--- Pilih jenjang pendidikan ---</option>
                    <option value="Tidak Lulus SD" {{ old('pemilik_pendidikan', $data->pemilik_pendidikan) == 'Tidak Lulus SD' ? 'selected' : '' }}>Tidak Lulus SD</option>
                    <option value="SD" {{ old('pemilik_pendidikan', $data->pemilik_pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('pemilik_pendidikan', $data->pemilik_pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ old('pemilik_pendidikan', $data->pemilik_pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="Diploma" {{ old('pemilik_pendidikan', $data->pemilik_pendidikan) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                    <option value="Sarjana" {{ old('pemilik_pendidikan', $data->pemilik_pendidikan) == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                </select>
                @error('pemilik_pendidikan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group mt-4">
                <label for="password">Password *</label>
                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
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