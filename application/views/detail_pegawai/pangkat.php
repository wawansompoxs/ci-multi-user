<?php
// fungsi buatRupiah
function buatRupiah($angka)
{
    $hasil = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil;
}
$data_pangkat = query("SELECT * FROM pangkat WHERE nip='$nip' ORDER BY tmt_pangkat");
?>
<div class="table-responsive mt-3">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Pangkat / Golongan</th>
                <th>Nama Pengesah SK</th>
                <th>No SK</th>
                <th>Gaji Pokok</th>
                <th>Status pangkat</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data_pangkat as $pangkat) :
            ?>
                <tr>
                    <td><?= ucwords($pangkat['nama_pangkat']) ?> - <?= ucwords($pangkat['jenis_pangkat']) ?> <br />
                    <span class="text-blue font-small">TMT : <?= date('d-m-Y', strtotime($pangkat['tmt_pangkat'])) ?> </span>
                    </td>
                    <td><?= ucwords($pangkat['nama_pengesah_sk']) ?></td>
                    <td><?= ucwords($pangkat['no_sk']) ?> <br />
                    <span class="text-blue font-small">Tanggal : <?= date('d-m-Y', strtotime($pangkat['sah_sk'])) ?></span>
                    </td>
                    <td><?= buatRupiah(ucwords($pangkat['gapok'])) ?></td>
                    <td><?= ucwords($pangkat['status_pangkat']) ?></td>
                    <td>
                        <a href="<?= base_url('detail_pegawai/edit_pangkat') ?>?id=<?= $pangkat['id_pangkat'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <a href="<?= base_url('_config/proses_pangkat') ?>?set&id=<?= $pangkat['id_pangkat'] ?>&nip=<?= $nip ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Setup</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= base_url('pangkat') ?>?nip=<?= $data_detail[0]['nip']?>" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Pangkat</a>
</div>