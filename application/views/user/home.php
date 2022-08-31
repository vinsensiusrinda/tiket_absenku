<script type="text/javascript">
    $(function() {
        reconfigure();
        list_data = $('#list_data').DataTable({
            'searching': true,
            'searchDelay': 1000,
            'paging': true,
            'lengthChange': true,
            'ordering': true,
            'info': true,
            'scrollX': true,
            // 'scrollCollapse': true,
            // 'fixedColumns': true,
            'language': {
                'url': '<?= base_url("assets/plugins/datatables/dataTables-language-id.json") ?>',
                'sEmptyTable': 'Tidak ada data untuk ditampilkan',
                'searchPlaceholder': 'Username/Nama'
            },
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= route('user.listdata') ?>",
                "type": "POST",
                "complete": function(data) {
                    reconfigure(data);
                }
            },

            "aoColumnDefs": [{
                    "aTargets": [0],
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

        //BTN TAMBAH
        $(document).on('click', '.btn_tambah', function() {
            $('#tampil_form').load("<?= route('user.form.tambah') ?>", function() {
                $('#modal_form').modal('show');
                $(".title").text("Form Tambah Data");
                $(".btn_save").addClass("btn_save btn btn-primary");
                $(".btn_save").append('<i class="fa fa-save"></i> ');
                $(".btn_save").append('SIMPAN');
                $("#btn_new_input").hide();
            });
        });

        //PROSES SAVE
        $(document).on("click", ".btn_save", function(e) {
            e.preventDefault();
            $('#message').html("");
            var loading = Ladda.create(this);

            if ($("#nm_user").val() == "") {
                $('#message').html("<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> Nama user belum diisi</font>");
                $("#nm_user").focus();
                return false;
            } else if ($("#lvl_user").val() == "0") {
                $('#message').html("<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> Level user belum dipilih</font>");
                $('#lvl_user').focus();
                return false;
            } else if ($("#username").val() == "") {
                $('#message').html("<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> Username belum diiisi</font>");
                $('#username').focus();
                return false;
            }

            loading.start();

            var param = {};
            param.id_user = $("#id_user").val();
            param.nm_user = $("#nm_user").val();
            param.lvl_user = $("#lvl_user").val();
            param.username = $("#username").val();

            $.ajax({
                type: 'POST',
                url: "<?= route('user.save') ?>",
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
                    $('#message').show();
                    $('#message').html(result.message);
                },
                error: function() {
                    loading.stop();
                    $('#message').show();
                    $('#message').html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
                }
            });
        });

        //BTN EDIT
        $(document).on('click', '.btn_edit', function() {
            $('#tampil_form').load("<?= route('user.form.edit') ?>" + "/" + $(this).attr('id'), function() {
                $('#modal_form').modal('show');
                $(".title").text("Form Edit Data");
                $(".btn_save").addClass("btn_save btn btn-warning");
                $(".btn_save").append('<i class="fa fa-edit (alias)"></i> ');
                $(".btn_save").append('PERBARUI');
                $("#btn_new_input").hide();
            });
        });

        //BTN DELETE
        $(document).on('click', '.btn_delete', function() {
            $('#tampil_form').load("<?= route('user.form.hapus') ?>" + "/" + $(this).attr('id'), function() {
                $('#modal_form').modal('show');
                $(".title").text("Apakah Anda ingin menghapus data ini?");
                $('#form_input input[type=text]').prop("disabled", true);
                $('#form_input select').prop("disabled", true);
                $(".btn_save").append('<i class="fa fa-trash"></i> ');
                $(".btn_save").append('HAPUS');
                $(".btn_save").removeClass("btn_save").addClass("btn_hapus btn btn-danger");
            });
        });

        // PROSES DELETE
        $(document).on('click', '.btn_hapus', function() {
            var loading = Ladda.create(this);
            loading.start();

            var param = {};
            param.id_user = $("#id_user").val();

            $.ajax({
                type: 'POST',
                url: "<?= route('user.delete') ?>",
                data: param,
                dataType: 'JSON',
                success: function(result) {
                    $("#modal_form .card-body").hide();
                    $("#modal_form .card-footer").hide();
                    $("#modal_form .title").html(result.message);
                },
                error: function() {
                    loading.stop();
                    $("#modal_form .card-body").hide();
                    $("#modal_form .card-footer").hide();
                    $("#modal_form .title").html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
                }
            });
        });

        $(document).on('click', '#btn_new_input', function() {
            $('#form_input select').prop("disabled", false);
            $('#form_input select').prop("value", "0");
            $('#form_input input[type=text]').prop("disabled", false);
            $("#form_input input[type=text]").val('');

            $('.btn_save').show();
            $('#btn_new_input').hide();
            $('#message').hide();
        });

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
                        <li class="breadcrumb-item"><a href="#">Data User</a>
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
                    <button type="button" class="btn_tambah btn btn-biru">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
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
                            <th class="text-center">NO</th>
                            <th class="text-left">USERNAME</th>
                            <th class="text-left">NAMA USER</th>
                            <th class="text-center">LEVEL</th>
                            <th class="text-center">AKTIF</th>
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