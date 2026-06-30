<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Keterangan Izin Keluar Santri</title>
    <style>
        @page { margin: 24mm 22mm 22mm 22mm; }
        body { font-family: "Times New Roman", Times, serif; color: #111827; font-size: 12pt; line-height: 1.55; }
        .kop-table { width: 100%; border-bottom: 3px double #111827; padding-bottom: 12px; margin-bottom: 26px; }
        .logo-box { width: 70px; height: 70px; border: 2px solid #111827; border-radius: 50%; text-align: center; line-height: 70px; font-weight: bold; font-size: 16pt; }
        .kop-title { text-align: center; }
        .kop-title h2 { margin: 0; font-size: 16pt; letter-spacing: 0.5px; text-transform: uppercase; }
        .kop-title h3 { margin: 2px 0; font-size: 12pt; text-transform: uppercase; }
        .kop-title p { margin: 3px 0 0 0; font-size: 9.5pt; }
        .judul-surat { text-align: center; font-weight: bold; text-decoration: underline; font-size: 14pt; margin-top: 8px; margin-bottom: 2px; text-transform: uppercase; }
        .nomor-surat { text-align: center; margin-bottom: 28px; font-size: 11.5pt; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 22px; }
        .meta-table td { padding: 5px 0; vertical-align: top; }
        .meta-label { width: 180px; }
        .box-keterangan { border: 1px solid #d1d5db; padding: 12px 14px; margin: 18px 0; background-color: #f9fafb; font-size: 11pt; }
        .ttd-kanan { width: 260px; text-align: center; float: right; margin-top: 30px; }
        .nama-pejabat { font-weight: bold; text-decoration: underline; }
        .footer-note { position: fixed; bottom: -8mm; left: 0; right: 0; text-align: center; font-size: 8.5pt; color: #6b7280; border-top: 1px solid #e5e7eb; padding-top: 6px; }
    </style>
</head>
<body>
    <table class="kop-table">
        <tr>
            <td style="width: 82px; vertical-align: middle;">
                <div class="logo-box">PP</div>
            </td>
            <td class="kop-title">
                <h2>YAYASAN PONDOK PESANTREN SIMPEL-K</h2>
                <h3>Kecamatan Lowokwaru - Kota Malang</h3>
                <p>Jl. Jalur Lingkar Informatika No. 45, Malang, Telp. (0341) 888999, Kode Pos 65141</p>
            </td>
        </tr>
    </table>

    <div class="judul-surat">SURAT KETERANGAN IZIN KELUAR/PULANG</div>
    <div class="nomor-surat">Nomor: {{ $surat->nomor_surat }}</div>

    <p>Yang bertanda tangan di bawah ini, Kepala Pengurus Pondok Pesantren Simpel-K Malang, menerangkan bahwa permohonan izin keluar/pulang santri berikut telah tercatat dan disetujui oleh sistem layanan kesantrian:</p>

    <table class="meta-table">
        <tr>
            <td class="meta-label">Nomor Surat Jalan</td>
            <td>: {{ $surat->nomor_surat }}</td>
        </tr>
        <tr>
            <td class="meta-label">Nama Santri</td>
            <td>: {{ $surat->member->name ?? 'Santri Tidak Ditemukan' }}</td>
        </tr>
        <tr>
            <td class="meta-label">Tanggal Mulai Izin</td>
            <td>: {{ date('d F Y', strtotime($surat->tanggal_mulai_pulang)) }}</td>
        </tr>
        <tr>
            <td class="meta-label">Tanggal Wajib Kembali</td>
            <td>: {{ date('d F Y', strtotime($surat->tanggal_kembali)) }}</td>
        </tr>
        <tr>
            <td class="meta-label">Alasan Meninggalkan Pesantren</td>
            <td>: {{ $surat->alasan_pulang ?? 'Keperluan Keluarga' }}</td>
        </tr>
        <tr>
            <td class="meta-label">Status Berkas Lampiran</td>
            <td>: {{ $surat->berkas_pendukung ? 'Berkas Valid (Tersimpan di Sistem)' : 'Belum Tersedia' }}</td>
        </tr>
    </table>

    <div class="box-keterangan">
        Dokumen ini diterbitkan secara otomatis berdasarkan data permohonan perizinan santri yang valid pada aplikasi Simpel-K. Data cetakan ini sah digunakan sebagai bukti administratif santri selama berada di luar lingkungan pesantren.
    </div>

    <p style="text-align: justify;">Demikian surat keterangan izin ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya. Santri wajib kembali ke pondok tepat waktu sesuai dengan tanggal yang tertera di atas.</p>

    <div class="ttd-kanan">
        Malang, {{ date('d F Y') }}<br>
        Kepala Pengurus Kesantrian,
        <br><br><br><br>
        <span class="nama-pejabat">( Ustadz Pemrograman Web, M.Kom )</span><br>
        NIP. 199208122024121001
    </div>

    <div class="footer-note">
        Dicetak otomatis melalui Aplikasi Administrasi Digital Pondok Pesantren Simpel-K Malang
    </div>
</body>
</html>
