<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Setup - Perpustakaan</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/build/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/build/css/style.css">

    </head>

    <body>

        <!-- Top content -->
        <div >
            <div class="container">
                
                <div>
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                        <form role="form" action="<?php echo base_url() ?>setup/submit" method="post" class="f1">

                            <h3>Setup Aplikasi Perpustakaan</h3>
                            <p>Masukkan data perpustakaan anda</p>
                            <div class="f1-steps">
                                <div class="f1-progress">
                                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                                </div>
                                <div class="f1-step active">
                                    <div class="f1-step-icon"> <i class="fa fa-paper-plane"></i></div>
                                    <p>Welcome</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-book"></i></div>
                                    <p>Perpustakaan</p>
                                </div>
                                <div class="f1-step">
                                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                                    <p>Admin</p>
                                </div>
                            </div>

                            <fieldset>
                                <h4><strong>Selamat datang !</strong></h4>
                                <p>
                                    &emsp;Kami ucapkan terima kasih yang sebesar besarnya
                                    karena telah mempercayakan solusi aplikasi web
                                    kepada kami. Silahkan memulai dengan mengisi
                                    data perusahaan anda. Selamat Menggunakan.
                                </p>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <h4>Data Perpustakaan</h4>
                                <div class="form-group">
                                    <label class="sr-only">Nama Perpustakaan</label>
                                    <input type="text" name="name" placeholder="Nama Perpustakaan" class="f1-first-name form-control" id="f1-first-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Alamat</label>
                                    <input type="text" name="address" placeholder="Alamat" class="f1-last-name form-control" id="f1-last-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Tentang</label>
                                    <textarea name="about" placeholder="Tentang" 
                                                         class="f1-about-yourself form-control" id="f1-about-yourself"></textarea>
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4>Registrasi Akun Admin</h4>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-email">Nama Lengkap</label>
                                    <input type="text" name="fullname" placeholder="Nama Lengkap" class="f1-email form-control" id="f1-email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-password">Username</label>
                                    <input type="text" name="username" placeholder="Username" class="f1-password form-control" id="f1-password">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" name="password" placeholder="Password" 
                                                        class="f1-repeat-password form-control" id="f1-repeat-password">
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" name="setup" class="btn btn-submit">Submit</button>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
                    
            </div>
        </div>


        <!-- Javascript -->
        <script src="<?php echo base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/build/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url() ?>assets/build/js/retina-1.1.0.min.js"></script>
        <script src="<?php echo base_url() ?>assets/build/js/scripts.js"></script>
        
    </body>

</html>