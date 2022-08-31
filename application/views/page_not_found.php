<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Absenku | 404</title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.png">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom-vii.css">


    <style type="text/css">
        html body {
            background-image: url(<?= base_url('assets/images/bg-berhasil.jpg') ?>);
            /*background-size: cover;*/
            background-size: 100% 100%;
        }

        .content-body {
            margin-top: 3.7%;
        }

        img.oops {
            width: 10%;
        }

        img.oops2 {
            width: 30%;
            margin: 0;
        }


        @media (max-width: 768px) {
            html {
                background-image: url(<?= base_url('assets/images/bg-berhasil.jpg') ?>);
                background-size: cover;
                height: 100%;
                background-position: right;
                background-repeat: no-repeat;
            }

            html body {
                background: transparent;
            }

            .content-body {
                margin-top: 0;
            }

            img.oops {
                width: 30%;
            }

            img.oops2 {
                width: 70%;
            }
        }

        @media (min-width: 1500px) {
            html body {
                /*background-position: bottom;*/
            }

            .content-body {
                margin-top: 15%;
            }

            form.formdaftar h4.form-section {
                line-height: 3rem;
            }

            form.formdaftar .form-group {
                margin-bottom: 1.1rem;
            }
        }
    </style>

</head>

<body class="horizontal-layout horizontal-menu 1-column menu-expanded blank-page blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">
    <div class="app-content container center-layout">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12 register-berhasil">
                        <img class="oops" src="<?= base_url() ?>assets/images/Oops.png">
                        <br />
                        <img class="oops2" src="<?= base_url() ?>assets/images/PAGE NOT FOUND.png">
                        <div>
                            <img class="support" src="<?= base_url() ?>assets/images/not-found.png">
                        </div>
                        <a href="<?= route("dashboard.absensi") ?>">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>