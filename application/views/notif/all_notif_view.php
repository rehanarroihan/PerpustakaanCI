<div class="">
    <div class="page-title" style="padding: 8px">
        <div class="title_left">
            <h1><i class="fa fa-bell"></i>  Notifikasi</h1>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Semua Notifikasi</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if($total == 0): ?>
                    <div class="alert alert-danger">Tidak ada data</div>
                    <?php else: ?>
                        <?php foreach($list as $ntf): ?>
                        <div class="col-md-12 col-sm-12 col-xs-12"">
                            <div class="col-md-6 col-lg-6 col-xs-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <span><img style="border-radius: 5px;height: 29px;width: 29px" src="<?php echo base_url() ?>assets/images/upload/profile/<?php echo $ntf->PHOTO ?>" />&emsp;<?php echo $ntf->FULLNAME ?></span>
                                    </div>
                                    <div class="panel-body">
                                        <b><?php echo $ntf->JUDUL ?>.</b> <?php echo $ntf->ISI ?>
                                    </div>
                                    <div class="panel-footer" style="">
                                        <?php $tgl = date_create($ntf->DT);echo date_format($tgl,"D, d M Y"); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
