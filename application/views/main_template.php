<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="<?= $this->MY_response['csrf_token'] ?>" />

    <title>Tiket Absenku | <?= $judul ?> </title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/app-assets/images/ico/apple-icon-120.png">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.png">

    <!-- Select2 -->
    <link href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">

    <!-- Select2 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/vendors/css/weather-icons/climacons.min.css">
    <!-- END VENDOR CSS-->

    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/app.css">
    <!-- END STACK CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/core/colors/palette-gradient.css">
    <!-- link(rel='stylesheet', type='text/css', href=app_assets_path+'/css'+rtl+'/pages/users.css')-->
    <!-- END Page Level CSS-->
    <!-- BEGIN Upload CSS-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/dropify/dist/css/dropify.min.css">
    <!-- END Upload CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/custom-vii.css?v=1">
    <!-- END Custom CSS-->

    <!-- datepicker bootstrap -->
    <link href="<?= base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Calendar CSS -->
    <link href="<?= base_url() ?>/assets/plugins/calendar/dist/fullcalendar.css" rel="stylesheet" />

    <!-- leaflet -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/leaflet/leaflet.css" />

    <!-- datatables -->
    <link href="<?= base_url() ?>assets/plugins/datatables/datatables.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/datatables/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/datatables/dataTables.fixedColumns.3.3.2.min.css" rel="stylesheet">

    <!-- Ladda Button -->
    <link href="<?= base_url() ?>assets/plugins/ladda-button/dist/ladda-themeless.min.css" rel="stylesheet">

    <!-- Image-Uploader -->
    <!-- <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css"> -->

    <script type="text/javascript" src="<?= base_url() ?>assets/jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>

    <!-- Ladda button -->
    <script src="<?= base_url() ?>assets/plugins/ladda-button/dist/spin.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/ladda-button/dist/ladda.min.js"></script>

    <!-- ckeditor -->
    <script src="<?= base_url() ?>assets/plugins/ckeditor/ckeditor.js"></script>

    <!-- autonumeric -->
    <script src="<?= base_url('assets/js') ?>/autoNumeric.js"></script>
</head>

<body class="horizontal-layout horizontal-menu 2-columns menu-expanded" data-open="click" data-menu="horizontal-menu" data-col="2-columns">
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item">
                        <img class="brand-logo" src="<?= base_url() ?>assets/images/logo-header.png" height="50px">
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left"></ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a href="#" class="dropdown-toggle nav-link dropdown-user-link" data-toggle="dropdown">
                                <!-- Logo Client -->
                                <?php

                                $foto_profil = $this->config->item('base_image') . 'image?_t=photo&_d=foto-profil';
                                ?>
                                <!-- Logo Client -->
                                <span class="avatar avatar-online">
                                    <img src="<?= $foto_profil ?>" alt="avatar">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="row">
                                    <div class="div col-md-12">
                                        <span class="dropdown-item">
                                            <b class="font-size-large"><?= $this->nama_user ?></b><br>
                                            <?= $this->nama_user ?>
                                        </span>
                                        <span class="dropdown-item font-weight-bold" style="font-size: 10pt; padding-top:0px"> <?= $this->level_user ?></span>
                                        <div class="dropdown-divider"></div>
                                        <a href="<?= route("ganti.password") ?> " class="dropdown-item"><i class="fa fa-lock"></i> Ganti Password</a>
                                        <a class="dropdown-item" href="<?= site_url('logout') ?>"><i class="ft-power"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <!-- START TAMPIL MODAL -->
    <div id="modal_form" class="modal fade in" data-keyboard="false" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div id="tampil_form" class="modal-content"></div>
        </div>
    </div>
    <!-- END TAMPIL MODAL -->

    <!-- Modal Detail Laporan -->
    <div class="modal fade" id="modalViewDetail" tabindex="-1" role="dialog" aria-labelledby="modalViewDetail" aria-hidden="true">
        <div style="max-width:120px;" class="modal-dialog modal-dialog-centered modal-dialog-view-detail" role="document">
            <div class="modal-content" id="contentModalViewDetail">
            </div>
        </div>
    </div>
    <!-- END TAMPIL MODAL -->
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- Horizontal navigation-->
    <?= (isset($menu) ? $menu : '') ?>
    <!-- Horizontal navigation-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <?= (isset($content) ? $content : '') ?>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer footer-static navbar-shadow">
        <p class="clearfix text-sm-center mb-0 px-2">
            Copyright © 2021 Absenku
        </p>
    </footer>

    <div id="soundeffct"></div>

    <!-- BEGIN VENDOR JS-->
    <script type="text/javascript" src="<?= base_url() ?>assets/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="<?= base_url() ?>assets/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/extensions/jquery.knob.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/js/scripts/extensions/knob.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/data/jvector/visitor-data.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/charts/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/vendors/js/extensions/unslider-min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/app-assets/fonts/simple-line-icons/style.min.css">
    <!-- END PAGE VENDOR JS-->

    <!-- jQuery file upload -->
    <script src="<?= base_url() ?>assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <!-- END Upload Jquery-->
    <!-- BEGIN STACK JS-->
    <script src="<?= base_url() ?>assets/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/js/core/app.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- END STACK JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="<?= base_url() ?>assets/app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
    <!-- END PAGE LEVEL JS-->

    <!-- DataTables -->
    <script src="<?= base_url() ?>assets/plugins/datatables/datatables.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables/dataTables.fixedColumns.3.3.2.min.js"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>

    <script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Datepicker ID -->
    <script src="<?= base_url() ?>assets/js/datepicker-id.js"></script>

    <!-- leaflet -->
    <script src="<?= base_url(); ?>/assets/plugins/leaflet/leaflet.js"></script>

    <!-- Calendar JavaScript -->
    <script src="<?= base_url() ?>/assets/plugins/moment/moment.js"></script>
    <script src='<?= base_url() ?>/assets/plugins/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?= base_url() ?>/assets/plugins/calendar/dist/cal-init.js"></script>


    <!-- Input Mask -->
    <script src="<?= base_url() ?>/assets/plugins/inputmask/dist/jquery.inputmask.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/inputmask/dist/inputmask.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/inputmask/dist/bindings/inputmask.binding.js"></script>

    <!-- Image-Uploader -->
    <script type="text/javascript" src="http://example.com/jquery.min.js"></script>
    <script type="text/javascript" src="http://example.com/image-uploader.min.js"></script>

    <script type="text/javascript">
        var customspinner = '<div class="custom-lds-ring"><div></div><div></div><div></div>';

        $(function() {
            callmasktanggal();

            reconfigure();
            // checkpermission();

            $(document).on('focus', ':input', function() {
                $(this).attr('autocomplete', 'off');

                $.fn.datepicker.dates['id'] = {
                    days: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                    daysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    daysMin: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    today: 'Hari Ini',
                    clear: 'Clear',
                    weekStart: 0
                };



                $(".numberbox").keydown(function(e) {
                    // Allow: backspace, delete, tab, escape, enter and
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                        // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right, down, up
                        (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                        $("#jumlah_barang").focus();
                        return false();
                    }
                });

            });
        });


        function datepicker(start_date = null, end_date = null, el = '.datepicker') {

            var option = {
                format: 'dd-mm-yyyy',
                autoclose: true,
                orientation: 'bottom',
                language: 'id',
                todayHighlight: true,

            }

            if (start_date !== null) {
                option.startDate = start_date;
            }

            if (end_date !== null) {
                option.endDate = end_date;
            }

            var datepicker = $(el).datepicker(option);

            $(el).on('keypress', function(event) {
                if (event.keyCode == 13) {
                    $(this).trigger('change');
                    if ($(document).find('datepicker-dropdown').length == 0) {
                        $(this).val('');
                    }
                }
            });

            // $(el).on('blur', function(event){
            //     if($(document).find('datepicker-dropdown').length == 0){
            //             $(this).val('');
            //         }
            // });

            return datepicker;
        }

        function dropify() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Seret dan lepas atau klik disini',
                    'replace': 'Seret dan lepas atau klik disini',
                    'remove': 'Hapus',
                    'error': 'Ooops, terjadi kesalahan.',
                },
                error: {
                    'fileSize': 'The file size is too big ({{ value }} max).',
                    'minWidth': 'The image width is too small ({{ value }}}px min).',
                    'maxWidth': 'The image width is too big ({{ value }}}px max).',
                    'minHeight': 'The image height is too small ({{ value }}}px min).',
                    'maxHeight': 'The image height is too big ({{ value }}px max).',
                    'imageFormat': 'Format file tidak diperbolehkan ({{ value }} only).'
                }
            });
        }

        function callmasktanggal() {
            $('.masktanggal').inputmask({
                "mask": "99-99-9999",
                "placeholder": "dd-mm-yyyy"
            });
        }

        function serializeInput(id_form) {
            var dt = new FormData();
            var t = $('#' + id_form).find("select, textarea, input");
            $.each(t, function(i, v) {
                if ($(this).prop('disabled') != true) {
                    var name;
                    if ($(this).attr('id').length > 0) {
                        name = $(this).attr('id');
                    } else if ($(this).attr('name').length > 0) {
                        name = $(this).attr('name');
                    }

                    var val = $(this).val();
                    dt.append(name, val);
                }
            });

            return dt;
        }

        function validasijam24(str) {
            var ok = false;
            // jam format 24 jam
            if (str.match(/^([01][0-9]|2[0-3]):([0-5][0-9])$/)) {
                ok = true;
            }
            return ok;
        }

        function validasitanggal(str) {
            var ok = false;
            // tanggal dd-mm-yyyy / dd.mm.yyyy / dd/mm/yyyy / dd/mm/yy
            if (str.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/)) {
                ok = true;
            }
            return ok;
        }

        function loadfungsimodaldetail() {
            $('#modalViewDetail').on('show.bs.modal', function() {
                $('#contentModalViewDetail').html('<div class="modal-body"><div class="text-center">' + customspinner + '</div></div>');
            });
            $('#modalViewDetail').on('shown.bs.modal', function(e) {
                setTimeout(function() {
                    var url_lokasi_absen = $(e.relatedTarget).data('uri');
                    // $('#contentModalViewDetail').html('');
                    $('#contentModalViewDetail').load(url_lokasi_absen);
                    $('.modal-dialog-view-detail').attr('style', 'max-width:80%; transition: all .2s linear;');
                }, 1000);
            });

            $('#modalViewDetail').on('hidden.bs.modal', function(e) {
                $('.modal-dialog-view-detail').attr('style', 'max-width:120px');
                $('#contentModalViewDetail').html('');
            });
        }

        function pickrange() {
            var pickrange = $('#tanggal_mulai, #tanggal_selesai');
            pickrange.on('changeDate', function() {
                var idf = $(this).attr('id');
                var mul = ($('#tanggal_mulai').val() != '') ? moment($('#tanggal_mulai').val(), 'DD-MM-YYYY') : false;
                var sel = ($('#tanggal_selesai').val() != '') ? moment($('#tanggal_selesai').val(), 'DD-MM-YYYY') : false;

                var selu = parseInt(sel.format('x'));
                var mulu = parseInt(mul.format('x'));
                if (idf == 'tanggal_mulai') {
                    var dif = mul.diff(sel, 'days');
                    dif = dif * -1;
                    if (dif >= 30) {
                        var selx = mul.add(30, 'days');
                        sel = selx.format('DD-MM-YYYY');

                        $('#tanggal_selesai').val(sel);
                        // $('#tanggal_selesai').datepicker('update', selx.toDate());
                    } else {
                        if (mulu > selu) {
                            var selx = mul;
                            sel = selx.format('DD-MM-YYYY');
                            $('#tanggal_selesai').val(sel);
                            // $('#tanggal_selesai').datepicker('update', selx.toDate());
                        }
                    }

                    if (typeof selx != 'undefined') {
                        $('#tanggal_selesai').datepicker('update', selx.toDate());
                    }
                }

                if (idf == 'tanggal_selesai') {
                    var dif = sel.diff(mul, 'days');
                    dif = dif;
                    if (dif >= 30) {
                        var mulx = sel.subtract(30, 'days');
                        mul = mulx.format('DD-MM-YYYY');

                        $('#tanggal_mulai').val(mul);
                        // $('#tanggal_mulai').datepicker('update', mulx.toDate());
                    } else {
                        if (sel.format('x') <= mul.format('x')) {
                            var mulx = sel;
                            mul = mulx.format('DD-MM-YYYY');
                            $('#tanggal_mulai').val(mul);
                            // $('#tanggal_mulai').datepicker('update', mulx.toDate());
                        }
                    }

                    if (typeof mulx != 'undefined') {
                        $('#tanggal_mulai').datepicker('update', mulx.toDate());
                    }
                }
            });
        }

        // $(document).ajaxSend(function(event, request, settings) {
        //     window.Pace.start();
        // });
        // $(document).ajaxComplete(function(event, request, settings) {
        //     window.Pace.stop();
        // });

        $(document).ajaxError(function(event, request, settings) {
            req_token();
        });

        $(document).ajaxSend(function(event, request, settings) {
            if (settings.hasOwnProperty('headers') === false) {
                set_header();
            }
        });

        <?php
        // IF PRODUCTION HIDE TABEL ERROR
        if (ENVIRONMENT == 'production') {
        ?>
            if (jQuery().DataTable) {
                $.fn.dataTable.ext.errMode = function(settings, techNote, message) {
                    // alert('Terjadi gangguan saat mengambil data, halaman ini akan dimuat ulang dalam 3 detik setelah anda menekan tombol "OK"');
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                };
            }
        <?php } ?>

        $(document).ajaxComplete(function(event, request, settings) {
            window.Pace.stop();

            if (typeof request.responseJSON !== 'undefined') {
                reconfigure(request);
            }
            var tabel = $('div.dataTables_scrollBody > table');
            if (tabel.length > 0) {
                var id_tabel = tabel.attr('id');
                if (typeof request.responseJSON !== 'undefined') {
                    if (request.responseJSON.success == true) {
                        if ($.fn.DataTable.isDataTable('#' + id_tabel)) {
                            if (request.responseJSON.type == "save") {

                                if ($('#' + id_tabel).DataTable().state() != null) {
                                    $('#' + id_tabel).DataTable().ajax.reload(null, false);
                                } else {
                                    console.log('tes');
                                    $('#' + id_tabel).DataTable().ajax.reload(null, false);
                                }

                            } else {
                                // table.ajax.reload(callback, resetPaging)
                                $('#' + id_tabel).DataTable().ajax.reload(null, false);
                            }
                        }
                    }
                }

            }
        });

        function reconfigure(data = null) {
            if (data != null) {
                $("meta[name=csrf-token]").attr('content', data.responseJSON.csrf_token);
            }

            set_header();
            refresh_token();
        }

        function set_header() {
            $.ajaxSetup({
                headers: {
                    'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        // function reconfigure(data = null){
        //     if(data != null){
        //         $("meta[name=csrf-token]").attr('content', data.responseJSON.csrf_token);
        //     }

        //     $.ajaxSetup({
        //         headers: {
        //             'Csrf-Token':  $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });


        // }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.min.js"></script>

    <script type="text/javascript">
        var socket = undefined;
        var hostname = window.location.origin ? window.location.origin + '' : window.location.protocol + '/' + window.location.host + '';
        // var socket = io( ':2083/absenku-gss');
        // var socket = io.connect( '<?php echo $this->config->item('socket_server') ?>' );
        syncSocket();

        async function syncSocket() {
            let doPromise = new Promise(function(resolve, reject) {

                $.ajax({
                    url: hostname + ":2083",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    xhr: function() {
                        var xhr = $.ajaxSettings.xhr();
                        var setRequestHeader = xhr.setRequestHeader;
                        xhr.setRequestHeader = function(name, value) {
                            if (name == 'Csrf-Token') return;
                            setRequestHeader.call(this, name, value);
                        }
                        return xhr;
                    },
                    success: function(response) {
                        if (response.serverStatus === 'ready') {
                            resolve(response.serverStatus);
                        } else {
                            reject("Error");
                        }
                    },
                    error: function(err) {
                        console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
                    }
                });
            });
            await doPromise.then(
                function(value) {
                    runSocket(value);
                },
                function(error) {
                    runSocket(error);
                }
            );
        }

        function runSocket(v) {
            socket = io(':<?= $this->config->item('socket_port') ?>/<?= $this->config->item('socket_namespace') ?>');

            socket.on('connect', function() {
                socket.emit('connect_users', {
                    'id_karyawan': '<?= $this->session->userdata("id_karyawan") ?>'
                });
            });

            socket.on('look-online', function(data) {
                // console.log(data);
                // $.each(data.data, function(k,v){
                //     setTimeout(function(){
                //     $('.o-stat-'+k).removeClass('text-muted');
                //     $('.o-stat-'+k).addClass('text-success');
                //     $('.o-stat-'+k).text('Online');
                //     $('.n-'+k).html('<span class="heartbit"></span> <span class="point"></span>');
                //     }, 1000);
                // });
            });

            // socket.emit("izin",{'room': '11'});
            socket.on('receive_notif', function(data) {

                if (data.type == 'izin') {
                    load_notif_izin();
                } else if (data.type == 'lembur') {
                    load_notif_lembur();
                }

                if ($.fn.loadlst) {
                    loadlst(data.type);
                }
                // $('.notif').addClass('show');
                if (typeof data.show_notification != 'undefined' && data.show_notification == true) {
                    notifyMe(data.params);
                }
            });

            socket.on('req_token', function(data) {
                var c = data._token;
                $('meta[name="csrf-token"]').attr('content', c);
                set_header();
            });

            socket.on('broadcast', function(data) {
                console.log(data);
            });

            socket.on('receive_visitor_statistic', function(data) {
                // alert2('tes');
                // setVisitorStatistic(data);
                setVisitorStatistic(data);
            });
        }

        function broadcast_visitor_statistik(data) {
            if (socket !== undefined) {
                socket.emit('broadcast_visitor_statistic', data);
            }
        }

        function refresh_token() {
            if (socket !== undefined) {
                socket.emit('refresh-token', {
                    'id_karyawan': '<?= $this->id_user ?>',
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'refresh': true
                });
            }
        }

        function cek_soket() {
            if (socket !== undefined) {
                socket.emit('test-broadcast', {
                    'a': 'b',
                    'c': 'd',
                    'room': '<?php echo $room ?>'
                });
            }
        }

        function disconnect() {
            if (socket !== undefined) {
                socket.emit('disconnect_users', {
                    'user': '<?php echo $user ?>',
                    'room': '<?php echo $room ?>'
                });
            }
        }
    </script>

    <script type="text/javascript">
        var granted = 0;

        function random_int() {
            return Math.floor(Math.random() * 100);
        }

        function checkpermission() {
            if (!("Notification" in window)) {
                alert('This browser does not support');
            } else if (Notification.permission === 'granted') {
                granted = 1;
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function(permission) {

                    if (permission === 'granted') {
                        granted = 1;
                    }

                });
            }
        }

        function notifyMe(params) {
            if (granted == 1) {
                var image = '<?php echo base_url('assets/images/logo/logo.png') ?>';
                var message = params.message;
                if (params.image != null) {
                    image = params.image;
                }

                notification = new Notification(params.title, {
                    body: message,
                    icon: image
                });

                playSound();
                if (typeof params.redirect_url != 'undefined') {
                    notification.onclick = function() {
                        window.location.href = params.redirect_url;
                    }
                }

                // setInterval(function(){ notification.close() }, 60000);
            }
        }

        function playSound() {
            $("#soundeffct").html('<audio autoplay="autoplay"><source src="<?php echo base_url('assets/sound-effect/notification1') ?>.wav" type="audio/wav" /><embed hidden="true" autostart="true" loop="false" src="<?php echo base_url('assets/sound-effect/notification1') ?>.wav" /></audio>');
        }

        function req_token() {
            $.get('<?= route('new.token.req') ?>', function(result) {
                var json = $.parseJSON(result);

                if (json.status) {
                    $('meta[name="csrf-token"]').attr('content', json.csrf_token);
                    reconfigure();
                } else {
                    location.reload();
                }
            });
        }
    </script>
    <script>
        var granted = 0;

        function checkpermission() {
            if (!("Notification" in window)) {
                // alert('This browser does not support');
            } else if (Notification.permission === 'granted') {
                granted = 1;
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function(permission) {

                    if (permission === 'granted') {
                        granted = 1;
                    }

                });
            }
        }
    </script>
</body>

</html>