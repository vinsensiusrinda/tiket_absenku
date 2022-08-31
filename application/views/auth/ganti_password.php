<script type="text/javascript">
    $(function() {
        // ​$("#password").keydown(function (e) {
        //     return e.which !== 32;
        // });​​​​​

        $(".password").keydown(function (e) {
            // Ensure that it is a number and stop the keypress
            if ((e.keyCode == 32)) {
                e.preventDefault();
                $("#jumlah_barang").focus();
                return false();
            }
        });

        $(document).on("click","#btn_save",function(e){
            e.preventDefault();
            $('#message').html("");
            var loading = Ladda.create(this);
        
            if($("#password_lama").val()==""){
                $('#message').html("<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> Password lama belum diisi</font>");
                $("#password_lama").focus();
                return false;
            }else if($("#password_baru").val() ==""){
                $('#message').html("<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> Password baru belum diiisi</font>");
                $('#password_baru').focus();
                return false;
            }else if($("#konfirmasi_password_baru").val() ==""){
                $('#message').html("<font style='color:Crimson'><i class='fa fa-exclamation-triangle'></i> Konfirmasi password baru belum diiisi</font>");
                $('#konfirmasi_password_baru').focus();
                return false;
            }
            
            loading.start();
        
            var param = {};
            param.password_lama = $("#password_lama").val();
            param.password_baru = $("#password_baru").val();
            param.konfirmasi_password_baru = $("#konfirmasi_password_baru").val();

            $.ajax({
                type: 'POST',
                url: "<?= route('ganti.password.proses') ?>",
                data: param,
                dataType:'JSON',
                success: function(result) {
                    loading.stop();
                    $('#message').show();
                    $('#message').html(result.message);
                },
                error:function(){
                    loading.stop();
                    $('#message').show();
                    $('#message').html('<font color="#eb3a28"><i class="fa fa-close(alias)">&nbsp;</i><strong>Gagal : Terjadi Kesalahan</strong></font>');
                }
            });
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
                        <li class="breadcrumb-item"><a href="#">Profil</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $judul ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
        </div>
    </div>
</div>

<div class="card card-rounded">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Password Lama <i class="text-danger">*</i></label>
                        <input type="text" id="password_lama" class="form-control password">
                    </div>                            
                    <div class="form-group">
                        <label>Password Baru <i class="text-danger">*</i></label>
                        <input type="text" id="password_baru" class="form-control password">
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru <i class="text-danger password">*</i></label>
                        <input type="text" id="konfirmasi_password_baru" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-left">
                    <button id="btn_save" class="btn btn-warning ladda-button" data-style="expand-left"><i class="fa fa-edit"></i> GANTI PASSWORD</button>
                    <label id="message"></label>
                </div>
            </div><!-- ./row -->
        </div>
    </div>
</div>

