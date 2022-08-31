<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Developer Absenku">
    <meta name="csrf-token" content="<?= $this->MY_response['csrf_token'] ?>" />
    <title>Absenku | Login</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.png">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/vendors.css">
    <!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/app.css">
    <!-- END STACK CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom-login.css">
    <!-- END Custom CSS-->

    <script type="text/javascript" src="<?= base_url() ?>assets/jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            reconfigure();
            $(".toggle-password").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
            // showPassword();

            $(document).on('keypress', 'input', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    if (this.tabIndex == "4") {
                        document.getElementById("login").click();
                    } else {
                        var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
                        if (!$next.length) {
                            $next = $('[tabIndex=1]');
                        }
                        $next.focus().click();
                    }


                }
            });


            $(".flip").click(function() {
                $(".formlupapassword").slideToggle("slow");
                $(".formlogin").hide(600);
            });

            $(".kembalilogin").click(function() {
                $(".formlupapassword").hide(400);
                $(".formlogin").show(600);
            });

            $("#login").on('click', function(e) {
                e.preventDefault();
                $('#message').hide();

                if ($("#username").val() == "") {
                    $('#message').html("<h5><i class='fa fa-exclamation-triangle'></i> Username belum diisi</h5>");
                    $('#message').show();
                    $("#username").focus();
                    return false;
                } else if ($("#password").val() == "") {
                    $('#message').html("<h5><i class='fa fa-exclamation-triangle'></i> Password belum diisi</h5>");
                    $('#message').show();
                    $('#password').focus();
                    return false;
                } else if ($("#captcha").val() == "") {
                    $('#message').html("<h5><i class='fa fa-exclamation-triangle'></i> Captcha belum diisi</h5>");
                    $('#message').show();
                    $('#captcha').focus();
                    return false;
                }

                var param = {};
                param.username = $("#username").val();
                param.password = $("#password").val();
                param.captcha = $("#captcha").val();

                $.ajax({
                    type: 'POST',
                    url: "<?= site_url('login/proses') ?>",
                    data: param,
                    dataType: 'JSON',
                    success: function(result) {
                        if (result.success == true) {
                            window.location.replace(result.url);
                        } else {
                            // $('#img_captcha').attr('src', 'https://awsimages.detik.net.id/community/media/visual/2020/07/10/tes-psikologi.jpeg?w=700&q=90');
                            $('#img_captcha').attr('src', '<?= site_url('login/captcha') ?>');
                            $('#message').html("<h5><i class='fa fa-exclamation-triangle'></i> " + result.message + "</h5>");
                            $('#message').show();
                        }
                    },
                    error: function() {
                        $('.btn_save').prop('disabled', false);
                        $('#text_btn').show();
                        $('#spinner').hide();
                        $('#message').show();
                        $('#message').html("<h5><i class='fa fa-exclamation-triangle'></i> Terjadi kesalahan</h5>");
                    }
                });
            });
        });
    </script>
    <style>
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
    </style>
</head>

<body class="horizontal-layout horizontal-menu 1-column menu-expanded blank-page blank-page" data-open="click" data-menu="horizontal-menu" data-col="1-column">
    <div class="app-content container center-layout">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="row align-items-center">
                            <div class="col-md-8 p-0">
                                <div>
                                    <div class="card bg-selamatdatang">
                                        <div class="card-body">
                                            <div class="row align-items-end">
                                                <div class="col-md-5">
                                                    <img src="<?= base_url('assets/images/laptopabsenku.png') ?>" alt="Login Absenku Karyawan">
                                                </div>
                                                <div class="col-md-7">
                                                    <h3>Absenku Profesional</h3>
                                                    <p>
                                                        Mempermudah pekerjaan departemen HR (Human Resources) untuk pengelolaan aktifitas kehadiran karyawan secara real times, lebih efisien, transparan, dan akuntabel.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="https://registrasi.absenku.com/index.php/register/index/trial">
                                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-coba btn-block slideright">
                                                            <i class="fa fa-laptop"></i> Coba Absenku Full 7 Hari
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="https://registrasi.absenku.com/index.php/register">
                                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-pesan btn-block slideright">
                                                            <i class="fa fa-shopping-cart"></i> Pesan Absenku Sekarang
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-0 v-login">
                                <!-- <div class="col-md-4 col-10 box-shadow-2 p-0"> -->
                                <div class="card border-grey border-lighten-3 m-0 box-shadow-2">
                                    <div class="card-header border-0">
                                        <div class="card-title text-center">
                                            <div class="">
                                                <img src="<?= base_url('assets/images/absenkaryawanputih.png') ?>" alt="Login Absenku Karyawan" style="width: 70%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="formlogin">
                                                <div id="message" class="alert alert-danger font-weight-bold" style="display:none"></div>
                                                <p>Username</p>
                                                <fieldset class="form-group position-relative">
                                                    <input type="text" id="username" class="form-control" placeholder="Username" tabIndex="1">
                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                </fieldset>
                                                <p>Password</p>
                                                <fieldset class="form-group position-relative">
                                                    <input type="password" id="password" class="form-control" placeholder="Password" tabIndex="2">
                                                    <div class="form-control-position">
                                                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="form-group position-relative">
                                                    <center><img id="img_captcha" src='<?= site_url('login/captcha') ?>' height="30px"></center>
                                                    <input type="text" id="captcha" class="form-control" placeholder="Captcha" name="captcha" tabIndex="3">
                                                </fieldset>
                                                <!--
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                    <a href="#" class="flip card-link f-12">
                                                        <i class="fa fa-lock"></i> Lupa Password?
                                                    </a>
                                                    </div>
                                                </div>
-->
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button type="button" id="login" class="btn btn-block" tabIndex="4"> Login</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a id="link_registrasi" href="https://registrasi.absenku.com/index.php/register/index/2">Belum punya akun? Daftar disini!</a>
                                            <!-- Form Lupa Password -->
                                            <form class="formlupapassword form-horizontal form-simple">
                                                <h3 class="text-center mb-1">
                                                    Reset Password
                                                </h3>
                                                <p class="text-center mb-2">
                                                    Masukkan email anda.
                                                    Link untuk reset password akan dikirim ke email anda.
                                                </p>

                                                <p>Email</p>
                                                <fieldset class="form-group position-relative">
                                                    <input type="text" class="form-control" placeholder="Email">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-envelope-o"></i>
                                                    </div>
                                                </fieldset>
                                                <button type="submit" class="btn bg-gradient-directional-purple white btn-purple btn-block"> Reset</button>

                                                <a href="#" class="kembalilogin">
                                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2 mb-1">
                                                        <span>Kembali ke Halaman Login</span>
                                                    </h6>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ajaxComplete(function(event, request, settings) {
            if (typeof request.responseJSON !== 'undefined') {
                reconfigure(request);
            }
            var tabel = $('div.dataTables_scrollBody > table');
            if (tabel.length > 0) {
                var id_tabel = tabel.attr('id');
                if (typeof request.responseJSON !== 'undefined') {
                    if (request.responseJSON.success == true) {
                        if ($.fn.DataTable.isDataTable('#' + id_tabel)) {
                            $('#' + id_tabel).DataTable().ajax.reload();
                        }
                    }
                }

            }
        });

        function reconfigure(data = null) {
            if (data != null) {
                $("meta[name=csrf-token]").attr('content', data.responseJSON.csrf_token);
            }

            $.ajaxSetup({
                headers: {
                    'Csrf-Token': $('meta[name="csrf-token"]').attr('content'),
                    'CustomCrsf': 'Custom CRSF'
                }
            });
        }
    </script>
</body>

</html>