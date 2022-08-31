<style media="screen">
    #kelola {
        background-color: #1C77D4;
        color: white;
        border-radius: 25px;
    }

    .horizontal-menu .navbar-light ul#main-menu-navigation>li>#kelola:hover {
        background-color: #1C77D4 !important;
        color: white;
    }
</style>
<!-- Horizontal navigation-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">

        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item <?= ($aktif == 'users') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= route('user.home') ?>">
                    <i class="fa fa-dashboard"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item <?= ($aktif == 'users') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= route('user.home') ?>">
                    <i class="fa fa-users"></i><span>Users</span>
                </a>
            </li>

            <li class="nav-item <?= ($aktif == 'task') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= route('task.home') ?>">
                    <i class="fa fa-ticket"></i><span>Tiket</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Horizontal navigation-->

<!-- script untuk menanggulangi submenu 2 baris -->
<!-- mohon apabila ada submenu yg 2 baris tambahkan class submenu2 agar fungsi ini terpanggil Thx -->
<script type="text/javascript">
    $(document).ready(function() {
        if ($('li').hasClass("submenu2")) {
            $(".app-content").addClass("margin-submenu");
        }
    });

    $(document).on('mouseenter mouseleave', '#kelola', function(e) {
        if (e.type == "mouseenter") {
            // check if it is mouseenter, do something
            $('#alert_kelola_mudah').css('display', 'inline-block');
        } else {
            // if not, mouseleave, do something
            $('#alert_kelola_mudah').css('display', 'none');
        }
    });
</script>
<!-- script untuk menanggulangi submenu 2 baris -->

<script>
    function showhide() {
        var div = document.getElementById("alert_kelola_mudah");
        if (div.style.display !== "none") {
            div.style.display = "none";
        } else {
            div.style.display = "inline-block";
        }
    }
</script>