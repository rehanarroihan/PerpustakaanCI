<div class="">
    <div class="page-title" style="padding: 8px">
        <div class="title_left">
            <h1><i class="fa fa-user"></i>  Petugas</h1>
        </div>
    </div>
    <?php if($this->session->userdata('role')=='superadmin'): ?>
    <a href="<?php echo base_url() ?>petugas/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Petugas</a>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List Data <small>Petugas</small></h2>
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
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Last Login</th>
                                <?php if($this->session->userdata('role')=='superadmin'): ?>
                                <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($list as $petugasList):?>
                            <?php
                                $rl = null;
                                if($petugasList->ROLE == 'superadmin'){$rl='Admin';}else{$rl='Petugas';}
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $petugasList->FULLNAME ?></td>
                                <td><?php echo $petugasList->USERNAME ?></td>
                                <td><?php echo $petugasList->PASSWORD ?></td>
                                <td><?php echo $rl ?></td>
                                <td><?php echo $petugasList->LAST_LOGIN ?></td>
                                <?php if($this->session->userdata('role')=='superadmin'): ?>
                                <td>
                                    <a href="<?php echo base_url() ?>petugas/edit?tken=<?php echo $petugasList->ID_ADMIN ?>" class="btn btn-info btn-xs">
                                        <i class="fa fa-edit"> Edit</i>
                                    </a>
                                    <button class="btn btn-danger btn-xs" onclick="deletePetugas()">
                                        <i class="fa fa-trash"> Delete</i>
                                    </button>
                                </td>
                                <?php endif; ?>
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

<script>
function deletePetugas() {
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
        window.location.href = "<?php echo base_url() ?>petugas/delete?rcgn=<?php echo $petugasList->ID_ADMIN ?>";
    });
}
</script>