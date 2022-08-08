<?php
$data_pegawai = query("SELECT * FROM pegawai WHERE nip='$nip'");
?>
<table class="text-dark mt-3">
    <tr>
        <td>NIP</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['nip'] ?></td>
    </tr>
    <tr>
        <td>Nama Lengkap</td>
        <td>:</td>
        <td><?= strlen($data_pegawai[0]['gelar_dpn']) > 0 ? $data_pegawai[0]['gelar_dpn'] . ". " : "" ?><?= ucwords($data_pegawai[0]['nama_pegawai']) ?><?= strlen($data_pegawai[0]['gelar_blkg']) > 0 ? ", " . $data_pegawai[0]['gelar_blkg'] : "" ?></td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td><?= ucwords($data_pegawai[0]['tempat_lahir']) . ', ' . date('d-m-Y', strtotime($data_pegawai[0]['tanggal_lahir'])) ?> </td>
    </tr>
    <tr>
        <td>Agama</td>
        <td>:</td>
        <td><?= ucwords($data_pegawai[0]['agama']) ?> </td>
    </tr>
    <tr>
        <td>Usia</td>
        <td>:</td>
        <td> </td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?= ucwords($data_pegawai[0]['jenis_kelamin']) ?> </td>
    </tr>
    <tr>
        <td>Golongan Darah</td>
        <td>:</td>
        <td><?= strtoupper($data_pegawai[0]['gol_darah']) ?> </td>
    </tr>
    <tr>
        <td>Status Perkawinan</td>
        <td>:</td>
        <td><?= ucwords($data_pegawai[0]['status_pernikahan']) ?> </td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['nik'] ?> </td>
    </tr>
    <tr>
        <td>No. HP</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['no_hp'] ?> </td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['email'] ?> </td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?= ucwords($data_pegawai[0]['alamat']) ?> </td>
    </tr>
    <tr>
        <td>No. NPWP</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['npwp'] ?> </td>
    </tr>
    <tr>
        <td>No. BPJS</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['bpjs'] ?> </td>
    </tr>
    <tr>
        <td>Status Kepegawaian</td>
        <td>:</td>
        <td><?= strtoupper($data_pegawai[0]['status_kepegawaian']) ?> </td>
    </tr>
    <tr>
        <td>Karpeg</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['karpeg'] ?> </td>
    </tr>
    <tr>
        <td>No. SK CPNS</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['sk_cpns'] ?> </td>
    </tr>
    <tr>
        <td>TMT CPNS</td>
        <td>:</td>
        <td><?= date('d-m-Y', strtotime($data_pegawai[0]['tmt_cpns'])) ?> </td>
    </tr>
    <tr>
        <td>No. SK PNS</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['sk_pns'] ?> </td>
    </tr>
    <tr>
        <td>TMT PNS</td>
        <td>:</td>
        <td><?= date('d-m-Y', strtotime($data_pegawai[0]['tmt_pns'])) ?> </td>
    </tr>
    <tr>
        <td>Golongan Awal</td>
        <td>:</td>
        <td><?= $data_pegawai[0]['gol_awal'] ?> </td>
    </tr>
    <?php
    $awal  = date_create($data_pegawai[0]['tmt_cpns']);
    $akhir = date_create(); // waktu sekarang
    $diff  = date_diff($awal, $akhir);
    ?>
    <tr>
        <td>Masa Kerja</td>
        <td>:</td>
        <td><?= $diff->y + $data_pegawai[0]['mk_thn'] . ' tahun'; ?> <?= $diff->m + $data_pegawai[0]['mk_bln'] . ' bulan'; ?></td>
    </tr>
</table>