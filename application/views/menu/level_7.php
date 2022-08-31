<!-- Horizontal navigation-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">

        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="dropdown mega-dropdown nav-item <?= in_array($aktif, array('dashboard', 'kepegawaian')) ? 'show' : '' ?>" data-menu="megamenu">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="fa fa-dashboard"></i><span> Dashboard</span>
                </a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                    <li class="col-md-12 p-0" data-mega-col="col-md-12">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="nav-item <?= ($aktif=='dashboard')?'active':''?>">
                                        <a href="<?= route('dashboard.absensi') ?>" class="nav-link">
                                            <i class="ft-home"></i>
                                            <span>Absensi</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item <?= ($aktif=='kepegawaian')?'active':''?>">
                                        <a href="<?= route('dashboard.kepegawaian') ?>" class="nav-link">
                                            <i class="ft-briefcase"></i>
                                            <span>Kepegawaian</span>
                                        </a>
                                    </li> -->
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown mega-dropdown nav-item <?= in_array($aktif, array('cabang', 'lokasi', 'departemen', 'jabatan', 'shift', 'karyawan', 'jenis_izin', 'jenis_plafon')) ? 'show' : '' ?>" data-menu="megamenu">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="ft-box"></i><span>Master Data</span>
                </a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                    <li class="col-md-12 p-0" data-mega-col="col-md-12">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="<?= ($aktif=='karyawan')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('master/karyawan') ?>">
                                            Karyawan
                                        </a>
                                    </li>
                                    <li class="<?= ($aktif=='shift')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('master/shift') ?>">
                                            Shift
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown mega-dropdown nav-item <?= in_array($aktif, array('perusahaan', 'pengaturan_umum','jam_kerja','pengaturan_shift', 'kepala_cabang', 'kepala_departemen', 'atasan_khusus', 'pengaturan_ijin', 'pengaturan_lembur', 'pengaturan_reimbursement', 'kalender', 'pengaturan_notif')) ? 'show submenu2' : '' ?>" data-menu="megamenu">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="fa fa-cog"></i><span> Pengaturan</span>
                </a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                    <li class="col-md-12 p-0" data-mega-col="col-md-12">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="<?= ($aktif=='pengaturan_shift')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('pengaturan/shift') ?>">
                                            Pengaturan Shift
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown mega-dropdown nav-item <?= in_array($aktif, array('lembur', 'izin','aktivitas','data_absensi','rekap_absensi')) ? 'show' : '' ?>" data-menu="megamenu">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
                    <i class="fa fa-file-text-o"></i><span> Kelola Absensi</span>
                </a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                    <li class="col-md-12 p-0" data-mega-col="col-md-12">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="<?= ($aktif=='data_absensi')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('absensi/data') ?>">
                                            Laporan Absensi
                                        </a>
                                    </li>
                                    <li class="<?= ($aktif=='rekap_absensi')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('rekap/absensi/data') ?>">
                                            Rekap Absensi
                                        </a>
                                    </li>
                                    <li class="<?= ($aktif=='lembur')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('pengajuan/lembur') ?>">
                                            Pengajuan Lembur
                                        </a>
                                    </li>
                                    <li class="<?= ($aktif=='izin')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('pengajuan/izin') ?>">
                                            Pengajuan Izin
                                        </a>
                                    </li>
                                    <li class="<?= ($aktif=='aktivitas')?'active':''?>">
                                        <a class="dropdown-item" href="<?= site_url('laporan/aktivitas') ?>">
                                            Laporan Aktivitas
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- <li class="nav-item <?= ($aktif=='reimburse')?'active':''?>">
                <a href="<?= site_url('reimburse') ?>" class="nav-link">
                    <i class="fa fa-list-alt"></i>
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