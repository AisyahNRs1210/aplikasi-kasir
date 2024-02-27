
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Yuzushi Gift Store</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="<?=base_url('admin/images/logo_ukk.png'); ?>" />
    <link rel="shortcut icon" href="<?=base_url('admin/images/logo_ukk.png'); ?>" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?=base_url('admin/assets/css/cs-skin-elastic.css'); ?>">
    <link rel="stylesheet" href="<?=base_url('admin/assets/css/style.css'); ?>">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        <img class="align-content" src="<?=base_url('admin/images/logo_ukk.png'); ?>" style="width:400px;height:200px;" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action="/form-registrasi" method="POST">
                         <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                            value="<?=isset($detailPengguna[0]->email) ? $detailPengguna[0]->email : null;?>"placeholder="Masukkan email">
                             <div class="invalid-feedback">Email tidak boleh kosong</div>
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_user" 
                            value="<?=isset($detailPengguna[0]->nama_user) ? $detailPengguna[0]->nama_user : null;?>" placeholder="Masukkan nama lengkap">
                             <div class="invalid-feedback">Nama tidak boleh kosong</div>
                        </div>
                       
                        <div class="form-group">
                            <label>Password</label>
                           <input type="password" class="form-control" name="password" width="20"
                    value="<?=isset($detailPengguna[0]->password) ? $detailPengguna[0]->password : null;?>"
                    placeholder="Masukkan password" required/>
                    <div class="invalid-feedback">Password tidak boleh kosong</div>
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <select class="form-control" name="role">
                                <option value="">Pilih Jabatan</option>
                                <?php
                                if(isset($listPenguna)) :
                                    foreach($listPenguna as $baris) :
                                        if(isset($detailPengguna[0]->role)) :
                                            $detailPengguna[0]->role == $baris->role ? $pilih = 'selected' : $pilih=null;
                                            else : 
                                            $pilih=null;
                                        endif;
                                            echo '<option '.$pili.'value="'.$baris->role.'">'.$baris->role.'</option>';
                                    endforeach;
                                endif;
                                ?>
                                <option <?= (isset($detailPengguna[0]->role) && $detailPengguna[0]->role) == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option <?= (isset($detailPengguna[0]->role) && $detailPengguna[0]->role) == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                        
                        <div class="register-link m-t-15 text-center">
                            <p>sudah punya akun? <a href="<?=site_url('form-login'); ?>">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?=base_url('admin/assets/js/main.js'); ?>"></script>

</body>
</html>
