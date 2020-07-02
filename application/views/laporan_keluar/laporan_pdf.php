<?php

if (empty($tanggal_a) || empty($tanggal_b)) {
    $query = $this->db->query("SELECT *, sum(trans_detail.jumlah) as total
                                FROM trans
                                INNER JOIN trans_detail ON trans.notrans = trans_detail.notrans
                                GROUP BY trans.notrans
                                ");
} else {
    $query = $this->db->query("SELECT *, sum(trans_detail.jumlah) as total
                                FROM trans
                                INNER JOIN trans_detail ON trans.notrans = trans_detail.notrans
                                WHERE trans.datetime >= '$tanggal_a . 00:00:00' AND trans.datetime <= '$tanggal_b . 23:59:59'
                                GROUP BY trans.notrans");
}

?>
<html>
<style>
.body {
  font-family: "Times New Roman", Times, serif;
}
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: grey;
  color: white;
  text-align: center;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
<body class="body">
<center><h2>HELLO PRINT</h2>
<h3>LAPORAN BARANG KELUAR</h3>
</center>

<div class="box-body">
    <div style="padding-bottom: 10px;">
    <table class='table table-bordered' width="100%" >
        <tr>
            <td>No</td>
            <td>No trans</td>
            <td>Ket</td>
            <td>Jumlah</td>
        </tr>
        <?php
$no = 1;
foreach ($query->result_array() as $data) {
    ?>
        <tr>
            <td> <?php echo $no; ?></td>
            <td> <?php echo $data['notrans']; ?></td>
            <td> <?php echo $data['ket']; ?></td>
            <td> <?php echo rupiah($data['total']); ?></td>
        </tr>
        <?php $no++?>
        <?php }?>
</table>
</div>
</div>
<div class="footer">
  <p>Dicetak tanggal <?php echo date('Y-m-d H:i:s'); ?></p>
</div>
</body>
</html>