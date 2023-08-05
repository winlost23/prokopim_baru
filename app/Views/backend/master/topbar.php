<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="<?= base_url('nimda/home') ?>" class="logo">
            <span>
                <img src="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_logo_header ?>" alt="logo-small" class="logo-sm">
            </span>
            <!--span>
                <img src="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_logo_header ?>" alt="logo-large" class="logo-lg logo-light">
                <img src="<?= base_url() ?>/img/<?= $pengaturan->pengaturan_logo_header ?>" alt="logo-large" class="logo-lg">
            </span-->
        </a>
    </div>
    <!--end logo-->
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url() ?>/avatar/<?= $users->users_foto ?>" alt="profile-user" class="rounded-circle" />
                    <span class="ml-1 nav-user-name hidden-sm"><?= $users->users_name ?> <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= base_url('nimda/users/edit') ?>/<?= session()->userid ?>"><i class="ti-user text-muted mr-2"></i> Profile</a>
                    <a class="dropdown-item" href="<?= base_url('nimda/pengaturan') ?>"><i class="ti-settings text-muted mr-2"></i> Pengaturan</a>
                    <div class="dropdown-divider mb-0"></div>
                    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="ti-power-off text-muted mr-2"></i> Logout</a>
                </div>
            </li>
        </ul>
        <!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
            <li>
                <button class="nav-link button-menu-mobile waves-effect waves-light">
                    <i class="ti-menu nav-icon"></i>
                </button>
            </li>
        </ul>
    </nav>
    <!-- end navbar-->
</div>