<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA BARANG MASUk</h3>
				<div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah Barang</a></div>
            </div>
			<table class='table table-bordered table-striped'>
			<form name="form" id="form" action ="<?php base_url('');?>insert_trans" method="post">
			<tr>
				<td width="100px">No Transaksi</td>
					<?php $notrans = nopo();?>
				<td width="200px">
					<?php echo $notrans; ?></td>
				<td width="100px">Tanggal</td>
				<td width="100px">
					<?php echo date('Y-m-d'); ?></strong></td>

			</tr>
			<tr>
				<td>Keterangan</td>
				<td><textarea class="form-control" rows="2" name="ket" id="ket"></textarea></td>

			</tr>
			</table>

			<div id="reload">
			<table class="table table-bordered table-striped" id="mydata">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
					<th style="text-align: right;">Aksi</th>
				</tr>
			</thead>
			<tbody id="show_data">

			</tbody>
		</table>
		<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>">
		<input type="hidden" name="no_po" id="no_po" value="<?php echo $notrans; ?>">
		<input class="btn btn-primary btn-lg btn-block" type="submit" value="SAVE">
		</form>


		<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
							<?php echo select2_dinamis_id('id_barang', 'mst_barang', 'barang', 'id', 'Nama Barang', 'use_stok', '1') ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-xs-3" >Stok</label>
                        <div class="col-xs-9">
							<input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Harga</label>
                        <div class="col-xs-9">
							<input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" required />
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
					<input type="hidden" name="no_po" id="no_po" value="<?php echo $notrans; ?></td>">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalaEdit" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Edit Barang</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode Barang</label>
                        <div class="col-xs-9">
						<input name="nama" id="nama" class="form-control" type="text" placeholder="nama" style="width:335px;" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Stok</label>
                        <div class="col-xs-9">
						<input type="text" class="form-control" name="stok_edit" id="stok2" placeholder="Stok"  />
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
					<input type="hidden" name="id" id="id" value="">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_update">Update</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->

        <!--MODAL HAPUS-->
        <div class="modal fade" id="ModalHapus" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
                    </div>
                    <form class="form-horizontal">
                    <div class="modal-body">
					<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
					<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/jquery.dataTables.css' ?>">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus barang ini?</p></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--END MODAL HAPUS-->
		</div>


<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		tampil_data_barang();	//pemanggilan fungsi tampil barang.

		$('#mydata').dataTable();

		//fungsi tampil barang
		function tampil_data_barang(){
		    $.ajax({
		        type  : 'GET',
		        url   : '<?php echo base_url() ?>po/data_barang',
		        async : true,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
								'<td hidden>'+data[i].id+'</td>'+
		                  		'<td>'+data[i].no_po+'</td>'+
		                        '<td>'+data[i].nama+'</td>'+
								'<td>'+data[i].stok+'</td>'+
                                '<td>'+data[i].harga+'</td>'+
                                '<td>'+data[i].jumlah+'</td>'+
		                        '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id+'">Edit</a>'+' '+
                                    '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+data[i].id+'">Hapus</a>'+
                                '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }

		    });
		}

		//GET UPDATE
		$('#show_data').on('click','.item_edit',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('po/get_barang') ?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(id_barang, stok){
                    	$('#ModalaEdit').modal('show');
            			$('[name="nama"]').val(data.nama);
            			$('[name="stok_edit"]').val(data.stok);
						$('[name="id"]').val(data.id);
            		});
                }
            });
            return false;
        });


		//GET HAPUS
		$('#show_data').on('click','.item_hapus',function(){
            var id=$(this).attr('data');
            $('#ModalHapus').modal('show');
            $('[name="id"]').val(id);
        });

		//Simpan Barang
		$('#btn_simpan').on('click',function(){
			var id_barang		= $('#id_barang').val();
            var stok			= $('#stok').val();
            var harga			= $('#harga').val();
			var no_po	        = $('#no_po').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('po/simpan_barang') ?>",
                dataType : "JSON",
                data : {no_po:no_po, id_barang:id_barang , stok:stok, harga:harga},
                success: function(data){
                    $('[name="id_barang"]').val("");
                    $('[name="stok"]').val("");
                    $('[name="harga"]').val("");
                    // $('#ModalaAdd').modal('hide');
                    tampil_data_barang();
                }
            });
            return false;
        });

        //Update Barang
		$('#btn_update').on('click',function(){
            var id=$('#id').val();
            var stok=$('#stok2').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('po/update_barang') ?>",
                dataType : "JSON",
                data : {id:id , stok:stok},
                success: function(data){
                    $('[name="nama"]').val("");
                    $('[name="stok"]').val("");
                    $('#ModalaEdit').modal('hide');
                    tampil_data_barang();
                }
            });
            return false;
        });

        //Hapus Barang
        $('#btn_hapus').on('click',function(){
            var id=$('#id').val();
            $.ajax({
            type : "POST",
            url  : "<?php echo base_url('po/hapus_barang') ?>",
            dataType : "JSON",
                    data : {id: id},
                    success: function(data){
                            $('#ModalHapus').modal('hide');
                            tampil_data_barang();
                    }
                });
                return false;
            });

	});

</script>
</div>
</div>