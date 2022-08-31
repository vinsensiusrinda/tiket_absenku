<script type="text/javascript">
    $(function() {
        //PROSES INPUT DATA
        $(document).on('click', '#btn_new_input', function() {
            datepicker();
            dropdown_kota();
            $('#form_input select').prop("enable", false);
            $('#form_input select').prop("value", "0");
            $('#form_input input[type=text]').prop("enable", false);
            $("#form_input input[type=text]").val('');
            $('.btn_save').show();
            $('#btn_new_input').show();
            $('#message').hide();

        });

        //MODUL
        $('#modul').select2({
            placeholder: 'Pilih Modul',
            allowClear: true,
            ajax: {
                // type: 'POST',
                url: '<?= route("dropdown.modul")  ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: false
            },
            minLength: 3
        });

        //SUB MODUL
        $('#submodul').select2({
            placeholder: 'Pilih Submodul',
        });

        //RUBAH KE SUBMODUL
        $("#modul").change(function() {
            $('#submodul').val('0').trigger("change").select2();
            dropdown_submodul();
        });

        //LAYANAN
        $('#tipe_pelanggan').select2({
            placeholder: 'Pilih Tipe Pelanggan',
            allowClear: true,
            ajax: {
                // type: 'POST',
                url: '<?= route("dropdown.tipe_pelanggan")  ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: false
            },
            minLength: 3
        });

        //PELANGGAN
        $('#pelanggan').select2({
            placeholder: 'Pilih Nama Pelanggan',
        });

        $("#tipe_pelanggan").change(function() {
            $('#pelanggan').val('0').trigger("change");
            dropdown_pelanggan();
        });

        // $(document).ready(function() {
        //     $("#modul").select2({
        //         ajax: {
        //             url: '<?= base_url() ?>task/getmodule',
        //             type: "post",
        //             dataType: 'json',
        //             delay: 200,
        //             data: function(params) {
        //                 var search = {
        //                     csrf_token: $("meta[name=csrf-token]").attr('content'),
        //                     searchTerm: params.term
        //                 };
        //                 return search;
        //             },
        //             processResults: function(response) {
        //                 $("meta[name=csrf-token]").attr('content', response.csrf_token)
        //                 return {
        //                     results: response.data
        //                 };
        //             },
        //             cache: false
        //         }
        //     });
        // });



        // $(document).on('change', '#modul', function() {
        //     var id_modul_kategori = $("#modul").val();
        //     $("#submodul").select2({
        //         ajax: {
        //             url: '<?= base_url() ?>task/getsubmodule',
        //             type: "post",
        //             dataType: 'json',
        //             delay: 200,
        //             data: function(params) {
        //                 var search = {
        //                     csrf_token: $("meta[name=csrf-token]").attr('content'),
        //                     searchTerm: params.term,
        //                     id_modul_kategori: id_modul_kategori
        //                 };
        //                 return search;
        //             },
        //             processResults: function(response) {
        //                 $("meta[name=csrf-token]").attr('content', response.csrf_token)
        //                 return {
        //                     results: response.data
        //                 };
        //             },
        //             cache: true
        //         }
        //     });
        // });

        //PROSES SAVE DATA
        $(document).on("click", ".btn_save", function(e) {
            e.preventDefault();
            $('.footer #message').html("");
            $("#form_input").find('.form-control').removeClass("border-red");
            $("#form_input").find('#message').hide();

            var loading = Ladda.create(this);

            if ($("#judul").val() == "") {
                $("#judul").addClass("border-red")
                $('.judul #message').show();
                $("#judul").focus();
                return false;
            } else if ($("#modul").val() == "") {
                $("#modul").addClass("border-red")
                $('.modul #message').show();
                $("#modul").focus();
                return false;
            } else if ($("#submodul").val() == "") {
                $("#submodul").addClass("border-red")
                $('.submodul #message').show();
                $("#submodul").focus();
                return false;
            } else if ($("#keterangan").val() == "") {
                $("#keterangan").addClass("border-red")
                $('.keterangan #message').show();
                $("#keterangan").focus();
                return false;
            } else if ($("#tipe_pelanggan").val() == "") {
                $("#tipe_pelanggan").addClass("border-red")
                $('.tipe_pelanggan #message').show();
                $("#tipe_pelanggan").focus();
                return false;
            } else if ($("#pelanggan").val() == "") {
                $("#pelanggan").addClass("border-red")
                $('.pelanggan #message').show();
                $("#pelanggan").focus();
                return false;
            } else if ($("#tipe").val() == "") {
                $("#tipe").addClass("border-red")
                $('.tipe #message').show();
                $("#tipe").focus();
                return false;
            } else if ($("#platform").val() == "") {
                $("#platform").addClass("border-red")
                $('.platform #message').show();
                $("#platform").focus();
                return false;
            } else if ($("#status").val() == "") {
                $("#status").addClass("border-red")
                $('.status #message').show();
                $("#status").focus();
                return false;
            } else if ($("#prioritas").val() == "") {
                $("#prioritas").addClass("border-red")
                $('.prioritas #message').show();
                $("#prioritas").focus();
                return false;
            } else if ($("#pelimpahan").val() == "") {
                $("#pelimpahan").addClass("border-red")
                $('.pelimpahan #message').show();
                $("#pelimpahan").focus();
                return false;
            } else if ($("#tgl_pengaduan").val() == "") {
                $("#tgl_pengaduan").addClass("border-red")
                $('.tgl_pengaduan #message').show();
                $("#tgl_pengaduan").focus();
                return false;
            }

            loading.start();

            var param = {};
            param.no_tiket = $("#no_tiket").val();
            param.judul = $("#judul").val();
            param.modul = $("#modul").val();
            param.submodul = $("#submodul").val();
            param.keterangan = $("#keterangan").val();
            param.tipe_pelanggan = $("#tipe_pelanggan").val();
            // param.pelanggan = $("#pelanggan").select2('data')[0]['jenis'];
            param.pelanggan = $("#pelanggan").val();
            param.tipe = $("#tipe").val();
            param.platform = $("#platform").val();
            param.status = $("#status").val();
            param.prioritas = $("#prioritas").val();
            param.pelimpahan = $("#pelimpahan").val();
            param.tgl_pengaduan = $("#tgl_pengaduan").val();
            param.tgl_dikerjakan = $("#tgl_dikerjakan").val();
            param.tgl_selesai = $("#tgl_selesai").val();
            param.tgl_konfirmasi = $("#tgl_konfirmasi").val();

            $.ajax({
                type: 'POST',
                url: "<?= route('task.save') ?>",
                data: param,
                dataType: 'JSON',
                success: function(result) {
                    if (result.success == true) {
                        if (result.type == 'save') {
                            $("#form_input :input").prop("disabled", true);
                            $('.btn_save').hide();
                            $('#btn_new_input').show();
                        }

                    }
                    loading.stop();
                    $('.footer #message').show();
                    $('.footer #message').html(result.message);
                },
                error: function() {
                    loading.stop();
                    $('.footer #message').show();
                    $('.footer #message').html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
                }
            });
        });

        // $(document).on("click", ".btn_save", function(e) {
        //     e.preventDefault();
        //     $('.footer #message').html("");
        //     $("#form_input").find('.form-control').removeClass("border-red");
        //     $("#form_input").find('#message').hide();
        //     var elements = document.getElementById("message");
        //     console.log(elements.length);
        //     // return false;

        //     for (var i = 0; i < elements.length; i++) {
        //         elements[i].hide();
        //     }


        //     var loading = Ladda.create(this);

        //     // var html_content = CKEDITOR.instances.keterangan.getData();
        //     // var keterangan = html_content.replace(/\&nbsp;/g, ' ');
        //     // var keterangan = encodeURIComponent(keterangan);

        //     if ($("#judul").val() == "") {
        //         $("#judul").addClass("border-red")
        //         $('.judul #message').show();
        //         $("#judul").focus();
        //         return false;
        //     } else if ($("#modul").val() == "") {
        //         $("#modul").addClass("border-red")
        //         $('.modul #message').show();
        //         $("#modul").focus();
        //         return false;
        //     } else if ($("#submodul").val() == "") {
        //         $("#submodul").addClass("border-red")
        //         $('.submodul #message').show();
        //         $("#submodul").focus();
        //         return false;
        //     } else if ($("#keterangan").val() == "") {
        //         $("#keterangan").addClass("border-red")
        //         $('.keterangan #message').show();
        //         $("#keterangan").focus();
        //         return false;
        //     } else if ($("#tipe_pelanggan").val() == "0") {
        //         $("#tipe_pelanggan").addClass("border-red")
        //         $('.tipe_pelanggan #message').show();
        //         $("#tipe_pelanggan").focus();
        //         return false;
        //     } else if ($("#pelanggan").val() == "") {
        //         $("#pelanggan").addClass("border-red")
        //         $('.pelanggan #message').show();
        //         $("#pelanggan").focus();
        //         return false;
        //     } else if ($("#tipe").val() == "0") {
        //         $("#tipe").addClass("border-red")
        //         $('.tipe #message').show();
        //         $("#tipe").focus();
        //         return false;
        //     } else if ($("#platform").val() == "0") {
        //         $("#platform").addClass("border-red")
        //         $('.platform #message').show();
        //         $("#platform").focus();
        //         return false;
        //     } else if ($("#status").val() == "") {
        //         $("#status").addClass("border-red")
        //         $('.status #message').show();
        //         $("#status").focus();
        //         return false;
        //     } else if ($("#prioritas").val() == "0") {
        //         $("#prioritas").addClass("border-red")
        //         $('.prioritas #message').show();
        //         $("#prioritas").focus();
        //         return false;
        //     } else if ($("#pelimpahan").val() == "") {
        //         $("#pelimpahan").addClass("border-red")
        //         $('.pelimpahan #message').show();
        //         $("#pelimpahan").focus();
        //         return false;
        //     } else if ($("#tgl_pengaduan").val() == "") {
        //         $("#tgl_pengaduan").addClass("border-red")
        //         $('.tgl_pengaduan #message').show();
        //         $("#tgl_pengaduan").focus();
        //         return false;
        //     }

        //     loading.start();

        //     var param = {};
        //     param.judul = $("#judul").val();
        //     param.modul = $("#modul").val();
        //     param.submodul = $("#submodul").val();
        //     param.keterangan = $("#keterangan").val();
        //     param.layanan = $("#tipe_pelanggan").val();
        //     // param.pelanggan = $("#pelanggan").select2('data')[0]['jenis'];
        //     param.pelanggan = $("#pelanggan").val();
        //     param.tipe = $("#tipe").val();
        //     param.platform = $("#platform").val();
        //     param.status = $("#status").val();
        //     param.prioritas = $("#prioritas").val();
        //     param.pelimpahan = $("#pelimpahan").val();
        //     param.tgl_pengaduan = $("#tgl_pengaduan").val();
        //     param.tgl_dikerjakan = $("#tgl_dikerjakan").val();
        //     param.tgl_selesai = $("#tgl_selesai").val();
        //     param.prioritas_pelanggan = $("#prioritas_pelanggan").val();


        //     var form = $('#form-input')[0];
        //     var data = new FormData(form);
        //     // data.append(
        //     //     'keterangan', CKEDITOR.instances['keterangan'].getData()
        //     // )
        //     $.ajax({
        //         type: 'POST',
        //         url: "<?= route('task.save') ?>",
        //         data: param,
        //         dataType: 'JSON',
        //         success: function(result) {
        //             if (result.success == true) {
        //                 if (result.type == 'save') {
        //                     $("#form_input :input").prop("disabled", true);
        //                     $('.btn_save').hide();
        //                     $('#btn_new_input').show();
        //                 }
        //             }
        //             loading.stop();
        //             $('#message').show();
        //             $('#message').html(result.message);
        //         },
        //         error: function() {
        //             loading.stop();
        //             $('#message').show();
        //             $('#message').html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>ERROR BOS Gagal : Terjadi Kesalahan</strong></font>');
        //         }
        //     });
        // });

        // PROSES DELETE
        $(document).on('click', '.btn_hapus', function() {
            var loading = Ladda.create(this);
            loading.start();

            var param = {};
            param.no_tiket = $("#no_tiket").val();

            $.ajax({
                type: 'POST',
                url: "<?= route('task.delete') ?>",
                data: param,
                dataType: 'JSON',
                success: function(result) {
                    $("#modal_hapus .card-body").hide();
                    $("#modal_hapus .card-footer").hide();
                    $("#modal_hapus .title").html(result.message);
                },
                error: function() {
                    loading.stop();
                    $("#modal_hapus .card-body").hide();
                    $("#modal_hapus .card-footer").hide();
                    $("#modal_hapus .footer").html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
                }
            });
        });

    });

    function dropdown_pelanggan() {
        $('#pelanggan').select2({
            placeholder: 'Pilih Pelanggan',
            allowClear: true,
            ajax: {
                // type: 'POST',
                url: '<?= route("dropdown.pelanggan") . "/" ?>' + $('#tipe_pelanggan').val(),
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: false
            },
            minLength: 3
        });
    }

    function dropdown_submodul() {
        $('#submodul').select2({
            placeholder: 'Pilih Submodul',
            allowClear: true,
            ajax: {
                // type: 'POST',
                url: '<?= route("dropdown.submodul") . "/" ?>' + $('#modul').val(),
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: false
            },
            minLength: 3
        });
    }
</script>

<div class="content-header">
    <div class="row align-items-center">
        <div class="content-header-left col-md-6 col-12 mb-md-0 mb-1">
            <h3 class="content-header-title"><?= $judul ?></h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        </li>
                        <li class="breadcrumb-item"><a href="#">Tiket</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $judul ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-rounded">
    <div class="card-content">
        <div class="card-body">
            <div id="form_input" class="row">
                <div class="col-md-10">
                    <div id="form_body" class="row">
                        <form id="form-input">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12"><label class="font-weight-bold">Gangguan</label></div>
                                </div>
                                <input type="hidden" id="no_tiket" class="form-control" value="<?= ((isset($data)) ? md5($data->no_tiket) : '') ?>">
                                <div class="row form-group judul">
                                    <div class="col-md-12">
                                        <label>Judul <i class="text-danger">*</i></label>
                                        <input type="text" placeholder="Masukkan Judul Gangguan" id="judul" name="judul" class="form-control" required value="<?= isset($data->judul) ? $data->judul : '' ?>">
                                        <i id="message" class="text-danger font-size-small" style="display:none">Judul harus diisi</i>
                                    </div>
                                </div>
                                <div class="row form-group modul">
                                    <div class="col-md-12">
                                        <label>Modul <i class="text-danger">*</i></label>
                                        <select id="modul" name="modul" class="form-control select2">
                                            <option value="<?= (($data->id_modul_kategori) ? $data->id_modul_kategori : '') ?>" selected><?= (($data->nama_modul) ? $data->nama_modul : '') ?></option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Modul harus diisi</i>
                                    </div>
                                </div>
                                <div class="row form-group submodul">
                                    <div class="col-md-12">
                                        <label>Sub Modul <i class="text-danger">*</i></label>
                                        <select id="submodul" name="submodul" class="form-control select2">
                                            <option value="<?= (($data->id_submodul) ? $data->id_sub_modul : '') ?>" selected><?= (($data->nama_submodul) ? $data->nama_submodul : '') ?></option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Sub Modul harus diisi</i>
                                    </div>
                                </div>
                                <div class="row form-group keterangan">
                                    <div class="col-md-12">
                                        <label>Keterangan <i class="text-danger">*</i></label>
                                        <textarea id="keterangan" name="keterangan" class="form-control" rows="10"><?= isset($data->keterangan) ? $data->keterangan : '' ?></textarea>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Keterangan harus diisi</i>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="font-weight-bold">Pelanggan</label></div>
                                </div>
                                <div class="form-group">
                                    <label>Layanan <i class="text-danger">*</i></label>
                                    <select id="tipe_pelanggan" name="tipe_pelanggan" class="form-control select2" required>
                                        <option value="<?= (($data->tipe_pelanggan) ? $data->tipe_pelanggan : '') ?>" selected><?= (($data->jenis_registrasi) ? $data->jenis_registrasi : '') ?></option>
                                    </select>
                                    <i id="message" class="text-danger font-size-small" style="display:none">Layanan harus diisi</i>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label>Pelanggan <i class="text-danger">*</i></label>
                                        <select id="pelanggan" name="pelanggan" class="form-control select2-selection select2-selection--multiple">
                                            <option value="<?= (($data->id_company) ? $data->id_company : '') ?>" selected><?= (($data->nama) ? $data->nama : '') ?></option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Pelanggan harus diisi</i>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="font-weight-bold">Detail</label></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 tipe">
                                        <label>Tipe <i class="text-danger">*</i></label>
                                        <select id="tipe" name="tipe" class="form-control">
                                            <option value="" disabled selected>PILIH</option>
                                            <option value="bug" <?= ((isset($data) and $data->tipe == 'bug') ? 'selected' : '') ?>>BUG</option>
                                            <option value="revisi" <?= ((isset($data) and $data->tipe == 'revisi') ? 'selected' : '') ?>>REVISI</option>
                                            <option value="import data" <?= ((isset($data) and $data->tipe == 'import data') ? 'selected' : '') ?>>IMPORT DATA</option>
                                            <option value="tambah fitur" <?= ((isset($data) and $data->tipe == 'tambah fitur') ? 'selected' : '') ?>>TAMBAH FITUR</option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Tipe harus diisi</i>
                                    </div>
                                    <div class="col-md-6 platform">
                                        <label>Platform <i class="text-danger">*</i></label>
                                        <select id="platform" name="platform" class="form-control" required>
                                            <option value="" disabled selected>PILIH</option>
                                            <option value="android" <?= ((isset($data) and $data->platform == 'ANDROID') ? 'selected' : '') ?>>ANDROID</option>
                                            <option value="ios" <?= ((isset($data) and $data->platform == 'IOS') ? 'selected' : '') ?>>IOS</option>
                                            <option value="web" <?= ((isset($data) and $data->platform == 'WEB') ? 'selected' : '') ?>>WEBSITE</option>
                                            <option value="lainnya" <?= ((isset($data) and $data->platform == 'LAINNYA') ? 'selected' : '') ?>>LAINNYA</option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Platform harus diisi</i>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 stat   us">
                                        <label>Status <i class="text-danger">*</i></label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="" disabled selected>PILIH</option>
                                            <option value="new" <?= ((isset($data) and $data->status == 'new') ? 'selected' : '') ?>>NEW</option>
                                            <option value="in progress" <?= ((isset($data) and $data->status == 'in progress') ? 'selected' : '') ?>>IN PROGRESS</option>
                                            <option value="closed" <?= ((isset($data) and $data->status == 'closed') ? 'selected' : '') ?>>CLOSED</option>
                                            <option value="on hold" <?= ((isset($data) and $data->status == 'on hold') ? 'selected' : '') ?>>ON HOLD</option>
                                            <option value="rejected" <?= ((isset($data) and $data->status == 'on hold') ? 'selected' : '') ?>>REJECTED</option>
                                            <option value="menunggu konfirmasi" <?= ((isset($data) and $data->status == 'menunggu konfirmasi') ? 'selected' : '') ?>>MENUNGGU KONFIRMASI</option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Status harus diisi</i>
                                    </div>
                                    <div class="col-md-6 prioritas">
                                        <label>Prioritas <i class="text-danger">*</i></label>
                                        <select id="prioritas" name="prioritas" class="form-control">
                                            <option value="" disabled selected>PILIH</option>
                                            <option value="low" <?= ((isset($data) and $data->prioritas == 'low') ? 'selected' : '') ?>>LOW</option>
                                            <option value="medium" <?= ((isset($data) and $data->prioritas == 'medium') ? 'selected' : '') ?>>MEDIUM</option>
                                            <option value="high" <?= ((isset($data) and $data->prioritas == 'high') ? 'selected' : '') ?>>HIGH</option>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Prioritas harus diisi</i>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 pelimpahan">
                                        <label>Pelimpahan<i class="text-danger">*</i></label>
                                        <select id="pelimpahan" name="pelimpahan" class="form-control">
                                            <option value="" disabled selected>PILIH</option>
                                            <?php foreach ($users as $row) : ?>
                                                <option value=" <?php echo $row->id_user; ?>"><?php echo $row->nama_user; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <i id="message" class="text-danger font-size-small" style="display:none">Pelimpahan harus diisi</i>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="font-weight-bold">Tanggal</label></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6 tgl_pengaduan">
                                        <label>Tanggal Pengaduan <i class="text-danger">*</i></label>
                                        <input type="text" id="tgl_pengaduan" name="id_pengaduan" class="form-control datepicker" placeholder="Tanggal Pengaduan" value="<?= isset($data->tgl_pengaduan) ? $data->tgl_pengaduan : '' ?>">
                                        <i id="message" class="text-danger font-size-small" style="display:none">Tanggal Pengaduan harus diisi</i>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Dikerjakan</label>
                                        <input type="text" id="tgl_dikerjakan" name="tgl_dikerjakan" class="form-control datepicker" placeholder="Tanggal Dikerjakan" value="<?= isset($data->tgl_dikerjakan) ? $data->tgl_dikerjakan : '' ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label>Selesai Dikerjakan</label>
                                        <input type="text" id="tgl_selesai" name="tgl_selesai" class="form-control datepicker" placeholder="Selesai Dikerjakan " value="<?= isset($data->tgl_selesai) ? $data->tgl_selesai : '' ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Konfirmasi</label>
                                        <input type="text" id="tgl_konfirmasi" name="tgl_konfirmasi" class="form-control datepicker" placeholder="Tanggal Konfirmasi " value="<?= isset($data->tgl_konfirmasi) ? $data->tgl_konfirmasi : '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- field foto -->
                                    <div class="card-group">
                                        <div class="card-body col-md-3">
                                            <label>Masukkan Gambar Detail Gangguan 1</label>
                                            <?php
                                            if ($data->foto == "") {
                                                $foto = '';
                                            } else {
                                                $foto = 'data-default-file="' . $this->config->item('base_image') . $data->foto . '"';
                                            }
                                            ?>
                                            <input type="hidden" name="foto1_lama" id="foto1_lama" value="<?= $data->foto ?>">
                                            <input type="file" name="foto1" id="foto1" id="input-file-now-custom-1" class="dropify" <?= $foto ?> data-allowed-file-extensions="jpg png jpeg" />
                                        </div>
                                        <div class="card-body col-md-3">
                                            <label>Masukkan Gambar Detail Gangguan 2</label>
                                            <?php
                                            if ($data->foto == "") {
                                                $foto = '';
                                            } else {
                                                $foto = 'data-default-file="' . $this->config->item('base_image') . $data->foto . '"';
                                            }
                                            ?>
                                            <input type="hidden" name="foto2_lama" id="foto2_lama" value="<?= $data->foto ?>">
                                            <input type="file" name="foto2" id="foto2" id="input-file-now-custom-1" class="dropify" <?= $foto ?> data-allowed-file-extensions="jpg png jpeg" />
                                        </div>
                                        <div class="card-body col-md-3">
                                            <label>Masukkan Gambar Detail Gangguan 3</label>
                                            <?php
                                            if ($data->foto == "") {
                                                $foto = '';
                                            } else {
                                                $foto = 'data-default-file="' . $this->config->item('base_image') . $data->foto . '"';
                                            }
                                            ?>
                                            <input type="hidden" name="foto3_lama" id="foto3_lama" value="<?= $data->foto ?>">
                                            <input type="file" name="foto3" id="foto3" id="input-file-now-custom-1" class="dropify" <?= $foto ?> data-allowed-file-extensions="jpg png jpeg" />
                                        </div>
                                        <div class="card-body col-md-3">
                                            <label>Masukkan Gambar Detail Gangguan 4</label>
                                            <?php
                                            if ($data->foto == "") {
                                                $foto = '';
                                            } else {
                                                $foto = 'data-default-file="' . $this->config->item('base_image') . $data->foto . '"';
                                            }
                                            ?>
                                            <input type="hidden" name="foto4_lama" id="foto4_lama" value="<?= $data->foto ?>">
                                            <input type="file" name="foto4" id="foto4" id="input-file-now-custom-1" class="dropify" <?= $foto ?> data-allowed-file-extensions="jpg png jpeg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="row footer">
                        <div class="col-md-5 text-left">
                            <button class="btn_save btn btn-primary btn-min-width ladda-button" data-style="expand-left"><i class="fa fa-save"></i> SIMPAN</button>
                            <?php
                            if (!empty($id_karyawan)) { ?>
                                <button class="btn btn-secondary btn-min-width" onclick="detail_datadiri('<?= md5($data->id_karyawan) ?>')">
                                    <i class="fa fa-arrow-left"></i> KEMBALI
                                </button>
                            <?php } ?>
                        </div>
                        <div class="col-md-7 text-left">
                            <div id="message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery file upload -->
<script>
    $(document).ready(function() {

        $('.dropify').dropify({
            messages: {
                'default': 'Seret dan lepas atau klik disini',
                'replace': 'Seret dan lepas atau klik disini',
                'remove': 'Hapus',
                'error': 'Ooops, terjadi kesalahaan.'
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

        foto = $('#form_input #foto').dropify();

        foto.on('dropify.afterClear', function(event, element) {
            $("#foto_lama").val("");
        });
    });
</script>

<!-- <script type="text/javascript">
    CKEDITOR.replace('keterangan', {
        height: 300,
    });

    CKEDITOR.config.toolbar = [
        ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
        '/',
        ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['Styles', 'Format', 'Font', 'FontSize']
    ];
</script> -->