@extends('layouts.mother')

@section('container')

@if (session('success'))
    <div id="success-alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<script>
    setTimeout(function() {
        $('#success-alert').fadeOut('slow');
    }, 3000); // menampilkan notifikasi selama 3 detik
</script>

@if (session('error'))
    <div id="error-alert" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<script>
    setTimeout(function() {
        $('#error-alert').fadeOut('slow');
    }, 5000); // menampilkan notifikasi selama 5 detik
</script>

<div class="card p-3 shadow-sm">
    <div class="card-header">
        <h5>Data Panen</h5>
    </div>
    <ul class="list-group mt-3">
        <div class="card-header">
            <p class="">Silahkan tambahkan data panen berdasarkan kegiatan penanaman bawang yang telah dilakukan. Berikut adalah langkah-langkah yang dilakukan untuk mengisi data panen:</p>
            <p>1. Pilih <i class="menu-icon mdi mdi-plus btn-outline-success mx-1"></i> untuk menambahkan hasil panen<br> 2. Pilih <i class="menu-icon mdi mdi-pencil btn-outline-warning mx-1"></i> untuk mengedit hasil panen<br> 2. Pilih <i class="menu-icon mdi mdi-database btn-outline-primary mx-1"></i> untuk melakukan backup data
            </p>
        </div>
        @foreach ($panens as $panen)
            <li class="list-group-item mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <table>
                            <tr>
                                <th>Keterangan Lokasi Sawah</th>
                                <td>{{ $panen->lokasisawah_keterangan}}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten</th>
                                <td>{{ $panen->kabupaten_nama }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Tanam</th>
                                <td>{{ \Carbon\Carbon::parse($panen->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Luas Lahan</th>
                                <td>{{ number_format($panen->ks_luas_lahan, 0, ',', '.') }} m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th>Varietas Bawang Merah</th>
                                <td>{{ $panen->varietasbawang_nama }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Bibit</th>
                                <td>{{ number_format($panen->ks_jumlah_bibit, 0, ',', '.') }} kg</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-end align-items-center">
                            <?php
                            $dataPanen = $panen->ks_panen;
                            $idSawah = $panen->id;
                            if ($dataPanen == 0) {
                                echo "<form id='formverify' action='/verifypetani' method='post' enctype='multipart/form-data'>" . csrf_field() .
                                    "<input type='hidden' id='idSawahpetani' value=$idSawah name='idSawahpetani'>" .
                                    "<a href='/addpanen/{$panen->id}' class='btn btn-sm btn-outline-success mx-1'>" .
                                    "<i class='menu-icon mdi mdi-plus'></i> Hasil panen" .
                                    "</a>" .
                                    // "<input type='checkbox' id='verify-checkbox' value=1 name='verify-checkbox' onclick='isChecked()' class='mt-2 ms-3'>" .
                                    // "<p id='message' class='ms-1 mt-2'>Belum panen</p>" .
                                    "</form>";
                            } else {
                                echo "<input type='checkbox' id='verify-checkbox' onclick='isChecked()' checked disabled/>" .
                                    "<p id='message' class='mt-3 me-2 ms-1'>Sudah Panen</p>" .
                                    // "<a href='/addpanen/{$panen->id}' class='btn btn-sm btn-outline-success mx-1'>" .
                                    // "<i class='menu-icon mdi mdi-plus'></i> Masukkan hasil panen" .
                                    // "</a>".
                                    "<a href='#' class='btn btn-sm btn-outline-warning mx-1'>" .
                                    "<i class='menu-icon mdi mdi-pencil'></i> Edit panen" .
                                    "</a>".
                                    "<a href='/confirmbackup/{$panen->id}' class='btn btn-sm btn-outline-primary mx-1'>" .
                                    "<i class='menu-icon mdi mdi-database'></i> Backup Data" .
                                    "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection