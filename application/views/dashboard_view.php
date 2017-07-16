<div class="">
    <div class="page-title" style="padding: 8px">
        <div class="title_left">
            <h1><i class="fa fa-dashboard"></i>  Dashboard</h1>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count">
                    <?php echo $agtCount ?>
                </div>
                <h3>Anggota</h3>
                <p>Jumlah anggota terdaftar</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-book"></i></div>
                <div class="count">
                    <?php echo $bkCount ?>
                </div>
                <h3>Buku</h3>
                <p>Jumlah judul buku</p>
            </div>
        </div>
        <?php if($this->session->userdata('role')=='superadmin'): ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="count">
                    <?php echo $ptgCount ?>
                </div>
                <h3>Petugas</h3>
                <p>Jumlah petugas terdaftar</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-list-alt"></i></div>
                <div class="count">
                    <?php echo $trnCount ?>
                </div>
                <h3>Transaksi</h3>
                <p>Total jumlah transaksi</p>
            </div>
        </div>
        <?php else: ?>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-up"></i></div>
                <div class="count">
                    <?php echo $pnjCount ?>
                </div>
                <h3>Peminjaman</h3>
                <p>Jumlah peminjaman belum kembali</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-down"></i></div>
                <div class="count">
                    <?php echo $kmbCount ?>
                </div>
                <h3>Pengembalian</h3>
                <p>Jumlah peminjaman sudah kembali</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-list"></i>  Data Perpustakaan</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <label>Nama Perpustakaan</label>
                    <p>&emsp;&nbsp;
                        <?php echo $this->db->get('perpus')->row('NAMA_P') ?>
                    </p>
                    <label>Alamat</label>
                    <p>&emsp;&nbsp;
                        <?php echo $this->db->get('perpus')->row('ALAMAT_P') ?>
                    </p>
                    <label>Tentang</label>
                    <p>&emsp;&nbsp;
                        <?php echo $this->db->get('perpus')->row('ABOUT') ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-flag"></i>  Statistik Buku</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <?php
                                $query1 = $this->db->select_sum('QTY', 'qty')->get('buku')->result();
                                $rst1 = $query1[0]->qty;
                                $query2 = $this->db->select_sum('KELUAR', 'klr')->get('buku')->result();
                                $rst2 = $query2[0]->klr;
                                $min = (int)$rst1 - (int)$rst2;
                            ?>
                            <div style="padding-top: 23px; padding-left: 20px">
                            <?php echo '<h4>Total Inventaris : <b>'.$rst1.'</b></h6>'; ?>
                            <?php echo '<h4>Buku dipinjam : <b>'.$rst2.'</b></h6>'; ?>
                            <?php echo '<h4>Buku di rak : <b>'.$min.'</b></h6>'; ?>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                            <!-- <canvas id="bookgraph"></canvas> -->
                            <div id="bookgraph"></div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-users"></i>  Anggota <small>4 terbaru</small></h2>
                    <h2 class="pull-right"><small><a href="<?php echo base_url() ?>anggota">Lihat Selengkapnya >></a></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Jenkel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $agtNo = $agtCount; foreach($agtList as $agt): ?>
                            <?php if($agt->GENDER=='L'){$g='Laki-laki';}else{$g='Perempuan';} ?>
                            <tr>
                                <th scope="row"><?php echo $agtNo; ?></th>
                                <td><?php echo $agt->ID_ANGGOTA ?></td>
                                <td><?php echo $agt->FULL_NAME ?></td>
                                <td><?php echo $g ?></td>
                            </tr>
                            <?php $agtNo--;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-book"></i>  Buku <small>4 terbaru</small></h2>
                    <h2 class="pull-right"><small><a href="<?php echo base_url() ?>buku">Lihat Selengkapnya >></a></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $bkNo = $bkCount; foreach($bkList as $bk): ?>
                            <tr>
                                <th scope="row"><?php echo $bkNo; ?></th>
                                <td><?php echo $bk->ID_BUKU ?></td>
                                <td><?php echo $bk->TITLE ?></td>
                                <td><?php echo $bk->AUTHOR ?></td>
                                <td><?php echo $bk->QTY ?></td>
                            </tr>
                            <?php $bkNo--;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <?php if($this->session->userdata('role')=='superadmin'): ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-user"></i>  Petugas <small>4 terbaru</small></h2>
                    <h2 class="pull-right"><small><a href="<?php echo base_url() ?>petugas">Lihat Selengkapnya >></a></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ptgNo = $ptgCount; foreach($ptgList as $ptg): ?>
                            <?php if($ptg->ROLE=='admin'){$r='Petugas';}else{$r='Admin';} ?>
                            <tr>
                                <th scope="row"><?php echo $ptgNo; ?></th>
                                <td><?php echo $ptg->ID_ADMIN ?></td>
                                <td><?php echo $ptg->FULLNAME ?></td>
                                <td><?php echo $ptg->USERNAME ?></td>
                                <td><?php echo $r ?></td>
                            </tr>
                            <?php $ptgNo--;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-list-alt"></i>  Transaksi<small>4 terbaru</small></h2>
                    <h2 class="pull-right"><small><a href="<?php echo base_url() ?>transaksi">Lihat Selengkapnya >></a></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jumlah Buku</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ct=$trnCount;foreach($trnList as $trn): ?>
                            <tr>
                                <th scope="row"><?php echo $ct; ?></th>
                                <td><?php echo $trn->ID_PINJAM ?></td>
                                <td><?php echo $trn->FULL_NAME ?></td>
                                <td><?php echo $trn->TGL_PINJAM ?></td>
                                <td><?php echo $trn->JML_BUKU ?></td>
                            </tr>
                            <?php $ct--;endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendors/highcharts.js"></script>
<script>
$(function () {
    var chart;
    $(document).ready(function () {
        // Build the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'bookgraph',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                width: null,
                height: 160
            },
            title: {
                text: null
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            legend:{
                 align: 'right',
                 verticalAlign: 'top',
                 floating: true        
            },
            series: [{
                type: 'pie',
                name: 'Presentase',
                data: [
                    ['Buku di pinjam', <?php echo $rst2 ?>],
                    ['Buku di rak', <?php echo $min ?>],
                ]
            }]
        });
    });
     
});
</script>


