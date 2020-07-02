<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA MST_BARANG</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

<table class='table table-bordered'>

		<tr><td width='200'>Kategori <?php echo form_error('id_kategori') ?></td>
			<td>
				<?php echo select2_dinamis('id_kategori', 'mst_kategori', 'kategori', 'id', 'Kategori') ?>
			</td>
		</tr>
		<input type="hidden" id="pricelist_db" name="pricelist_db" value="<?php echo $use_pricelist; ?>">
		<input type="hidden" id="stok_db" name="stok_db" value="<?php echo $use_stok; ?>">

	    <tr><td width='200'>Nama Barang <?php echo form_error('barang') ?></td><td><input type="text" class="form-control" name="barang" id="barang" placeholder="Barang" value="<?php echo $barang; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Datetime <?php echo form_error('datetime') ?></td><td><input type="text" class="form-control" name="datetime" id="datetime" placeholder="Datetime" value="<?php echo $datetime; ?>" /></td></tr> -->
		<tr><td width='200'>Pakai Pricelist <?php echo form_error('use_pricelist') ?></td><td><input type="checkbox" name="use_pricelist" id="use_pricelist" value="1" value="<?php echo $use_pricelist; ?>" /></td></tr>
		<tr><td width='200'>Harga <?php echo form_error('harga') ?></td><td><input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Stok <?php echo form_error('stok') ?></td><td><input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" /></td></tr> -->
	    <tr><td width='200'>Ukuran <?php echo form_error('ukuran') ?></td><td><input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="Ukuran" value="<?php echo $ukuran; ?>" /></td></tr>
	    <tr><td width='200'>Pakai Stok <?php echo form_error('use_stok') ?></td><td><input type="checkbox" name="use_stok" id="use_stok" placeholder="Use Stok" value="1" value="<?php echo $use_stok; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
		<a href="<?php echo site_url('mst_barang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
		<p id="text" style="display:none">Checkbox is CHECKED!</p>
	</table></form>        </div>
</div>
</div>
<script>
// disable harga on pricelist change
document.getElementById('use_pricelist').onchange = function() {
    document.getElementById('harga').disabled = this.checked;
};
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

var pricelist_db = $('#pricelist_db').val();
var stok_db = $('#stok_db').val();

// cek value use_pricelist
if(pricelist_db === "1"){
	$("#use_pricelist").prop('checked', true);
	document.getElementById('harga').disabled = true;
}
// cek value use_stok
if(stok_db === "1"){
	$("#use_stok").prop('checked', true);
}

});

</script>