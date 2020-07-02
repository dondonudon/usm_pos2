<?php
$data = $this->db->query("SELECT
                            trans.notrans, trans.ket, trans.datetime, mst_barang.barang,
                            trans_detail.id_barang, trans_detail.harga, trans_detail.qty, trans_detail.jumlah,
                            mst_customer.nama,mst_customer.alamat,mst_customer.telp
                          FROM
                            trans
                          INNER JOIN trans_detail  ON trans.notrans = trans_detail.notrans
                          INNER JOIN mst_barang ON trans_detail.id_barang = mst_barang.id
                          INNER JOIN mst_customer ON trans.id_customer = mst_customer.id
                          WHERE
                            trans.notrans = '$notrans'");
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
</center>

      <table class='table table-bordered table-striped'>

			<tr>
			<?php $row = $data->row();?>
				<td width="100px">No Transaksi</td>
				<td width="200px">
					<?php echo $row->notrans; ?>
				<td width="100px">Tanggal</td>
				<td width="100px">
					<?php echo $row->datetime; ?>

      </tr>
      <tr>
        <td>Nama</td>
        <td><?php echo $row->nama; ?></td>
        <td>Alamat</td>
        <td><?php echo $row->alamat; ?></td>
			</tr>
			<tr>
        <td>Telp</td>
        <td><?php echo $row->telp; ?></td>
        <td>Keterangan</td>
        <td><?php echo $row->ket; ?></td>
			</tr>
			</table>
<div class="box-body">
    <div style="padding-bottom: 10px;">
    <table class="table table-bordered table-striped" id="mydata">
			<thead>
				<tr>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>QTY</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody id="show_data">
      <?php
$sum = 0;
foreach ($data->result_array() as $isi) {?>
			<tr>
			<td><?php echo $isi['barang']; ?></td>
			<td><?php echo rupiah($isi['harga']); ?></td>
			<td><?php echo $isi['qty']; ?></td>
			<td><?php echo rupiah($isi['jumlah']); ?></td>
			</tr>
      <?php
$sum += $isi['jumlah'];
}
;?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">Total</td>
          <td><?php echo rupiah($sum); ?></td>
        </tr>
      </tfoot>
    </table>

</div>
</div>
<div class="footer">
  <p>Dicetak tanggal <?php echo date('Y-m-d H:i:s'); ?></p>
</div>
</body>
</html>