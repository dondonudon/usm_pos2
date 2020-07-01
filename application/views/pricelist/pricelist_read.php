<div class="content-wrapper">

<section class="content">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">pricelist Read</h3>
        </div>

		<form action="<?php echo $action; ?>" method="post">
<table class='table table-bordered>'>
<?php

$query       = $this->db->query("SELECT barang FROM mst_barang WHERE id= '$id_barang'")->row();
$nama_barang = $query->barang;
?>
	    <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
		<?php
$query = $this->db->query("SELECT pricelist.id, pricelist.id_barang, pricelist.range_pricelist, pricelist.harga, range_pricelist.nama FROM pricelist INNER JOIN range_pricelist ON pricelist.range_pricelist = range_pricelist.id WHERE pricelist.id_barang = '$id_barang' ORDER BY range_pricelist.id")->result_array();

foreach ($query as $key) {
 echo "<tr><td width='200'><input type=\"hidden\" name=\"range_pricelist[]\" id=\"range_pricelist[]\" value=" . $key['range_pricelist'] . " readonly><input type=\"hidden\" name=\"id[]\" id=\"id[]\" value=" . $key['id'] . " readonly>";
 echo $key['nama'] . "</td>";
 echo "<td><input type=\"text\" class=\"form-control\" name=\"harga[]\" id=\"harga[]\" placeholder=\"Harga\" value=" . $key['harga'] . "></td></tr>";
 //  echo $key['range_pricelist'];
 //  echo $key['nama'];
}
?>
	    <!-- <tr><td>Harga</td><td><input type="text" id="harga" name="harga" value="<?php echo $harga; ?>"></td></tr> -->
		<input type="hidden" id="id_barang" name="id_barang" value= <?php echo $id_barang; ?>>
	    <tr><td></td><td><button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button><a href="<?php echo site_url('pricelist') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
	</form>
</div>
</div>
</div>