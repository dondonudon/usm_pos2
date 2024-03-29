<?php $data = $this->db->query("SELECT
								trans.notrans, trans.ket, trans.datetime, id_barang, barang, qty
                            FROM
                                trans
                            INNER JOIN trans_detail ON trans.notrans = trans_detail.notrans
                            INNER JOIN mst_barang on trans_detail.id_barang = mst_barang.id
                            WHERE
								trans.notrans = '$notrans'");

?>

<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DATA STOCK OPNAME</h3>

            </div>
			<table class='table table-bordered table-striped'>
			<form name="form" id="form" action ="<?php base_url('');?>insert_trans" method="post">
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
				<td>Keterangan</td>
				<td><?php echo $row->ket; ?></td>

			</tr>
			</table>

			<div id="reload">
			<table class="table table-bordered table-striped" id="mydata">
			<thead>
				<tr>
					<th>Kode</th>
					<th>Nama Barang</th>
					<th>Stok</th>

				</tr>
			</thead>
			<tbody id="show_data">
			<?php foreach ($data->result_array() as $isi) {?>
			<tr>
			<td><?php echo $isi['id_barang']; ?></td>
			<td><?php echo $isi['barang']; ?></td>
			<td><?php echo $isi['qty']; ?></td>
			</tr>
			<?php }
;?>
			</tbody>
		</table>

		</form>



		</div>


<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>

</div>
</div>