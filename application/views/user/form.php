<div class="card-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h3 class="title modal-title"></h3>
</div>
<div id="form_input" class="card-body" disabled>
    <input type="hidden" id="id_user" class="form-control" value="<?= ((isset($data)) ? md5($data->id_user) : '') ?>">
    <div class="form-group">
        <label>Nama user <i class="text-danger">*</i></label>
        <input type="text" id="nm_user" class="form-control" value="<?= ((isset($data)) ? $data->nama_user : '') ?>">
    </div>
    <div class="form-group">
        <label>Level User <i class="text-danger">*</i></label>
        <select id="lvl_user" class="form-control select2">
            <option value="0">Pilih</option>
            <option value="1" <?= (isset($data) && $data->level_user == "1") ? "selected" : "" ?>>Admin</option>
            <option value="2" <?= (isset($data) && $data->level_user == "2") ? "selected" : "" ?>>Direksi</option>
            <option value="3" <?= (isset($data) && $data->level_user == "3") ? "selected" : "" ?>>Staff</option>
        </select>
    </div>
    <div class="form-group">
        <label>Username <i class="text-danger">*</i></label>
        <input type="text" id="username" class="form-control" value="<?= ((isset($data)) ? $data->username : '') ?>">
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-md-7 text-left">
            <div id="message"></div>
        </div>
        <div class="col-md-5 text-right">
            <button id="btn_new_input" class="btn" style="display:none">TAMBAH BARU</button>
            <button class="btn_save ladda-button" data-style="expand-left"></button>
        </div>
    </div><!-- ./row -->
</div>