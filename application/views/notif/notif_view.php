<div class="">
    <div class="page-title" style="padding: 8px">
        <div class="title_left">
            <h1><i class="fa fa-bell"></i>  Notifikasi</h1>
        </div>
    </div>
    <?php if($this->session->userdata('role')=='superadmin'): ?>
    <a href="<?php echo base_url() ?>notification/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Notifikasi</a>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Notifikasi</h2>
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
                                <?php $tgl = date_create($ntf->DT);echo date_format($tgl,"D, d M Y"); ?>
                                </div>
                                <div class="panel-body">
                                    <b><?php echo $ntf->JUDUL ?>.</b> <?php echo $ntf->ISI ?>
                                    <button onclick="del()" class="btn btn-danger btn-xs pull-right">
                                        <i class="fa fa-trash">  Hapus</i>
                                    </button>
                                </div>
                                <div class="panel-footer" style="">
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

<script type="text/javascript">
    function del() {
    swal({
            title: "Apakah anda yakin ingin menghapus data ?",
            text: "Data tidak bisa di kembalikan",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            closeOnConfirm: false
        },
        function() {
            window.location.href = "<?php echo base_url() ?>notification/delete?rcgn=<?php echo $ntf->ID_NOTIF ?>";
        });
}
</script>
