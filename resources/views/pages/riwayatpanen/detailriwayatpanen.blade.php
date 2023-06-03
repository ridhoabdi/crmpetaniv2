@extends('layouts.mother')

@section('container')

<div class="card p-3 shadow-sm">
    <div class="card-header">
        <h5>Detail Riwayat Panen</h5>
    </div>
    <ul class="list-group mt-3">
        <li class="list-group-item mt-3">
            @foreach ($panens as $panen)
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header mb-3">
                            <h5>Identitas Petani</h5>
                        </div>
                        <table>
                            <tr>
                                <th>Nama Petani</th>
                                <td>{{ $panen->pemilik_nama}}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $panen->pemilik_jeniskelamin }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ \Carbon\Carbon::parse($panen->pemilik_tanggal_lahir)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td>{{ $panen->pemilik_kontak }}</td>
                            </tr>
                            <tr>
                                <th>IoT ID</th>
                                <td>{{ $panen->iot_id ? $panen->iot_id : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten</th>
                                <td>{{ $panen->kabupaten_nama }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan Lokasi Sawah</th>
                                <td>{{ $panen->lokasisawah_keterangan }}</td>
                            </tr>
                        </table>
                        <div class="card-header mb-3 mt-4">
                            <h5>Kegiatan Penanaman Bawang</h5>
                        </div>
                        <table>
                            <tr>
                                <th>Waktu Tanam</th>
                                <td>{{ \Carbon\Carbon::parse($panen->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pengairan</th>
                                <td>{{ $panen->ks_metode_pengairan }}</td>
                            </tr>
                            <tr>
                                <th>Varietas Bawang Merah</th>
                                <td>{{ $panen->varietasbawang_nama }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Bibit</th>
                                <td>{{ number_format($panen->ks_jumlah_bibit, 0, ',', '.') }} kg</td>
                            </tr>
                            <tr>
                                <th>Luas Lahan</th>
                                <td>{{ number_format($panen->ks_luas_lahan, 0, ',', '.') }} m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <th>Status Lahan</th>
                                <td>{{ $panen->ks_status_lahan}}</td>
                            </tr>
                            <tr>
                                <th>Sumber Modal</th>
                                <td>{{ $panen->ks_sumber_modal}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Modal</th>
                                <td>{{ 'Rp ' . number_format($panen->ks_jumlah_modal, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                        <div class="card-header mb-3 mt-4">
                            <h5>Hasil Panen</h5>
                        </div>
                        <table>
                            <tr>
                                <th>Tanggal Panen</th>
                                <td>{{ \Carbon\Carbon::parse($panen->panen_tanggal)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Panen</th>
                                <td>{{ number_format($panen->panen_jumlah, 0, ',', '.') }} kg</td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td>{{ 'Rp ' . number_format($panen->panen_harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Grade A (Bagus) </th>
                                <td>{{ number_format($panen->panen_kualitas_a, 0, ',', '.') ? $panen->panen_kualitas_a : '-' }} kg </td>
                            </tr>
                            <tr>
                                <th>Grade B (Sedang) </th>
                                <td>{{ number_format($panen->panen_kualitas_b, 0, ',', '.') ? $panen->panen_kualitas_b : '-' }} kg </td>
                            </tr>
                            <tr>
                                <th>Grade C (Buruk) </th>
                                <td>{{ number_format($panen->panen_kualitas_c, 0, ',', '.') ? $panen->panen_kualitas_c : '-' }} kg </td>
                            </tr>
                            <tr>
                                <th>Nama Pengepul</th>
                                <td>{{ $panen->pengepul_nama}}</td>
                            </tr>
                            <tr>
                                <th>Kontak Pengepul</th>
                                <td>{{ $panen->pengepul_kontak}}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten</th>
                                <td>{{ $panen->pengepul_kabupaten}}</td>
                            </tr>
                            <tr>
                                <th>Alamat Pengepul</th>
                                <td>{{ $panen->pengepul_alamat}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach

            @foreach ($kspupuks as $index => $kspupuk)
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header mb-3 mt-3">
                            <h5>Kegiatan Pupuk</h5>
                        </div>
                        <table>
                            <tr>
                                <th style="background-color: white; color: green;" class="mt-2">Kegiatan Pupuk ke - {{ $index + 1 }}</th>
                            </tr>
                            <tr>
                                <th>Tanggal Rabuk Pupuk</th>
                                <td>{{ \Carbon\Carbon::parse($kspupuk->ks_pupuk_tgl_rabuk)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pupuk</th>
                                <td>{{ $kspupuk->jenispupuk_nama}}</td>
                            </tr>
                                <tr>
                                <th>Merk Pupuk</th>
                                <td>{{ $kspupuk->merkpupuk_nama}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Takaran Pupuk</th>
                                <td>{{ number_format($kspupuk->ks_pupuk_jumlah_takaran) }} kg</td>
                            </tr>
                            <tr>
                                <th>Keterangan Kegiatan Pupuk</th>
                                <td>{{ $kspupuk->ks_pupuk_keterangan ? $kspupuk->ks_pupuk_keterangan : '-' }}</td>

                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach

            @foreach ($kspestisidas as $index => $kspestisida)
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header mb-3 mt-3">
                            <h5>Kegiatan Pestisida</h5>
                        </div>
                        <table>
                            <tr>
                                <th style="background-color: white; color: blue;" class="mt-2">Kegiatan Pestisida ke - {{ $index + 1 }}</th>
                            </tr>
                            <tr>
                                <th>Tanggal Semprot Pestisida</th>
                                <td>{{ \Carbon\Carbon::parse($kspestisida->ks_pestisida_tgl_semprot)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pestisida</th>
                                <td>{{ $kspestisida->pestisida_nama}}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Takaran Pestisida</th>
                                <td>{{ number_format($kspestisida->ks_pestisida_jumlah_takaran, 1) }} liter</td>
                            </tr>
                            <tr>
                                <th>Keterangan Kegiatan Pestisida</th>
                                <td>{{ $kspestisida->ks_pestisida_keterangan ? $kspestisida->ks_pestisida_keterangan : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach
        </li>
    </ul>
</div>

@endsection