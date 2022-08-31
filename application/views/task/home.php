<script type="text/javascript">
    $(function() {
        // reconfigure();
        list_data = $('#list_data').DataTable({
            'searching': true,
            'searchDelay': 1000,
            'paging': true,
            'lengthChange': true,
            'ordering': true,
            'info': true,
            'scrollX': true,
            'scrollCollapse': true,
            'fixedColumns': true,
            'language': {
                'url': '<?= base_url("assets/plugins/datatables/dataTables-language-id.json") ?>',
                'sEmptyTable': 'Tidak ada data untuk ditampilkan',
                'searchPlaceholder': 'Nama / No. Ticket'
            },
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= route('task.listdata') ?>",
                "type": "POST",
                "complete": function(data) {
                    reconfigure(data);
                }
            },

            "aoColumnDefs": [{
                    "aTargets": [1],
                    "bSortable": false
                }
                <?php
                if (in_array($this->level_user, array("1"))) {
                ?>, {
                        "aTargets": [5],
                        "bSortable": false
                    }

                <?php } ?>
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(0)', nRow).css({
                    'text-align': 'center',
                    'width': '10px'
                });
                $('td:eq(3)', nRow).css({
                    'text-align': 'center'
                });
                $('td:eq(4)', nRow).css({
                    'text-align': 'center'
                });

                <?php
                if (in_array($this->level_user, array("1"))) {
                ?>
                    $('td:eq(5)', nRow).css({
                        'text-align': 'center',
                        'width': '100px'
                    });
                <?php } ?>
            }

        });


        // $(document).on('click', '.btn_tambah', function() {
        //     $('#tampil_hapus').load("<?= route('task.form.tambah') ?>", function() {
        //         $('#modal_hapus').modal('show');
        //         $(".title").text("Form Tambah Data");
        //         $(".btn_save").addClass("btn_save btn btn-primary");
        //         $(".btn_save").append('<i class="fa fa-save"></i> ');
        //         $(".btn_save").append('SIMPAN');
        //         $("#btn_new_input").hide();
        //     });
        // });

        $(document).on('click', '.btn_edit', function() {
            $('#tampil_form').load("<?= route('task.form.edit') ?>" + "/" + $(this).attr('no_tiket'), function() {
                $('#modal_form').modal('show');
                $(".title").text("Form Edit Data");
                $(".btn_save").addClass("btn_save btn btn-warning");
                $(".btn_save").append('<i class="fa fa-edit (alias)"></i> ');
                $(".btn_save").append('PERBARUI');
                $("#btn_new_input").show();
            });
        });

        //btn_hapus
        // $(document).on('click', '.btn_delete', function() {
        //     var id = $(this).attr('id');
        //     $('#modal_hapus').modal('show');
        //     $(".title").text("Apakah Anda ingin menghapus data ini?");
        //     $(".btn_hapus").removeClass("btn_hapus").addClass("btn_hapus btn btn-danger");

        //     //btn_delete
        //     $('.btn_hapus').on('click', function() {
        //         var loading = Ladda.create(this);
        //         loading.start();

        //         var param = {};
        //         param.no_tiket = $("#no_tiket").val();
        //         $.ajax({
        //             type: 'POST',
        //             url: "<?= route('task.delete') ?>",
        //             data: param,
        //             dataType: 'JSON',
        //             complete: function(data) {
        //                 reconfigure(data);
        //             },
        //             success: function(result) {
        //                 loading.stop();
        //                 $("#modal_hapus").modal('hide');
        //                 list_data();
        //             },
        //             error: function() {
        //                 loading.stop();
        //                 $("#modal_hapus .card-body").hide();
        //                 $("#modal_hapus .card-footer").hide();
        //                 $("#modal_hapus .title").html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
        //             }
        //         });
        //     });
        //     //btn_delete
        // });
        //btn_hapus

        $(document).on('click', '.btn_delete', function() {
            $('#tampil_form').load("<?= route('task.form.hapus') ?>" + "/" + $(this).attr('id'), function() {
                var id = $(this).attr('id');
                $('#modal_hapus').modal('show');
                $(".title").text("Apakah Anda ingin menghapus data ini?");
                $(".btn_hapus").removeClass("btn_hapus").addClass("btn_hapus btn btn-danger");
                $(".btn_save").append('<i class="fa fa-trash"></i> ');
                $(".btn_save").append('HAPUS');
                $(".btn_save").removeClass("btn_save").addClass("btn_hapus btn btn-danger");
            });
        });

        //btn_delete
        $('.btn_hapus').on('click', function() {
            var loading = Ladda.create(this);
            loading.start();

            var param = {};
            param.no_tiket = $("#no_tiket").val();
            $.ajax({
                type: 'POST',
                url: "<?= route('task.delete') ?>",
                data: param,
                dataType: 'JSON',
                complete: function(data) {
                    reconfigure(data);
                },
                success: function(result) {
                    loading.stop();
                    $("#modal_hapus").modal('hide');
                    list_data();
                },
                error: function() {
                    loading.stop();
                    $("#modal_hapus .card-body").hide();
                    $("#modal_hapus .card-footer").hide();
                    $("#modal_hapus .title").html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
                }
            });
        });
        //     //btn_delete

        $(document).on('click', '#btn_new_input', function() {
            $('#form_input select').prop("disabled", false);
            $('#form_input select').prop("value", "0");
            $('#form_input input[type=text]').prop("disabled", false);
            $("#form_input input[type=text]").val('');

            $('.btn_save').show();
            $('#btn_new_input').hide();
            $('#message').hide();
        });

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
            param.tgl_input = $("#tgl_pengaduan").val();
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

        // PROSES DELETE
        // $(document).on('click', '.btn_hapus', function() {
        //     var loading = Ladda.create(this);
        //     loading.start();

        //     var param = {};
        //     param.no_tiket = $("#no_tiket").val();

        //     $.ajax({
        //         type: 'POST',
        //         url: "<?= route('task.delete') ?>",
        //         data: param,
        //         dataType: 'JSON',
        //         success: function(result) {
        //             $("#modal_hapus .card-body").hide();
        //             $("#modal_hapus .card-footer").hide();
        //             $("#modal_hapus .title").html(result.message);
        //         },
        //         error: function() {
        //             loading.stop();
        //             $("#modal_hapus .card-body").hide();
        //             $("#modal_hapus .card-footer").hide();
        //             $("#modal_hapus .title").html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
        //         }
        //     });
        // });

    });
</script>
<div class="content-header">
    <div class="row align-items-center">
        <div class="content-header-left col-md-6 col-12 mb-md-0 mb-1">
            <h3 class="content-header-title"><?= $judul ?></h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        </li>
                        <li class="breadcrumb-item"><a href="#">Data Tiket</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $judul ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <?php
            if (in_array($this->level_user, array("1"))) {
            ?>
                <div class="float-md-right">
                    <a href="<?= route('task.form.tambah') ?>">
                        <button type="button" class="btn_tambah btn btn-biru">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<div class="card card-rounded">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="list_data" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">NO TIKET</th>
                            <th class="text-left">TGL PENGADUAN</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-left">TIPE</th>
                            <th class="text-center">PRIORITAS</th>
                            <th class="text-center">JENIS LAYANAN</th>
                            <th class="text-center">PELANGGAN</th>
                            <th class="text-center">MODUL</th>
                            <th class="text-center">JUDUL</th>
                            <th class="text-center">KETERANGAN</th>
                            <th class="text-center">PLATFORM</th>
                            <th class="text-center">PELIMPAHAN</th>
                            <th class="text-center">TGL DIKERJAKAN</th>
                            <th class="text-center">TGL SELESAI</th>
                            <th class="text-center">TGL KONFIRMASI</th>
                            <?php
                            if (in_array($this->level_user, array("1"))) {
                            ?>
                                <th class="text-center">AKSI</th>
                            <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- START TAMPIL MODAL -->
<div id="modal_form" class="modal fade in">
    <div class="modal-dialog modal-md">
        <div id="tampil_form" class="modal-content"></div>
    </div>
</div>
<!-- END TAMPIL MODAL -->
<!-- START TAMPIL MODAL -->
<div id="modal_hapus" class="modal fade in">
    <div class="modal-dialog modal-md">
        <div id="tampil_hapus" class="modal-content">
            <div class="card-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h3 class="title modal-title"></h3>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-7 text-left">
                        <div id="message"></div>
                    </div>
                    <div class="col-md-5 text-right">
                        <button class="btn_hapus ladda-button" id="btn_hapus" data-style="expand-left"><i class="fa fa-trash"></i> HAPUS</button>
                    </div>
                </div><!-- ./row -->
            </div>
        </div>
    </div>
</div>
<!-- END TAMPIL MODAL -->