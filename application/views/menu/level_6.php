<!-- Horizontal navigation-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">

        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item <?= ($aktif=='gaji')?'active':''?>">
                <a href="<?= site_url('informasi/gaji') ?>" class="nav-link">
                    <i class="fa fa-list-alt"></i>
                    <span>Informasi Gaji</span>
                </a>
            </li>

            <!-- <li class="nav-item <?= ($aktif=='reimburse')?'active':''?>">
                <a href="<?= site_url('reimburse') ?>" class="nav-link">
                    <i class="fa fa-credit-card"></i>
                    <span>Reimburse</span>
                </a>
            </li>

            <li class="dropdown mega-dropdown nav-item <?= in_array($aktif, array('reimburse_departemen', 'reimburse_karyawan')) ? 'show' : '' ?>" data-menu="megamenu">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="fa fa-list-ul"></i><span> Rekap Reimburse</span>
                </a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                    <li class="col-md-12 p-0" data-mega-col="col-md-12">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="<?= ($aktif=='reimburse_departemen')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('reimburse/rekap/departemen') ?>">
                                            Per Departemen
                                        </a>
                                    </li>
                                    <li class="<?= ($aktif=='reimburse_karyawan')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('reimburse/rekap/karyawan') ?>">
                                            Per Karyawan
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Horizontal navigation-->


<!-- script untuk menanggulangi submenu 2 baris -->
    <!-- mohon apabila ada submenu yg 2 baris tambahkan class submenu2 agar fungsi ini terpanggil Thx -->
    <script type="text/javascript">
        $(document).ready(function(){
            if($('li').hasClass("submenu2"))
                $(".app-content").addClass("margin-submenu");
        });
    </script>
<!-- script untuk menanggulangi submenu 2 baris -->