<div class="">
    <div class="page-title" style="padding: 8px">
        <div class="title_left">
            <h1><i class="fa fa-users"></i>  Detail Anggota</h1>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $row->FULL_NAME; ?></h2>
                    <?php if($this->session->userdata('role')=='superadmin'){echo '<h2 class="pull-right" style="color: #E0E0E0">created at '.$row->D_CREATED.' </h2>';} ?>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-3">
                            <img class="pull-right" style="height: 320px;width: 240px" src="<?php echo base_url(); ?>assets/images/upload/anggota/<?php echo $row->FOTO; ?>">
                        </div>
                        <div class="col-md-6">
                            <?php
                                $jenkel = $row->GENDER;
                                if($jenkel == 'L'){
                                    $jenkel = 'Laki-laki';
                                }else{
                                    $jenkel = 'Perempuan';
                                }
                            ?>

                            <label>Nama Lengkap</label>
                            <p>&emsp;&nbsp;<?php echo $row->FULL_NAME ?></p>

                            <label>Tempat Lahir</label>
                            <p>&emsp;&nbsp;<?php echo $row->TMP_LAHIR ?></p>

                            <label>Tanggal Lahir</label>
                            <p>&emsp;&nbsp;<?php echo $row->TGL_LAHIR ?></p>

                            <label>Jenis Kelamin</label>
                            <p>&emsp;&nbsp;<?php echo $jenkel ?></p>

                            <label>Alamat</label>
                            <p>&emsp;&nbsp;<?php echo $row->ALAMAT ?></p>

                            <label>No. Telepon</label>
                            <p>&emsp;&nbsp;<?php echo $row->TELP ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
