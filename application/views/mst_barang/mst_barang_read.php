<div class="content-wrapper">

<section class="content">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Mst_barang Read</h3>
        </div>
<?php
if ($use_pricelist == '1') {
    $pricelist = "Ya";
} else {
    $pricelist = "Tidak";
}

if ($use_stok == '1') {
    $sstok = "Ya";
} else {
    $sstok = "Tidak";
}
?>

<table class='table table-bordered>'>
	    <tr><td>Barang</td><td><?php echo $barang; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
	    <tr><td>Kategori</td><td><?php echo $id_kategori; ?></td></tr>
	    <tr><td>Stok</td><td><?php echo $stok; ?></td></tr>
	    <tr><td>Ukuran</td><td><?php echo $ukuran; ?></td></tr>
	    <tr><td>Pakai Pricelist</td><td><?php echo $pricelist; ?></td></tr>
	    <tr><td>Pakai Stok</td><td><?php echo $sstok; ?></td></tr>
		<tr><td>Datetime</td><td><?php echo $datetime; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('mst_barang') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>

</div>
</div>
</div>