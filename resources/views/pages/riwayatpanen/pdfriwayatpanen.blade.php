<!DOCTYPE html>
<html>
<head>
    <title>Data Riwayat Panen Bawang Merah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .section-content {
            margin-left: 20px;
            font-size: 14px;
        }
        .section-content p {
            margin: 5px 0;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Riwayat Panen Bawang Merah</h1>
        <hr>
    </div>
    @foreach ($panens as $panen)
        <div class="section">
            <div class="section-title">Identitas Petani</div>
            <div class="section-content">
                <table>
                    <tr>
                        <td style="width: 150px;">Nama Petani</td>
                        <td> : {{ $panen->pemilik_nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Tanggal Lahir</td>
                        <td> : {{ \Carbon\Carbon::parse($panen->pemilik_tanggal_lahir)->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Pendidikan</td>
                        <td> : {{ $panen->pemilik_pendidikan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Kontak</td>
                        <td> : {{ $panen->pemilik_kontak }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">ID IoT</td>
                        <td> : {{ $panen->iot_id ? $panen->iot_id : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Kabupaten</td>
                        <td> : {{ $panen->kabupaten_nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Alamat Lokasi Sawah</td>
                        <td> : {{ $panen->lokasisawah_keterangan ? $panen->lokasisawah_keterangan : '-' }}</td>
                    </tr>
                </table>
            </div>  
        </div>
        <div class="section">
            <div class="section-title">Rincian Panen</div>
            <div class="section-content">
                <table>
                    <tr>
                        <td style="width: 150px;">Tanggal Panen</td>
                        <td> : {{ \Carbon\Carbon::parse($panen->panen_tanggal)->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Nama Pengepul</td>
                        <td> : {{ $panen->pengepul_nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Kontak</td>
                        <td> : {{ $panen->pengepul_kontak }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Kabupaten</td>
                        <td> : {{ $panen->pengepul_kabupaten }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Alamat Pengepul</td>
                        <td> : {{ $panen->pengepul_alamat }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Jumlah Panen</td>
                        <td> : {{ number_format($panen->panen_jumlah, 0, ',', '.') }} kg</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Harga Jual</td>
                        <td> : {{ 'Rp ' . number_format($panen->panen_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Grade A (Bagus)</td>
                        <td> : {{ number_format($panen->panen_kualitas_a, 0, ',', '.') ? $panen->panen_kualitas_a : '-' }} kg </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Grade B (Sedang)</td>
                        <td> : {{ number_format($panen->panen_kualitas_b, 0, ',', '.') ? $panen->panen_kualitas_b : '-' }} kg </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Grade C (Buruk)</td>
                        <td> : {{ number_format($panen->panen_kualitas_c, 0, ',', '.') ? $panen->panen_kualitas_c : '-' }} kg </td>
                    </tr>
                </table>
            </div>  
        </div>
        <div class="section">
            <div class="section-title">Kegiatan Penanaman Bawang</div>
            <div class="section-content">
                <table>
                    <tr>
                        <td style="width: 150px;">Waktu Tanam</td>
                        <td> : {{ \Carbon\Carbon::parse($panen->ks_waktu_tanam)->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Metode Pengairan</td>
                        <td> : {{ $panen->ks_metode_pengairan }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Jumlah Bibit</td>
                        <td> : {{ number_format($panen->ks_jumlah_bibit, 0, ',', '.') }} kg</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Luas Lahan</td>
                        <td> : {{ number_format($panen->ks_luas_lahan, 0, ',', '.') }} m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Status Lahan</td>
                        <td> : {{ $panen->ks_status_lahan}}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Sumber Modal</td>
                        <td> : {{ $panen->ks_sumber_modal }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Jumlah Modal</td>
                        <td> : {{ 'Rp ' . number_format($panen->ks_jumlah_modal, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>  
        </div>
    @endforeach

    
    <div class="section">
        <div class="section-title">Kegiatan Pupuk</div>
        <div class="section-content">
        @foreach ($kspupuks as $index => $kspupuk)
            <table>
                <tr>
                    <th style="width: 170px;">Kegiatan Pupuk ke - {{ $index + 1 }}</th>
                </tr>
                <tr>
                    <td style="width: 170px;">Tanggal Rabuk Pupuk</td>
                    <td> : {{ \Carbon\Carbon::parse($kspupuk->ks_pupuk_tgl_rabuk)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <td style="width: 170px;">Jenis Pupuk</td>
                    <td> : {{ $kspupuk->jenispupuk_nama }}</td>
                </tr>
                <tr>
                    <td style="width: 170px;">Merk Pupuk</td>
                    <td> : {{ $kspupuk->merkpupuk_nama }}</td>
                </tr>
                <tr>
                    <td style="width: 170px;">Jumlah Takaran</td>
                    <td> : {{ number_format($kspupuk->ks_pupuk_jumlah_takaran, 0, ',', '.') }} kg</td>
                </tr>
                <tr>
                    <td style="width: 150px;">Keterangan Kegiatan</td>
                    <td> : {{ $kspupuk->ks_pupuk_keterangan ? $kspupuk->ks_pupuk_keterangan : '-' }}</td>
                </tr>
            </table>
            <br>
        @endforeach
        </div>  
    </div>

    <div class="section">
        <div class="section-title">Kegiatan Pestisida</div>
        <div class="section-content">
        @foreach ($kspestisidas as $index => $kspestisida)
            <table>
                <tr>
                    <th style="width: 170px;">Kegiatan Pestisida ke - {{ $index + 1 }}</th>
                </tr>
                <tr>
                    <td style="width: 170px;">Tanggal Semprot Pestisida</td>
                    <td> : {{ \Carbon\Carbon::parse($kspestisida->ks_pestisida_tgl_semprot)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <td style="width: 170px;">Nama Pestisida</td>
                    <td> : {{ $kspestisida->pestisida_nama }}</td>
                </tr>
                <tr>
                    <td style="width: 170px;">Jumlah Takaran</td>
                    <td> : {{ number_format($kspestisida->ks_pestisida_jumlah_takaran, 0, ',', '.') }} liter</td>
                </tr>
                <tr>
                    <td style="width: 150px;">Keterangan Kegiatan</td>
                    <td> : {{ $kspestisida->ks_pestisida_keterangan ? $kspestisida->ks_pestisida_keterangan : '-' }}</td>
                </tr>
            </table>
            <br>
        @endforeach
        </div>  
    </div>
    
    