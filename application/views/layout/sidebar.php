<!-- ====== Start Header ====== -->
<div id="kt_app_header" class="app-header <?= @$h_tc . ' ' . @$h_rsv ?>">

    <!-- ====== Start Header container ====== -->
    <div class="app-container container-fluid bg-white d-flex align-items-stretch justify-content-between" id="kt_app_header_container">

        <!-- ====== Start sidebar mobile toggle ====== -->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <!-- ====== Start Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!-- ====== End sidebar mobile toggle ====== -->

        <!-- ====== Start Mobile logo ====== -->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="<?=base_url()?>" class="d-lg-none">
                <img alt="Logo" src="<?= base_url() ?>assets/img/logo.webp" class="theme-light-show h-30px" />
                <img alt="Logo" src="<?= base_url() ?>assets/img/logo.webp" class="theme-dark-show h-30px" />
            </a>
        </div>
        <!-- ====== Start Mobile logo ====== -->

        <!-- ====== Start Header wrapper ====== -->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">

            <!-- ======= Start Menu wrapper ====== -->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">

                <!-- ====== Start Menu ====== -->
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">

                    <!-- ====== Start Menu item ====== -->
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">

                        <!-- ====== Start Menu link ====== -->
                        <span>
                            <span class="menu-title text-gray-500"><?= @$breadcrumb ?></span>
                        </span>
                        <!--====== End Menu link ====== -->

                    </div>
                    <!--====== End Menu item ====== -->

                </div>
                <!--====== End Menu ====== -->

            </div>
            <!--======= End Menu wrapper ====== -->

        </div>
        <!-- ====== End Header wrapper ====== -->

    </div>
    <!-- ====== End Header container ====== -->
</div>
<!-- ====== End Header ====== -->


<!-- ======  Start Wrapper Side Bar ====== -->
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

    <!-- ====== Start Sidebar Desktop ======-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column" style="background-color: #202B46;" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

        <!-- ====== Start Logo Desktop ===== -->
        <div class="app-sidebar-logo px-6 my-6" id="kt_app_sidebar_logo">

            <!-- ====== Start Logo Desktop ===== -->
            <a href="<?=base_url()?>" class="app-sidebar-logo-default  text-white fw-bold">
                <img alt="Logo" src="<?= base_url() ?>assets/img/logo.png" class="h-70px app-sidebar-logo-default" />
            </a>
            <!--====== End Logo Desktop ===== -->

            <!--====== Start Sidebar Toggle ===== -->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                <span class="svg-icon svg-icon-2 rotate-180">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                        <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                    </svg>
                </span>
            </div>
            <!--====== End Sidebar Toggle =====-->

        </div>
        <!--====== End Logo Desktop ===== -->




        <!-- ====== Start sidebar menu ====== -->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">

            <!-- ====== Start Menu wrapper ====== -->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">

                <!-- ====== Start Menu ====== -->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                    <!-- ====== Start Name Login ===== -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion menu-border-nama pb-3 mb-5 <?= @$h_tc ?>">

                        <!-- ===== Start Menu Name login ===== -->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M35.7303 27.4116C32.769 25.8827 28.7198 25 24 25C13.9927 25 7 28.9684 7 34.6504V44H25V38.142L35.7303 27.4116Z" fill="#B6C2CD" />
                                        <path d="M31 11.1252C31 7.19005 27.8661 4 24.0003 4C23.7435 4 23.4868 4.01439 23.2315 4.0431C19.3891 4.4753 16.6184 7.99641 17.043 11.9077L17.4947 16.0692C17.8612 19.4451 20.6637 22 24.0003 22C27.3369 22 30.1395 19.4451 30.5059 16.0692L30.9577 11.9077C30.9859 11.6479 31 11.3866 31 11.1252Z" fill="currentColor" />
                                        <path d="M43.3845 24L47.9999 28.6153L44.923 31.6921L40.3076 27.0768L43.3845 24Z" fill="currentColor" />
                                        <path d="M38.7692 28.6158L43.3846 33.2311L32.6154 44H28V39.3847L38.7692 28.6158Z" fill="currentColor" />
                                    </svg>

                                </span>
                            </span>
                            <span class="menu-title">
                                <?= $_SESSION["logged_status"]["nama"] ?>
                            </span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--===== End Menu Name login  ===== -->

                        <!-- ======  Start Sub Name Login  ====== -->
                        <div class="menu-sub menu-sub-accordion">

                            <!-- ======  Start Menu Nama Login ===== -->
                            <div class="menu-item">
                                <a class="menu-link" href="<?= base_url() ?>pengguna/ubah/<?= base64_encode($_SESSION["logged_status"]["username"]) ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">
                                        Ganti Password
                                    </span>
                                </a>
                            </div>
                            <!--======  End Menu Nama Login ===== -->

                        </div>
                        <!--======  End Sub Name Login  ====== -->
                    </div>
                    <!--====== End Name Login ===== -->



                    <!--====== Start ALL Side bar ===== -->
            <?php if (($_SESSION["logged_status"]["role"] == "admin")||($_SESSION["logged_status"]["role"] == "GM")||($_SESSION["logged_status"]["role"] == "EAM")) { ?>
                        <!--====== Start Dashboard ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$mn_dash ?>" href="<?= base_url() ?>dashboard">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        <!--====== End Dashboard ===== -->

                        <!--====== Start Master ===== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= @$colmas ?> <?= @$h_tc . ' ' . @$h_rsv ?>">

                            <!-- ===== Start Sub Link Master ===== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2382 4.57447C19.3311 4.10638 19.7418 3.76917 20.219 3.76917H28.5448C29.022 3.76917 29.4327 4.10638 29.5257 4.57447L30.3089 8.52032C30.3765 8.86092 30.6168 9.1401 30.9384 9.27104C32.3203 9.83368 33.6134 10.5607 34.7842 11.4416C35.0578 11.6475 35.4144 11.713 35.7387 11.6031L39.6269 10.2854C40.0759 10.1332 40.5702 10.3173 40.8102 10.7262L44.9578 17.7917C45.2032 18.2098 45.1134 18.7436 44.7448 19.0584L41.6666 21.6871C41.4 21.9148 41.2741 22.2651 41.3221 22.6124C41.4196 23.3187 41.4791 24.0362 41.4791 24.7692C41.4791 25.5022 41.4196 26.2197 41.3221 26.926C41.2741 27.2733 41.4 27.6236 41.6666 27.8513L44.7448 30.48C45.1134 30.7948 45.2032 31.3286 44.9578 31.7467L40.8102 38.8121C40.5702 39.221 40.0759 39.4052 39.6269 39.253L35.7387 37.9353C35.4144 37.8254 35.0578 37.8909 34.7842 38.0968C33.6134 38.9777 32.3203 39.7047 30.9384 40.2673C30.6168 40.3983 30.3765 40.6774 30.3089 41.018L29.5257 44.9639C29.4327 45.432 29.022 45.7692 28.5448 45.7692H20.219C19.7418 45.7692 19.3311 45.432 19.2382 44.9639L18.4549 41.018C18.3873 40.6774 18.147 40.3983 17.8254 40.2673C16.4435 39.7047 15.1504 38.9777 13.9796 38.0968C13.706 37.8909 13.3494 37.8254 13.0251 37.9353L9.13701 39.253C8.68793 39.4052 8.1937 39.221 7.95366 38.8121L3.80611 31.7467C3.56072 31.3286 3.65048 30.7948 4.01911 30.48L7.09731 27.8513C7.36388 27.6236 7.48978 27.2733 7.44181 26.926C7.34425 26.2197 7.28476 25.5022 7.28476 24.7692C7.28476 24.0362 7.34425 23.3187 7.44181 22.6124C7.48978 22.2651 7.36388 21.9148 7.09731 21.6871L4.01911 19.0584C3.65048 18.7436 3.56072 18.2098 3.80611 17.7917L7.95366 10.7262C8.1937 10.3173 8.68793 10.1332 9.13701 10.2854L13.0251 11.6031C13.3494 11.713 13.706 11.6475 13.9796 11.4416C15.1504 10.5607 16.4435 9.83368 17.8254 9.27104C18.147 9.1401 18.3873 8.86092 18.4549 8.52032L19.2382 4.57447ZM24.3819 31.7692C28.2479 31.7692 31.3819 28.6352 31.3819 24.7692C31.3819 20.9032 28.2479 17.7692 24.3819 17.7692C20.5159 17.7692 17.3819 20.9032 17.3819 24.7692C17.3819 28.6352 20.5159 31.7692 24.3819 31.7692Z" fill="currentColor" />
                                            <path d="M31.3818 24.7692C31.3818 28.6352 28.2478 31.7692 24.3818 31.7692C20.5158 31.7692 17.3818 28.6352 17.3818 24.7692C17.3818 20.9032 20.5158 17.7692 24.3818 17.7692C28.2478 17.7692 31.3818 20.9032 31.3818 24.7692Z" fill="#324558" />
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Master</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Sub Link Master  ===== -->

                            <!-- ======  Start Sub Master  ====== -->
                            <div class="menu-sub menu-sub-accordion">

                                <!-- ======  Start Menu pengguna ===== -->
                                <div class="menu-item ">
                                    <a class="menu-link <?= @$side1 ?>" href="<?= base_url() ?>pengguna">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengguna</span>
                                    </a>
                                </div>
                                <!--======  End Menu pengguna ===== -->

                                <!-- ======  Start Menu Assign Staff ===== -->
                                <div class="menu-item ">
                                    <a class="menu-link <?= @$side8 ?>" href="<?= base_url() ?>assignstaff">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Assign Staff</span>
                                    </a>
                                </div>
                                <!--======  End Menu pengguna ===== -->

                                <!-- ======  Start Menu Guide ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side2 ?>" href="<?= base_url() ?>guide">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Guide</span>
                                    </a>
                                </div>
                                <!-- ======  End Menu Guide ===== -->

                                <!-- ======  Start Menu Pengayah ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side3 ?>" href="<?= base_url() ?>pengayah">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengayah</span>
                                    </a>
                                </div>
                                <!-- ======  End  Menu Pengayah ===== -->

                                <!-- ======  Start Menu Pengunjung ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side15 ?>" href="<?= base_url() ?>pengunjung">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengunjung</span>
                                    </a>
                                </div>
                                <!-- ======  End  Menu Pengunjung ===== -->

                                <!-- ======  Start Menu Items ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side4 ?>" href="<?= base_url() ?>items">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Items</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Items ===== -->

                                <!-- ======  Start Menu Produk ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side5 ?>" href="<?= base_url() ?>produk">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Experience</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Produk ===== -->

                                <!-- ======  Start Menu Paket ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side6 ?>" href="<?= base_url() ?>paket">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Paket</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Paket ===== -->

                                <!-- ======  Start Menu Store ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side7 ?>" href="<?= base_url() ?>store">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Divisi</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Store ===== -->

                            </div>
                            <!--======  End Sub Master  ====== -->
                        </div>
                        <!--====== End Master ===== -->


                        <!--====== Start Penyesuaian ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side11 ?>" href="<?= base_url() ?>penyesuaian">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_176_2)">
                                                <mask id="mask0_176_2" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="48" height="48">
                                                    <path d="M48 0H0V48H48V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_176_2)">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 6C8 4.89543 8.89543 4 10 4H38C39.1046 4 40 4.89543 40 6V21.1529C39.3481 21.0522 38.6801 21 38 21C30.8203 21 25 26.8203 25 34C25 38.0209 26.8255 41.6154 29.6929 44H10C8.89543 44 8 43.1046 8 42V6ZM14 10H28V14H14V10ZM14 18H22V22H14V18Z" fill="#B6C2CD" />
                                                    <path d="M14 10H28V14H14V10Z" fill="#324558" />
                                                    <path d="M14 18H22V22H14V18Z" fill="#324558" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M35.6267 24L35.1258 26.5234C34.2905 26.8338 33.5182 27.2674 32.84 27.8145L30.3733 26.9785L28 31.0215L29.9738 32.707C29.9038 33.129 29.8585 33.5586 29.8585 34C29.8585 34.4414 29.9038 34.871 29.9738 35.293L28 36.9785L30.3733 41.0215L32.84 40.1856C33.5182 40.7326 34.2905 41.1662 35.1258 41.4766L35.6267 44H40.3733L40.8742 41.4766C41.7095 41.1662 42.4818 40.7326 43.16 40.1856L45.6267 41.0215L48 36.9785L46.0262 35.293C46.0962 34.871 46.1415 34.4414 46.1415 34C46.1415 33.5586 46.0962 33.129 46.0262 32.707L48 31.0215L45.6267 26.9785L43.16 27.8145C42.4818 27.2674 41.7095 26.8338 40.8742 26.5234L40.3733 24H35.6267ZM41.3334 33.9998C41.3334 35.8408 39.841 37.3332 38 37.3332C36.1591 37.3332 34.6667 35.8408 34.6667 33.9998C34.6667 32.1589 36.1591 30.6665 38 30.6665C39.841 30.6665 41.3334 32.1589 41.3334 33.9998Z" fill="currentcolor" />
                                                </g>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_176_2">
                                                    x
                                                    <rect width="48" height="48" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Penyesuaian</span>
                            </a>
                        </div>
                        <!--====== End Penyesuaian ===== -->



                        <!--====== Start Approval Penyesuaian ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side12 ?>" href="<?= base_url() ?>penyesuaian/approval">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 7V10H32V7H38C39.1046 7 40 7.89543 40 9V42C40 43.1046 39.1046 44 38 44H10C8.89543 44 8 43.1046 8 42V9C8 7.89543 8.89543 7 10 7H16ZM34.4042 21.4242L21.8438 33.8087L14.5958 26.6623L17.4042 23.814L21.8438 28.1913L31.5958 18.5759L34.4042 21.4242Z" fill="currentcolor" />
                                            <path d="M18 4C16.8954 4 16 4.89543 16 6V10H32V6C32 4.89543 31.1046 4 30 4H18Z" fill="#324558" />
                                            <path d="M21.8437 33.8087L34.4041 21.4242L31.5957 18.5759L21.8437 28.1913L17.4041 23.814L14.5957 26.6623L21.8437 33.8087Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Approval Penyesuaian</span>
                            </a>
                        </div>
                        <!--====== End Approval Penyesuaian ===== -->

                        <!--====== Start Kas ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side13 ?>" href="<?= base_url() ?>kas">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 6C11 4.89543 11.8954 4 13 4H35C36.1046 4 37 4.89543 37 6V12H11V6Z" fill="currentcolor" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 42C11 43.1046 11.8954 44 13 44H35C36.1046 44 37 43.1046 37 42V23H11V42ZM19 27H29V30H19V27ZM29 33H19V36H29V33Z" fill="currentcolor" />
                                            <path d="M4 14C4 12.8954 4.89543 12 6 12H42C43.1046 12 44 12.8954 44 14V32C44 33.1046 43.1046 34 42 34H37V23H11V34H6C4.89543 34 4 33.1046 4 32V14Z" fill="#324558" />
                                            <path d="M19 27H29V30H19V27Z" fill="#324558" />
                                            <path d="M19 33H29V36H19V33Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Kas</span>
                            </a>
                        </div>
                        <!--====== End Kas ===== -->

                        <!--====== Start Rekapan Harian ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side14 ?>" href="<?= base_url() ?>kas/tutupharian">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentcolor" />
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558" />
                                            <path d="M13 20H23V24H13V20Z" fill="#324558" />
                                            <path d="M13 30H23V34H13V30Z" fill="#324558" />
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Rekapan Harian</span>
                            </a>
                        </div>
                        <!--====== END Rekapan Harian ===== -->

                        <!--====== Start Rekapan Harian ===== -->
                        <!-- <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                        <a class="menu-link <?= @$side15 ?>" href="<?= base_url() ?>kas/tutupharianguide">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentcolor" />
                                        <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558" />
                                        <path d="M13 20H23V24H13V20Z" fill="#324558" />
                                        <path d="M13 30H23V34H13V30Z" fill="#324558" />
                                        <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Komisi Guide</span>
                        </a>
                    </div> -->
                        <!--====== END Rekapan Harian ===== -->

                        <!--====== Start Rekapan Harian ===== -->
                        <!-- <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                        <a class="menu-link <?= @$side16 ?>" href="<?= base_url() ?>kas/tutupharianpengayah">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentcolor" />
                                        <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558" />
                                        <path d="M13 20H23V24H13V20Z" fill="#324558" />
                                        <path d="M13 30H23V34H13V30Z" fill="#324558" />
                                        <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Komisi Pengayah</span>
                        </a>
                    </div> -->
                        <!--====== END Rekapan Harian ===== -->

                        <!--====== START Laporan ===== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion <?= @$colmas_lp ?> <?= @$h_tc . ' ' . @$h_rsv ?>">

                            <!-- ===== Start Sub Link Master ===== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentcolor" />
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558" />
                                            <path d="M13 20H23V24H13V20Z" fill="#324558" />
                                            <path d="M13 30H23V34H13V30Z" fill="#324558" />
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laporan</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Sub Link Master  ===== -->

                            <!-- ======  Start Sub Master  ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!-- ======  Start Menu Guide ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side15 ?>" href="<?= base_url() ?>kas/komisiguide">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Komisi Guide</span>
                                    </a>
                                </div>
                                <!-- ======  End  Menu Guide ===== -->

                                <!-- ======  Start Menu Pengayah ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side16 ?>" href="<?= base_url() ?>kas/komisipengayah">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Komisi Pengayah</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Pengayah ===== -->

                                <!-- ======  Start Menu Penjualan ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side18 ?>" href="<?= base_url() ?>laporan/penjualan">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Penjualan ===== -->

                                <!-- ======  Start Menu Kas ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side19 ?>" href="<?= base_url() ?>laporan/kas">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kas</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Kas ===== -->

                                <!-- ======  Start Menu Untung Rugi ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side20 ?>" href="<?= base_url() ?>laporan/untungrugi">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Untung Rugi</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Untung Rugi ===== -->

                                <!-- ======  Start Menu Untung Rugi ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side21 ?>" href="<?= base_url() ?>laporan/produkteratas">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Produk Popular</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Untung Rugi ===== -->

                            </div>
                            <!--======  End Sub Master  ====== -->
                        </div>
                        <!--====== End Rekapan Harian ===== -->

                        <!--====== Start Transaksi ===== -->
                        <div class="menu-item menu-accordion <?= @$h_rsv ?>">
                            <a class="menu-link <?= @$sidetc ?>" href="<?= base_url() ?>transaksi">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30.6249 11.0928C30.8674 10.4412 31 9.73605 31 8.99994C31 8.54193 30.9487 8.09591 30.8515 7.6673C39.0853 9.38616 45 14.4744 45 23.4999C45 27.9957 42.7116 32.0715 39 35.0475V40.9999C39 42.1045 38.1046 42.9999 37 42.9999H33.0616C32.1438 42.9999 31.3439 42.3753 31.1213 41.485L30.5457 39.1826C28.4858 39.713 26.2856 39.9999 24 39.9999C22.0601 39.9999 20.1817 39.7932 18.3984 39.4064L17.8787 41.485C17.6561 42.3753 16.8562 42.9999 15.9384 42.9999H12C10.8954 42.9999 10 42.1045 10 40.9999V35.7985C9.57039 35.4964 9.1567 35.1806 8.76005 34.8519C4.85543 34.3117 0 29.7841 0 27.9049V23.9049C0 22.8031 0.890908 21.9095 1.99162 21.9049H1.73096C2.14333 21.9049 2.83715 21.7873 3.21057 20.7744C3.61913 18.2811 4.66275 15.9666 6.68906 14.0218L5.22176 11.7665C4.57061 10.7657 4.96377 9.46175 6.13574 9.23335C7.67875 8.93265 9.96119 8.79979 12.66 9.61005C14.6396 8.61025 16.8468 7.86457 19.207 7.43164C19.072 7.93156 19 8.45734 19 8.99994C19 9.66089 19.1069 10.2969 19.3043 10.8916C20.8218 10.6346 22.393 10.4999 24 10.4999C26.2859 10.4999 28.5138 10.6919 30.6249 11.0928ZM11 22.9999C12.1046 22.9999 13 22.1045 13 20.9999C13 19.8953 12.1046 18.9999 11 18.9999C9.89543 18.9999 9 19.8953 9 20.9999C9 22.1045 9.89543 22.9999 11 22.9999Z" fill="currentcolor" />
                                            <path d="M31 9C31 9.73611 30.8674 10.4413 30.6249 11.0929C28.5138 10.692 26.2859 10.5 24 10.5C22.393 10.5 20.8218 10.6346 19.3043 10.8916C19.1069 10.2969 19 9.66095 19 9C19 5.68629 21.6863 3 25 3C28.3137 3 31 5.68629 31 9Z" fill="#324558" />
                                            <path d="M44.7212 20.251C44.5115 19.0842 44.1866 17.9989 43.7577 16.9934C44.2623 16.3368 44.4999 15.6523 44.4999 14.9999C44.4999 13.7899 43.5622 12.7684 42.5256 12.4229C41.7397 12.1609 41.3149 11.3115 41.5769 10.5255C41.8389 9.73966 42.6883 9.31492 43.4743 9.57689C45.4376 10.2313 47.4999 12.2098 47.4999 14.9999C47.4999 17.126 46.3599 18.9306 44.7212 20.251Z" fill="#324558" />
                                            <path d="M13 21C13 22.1046 12.1046 23 11 23C9.89543 23 9 22.1046 9 21C9 19.8954 9.89543 19 11 19C12.1046 19 13 19.8954 13 21Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Transaksi</span>
                            </a>
                        </div>

                        <!--====== End Transaksi ===== -->
                            <!--====== Start Data Transaksi ===== -->
                            <div class="menu-item menu-accordion <?= @$h_rsv ?>">
                                <a class="menu-link <?= @$sidetc1 ?>" href="<?= base_url() ?>transaksi/listTransaksi">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M30.6249 11.0928C30.8674 10.4412 31 9.73605 31 8.99994C31 8.54193 30.9487 8.09591 30.8515 7.6673C39.0853 9.38616 45 14.4744 45 23.4999C45 27.9957 42.7116 32.0715 39 35.0475V40.9999C39 42.1045 38.1046 42.9999 37 42.9999H33.0616C32.1438 42.9999 31.3439 42.3753 31.1213 41.485L30.5457 39.1826C28.4858 39.713 26.2856 39.9999 24 39.9999C22.0601 39.9999 20.1817 39.7932 18.3984 39.4064L17.8787 41.485C17.6561 42.3753 16.8562 42.9999 15.9384 42.9999H12C10.8954 42.9999 10 42.1045 10 40.9999V35.7985C9.57039 35.4964 9.1567 35.1806 8.76005 34.8519C4.85543 34.3117 0 29.7841 0 27.9049V23.9049C0 22.8031 0.890908 21.9095 1.99162 21.9049H1.73096C2.14333 21.9049 2.83715 21.7873 3.21057 20.7744C3.61913 18.2811 4.66275 15.9666 6.68906 14.0218L5.22176 11.7665C4.57061 10.7657 4.96377 9.46175 6.13574 9.23335C7.67875 8.93265 9.96119 8.79979 12.66 9.61005C14.6396 8.61025 16.8468 7.86457 19.207 7.43164C19.072 7.93156 19 8.45734 19 8.99994C19 9.66089 19.1069 10.2969 19.3043 10.8916C20.8218 10.6346 22.393 10.4999 24 10.4999C26.2859 10.4999 28.5138 10.6919 30.6249 11.0928ZM11 22.9999C12.1046 22.9999 13 22.1045 13 20.9999C13 19.8953 12.1046 18.9999 11 18.9999C9.89543 18.9999 9 19.8953 9 20.9999C9 22.1045 9.89543 22.9999 11 22.9999Z" fill="currentcolor" />
                                                <path d="M31 9C31 9.73611 30.8674 10.4413 30.6249 11.0929C28.5138 10.692 26.2859 10.5 24 10.5C22.393 10.5 20.8218 10.6346 19.3043 10.8916C19.1069 10.2969 19 9.66095 19 9C19 5.68629 21.6863 3 25 3C28.3137 3 31 5.68629 31 9Z" fill="#324558" />
                                                <path d="M44.7212 20.251C44.5115 19.0842 44.1866 17.9989 43.7577 16.9934C44.2623 16.3368 44.4999 15.6523 44.4999 14.9999C44.4999 13.7899 43.5622 12.7684 42.5256 12.4229C41.7397 12.1609 41.3149 11.3115 41.5769 10.5255C41.8389 9.73966 42.6883 9.31492 43.4743 9.57689C45.4376 10.2313 47.4999 12.2098 47.4999 14.9999C47.4999 17.126 46.3599 18.9306 44.7212 20.251Z" fill="#324558" />
                                                <path d="M13 21C13 22.1046 12.1046 23 11 23C9.89543 23 9 22.1046 9 21C9 19.8954 9.89543 19 11 19C12.1046 19 13 19.8954 13 21Z" fill="#324558" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Data Transaksi</span>
                                </a>
                            </div>
                            <!--====== End Data Transaksi ===== -->

                    <!--====== End Transaksi ===== -->
                        <!--====== Start Data Pengantar ===== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?= @$sideres1 ?>" href="<?= base_url() ?>reservasi/pengantar">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Pengantar</span>
                            </a>
                        </div>
                        <!--====== End Data Pengantar  ===== -->

                    <!--====== Start Reservasi ===== -->
                    <div class="menu-item menu-accordion <?= @$h_tc ?>">
                        <a class="menu-link <?= @$sideres ?>" href="<?= base_url() ?>reservasi">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Reservasi</span>
                        </a>
                    </div>
                    <!--====== End Reservasi ===== -->

                    <!--====== Start Laundry ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side17 ?>" href="<?= base_url() ?>laundry">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                                            <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laundry</span>
                            </a>
                        </div>
                    <!--====== End Laundry ===== -->

            <?php }?>
                    <!--====== End ALL Side bar ===== -->
            <?php if (($_SESSION["logged_status"]["role"] == "pengayah")){?>
                        <!--====== Start Data Transaksi ===== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?= @$sideres1 ?>" href="<?= base_url() ?>reservasi/pengantar">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Pengantar</span>
                            </a>
                        </div>
                        <!--====== End Data Transaksi ===== -->

                    <!--====== Start Reservasi ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc ?>">
                            <a class="menu-link <?= @$sideres ?>" href="<?= base_url() ?>reservasi">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Reservasi</span>
                            </a>
                        </div>
            <?php }?>
            <?php if (($_SESSION["logged_status"]["role"] == "kasir") && !empty($_SESSION['logged_status']["storeid"])){?>
                <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                    <a class="menu-link <?= @$side17 ?>" href="<?= base_url() ?>store/penjualan">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                                    <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z" />
                                </svg>
                            </span>
                        </span>
                        <span class="menu-title">Penjualan Divisi</span>
                    </a>
                </div>
            <?php }?>
            <?php if (($_SESSION["logged_status"]["role"] == "kasir") && empty($_SESSION['logged_status']["storeid"])){?>
                        <!--====== Start Transaksi ===== -->
                        <div class="menu-item menu-accordion <?= @$h_rsv ?>">
                            <a class="menu-link <?= @$sidetc ?>" href="<?= base_url() ?>transaksi">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30.6249 11.0928C30.8674 10.4412 31 9.73605 31 8.99994C31 8.54193 30.9487 8.09591 30.8515 7.6673C39.0853 9.38616 45 14.4744 45 23.4999C45 27.9957 42.7116 32.0715 39 35.0475V40.9999C39 42.1045 38.1046 42.9999 37 42.9999H33.0616C32.1438 42.9999 31.3439 42.3753 31.1213 41.485L30.5457 39.1826C28.4858 39.713 26.2856 39.9999 24 39.9999C22.0601 39.9999 20.1817 39.7932 18.3984 39.4064L17.8787 41.485C17.6561 42.3753 16.8562 42.9999 15.9384 42.9999H12C10.8954 42.9999 10 42.1045 10 40.9999V35.7985C9.57039 35.4964 9.1567 35.1806 8.76005 34.8519C4.85543 34.3117 0 29.7841 0 27.9049V23.9049C0 22.8031 0.890908 21.9095 1.99162 21.9049H1.73096C2.14333 21.9049 2.83715 21.7873 3.21057 20.7744C3.61913 18.2811 4.66275 15.9666 6.68906 14.0218L5.22176 11.7665C4.57061 10.7657 4.96377 9.46175 6.13574 9.23335C7.67875 8.93265 9.96119 8.79979 12.66 9.61005C14.6396 8.61025 16.8468 7.86457 19.207 7.43164C19.072 7.93156 19 8.45734 19 8.99994C19 9.66089 19.1069 10.2969 19.3043 10.8916C20.8218 10.6346 22.393 10.4999 24 10.4999C26.2859 10.4999 28.5138 10.6919 30.6249 11.0928ZM11 22.9999C12.1046 22.9999 13 22.1045 13 20.9999C13 19.8953 12.1046 18.9999 11 18.9999C9.89543 18.9999 9 19.8953 9 20.9999C9 22.1045 9.89543 22.9999 11 22.9999Z" fill="currentcolor" />
                                            <path d="M31 9C31 9.73611 30.8674 10.4413 30.6249 11.0929C28.5138 10.692 26.2859 10.5 24 10.5C22.393 10.5 20.8218 10.6346 19.3043 10.8916C19.1069 10.2969 19 9.66095 19 9C19 5.68629 21.6863 3 25 3C28.3137 3 31 5.68629 31 9Z" fill="#324558" />
                                            <path d="M44.7212 20.251C44.5115 19.0842 44.1866 17.9989 43.7577 16.9934C44.2623 16.3368 44.4999 15.6523 44.4999 14.9999C44.4999 13.7899 43.5622 12.7684 42.5256 12.4229C41.7397 12.1609 41.3149 11.3115 41.5769 10.5255C41.8389 9.73966 42.6883 9.31492 43.4743 9.57689C45.4376 10.2313 47.4999 12.2098 47.4999 14.9999C47.4999 17.126 46.3599 18.9306 44.7212 20.251Z" fill="#324558" />
                                            <path d="M13 21C13 22.1046 12.1046 23 11 23C9.89543 23 9 22.1046 9 21C9 19.8954 9.89543 19 11 19C12.1046 19 13 19.8954 13 21Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Transaksi</span>
                            </a>
                        </div>

                        <!--====== End Transaksi ===== -->
                            <!--====== Start Data Transaksi ===== -->
                            <div class="menu-item menu-accordion <?= @$h_rsv ?>">
                                <a class="menu-link <?= @$sidetc1 ?>" href="<?= base_url() ?>transaksi/listTransaksi">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M30.6249 11.0928C30.8674 10.4412 31 9.73605 31 8.99994C31 8.54193 30.9487 8.09591 30.8515 7.6673C39.0853 9.38616 45 14.4744 45 23.4999C45 27.9957 42.7116 32.0715 39 35.0475V40.9999C39 42.1045 38.1046 42.9999 37 42.9999H33.0616C32.1438 42.9999 31.3439 42.3753 31.1213 41.485L30.5457 39.1826C28.4858 39.713 26.2856 39.9999 24 39.9999C22.0601 39.9999 20.1817 39.7932 18.3984 39.4064L17.8787 41.485C17.6561 42.3753 16.8562 42.9999 15.9384 42.9999H12C10.8954 42.9999 10 42.1045 10 40.9999V35.7985C9.57039 35.4964 9.1567 35.1806 8.76005 34.8519C4.85543 34.3117 0 29.7841 0 27.9049V23.9049C0 22.8031 0.890908 21.9095 1.99162 21.9049H1.73096C2.14333 21.9049 2.83715 21.7873 3.21057 20.7744C3.61913 18.2811 4.66275 15.9666 6.68906 14.0218L5.22176 11.7665C4.57061 10.7657 4.96377 9.46175 6.13574 9.23335C7.67875 8.93265 9.96119 8.79979 12.66 9.61005C14.6396 8.61025 16.8468 7.86457 19.207 7.43164C19.072 7.93156 19 8.45734 19 8.99994C19 9.66089 19.1069 10.2969 19.3043 10.8916C20.8218 10.6346 22.393 10.4999 24 10.4999C26.2859 10.4999 28.5138 10.6919 30.6249 11.0928ZM11 22.9999C12.1046 22.9999 13 22.1045 13 20.9999C13 19.8953 12.1046 18.9999 11 18.9999C9.89543 18.9999 9 19.8953 9 20.9999C9 22.1045 9.89543 22.9999 11 22.9999Z" fill="currentcolor" />
                                                <path d="M31 9C31 9.73611 30.8674 10.4413 30.6249 11.0929C28.5138 10.692 26.2859 10.5 24 10.5C22.393 10.5 20.8218 10.6346 19.3043 10.8916C19.1069 10.2969 19 9.66095 19 9C19 5.68629 21.6863 3 25 3C28.3137 3 31 5.68629 31 9Z" fill="#324558" />
                                                <path d="M44.7212 20.251C44.5115 19.0842 44.1866 17.9989 43.7577 16.9934C44.2623 16.3368 44.4999 15.6523 44.4999 14.9999C44.4999 13.7899 43.5622 12.7684 42.5256 12.4229C41.7397 12.1609 41.3149 11.3115 41.5769 10.5255C41.8389 9.73966 42.6883 9.31492 43.4743 9.57689C45.4376 10.2313 47.4999 12.2098 47.4999 14.9999C47.4999 17.126 46.3599 18.9306 44.7212 20.251Z" fill="#324558" />
                                                <path d="M13 21C13 22.1046 12.1046 23 11 23C9.89543 23 9 22.1046 9 21C9 19.8954 9.89543 19 11 19C12.1046 19 13 19.8954 13 21Z" fill="#324558" />
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="menu-title">Data Transaksi</span>
                                </a>
                            </div>
                            <!--====== End Data Transaksi ===== -->
            <?php }?>
                    <!-- ====== Start Menu item Logout ====== -->
                    <div class="menu-item menu-accordion">
                        <!-- ====== Start Menu link ====== -->
                        <a class="menu-link " href="<?= base_url() ?>Auth/logout">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 6C6.89543 6 6 6.89543 6 8V40C6 41.1046 6.89543 42 8 42H40C41.1046 42 42 41.1046 42 40V24V8C42 6.89543 41.1046 6 40 6H8ZM42 24L32 32V26H16V22H32V16L42 24Z" fill="currentColor" />
                                        <path d="M32 16L42 24L32 32V26H16V22H32V16Z" fill="#324558" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Logout</span>
                        </a>
                        <!--====== End Menu link ====== -->

                    </div>
                    <!--====== End Menu item Logout ====== -->

                </div>
                <!--====== End Menu ====== -->
            </div>
            <!--====== End Menu wrapper ====== -->
        </div>
        <!--====== End sidebar menu ====== -->

    </div>
    <!--====== End Sidebar Desktop ======-->


    <!-- ====== Start Main Content ====== -->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">