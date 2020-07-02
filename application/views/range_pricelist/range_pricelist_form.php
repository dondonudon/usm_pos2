<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA RANGE PRICELIST</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

<table class='table table-bordered'>

	    <tr><td width='200'>Nama <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <tr><td width='200'>QTY Awal <?php echo form_error('qty_a') ?></td><td><input type="text" class="form-control" name="qty_a" id="qty_a" placeholder="QTY AWAL" value="<?php echo $qty_a; ?>" /></td></tr>
	    <tr><td width='200'>QTY Akhir <?php echo form_error('qty_b') ?></td><td><input type="text" class="form-control" name="qty_b" id="qty_b" placeholder="QTY AKHIR" value="<?php echo $qty_b; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
	    <a href="<?php echo site_url('range_pricelist') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>