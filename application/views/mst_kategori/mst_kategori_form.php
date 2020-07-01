<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA MST_KATEGORI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered'>

	    <!-- <tr><td width='200'>Datetime <?php echo form_error('datetime') ?></td><td><input type="text" class="form-control" name="datetime" id="datetime" placeholder="Datetime" value="<?php echo $datetime; ?>" /></td></tr> -->
	    <tr><td width='200'>Kategori <?php echo form_error('kategori') ?></td><td><input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="<?php echo $kategori; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('mst_kategori') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>