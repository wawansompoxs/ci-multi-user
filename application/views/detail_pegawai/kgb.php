<?php
$data_kgb = query("SELECT * FROM kgb WHERE nip='$nip'");
?>
<div class="table-responsive mt-3">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Pangkat / Golongan</th>
                <th>Tangal SK</th>
                <th>Nama Pengesah SK</th>
                <th>No SK</th>
                <th>Gaji Pokok</th>
                <th>Masa Kerja</th>
                <th>Status pangkat</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data_kgb as $kgb) :
            ?>
                <tr>
                    <td><?= ucwords($kgb['pangkat']) ?> <br />
                    <span class="text-blue font-small">TMT KGB: <?= date('d-m-Y', strtotime($kgb['tmt_kgb'])) ?> </span>
                    </td>
                    <td><?= ucwords($kgb['nama_pengesah_sk']) ?>
                </td>
                    <td><?= ucwords($kgb['no_sk']) ?> <br />
                    <span class="text-blue font-small">Tanggal : <?= date('d-m-Y', strtotime($kgb['tanggal_sk'])) ?></span>
                    </td>
                    <td><?= buatRupiah(ucwords($kgb['gapok'])) ?></td>
                    <td><?= ucwords($kgb['mk_thn_kgb']) ?> Tahun <?= ucwords($kgb['mk_bln_kgb']) ?> Bulan</td>
                    <td><?= ucwords($kgb['status_kgb']) ?></td>
                    <td>
                        <a href="<?= base_url('detail_pegawai/edit_kgb') ?>?id=<?= $kgb['id_kgb'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <a href="<?= base_url('_config/proses_kgb') ?>?set&id=<?= $kgb['id_kgb'] ?>&nip=<?= $nip ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Setup</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= base_url('kgb') ?>?nip=<?= $data_detail[0]['nip']?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah KGB</a>
</div>