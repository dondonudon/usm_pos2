<?php
$data = $this->db->query("SELECT
                            po.no_po, po.ket, po.datetime, mst_barang.barang,
                            po_detail.id_barang, po_detail.harga, po_detail.qty, po_detail.jumlah

                          FROM
                            po
                          INNER JOIN po_detail  ON po.no_po = po_detail.no_po
                          INNER JOIN mst_barang ON po_detail.id_barang = mst_barang.id
                          WHERE
                            po.no_po = '$no_po'");
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
					<?php echo $row->no_po; ?>
				<td width="100px">Tanggal</td>
				<td width="100px">
					<?php echo $row->datetime; ?>

      </tr>
			<tr>
        <td>Keterangan</td>
        <td colspan="3"><?php echo $row->ket; ?></td>
			</>
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