<div class="">
    <div class="page-title" style="padding: 8px">
        <div class="title_left">
            <h1><i class="fa fa-arrow-down"></i>  Pengembalian</h1>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List Data <small>Peminjaman</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <!-- Notif -->
                <?php $announce = $this->session->userdata('announce') ?>
                <?php if(!empty($announce)): ?>
                    <?php if($announce == 'Berhasil menyimpan data'): ?>
                    <div class="alert alert-success fade in"><?php echo $announce; ?></div>
                    <?php else: ?>
                    <div class="alert alert-danger fade in"><?php echo $announce; ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- Data -->
                <?php if($total == 0): ?>
                    <div class="alert alert-danger">Tidak ada data</div>
                    <?php else: ?>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjaman</th>
                                <th>Nama</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jumlah Buku</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1;?>
                        <?php foreach ($datas as $yuhu):?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $yuhu->ID_PINJAM ?></td>
                                <td><?php echo $yuhu->FULL_NAME ?></td>
                                <td>
                                <?php $tgl = date_create($yuhu->TGL_PINJAM);echo date_format($tgl,"D, d M Y"); ?>
                                </td>
                                <td><?php echo $yuhu->JML_BUKU ?></td>
                                <td>
                                    <a class="btn btn-info btn-xs detaila" id="<?php echo $yuhu->ID_PINJAM ?>"><i class="fa fa-list-alt"></i>  Detail Data</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="detailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-arrow-down"></i>  Pengembalian</h4>
            </div>
            <div class="modal-body" id="contents"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Selesai</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".detaila").click(function(){
        var detail_id = $(this).attr("id");
        $.ajax({
            url: "<?php echo base_url() ?>pengembalian/det",
            type: "POST",
            data: "id="+detail_id,
            cache: false,
            success: function(data){
                $('#contents').html(data);
                $("#detailModal").modal("show");
            }
        })
    });
});
</script>