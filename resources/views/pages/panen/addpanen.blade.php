@extends('layouts.mother')

@section('container')

<div class="row justify-content-center">
    <div class="col-7" style="background-color: #ffffff;">
        <div class="card-header mt-3">
            <a href="/viewpanen" class="btn btn-sm btn-outline-secondary mt-1">
                <i class="menu-icon mdi mdi-arrow-left"></i>
            </a>
            <h5 class="card-title mt-3">Form Tambah Data Hasil Panen</h5>
            <p class="mt-1">Di bawah ini terdapat sebuah formulir yang digunakan untuk menambahkan data tentang hasil panen, dengan tujuan untuk mengumpulkan informasi tentang kegiatan panen yang telah dilakukan.</p>
        </div>

        <form action="/storepanen" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- [Hidden : lokasisawah_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="lokasisawah_id" id="lokasisawah_id" value="{{ $users->lokasisawah_id }}">
            </div>

            <!-- [Hidden : kegiatansawah_id ] -->
            <div class="form-group mt-3">
                <input type="hidden" name="id" id="id" value="{{ $users->id }}">
            </div>

            <!-- Tanggal Panen -->
            <div class="form-group mt-3">
                <label for="panen_tanggal">Tanggal Panen *</label>

                <input type="date" name="panen_tanggal" class="form-control form-control-lg @error('panen_tanggal') is-invalid @enderror" id="panen_tanggal" placeholder=" ">

                @error('panen_tanggal')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah Panen -->
            <div class="form-group mt-3">
                <label for="panen_jumlah">Jumlah Panen *</label>

                <input type="number" step="0.01" name="panen_jumlah" class="form-control form-control-lg @error('panen_jumlah') is-invalid @enderror" value="{{ old('panen_jumlah') }}">
                
                <div class="form-check">
                    <div class="">
                        <input class="inputan" type="radio" id="kilogram" name="stnPanen" value="Kilogram">
                        <label>Kilogram</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="kuintal" name="stnPanen" value="Kuintal">
                        <label>Kuintal</label>
                    </div>
                    <div class="">
                        <input class="inputan" type="radio" id="ton" name="stnPanen" value="Ton">
                        <label>Ton</label>
                    </div>
                </div>

                @error('panen_jumlah')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Penebas -->
            <div class="form-group mt-3">
                <label for="pengepul_id">Nama Pengepul *</label>
                <select class="cari form-control" name="cari" id="pengepul_id"></select>
            </div>

            <!-- Harga Panen -->
            <div class="form-group mt-3">
                <label for="panen_harga">Harga Panen yang disepakati *</label>

                <input type="text" name="panen_harga" id="rupiah" class="form-control form-control-lg @error('panen_harga') is-invalid @enderror" value="{{ old('panen_harga') }}">

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

                @error('panen_harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hidden: Status panen -->
            <div class="form-group">
                <input type="hidden" name="panen_status" value="verify">
            </div>

            <!-- Hidden: Status dari pengepul -->
            <div class="form-group">
                <input type="hidden" name="statusdaripengepul" value="0">
            </div>
            
            <!-- Buttom Submit dan Cancel -->
            <div class="d-flex justify-content-center">
                <?php
                    if ($reviewpanen == "datakosong") {
                        echo  "<button class='btn btn-primary' type='submit'>Jual</button>";
                    } else {
                        foreach ($reviewpanen as $verifypanen) {
                            if ($verifypanen->kegiatansawah_id == $id) {
                                echo   "<button class='btn btn-success' type='submit' disabled>Jual</button>";
                                echo "<br>";
                                echo "Data Sudah Terisi";
                            } else {
                                echo  "<button class='btn btn-success' type='submit'>Jual</button>";
                            }
                        }
                    }
                ?>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $('.cari').select2({
        placeholder: 'Cari nama pengepul...',
        ajax: {
            url: '/cari',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.pengepul_nama + ' - ' + item.pengepul_kabupaten + ' - ' + item.pengepul_alamat,
                            id: item.id 
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

@endsection