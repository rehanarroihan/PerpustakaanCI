<body>
<div class="col-md-12 col-lg-12 col-xs-12">
	<div class="col-lg-5 col-md-5 col-xs-12">
		<img style="max-height: 300px;max-width: 250px" src="<?php echo base_url() ?>assets/images/upload/profile/<?php echo $detail->PHOTO ?>">
	</div>
	<div class="col-lg-7 col-md-7 col-xs-12">
		<label>Nama Lengkap</label>
        <p>&emsp;&nbsp;<?php echo $detail->FULLNAME ?></p>
		<label>Username</label>
        <p>&emsp;&nbsp;<?php echo $detail->USERNAME ?></p>
        <label>Jenis Kelamin</label>
        <?php if($detail->JENKEL == null){$jk='<i>BELUM DIISI</i>';}else{$jk=$detail->JENKEL;} ?>
        <p>&emsp;&nbsp;<?php echo $jk ?></p>
        <label>No Telp.</label>
        <?php if($detail->NO_TELP == null){$tl='<i>BELUM DIISI</i>';}else{$tl=$detail->NO_TELP;} ?>
        <p>&emsp;&nbsp;<?php echo $tl ?></p>
        <label>Alamat</label>
        <?php if($detail->ALAMAT == null){$lm='<i>BELUM DIISI</i>';}else{$lm=$detail->ALAMAT;} ?>
        <p>&emsp;&nbsp;<?php echo $lm ?></p>
        <a href="<?php echo base_url() ?>profile/edit?change_key=<?php echo $detail->ID_ADMIN ?>&signup=0" class="btn btn-success pull-right"><i class="fa fa-edit"></i>  Edit</a>
	</div>
</div>
</body>