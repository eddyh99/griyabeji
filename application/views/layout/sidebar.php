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
            <a href="../../demo1/dist/index.html" class="d-lg-none">
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
            <a href="#" class="app-sidebar-logo-default  text-white fw-bold">
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

                    <?php if ($_SESSION["logged_status"]["role"] != "pengayah") { ?>
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
                                        <span class="menu-title">Produk</span>
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
                                        <span class="menu-title">Store</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu Store ===== -->

                            </div>
                            <!--======  End Sub Master  ====== -->
                        </div>
                        <!--====== End Master ===== -->

                        <!-- ====== Start Main Laporan ====== -->
                        <!-- <div class="menu-item pt-5"> -->
                        <!-- ====== Start Menu content ====== -->
                        <!-- <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Laporan</span>
                        </div> -->
                        <!-- ====== End Menu content ====== -->
                        <!-- </div> -->
                        <!-- ====== Start Main Laporan ====== -->


                        <!--====== Start Harga Items ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side8 ?>" href="<?= base_url() ?>items/hargaitems">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.8286 4C28.2981 4 27.7894 4.21071 27.4144 4.58579L5.4144 26.5858C4.63335 27.3668 4.63335 28.6332 5.41439 29.4142L18.5859 42.5858C19.367 43.3668 20.6333 43.3668 21.4144 42.5858L43.4144 20.5858C43.7894 20.2107 44.0001 19.702 44.0001 19.1716V5C44.0001 4.44772 43.5524 4 43.0001 4H28.8286ZM40.0001 12C40.0001 14.2091 38.2093 16 36.0001 16C33.791 16 32.0001 14.2091 32.0001 12C32.0001 9.79086 33.791 8 36.0001 8C38.2093 8 40.0001 9.79086 40.0001 12Z" fill="#B6C2CD" />
                                            <path d="M36 16C38.2092 16 40 14.2091 40 12C40 9.79086 38.2092 8 36 8C33.7909 8 32 9.79086 32 12C32 14.2091 33.7909 16 36 16Z" fill="#324558" />
                                            <path d="M33.5231 42.0783L24.3735 39.6267L40.5979 23.4022L35.9726 40.6641C35.6868 41.731 34.5901 42.3642 33.5231 42.0783Z" fill="currentcolor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Harga Items</span>
                            </a>
                        </div>
                        <!--====== End Harga Items ===== -->

                        <!--====== Start Harga Produk ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side9 ?>" href="<?= base_url() ?>produk/hargaproduk">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M43.8058 10.1644L40.1665 32H16.469C15.4737 32 14.6299 31.2681 14.4891 30.2828L11.4487 9H42.8194C43.4373 9 43.9074 9.55487 43.8058 10.1644ZM24.9999 20V14H28.9999V20H33.9999L26.9999 28L19.9999 20H24.9999Z" fill="currentcolor" />
                                            <path d="M4 8H7.26541L10.5295 30.8485C10.9518 33.8044 13.4833 36 16.4692 36H42V32H16.4692C15.4739 32 14.63 31.2681 14.4893 30.2828L11.1026 6.57574C10.8914 5.09779 9.62566 4 8.1327 4H4V8Z" fill="currentcolor" />
                                            <path d="M25 20V14H29V20H34L27 28L20 20H25Z" fill="#324558" />
                                            <path d="M19 41C19 42.6569 17.6569 44 16 44C14.3431 44 13 42.6569 13 41C13 39.3431 14.3431 38 16 38C17.6569 38 19 39.3431 19 41Z" fill="#324558" />
                                            <path d="M38 44C39.6569 44 41 42.6569 41 41C41 39.3431 39.6569 38 38 38C36.3431 38 35 39.3431 35 41C35 42.6569 36.3431 44 38 44Z" fill="#324558" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Harga Produk</span>
                            </a>
                        </div>
                        <!--====== End Harga Produk ===== -->

                        <!--====== Start Harga Paket ===== -->
                        <div class="menu-item menu-accordion <?= @$h_tc . ' ' . @$h_rsv ?>">
                            <a class="menu-link <?= @$side10 ?>" href="<?= base_url() ?>paket/hargapaket">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.4999 28.2894L11.8104 23.226L19.5 18L12 10.5L2 17.5L5.81348 21.4724V36.2883C5.81348 37.0331 6.22733 37.7162 6.88747 38.061L22.4999 46.2164V28.2894Z" fill="#B6C2CD" />
                                            <path d="M25.5 28.2895V46.2165L41.1126 38.061C41.7728 37.7162 42.1866 37.0331 42.1866 36.2883V21.4724L46.0001 17.5L36.0001 10.5L28.5001 18L36.1897 23.226L25.5 28.2895Z" fill="#B6C2CD" />
                                            <path d="M25.2994 17.2391C25.2994 16.824 25.1976 16.4982 24.9941 16.2617C24.7906 16.0252 24.4331 15.8019 23.9217 15.5917C23.4103 15.3815 22.938 15.1687 22.5049 14.9532C22.0718 14.7378 21.6986 14.4882 21.3855 14.2044C21.0724 13.9207 20.8324 13.5922 20.6654 13.2191C20.4984 12.846 20.4149 12.3941 20.4149 11.8634C20.4149 10.9753 20.7123 10.2449 21.3072 9.67212C21.9022 9.09407 22.6954 8.75776 23.6869 8.66319V7H24.9315V8.69467C25.8865 8.83659 26.6353 9.23331 27.1781 9.88494C27.726 10.5313 28 11.3537 28 12.3521H25.3542C25.3542 11.8055 25.2498 11.3852 25.0411 11.0909C24.8324 10.7966 24.5349 10.6495 24.1487 10.6495C23.8043 10.6495 23.5356 10.7598 23.3425 10.9806C23.1546 11.196 23.0606 11.4955 23.0606 11.8791C23.0606 12.268 23.1702 12.5781 23.3894 12.8092C23.6086 13.0352 23.9609 13.2533 24.4461 13.4635C24.9315 13.6684 25.3881 13.8839 25.816 14.1098C26.2492 14.3305 26.6223 14.5827 26.9354 14.8665C27.2485 15.1503 27.4938 15.4814 27.6712 15.8597C27.8486 16.2381 27.9373 16.6926 27.9373 17.2233C27.9373 18.1219 27.6529 18.855 27.0841 19.4224C26.5205 19.99 25.7508 20.3211 24.7749 20.4156V22H23.5304V20.4078C22.3927 20.2869 21.5186 19.8954 20.908 19.2333C20.3027 18.5659 20 17.6884 20 16.6006H22.6379C22.6379 17.1997 22.7684 17.6568 23.0294 17.9721C23.2955 18.2822 23.6712 18.4372 24.1566 18.4372C24.5114 18.4372 24.7906 18.3321 24.9941 18.1219C25.1976 17.9064 25.2994 17.6122 25.2994 17.2391Z" fill="currentcolor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Harga Paket</span>
                            </a>
                        </div>
                        <!--====== End Harga Paket ===== -->

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
                    <?php } ?>
                    <!--====== End Transaksi ===== -->
                    <?php if ($_SESSION["logged_status"]["role"] != "pengayah") { ?>
                        <?php if ($this->uri->segment(1) == "transaksi") { ?>
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
                        <?php } ?>
                    <?php } ?>

                    <!--====== End Transaksi ===== -->
                    <?php if ($_SESSION["logged_status"]["role"] == "pengayah") { ?>
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
                    <?php } ?>

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
                    <?php if ($_SESSION["logged_status"]["role"] != "pengayah") { ?>
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
                    <?php } ?>
                    <!--====== End Laundry ===== -->


                    <!--====== End ALL Side bar ===== -->


                    <!-- **** START CONDITION LOGIN AS ROLE -->
                    <?php /*?>
                    <?php if (@$_SESSION["logged_status"]["role"]=="Owner"){?>

                        <!-- ====== Start Menu item Dashboard ====== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?=@$mn_dash?>" href="<?=base_url()?>dashboard">
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
                        <!--====== End Menu item Dashboard ====== -->

                        <!-- ====== Start Main Menu Analysis ====== -->
                        <div class="menu-item pt-5">
                            <!-- ====== Start Menu content ====== -->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Analysis</span>
                            </div>
                            <!-- ====== End Menu content ====== -->
                        </div>
                        <!-- ====== Start Main Menu Analysis ====== -->

                        <!-- ====== Start Menu item Setup  ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                            <!-- ===== Start Menu link Setup ===== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2382 4.57447C19.3311 4.10638 19.7418 3.76917 20.219 3.76917H28.5448C29.022 3.76917 29.4327 4.10638 29.5257 4.57447L30.3089 8.52032C30.3765 8.86092 30.6168 9.1401 30.9384 9.27104C32.3203 9.83368 33.6134 10.5607 34.7842 11.4416C35.0578 11.6475 35.4144 11.713 35.7387 11.6031L39.6269 10.2854C40.0759 10.1332 40.5702 10.3173 40.8102 10.7262L44.9578 17.7917C45.2032 18.2098 45.1134 18.7436 44.7448 19.0584L41.6666 21.6871C41.4 21.9148 41.2741 22.2651 41.3221 22.6124C41.4196 23.3187 41.4791 24.0362 41.4791 24.7692C41.4791 25.5022 41.4196 26.2197 41.3221 26.926C41.2741 27.2733 41.4 27.6236 41.6666 27.8513L44.7448 30.48C45.1134 30.7948 45.2032 31.3286 44.9578 31.7467L40.8102 38.8121C40.5702 39.221 40.0759 39.4052 39.6269 39.253L35.7387 37.9353C35.4144 37.8254 35.0578 37.8909 34.7842 38.0968C33.6134 38.9777 32.3203 39.7047 30.9384 40.2673C30.6168 40.3983 30.3765 40.6774 30.3089 41.018L29.5257 44.9639C29.4327 45.432 29.022 45.7692 28.5448 45.7692H20.219C19.7418 45.7692 19.3311 45.432 19.2382 44.9639L18.4549 41.018C18.3873 40.6774 18.147 40.3983 17.8254 40.2673C16.4435 39.7047 15.1504 38.9777 13.9796 38.0968C13.706 37.8909 13.3494 37.8254 13.0251 37.9353L9.13701 39.253C8.68793 39.4052 8.1937 39.221 7.95366 38.8121L3.80611 31.7467C3.56072 31.3286 3.65048 30.7948 4.01911 30.48L7.09731 27.8513C7.36388 27.6236 7.48978 27.2733 7.44181 26.926C7.34425 26.2197 7.28476 25.5022 7.28476 24.7692C7.28476 24.0362 7.34425 23.3187 7.44181 22.6124C7.48978 22.2651 7.36388 21.9148 7.09731 21.6871L4.01911 19.0584C3.65048 18.7436 3.56072 18.2098 3.80611 17.7917L7.95366 10.7262C8.1937 10.3173 8.68793 10.1332 9.13701 10.2854L13.0251 11.6031C13.3494 11.713 13.706 11.6475 13.9796 11.4416C15.1504 10.5607 16.4435 9.83368 17.8254 9.27104C18.147 9.1401 18.3873 8.86092 18.4549 8.52032L19.2382 4.57447ZM24.3819 31.7692C28.2479 31.7692 31.3819 28.6352 31.3819 24.7692C31.3819 20.9032 28.2479 17.7692 24.3819 17.7692C20.5159 17.7692 17.3819 20.9032 17.3819 24.7692C17.3819 28.6352 20.5159 31.7692 24.3819 31.7692Z" fill="currentColor"/>
                                            <path d="M31.3818 24.7692C31.3818 28.6352 28.2478 31.7692 24.3818 31.7692C20.5158 31.7692 17.3818 28.6352 17.3818 24.7692C17.3818 20.9032 20.5158 17.7692 24.3818 17.7692C28.2478 17.7692 31.3818 20.9032 31.3818 24.7692Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Setup</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu link Setup Setup  ===== -->

                            <!-- ======  Start Sub Menu Setup  ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!-- ======  Start Menu item Pengguna ===== -->
                                <div class="menu-item ">
                                    <a class="menu-link <?=@$side1?>" href="<?=base_url()?>admin/pengguna">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengguna</span>
                                    </a>
                                </div>
                                <!--======  End Menu item Pengguna ===== -->

                                <!-- ======  Start Menu item Store ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side2?>" href="<?= base_url()?>admin/store">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Store</span>
                                    </a>
                                </div>
                                <!-- ======  End Menu item Store ===== -->

                                <!-- ======  Start Menu item Brand ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side3?>" href="<?= base_url()?>admin/brand">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Brand</span>
                                    </a>
                                </div>
                                <!-- ======  End  Menu item Brand ===== -->

                                <!-- ======  Start Menu item Kategori ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side4?>" href="<?= base_url()?>admin/kategori">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kategori</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu item Kategori ===== -->

                                <!-- ======  Start Menu item Size ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side5?>" href="<?= base_url()?>admin/size">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Size</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu item Size ===== -->
                                
                            </div>
                            <!--======  End Sub Menu Setup  ====== -->
                        </div>
                        <!-- ====== End Menu item ====== -->

                        <!-- ====== Start Menu item Master Data ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                            <!-- ====== Start Menu link Master Data ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="currentColor" />
                                            <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="currentColor" />
                                            <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="currentColor" />
                                            <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Master Data</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!-- ====== End Menu link Master Data ======-->

                            <!-- ====== Start Sub Menu Master Data ======-->
                            <div class="menu-sub menu-sub-accordion">

                                <!-- ====== Start Menu item Staff ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side6?>" href="<?= base_url()?>admin/assignstaff">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Assign Staff</span>
                                    </a>
                                </div>
                                <!-- ====== Start Menu item Staff ======-->

                                <!--====== Start Menu item Produk ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side7?>" href="<?= base_url()?>admin/produk">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Produk</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Produk ======-->
                                
                                <!--====== Start Menu item Produk Size ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side8?>" href="<?= base_url()?>admin/produksize">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Produk-Size</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Produk Size ======-->

                                <!--====== Start Menu item Stok ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side9?>" href="<?= base_url()?>admin/stok">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stok</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Stok ======-->

                            </div>
                            <!-- ====== End Sub Menu Master Data ======-->

                        </div>
                        <!-- ====== End Menu item Master Data ====== -->

                        <!-- ====== Start Menu item Member ====== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?=@$mn_member?>" href="<?= base_url()?>member">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.0003 5C27.8661 5 31 8.03054 31 11.7689C31 12.0173 30.9859 12.2655 30.9577 12.5123L30.5059 16.4657C30.1395 19.6728 27.3369 22.1 24.0003 22.1C20.6637 22.1 17.8612 19.6728 17.4947 16.4657L17.043 12.5123C16.6184 8.79658 19.3891 5.45153 23.2315 5.04095C23.4868 5.01367 23.7435 5 24.0003 5Z" fill="#B6C2CD"/>
                                            <path d="M10 34.6272C10 28.9293 15 24.95 24 24.95C33 24.95 38 28.9293 38 34.6272V43H10V34.6272Z" fill="#B6C2CD"/>
                                            <path d="M14.0624 12.8529C13.9553 11.916 13.9863 10.9999 14.1385 10.1221C13.7717 10.0421 13.3909 10 13.0002 10C12.8046 10 12.6092 10.0108 12.4147 10.0323C9.48858 10.3565 7.37857 12.9973 7.7019 15.9308L8.04592 19.0519C8.32499 21.5839 10.4592 23.5 13.0002 23.5C14.4746 23.5 15.8121 22.8548 16.7296 21.8185C15.5375 20.4535 14.7345 18.7354 14.5141 16.8063L14.0624 12.8529Z" fill="currentColor"/>
                                            <path d="M45.9999 40.0001H40.9999V34.6273C40.9999 31.1265 39.557 28.0582 36.9177 25.8325C42.778 26.3553 45.9999 29.3163 45.9999 33.39V40.0001Z" fill="currentColor"/>
                                            <path d="M31.271 21.8187C32.4631 20.4536 33.2662 18.7355 33.4866 16.8063L33.9384 12.8529C33.9795 12.493 34.0001 12.1311 34.0001 11.7689C34.0001 11.2065 33.9521 10.6569 33.8601 10.1232C34.0414 10.0837 34.2264 10.0532 34.4148 10.0323C34.6093 10.0108 34.8047 10 35.0003 10C37.9443 10 40.3308 12.3925 40.3308 15.3439C40.3308 15.54 40.3201 15.7359 40.2986 15.9308L39.9546 19.0519C39.6755 21.5839 37.5413 23.5 35.0003 23.5C33.5259 23.5 32.1885 22.8549 31.271 21.8187Z" fill="currentColor"/>
                                            <path d="M7 34.6273C7 31.1265 8.44285 28.0582 11.0822 25.8325C5.22191 26.3553 2 29.3163 2 33.39V40.0001H7V34.6273Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Member</span>
                            </a>
                        </div>
                        <!--====== End Menu item Member ====== -->

                        <!-- ====== Start Main Menu item Laporan -->
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Laporan</span>
                            </div>
                        </div>
                        <!-- ====== End Main Menu item Laporan -->

                        <!-- ===== Start Menu item Lapoan ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--===== Start Menu item Laporan ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor" />
                                            <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laporan</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu item Lapoan ====== -->

                            <!--===== Start Sub Menu Laporan ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side10?>" href="<?= base_url()?>admin/laporan/mutasi">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Global</span>
                                    </a>
                                </div>
                                <!--===== End Menu item Persediaan Global ====== -->

                                <!--===== Start Menu item Persediaan Detail ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side20?>" href="<?= base_url()?>admin/laporan/mutasidetail">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Detail</span>
                                    </a>
                                </div>
                                <!--End Menu item Persediaan Detail-->

                                <!--===== Start Menu item Penjualan Summary ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side11?>" href="<?= base_url()?>admin/laporan/penjualan">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Summary</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Summary ====== -->

                                <!--===== Start Menu item Penjualan Brand ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side15?>" href="<?= base_url()?>admin/laporan/brand">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Brand</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Brand ====== -->

                                <!--===== Start Menu item Drop In/Drop Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side12?>" href="<?= base_url()?>admin/laporan/barang">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Drop In/Drop Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Drop In/Drop Out ====== -->

                                <!--===== Start Menu item Non Tunai ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side14?>" href="<?= base_url()?>admin/laporan/nontunai">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Non Tunai</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Non Tunai ====== -->

                                <!--===== Start Menu item Permintaan ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side17?>" href="<?= base_url()?>admin/laporan/request">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Permintaan</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Permintaan ====== -->

                                <!--===== Start Menu item Retur Konsumen ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side18?>" href="<?= base_url()?>admin/laporan/retur">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Retur Konsumen</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Retur Konsumen ====== -->

                                <!--===== Start Menu item Stok Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side19?>" href="<?= base_url()?>admin/laporan/stokout">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stok Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Stok Out ====== -->

                                <!--===== Start Menu item Kas ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side21?>" href="<?= base_url()?>admin/laporan/kaskeluar">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kas</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Kas ====== -->

                            </div>
                            <!--===== End Sub Menu Laporan ======-->
                        </div>
                        <!--===== Start Menu item Lapoan ====== -->

                        <!-- ====== Start Menu item Rekapan Harian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_tutup?>" href="<?= base_url()?>staff/kas/tutupharian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentColor"/>
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558"/>
                                            <path d="M13 20H23V24H13V20Z" fill="#324558"/>
                                            <path d="M13 30H23V34H13V30Z" fill="#324558"/>
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Rekapan Harian</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Rekapan Harian ====== -->

                        <!-- ====== Start Menu item Stock Out ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_pinjam?>" href="<?= base_url()?>admin/pinjam">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Stock Out</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Stock Out ====== -->


                        <!-- ====== Start Menu item Request Barang ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_req?>" href="<?= base_url()?>admin/moving">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.9071 28.5687L12.2176 23.5053L19.9072 18.2793L12.4072 10.7793L2.40723 17.7793L6.22071 21.7517V36.5676C6.22071 37.3124 6.63456 37.9955 7.2947 38.3403L22.9071 46.4957V28.5687Z" fill="currentColor"/>
                                            <path d="M25.9072 28.5688V46.4958L41.5198 38.3403C42.18 37.9955 42.5938 37.3124 42.5938 36.5676V21.7517L46.4073 17.7793L36.4073 10.7793L28.9073 18.2793L36.5969 23.5053L25.9072 28.5688Z" fill="currentColor"/>
                                            <path d="M26.4072 2.2793H22.4072V8.2793H17.4072L24.4072 16.2793L31.4072 8.2793H26.4072V2.2793Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Request Barang</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Request Barang ====== -->

                        <!-- ====== Start Menu item Konfirmasi Permintaan ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_confirm?>" href="<?= base_url()?>admin/moving/konfirm">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7C4.89543 7 4 7.89543 4 9V39C4 40.1046 4.89543 41 6 41H42C43.1046 41 44 40.1046 44 39V13C44 11.8954 43.1046 11 42 11H24L19 7H6ZM26.5 17L26 28H22L21.5 17H26.5ZM22 35V31H26V35H22Z" fill="currentColor"/>
                                            <path d="M22 28H26L26.5 17H21.5L22 28Z" fill="#324558"/>
                                            <path d="M26 31H22V35H26V31Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Konfirmasi Permintaan</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Konfirmasi Permintaan ====== -->

                    <?php }elseif(@$_SESSION["logged_status"]["role"]=="Office Manager") {?>
                    
                        <!-- ====== Start Menu item Dashboard ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_dash?>" href="<?=base_url()?>dashboard">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Dashboard ====== -->

                        <!-- ====== Start Main Menu Analysis ====== -->
                        <div class="menu-item pt-5">
                            <!-- ====== Start Menu content ====== -->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Analysis</span>
                            </div>
                            <!-- ====== End Menu content ====== -->
                        </div>
                        <!-- ====== Start Main Menu Analysis ====== -->

                        <!-- ====== Start Menu item Setup  ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                            <!-- ===== Start Menu link Setup ===== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2382 4.57447C19.3311 4.10638 19.7418 3.76917 20.219 3.76917H28.5448C29.022 3.76917 29.4327 4.10638 29.5257 4.57447L30.3089 8.52032C30.3765 8.86092 30.6168 9.1401 30.9384 9.27104C32.3203 9.83368 33.6134 10.5607 34.7842 11.4416C35.0578 11.6475 35.4144 11.713 35.7387 11.6031L39.6269 10.2854C40.0759 10.1332 40.5702 10.3173 40.8102 10.7262L44.9578 17.7917C45.2032 18.2098 45.1134 18.7436 44.7448 19.0584L41.6666 21.6871C41.4 21.9148 41.2741 22.2651 41.3221 22.6124C41.4196 23.3187 41.4791 24.0362 41.4791 24.7692C41.4791 25.5022 41.4196 26.2197 41.3221 26.926C41.2741 27.2733 41.4 27.6236 41.6666 27.8513L44.7448 30.48C45.1134 30.7948 45.2032 31.3286 44.9578 31.7467L40.8102 38.8121C40.5702 39.221 40.0759 39.4052 39.6269 39.253L35.7387 37.9353C35.4144 37.8254 35.0578 37.8909 34.7842 38.0968C33.6134 38.9777 32.3203 39.7047 30.9384 40.2673C30.6168 40.3983 30.3765 40.6774 30.3089 41.018L29.5257 44.9639C29.4327 45.432 29.022 45.7692 28.5448 45.7692H20.219C19.7418 45.7692 19.3311 45.432 19.2382 44.9639L18.4549 41.018C18.3873 40.6774 18.147 40.3983 17.8254 40.2673C16.4435 39.7047 15.1504 38.9777 13.9796 38.0968C13.706 37.8909 13.3494 37.8254 13.0251 37.9353L9.13701 39.253C8.68793 39.4052 8.1937 39.221 7.95366 38.8121L3.80611 31.7467C3.56072 31.3286 3.65048 30.7948 4.01911 30.48L7.09731 27.8513C7.36388 27.6236 7.48978 27.2733 7.44181 26.926C7.34425 26.2197 7.28476 25.5022 7.28476 24.7692C7.28476 24.0362 7.34425 23.3187 7.44181 22.6124C7.48978 22.2651 7.36388 21.9148 7.09731 21.6871L4.01911 19.0584C3.65048 18.7436 3.56072 18.2098 3.80611 17.7917L7.95366 10.7262C8.1937 10.3173 8.68793 10.1332 9.13701 10.2854L13.0251 11.6031C13.3494 11.713 13.706 11.6475 13.9796 11.4416C15.1504 10.5607 16.4435 9.83368 17.8254 9.27104C18.147 9.1401 18.3873 8.86092 18.4549 8.52032L19.2382 4.57447ZM24.3819 31.7692C28.2479 31.7692 31.3819 28.6352 31.3819 24.7692C31.3819 20.9032 28.2479 17.7692 24.3819 17.7692C20.5159 17.7692 17.3819 20.9032 17.3819 24.7692C17.3819 28.6352 20.5159 31.7692 24.3819 31.7692Z" fill="currentColor"/>
                                            <path d="M31.3818 24.7692C31.3818 28.6352 28.2478 31.7692 24.3818 31.7692C20.5158 31.7692 17.3818 28.6352 17.3818 24.7692C17.3818 20.9032 20.5158 17.7692 24.3818 17.7692C28.2478 17.7692 31.3818 20.9032 31.3818 24.7692Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Setup</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu link Setup Setup  ===== -->

                            <!-- ======  Start Sub Menu Setup  ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!-- ======  Start Menu item Pengguna ===== -->
                                <div class="menu-item ">
                                    <a class="menu-link <?=@$side1?>" href="<?=base_url()?>admin/pengguna">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengguna</span>
                                    </a>
                                </div>
                                <!--======  End Menu item Pengguna ===== -->

                                <!-- ======  Start Menu item Store ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side2?>" href="<?= base_url()?>admin/store">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Store</span>
                                    </a>
                                </div>
                                <!-- ======  End Menu item Store ===== -->

                                <!-- ======  Start Menu item Brand ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side3?>" href="<?= base_url()?>admin/brand">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Brand</span>
                                    </a>
                                </div>
                                <!-- ======  End  Menu item Brand ===== -->

                                <!-- ======  Start Menu item Kategori ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side4?>" href="<?= base_url()?>admin/kategori">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kategori</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu item Kategori ===== -->

                                <!-- ======  Start Menu item Size ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side5?>" href="<?= base_url()?>admin/size">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Size</span>
                                    </a>
                                </div>
                                <!-- ======  Start Menu item Size ===== -->
                                
                            </div>
                            <!--======  End Sub Menu Setup  ====== -->
                        </div>
                        <!-- ====== End Menu item Setup ====== -->

                        <!-- ====== Start Menu item Master Data ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!-- ====== Start Menu link Master Data ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="currentColor" />
                                            <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="currentColor" />
                                            <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="currentColor" />
                                            <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Master Data</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!-- ====== End Menu link Master Data ======-->

                            <!-- ====== Start Sub Menu Master Data ======-->
                            <div class="menu-sub menu-sub-accordion">

                                <!-- ====== Start Menu item Staff ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side6?>" href="<?= base_url()?>admin/assignstaff">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Assign Staff</span>
                                    </a>
                                </div>
                                <!-- ====== Start Menu item Staff ======-->

                                <!--====== Start Menu item Produk ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side7?>" href="<?= base_url()?>admin/produk">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Produk</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Produk ======-->
                                
                                <!--====== Start Menu item Produk Size ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side8?>" href="<?= base_url()?>admin/produksize">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Produk-Size</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Produk Size ======-->

                                <!--====== Start Menu item Stok Awal  ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side9?>" href="<?= base_url()?>admin/stok">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stok Awal</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Stok  Awal ======-->

                                <!--====== Start Menu item Restock  ======-->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side16?>" href="<?= base_url()?>admin/stok/restok">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Restock</span>
                                    </a>
                                </div>
                                <!--====== End Menu item Restock ======-->

                            </div>
                            <!-- ====== End Sub Menu Master Data ======-->
                        </div>
                        <!-- ====== End Menu item Master Data ====== -->

                        <!-- ====== Start Menu item Member ====== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?=@$mn_member?>" href="<?= base_url()?>member">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.0003 5C27.8661 5 31 8.03054 31 11.7689C31 12.0173 30.9859 12.2655 30.9577 12.5123L30.5059 16.4657C30.1395 19.6728 27.3369 22.1 24.0003 22.1C20.6637 22.1 17.8612 19.6728 17.4947 16.4657L17.043 12.5123C16.6184 8.79658 19.3891 5.45153 23.2315 5.04095C23.4868 5.01367 23.7435 5 24.0003 5Z" fill="#B6C2CD"/>
                                            <path d="M10 34.6272C10 28.9293 15 24.95 24 24.95C33 24.95 38 28.9293 38 34.6272V43H10V34.6272Z" fill="#B6C2CD"/>
                                            <path d="M14.0624 12.8529C13.9553 11.916 13.9863 10.9999 14.1385 10.1221C13.7717 10.0421 13.3909 10 13.0002 10C12.8046 10 12.6092 10.0108 12.4147 10.0323C9.48858 10.3565 7.37857 12.9973 7.7019 15.9308L8.04592 19.0519C8.32499 21.5839 10.4592 23.5 13.0002 23.5C14.4746 23.5 15.8121 22.8548 16.7296 21.8185C15.5375 20.4535 14.7345 18.7354 14.5141 16.8063L14.0624 12.8529Z" fill="currentColor"/>
                                            <path d="M45.9999 40.0001H40.9999V34.6273C40.9999 31.1265 39.557 28.0582 36.9177 25.8325C42.778 26.3553 45.9999 29.3163 45.9999 33.39V40.0001Z" fill="currentColor"/>
                                            <path d="M31.271 21.8187C32.4631 20.4536 33.2662 18.7355 33.4866 16.8063L33.9384 12.8529C33.9795 12.493 34.0001 12.1311 34.0001 11.7689C34.0001 11.2065 33.9521 10.6569 33.8601 10.1232C34.0414 10.0837 34.2264 10.0532 34.4148 10.0323C34.6093 10.0108 34.8047 10 35.0003 10C37.9443 10 40.3308 12.3925 40.3308 15.3439C40.3308 15.54 40.3201 15.7359 40.2986 15.9308L39.9546 19.0519C39.6755 21.5839 37.5413 23.5 35.0003 23.5C33.5259 23.5 32.1885 22.8549 31.271 21.8187Z" fill="currentColor"/>
                                            <path d="M7 34.6273C7 31.1265 8.44285 28.0582 11.0822 25.8325C5.22191 26.3553 2 29.3163 2 33.39V40.0001H7V34.6273Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Member</span>
                            </a>
                        </div>
                        <!--====== End Menu item Member ====== -->

                        <!-- ====== Start Main Menu item Laporan -->
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Laporan</span>
                            </div>
                        </div>
                        <!-- ====== End Main Menu item Laporan -->

                        <!-- ===== Start Menu item Lapoan ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--===== Start Menu item Laporan ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor" />
                                            <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laporan</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu item Lapoan ====== -->

                            <!--===== Start Sub Menu Laporan ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side10?>" href="<?= base_url()?>admin/laporan/mutasi">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Global</span>
                                    </a>
                                </div>
                                <!--===== End Menu item Persediaan Global ====== -->

                                <!--===== Start Menu item Persediaan Detail ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side20?>" href="<?= base_url()?>admin/laporan/mutasidetail">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Detail</span>
                                    </a>
                                </div>
                                <!--End Menu item Persediaan Detail-->

                                <!--===== Start Menu item Penjualan Summary ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side11?>" href="<?= base_url()?>admin/laporan/penjualan">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Summary</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Summary ====== -->

                                <!--===== Start Menu item Penjualan Brand ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side15?>" href="<?= base_url()?>admin/laporan/brand">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Brand</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Brand ====== -->

                                <!--===== Start Menu item Drop In/Drop Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side12?>" href="<?= base_url()?>admin/laporan/barang">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Drop In/Drop Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Drop In/Drop Out ====== -->

                                <!--===== Start Menu item Non Tunai ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side14?>" href="<?= base_url()?>admin/laporan/nontunai">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Non Tunai</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Non Tunai ====== -->

                                <!--===== Start Menu item Permintaan ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side17?>" href="<?= base_url()?>admin/laporan/request">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Permintaan</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Permintaan ====== -->

                                <!--===== Start Menu item Retur Konsumen ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side18?>" href="<?= base_url()?>admin/laporan/retur">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Retur Konsumen</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Retur Konsumen ====== -->

                                <!--===== Start Menu item Stok Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side19?>" href="<?= base_url()?>admin/laporan/stokout">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stok Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Stok Out ====== -->

                                <!--===== Start Menu item Kas ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side21?>" href="<?= base_url()?>admin/laporan/kaskeluar">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kas</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Kas ====== -->

                            </div>
                            <!--===== End Sub Menu Laporan ======-->
                        </div>
                        <!--===== Start Menu item Lapoan ====== -->

                        <!-- ====== Start Menu item Rekapan Harian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_tutup?>" href="<?= base_url()?>staff/kas/tutupharian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentColor"/>
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558"/>
                                            <path d="M13 20H23V24H13V20Z" fill="#324558"/>
                                            <path d="M13 30H23V34H13V30Z" fill="#324558"/>
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Rekapan Harian</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Rekapan Harian ====== -->

                        <!-- ====== Start Menu item Stock Out ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_pinjam?>" href="<?= base_url()?>admin/pinjam">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Stock Out</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Stock Out ====== -->

                        <!-- ====== Start Menu item Request Barang ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_req?>" href="<?= base_url()?>admin/moving">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.9071 28.5687L12.2176 23.5053L19.9072 18.2793L12.4072 10.7793L2.40723 17.7793L6.22071 21.7517V36.5676C6.22071 37.3124 6.63456 37.9955 7.2947 38.3403L22.9071 46.4957V28.5687Z" fill="currentColor"/>
                                            <path d="M25.9072 28.5688V46.4958L41.5198 38.3403C42.18 37.9955 42.5938 37.3124 42.5938 36.5676V21.7517L46.4073 17.7793L36.4073 10.7793L28.9073 18.2793L36.5969 23.5053L25.9072 28.5688Z" fill="currentColor"/>
                                            <path d="M26.4072 2.2793H22.4072V8.2793H17.4072L24.4072 16.2793L31.4072 8.2793H26.4072V2.2793Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Request Barang</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Request Barang ====== -->

                        <!-- ====== Start Menu item Konfirmasi Permintaan ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_confirm?>" href="<?= base_url()?>admin/moving/konfirm">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7C4.89543 7 4 7.89543 4 9V39C4 40.1046 4.89543 41 6 41H42C43.1046 41 44 40.1046 44 39V13C44 11.8954 43.1046 11 42 11H24L19 7H6ZM26.5 17L26 28H22L21.5 17H26.5ZM22 35V31H26V35H22Z" fill="currentColor"/>
                                            <path d="M22 28H26L26.5 17H21.5L22 28Z" fill="#324558"/>
                                            <path d="M26 31H22V35H26V31Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Konfirmasi Permintaan</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Konfirmasi Permintaan ====== -->

                        <!-- ====== Start Menu item Konfirmasi Opname ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_appopname?>" href="<?= base_url()?>admin/opname/konfirm">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7C4.89543 7 4 7.89543 4 9V39C4 40.1046 4.89543 41 6 41H42C43.1046 41 44 40.1046 44 39V13C44 11.8954 43.1046 11 42 11H24L19 7H6ZM15 26.728L17.8284 23.8996L22.0711 28.1422L31.9706 18.2427L34.799 21.0712L22.0711 33.7991L15 26.728Z" fill="currentColor"/>
                                            <path d="M17.8284 23.8996L15 26.728L22.0711 33.7991L34.799 21.0712L31.9706 18.2427L22.0711 28.1422L17.8284 23.8996Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Konfirmasi Opname</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Konfirmasi Opname ====== -->

                        <!-- ====== Start Menu item Penyesuaian Stok ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_opname?>" href="<?= base_url()?>admin/opname">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7C4.89543 7 4 7.89543 4 9V39C4 40.1046 4.89543 41 6 41H42C43.1046 41 44 40.1046 44 39V13C44 11.8954 43.1046 11 42 11H24L19 7H6ZM15 26.728L17.8284 23.8996L22.0711 28.1422L31.9706 18.2427L34.799 21.0712L22.0711 33.7991L15 26.728Z" fill="currentColor"/>
                                            <path d="M17.8284 23.8996L15 26.728L22.0711 33.7991L34.799 21.0712L31.9706 18.2427L22.0711 28.1422L17.8284 23.8996Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Penyesuaian Stok</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Penyesuaian Stok ====== -->
                        
                    <?php }elseif(@$_SESSION["logged_status"]["role"]=="Office Staff"){?>
                        <!-- ====== Start Menu item Dashboard ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_dash?>" href="<?=base_url()?>dashboard">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Dashboard ====== -->

                        <!-- ===== Start Menu item Laporan ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--===== Start Menu item Laporan ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor" />
                                            <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laporan</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu item Lapoan ====== -->

                            <!--===== Start Sub Menu Laporan ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side10?>" href="<?= base_url()?>admin/laporan/mutasi">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Global</span>
                                    </a>
                                </div>
                                <!--===== End Menu item Persediaan Global ====== -->

                                <!--===== Start Menu item Persediaan Detail ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side20?>" href="<?= base_url()?>admin/laporan/mutasidetail">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Detail</span>
                                    </a>
                                </div>
                                <!--End Menu item Persediaan Detail-->

                            </div>
                            <!--===== End Sub Menu Laporan ======-->
                        </div>
                        <!--===== Start Menu item Laporan ====== -->

                        <!-- ====== Start Menu item Rekapan Harian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_tutup?>" href="<?= base_url()?>staff/kas/tutupharian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentColor"/>
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558"/>
                                            <path d="M13 20H23V24H13V20Z" fill="#324558"/>
                                            <path d="M13 30H23V34H13V30Z" fill="#324558"/>
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Rekapan Harian</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Rekapan Harian ====== -->

                        <!-- ====== Start Menu item Request Barang ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_req?>" href="<?= base_url()?>admin/moving">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.9071 28.5687L12.2176 23.5053L19.9072 18.2793L12.4072 10.7793L2.40723 17.7793L6.22071 21.7517V36.5676C6.22071 37.3124 6.63456 37.9955 7.2947 38.3403L22.9071 46.4957V28.5687Z" fill="currentColor"/>
                                            <path d="M25.9072 28.5688V46.4958L41.5198 38.3403C42.18 37.9955 42.5938 37.3124 42.5938 36.5676V21.7517L46.4073 17.7793L36.4073 10.7793L28.9073 18.2793L36.5969 23.5053L25.9072 28.5688Z" fill="currentColor"/>
                                            <path d="M26.4072 2.2793H22.4072V8.2793H17.4072L24.4072 16.2793L31.4072 8.2793H26.4072V2.2793Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Request Barang</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Request Barang ====== -->

                        <!-- ====== Start Menu item Konfirmasi Permintaan ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_confirm?>" href="<?= base_url()?>admin/moving/konfirm">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7C4.89543 7 4 7.89543 4 9V39C4 40.1046 4.89543 41 6 41H42C43.1046 41 44 40.1046 44 39V13C44 11.8954 43.1046 11 42 11H24L19 7H6ZM26.5 17L26 28H22L21.5 17H26.5ZM22 35V31H26V35H22Z" fill="currentColor"/>
                                            <path d="M22 28H26L26.5 17H21.5L22 28Z" fill="#324558"/>
                                            <path d="M26 31H22V35H26V31Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Konfirmasi Permintaan</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Konfirmasi Permintaan ====== -->
                    <?php } elseif(@$_SESSION["logged_status"]["role"]=="Store Manager"){?>

                        <!-- ====== Start Menu item Dashboard ====== -->
                        <div class="menu-item menu-accordion">

                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_dash?>" href="<?=base_url()?>dashboard">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Dashboard ====== -->

                        <!-- ====== Start Main Menu Analysis ====== -->
                        <div class="menu-item pt-5">
                            <!-- ====== Start Menu content ====== -->
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Analysis</span>
                            </div>
                            <!-- ====== End Menu content ====== -->
                        </div>
                        <!-- ====== Start Main Menu Analysis ====== -->

                        <!-- ====== Start Menu item Setup  ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                            <!-- ===== Start Menu link Setup ===== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2382 4.57447C19.3311 4.10638 19.7418 3.76917 20.219 3.76917H28.5448C29.022 3.76917 29.4327 4.10638 29.5257 4.57447L30.3089 8.52032C30.3765 8.86092 30.6168 9.1401 30.9384 9.27104C32.3203 9.83368 33.6134 10.5607 34.7842 11.4416C35.0578 11.6475 35.4144 11.713 35.7387 11.6031L39.6269 10.2854C40.0759 10.1332 40.5702 10.3173 40.8102 10.7262L44.9578 17.7917C45.2032 18.2098 45.1134 18.7436 44.7448 19.0584L41.6666 21.6871C41.4 21.9148 41.2741 22.2651 41.3221 22.6124C41.4196 23.3187 41.4791 24.0362 41.4791 24.7692C41.4791 25.5022 41.4196 26.2197 41.3221 26.926C41.2741 27.2733 41.4 27.6236 41.6666 27.8513L44.7448 30.48C45.1134 30.7948 45.2032 31.3286 44.9578 31.7467L40.8102 38.8121C40.5702 39.221 40.0759 39.4052 39.6269 39.253L35.7387 37.9353C35.4144 37.8254 35.0578 37.8909 34.7842 38.0968C33.6134 38.9777 32.3203 39.7047 30.9384 40.2673C30.6168 40.3983 30.3765 40.6774 30.3089 41.018L29.5257 44.9639C29.4327 45.432 29.022 45.7692 28.5448 45.7692H20.219C19.7418 45.7692 19.3311 45.432 19.2382 44.9639L18.4549 41.018C18.3873 40.6774 18.147 40.3983 17.8254 40.2673C16.4435 39.7047 15.1504 38.9777 13.9796 38.0968C13.706 37.8909 13.3494 37.8254 13.0251 37.9353L9.13701 39.253C8.68793 39.4052 8.1937 39.221 7.95366 38.8121L3.80611 31.7467C3.56072 31.3286 3.65048 30.7948 4.01911 30.48L7.09731 27.8513C7.36388 27.6236 7.48978 27.2733 7.44181 26.926C7.34425 26.2197 7.28476 25.5022 7.28476 24.7692C7.28476 24.0362 7.34425 23.3187 7.44181 22.6124C7.48978 22.2651 7.36388 21.9148 7.09731 21.6871L4.01911 19.0584C3.65048 18.7436 3.56072 18.2098 3.80611 17.7917L7.95366 10.7262C8.1937 10.3173 8.68793 10.1332 9.13701 10.2854L13.0251 11.6031C13.3494 11.713 13.706 11.6475 13.9796 11.4416C15.1504 10.5607 16.4435 9.83368 17.8254 9.27104C18.147 9.1401 18.3873 8.86092 18.4549 8.52032L19.2382 4.57447ZM24.3819 31.7692C28.2479 31.7692 31.3819 28.6352 31.3819 24.7692C31.3819 20.9032 28.2479 17.7692 24.3819 17.7692C20.5159 17.7692 17.3819 20.9032 17.3819 24.7692C17.3819 28.6352 20.5159 31.7692 24.3819 31.7692Z" fill="currentColor"/>
                                            <path d="M31.3818 24.7692C31.3818 28.6352 28.2478 31.7692 24.3818 31.7692C20.5158 31.7692 17.3818 28.6352 17.3818 24.7692C17.3818 20.9032 20.5158 17.7692 24.3818 17.7692C28.2478 17.7692 31.3818 20.9032 31.3818 24.7692Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Setup</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu link Setup Setup  ===== -->

                            <!-- ======  Start Sub Menu Setup  ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!-- ======  Start Menu item Pengguna ===== -->
                                <div class="menu-item ">
                                    <a class="menu-link <?=@$side1?>" href="<?=base_url()?>admin/pengguna">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pengguna</span>
                                    </a>
                                </div>
                                <!--======  End Menu item Pengguna ===== -->

                                <!-- ======  Start Menu item Store ===== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side2?>" href="<?= base_url()?>admin/store">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Store</span>
                                    </a>
                                </div>
                                <!-- ======  End Menu item Store ===== -->
                                
                            </div>
                            <!--======  End Sub Menu Setup  ====== -->
                        </div>
                        <!-- ====== End Menu item ====== -->

                        <!-- ====== Start Menu item Master Data ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">

                            <!-- ====== Start Menu link Master Data ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="currentColor" />
                                            <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="currentColor" />
                                            <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="currentColor" />
                                            <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Master Data</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!-- ====== End Menu link Master Data ======-->

                            <!-- ====== Start Sub Menu Master Data ======-->
                            <div class="menu-sub menu-sub-accordion">

                                <!-- ====== Start Menu item Staff ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side6?>" href="<?= base_url()?>admin/assignstaff">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Staff</span>
                                    </a>
                                </div>
                                <!-- ====== Start Menu item Staff ======-->

                            </div>
                            <!-- ====== End Sub Menu Master Data ======-->

                        </div>
                        <!-- ====== End Menu item Master Data ====== -->

                        <!-- ====== Start Menu item Member ====== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?=@$mn_member?>" href="<?= base_url()?>member">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.0003 5C27.8661 5 31 8.03054 31 11.7689C31 12.0173 30.9859 12.2655 30.9577 12.5123L30.5059 16.4657C30.1395 19.6728 27.3369 22.1 24.0003 22.1C20.6637 22.1 17.8612 19.6728 17.4947 16.4657L17.043 12.5123C16.6184 8.79658 19.3891 5.45153 23.2315 5.04095C23.4868 5.01367 23.7435 5 24.0003 5Z" fill="#B6C2CD"/>
                                            <path d="M10 34.6272C10 28.9293 15 24.95 24 24.95C33 24.95 38 28.9293 38 34.6272V43H10V34.6272Z" fill="#B6C2CD"/>
                                            <path d="M14.0624 12.8529C13.9553 11.916 13.9863 10.9999 14.1385 10.1221C13.7717 10.0421 13.3909 10 13.0002 10C12.8046 10 12.6092 10.0108 12.4147 10.0323C9.48858 10.3565 7.37857 12.9973 7.7019 15.9308L8.04592 19.0519C8.32499 21.5839 10.4592 23.5 13.0002 23.5C14.4746 23.5 15.8121 22.8548 16.7296 21.8185C15.5375 20.4535 14.7345 18.7354 14.5141 16.8063L14.0624 12.8529Z" fill="currentColor"/>
                                            <path d="M45.9999 40.0001H40.9999V34.6273C40.9999 31.1265 39.557 28.0582 36.9177 25.8325C42.778 26.3553 45.9999 29.3163 45.9999 33.39V40.0001Z" fill="currentColor"/>
                                            <path d="M31.271 21.8187C32.4631 20.4536 33.2662 18.7355 33.4866 16.8063L33.9384 12.8529C33.9795 12.493 34.0001 12.1311 34.0001 11.7689C34.0001 11.2065 33.9521 10.6569 33.8601 10.1232C34.0414 10.0837 34.2264 10.0532 34.4148 10.0323C34.6093 10.0108 34.8047 10 35.0003 10C37.9443 10 40.3308 12.3925 40.3308 15.3439C40.3308 15.54 40.3201 15.7359 40.2986 15.9308L39.9546 19.0519C39.6755 21.5839 37.5413 23.5 35.0003 23.5C33.5259 23.5 32.1885 22.8549 31.271 21.8187Z" fill="currentColor"/>
                                            <path d="M7 34.6273C7 31.1265 8.44285 28.0582 11.0822 25.8325C5.22191 26.3553 2 29.3163 2 33.39V40.0001H7V34.6273Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Member</span>
                            </a>
                        </div>
                        <!--====== End Menu item Member ====== -->

                        <!-- ====== Start Main Menu item Laporan -->
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Laporan</span>
                            </div>
                        </div>
                        <!-- ====== End Main Menu item Laporan -->

                        <!-- ===== Start Menu item Lapoan ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--===== Start Menu item Laporan ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor" />
                                            <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laporan</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu item Lapoan ====== -->

                            <!--===== Start Sub Menu Laporan ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side10?>" href="<?= base_url()?>admin/laporan/mutasi">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Global</span>
                                    </a>
                                </div>
                                <!--===== End Menu item Persediaan Global ====== -->

                                <!--===== Start Menu item Persediaan Detail ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side20?>" href="<?= base_url()?>admin/laporan/mutasidetail">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Detail</span>
                                    </a>
                                </div>
                                <!--End Menu item Persediaan Detail-->

                                <!--===== Start Menu item Penjualan Summary ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side11?>" href="<?= base_url()?>admin/laporan/penjualan">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Summary</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Summary ====== -->

                                <!--===== Start Menu item Penjualan Brand ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side15?>" href="<?= base_url()?>admin/laporan/brand">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Brand</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Brand ====== -->

                                <!--===== Start Menu item Drop In/Drop Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side12?>" href="<?= base_url()?>admin/laporan/barang">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Drop In/Drop Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Drop In/Drop Out ====== -->

                                <!--===== Start Menu item Non Tunai ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side14?>" href="<?= base_url()?>admin/laporan/nontunai">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Non Tunai</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Non Tunai ====== -->

                                <!--===== Start Menu item Permintaan ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side17?>" href="<?= base_url()?>admin/laporan/request">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Permintaan</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Permintaan ====== -->

                                <!--===== Start Menu item Retur Konsumen ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side18?>" href="<?= base_url()?>admin/laporan/retur">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Retur Konsumen</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Retur Konsumen ====== -->

                                <!--===== Start Menu item Stok Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side19?>" href="<?= base_url()?>admin/laporan/stokout">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stok Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Stok Out ====== -->

                                <!--===== Start Menu item Kas ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side21?>" href="<?= base_url()?>admin/laporan/kaskeluar">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kas</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Kas ====== -->

                            </div>
                            <!--===== End Sub Menu Laporan ======-->
                        </div>
                        <!--===== Start Menu item Lapoan ====== -->

                        <!-- ====== Start Menu item Stok Opname ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_opname?>" href="<?= base_url()?>admin/opname">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M42 18H6V40C6 41.1046 6.89543 42 8 42H40C41.1046 42 42 41.1046 42 40V18ZM16 24H32V28H16V24Z" fill="currentColor"/>
                                            <path d="M10 6H38V9H10V6Z" fill="#324558"/>
                                            <path d="M8 11H40V15H8V11Z" fill="#324558"/>
                                            <path d="M32 24H16V28H32V24Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Stok Opname</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Stok Opname ====== -->

                        <!-- ====== Start Menu item Ganti Cara Bayar ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_bayar?>" href="<?= base_url()?>admin/bayar">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.6998 2.68525C24.3111 2.30446 23.6892 2.30446 23.3004 2.68525L17.8047 8.06801C17.6204 8.24856 17.3734 8.35087 17.1154 8.35355L9.42319 8.43338C8.87903 8.43903 8.43928 8.87878 8.43363 9.42295L8.3538 17.1152C8.35113 17.3732 8.24881 17.6202 8.06825 17.8045L2.68549 23.3002C2.3047 23.6889 2.3047 24.3109 2.68549 24.6996L8.06825 30.1953C8.24881 30.3796 8.35113 30.6266 8.3538 30.8846L8.43363 38.5768C8.43928 39.121 8.87903 39.5608 9.42319 39.5664L17.1154 39.6462C17.3734 39.6489 17.6204 39.7512 17.8047 39.9318L23.3004 45.3145C23.6892 45.6953 24.3111 45.6953 24.6998 45.3145L30.1955 39.9318C30.3798 39.7512 30.6268 39.6489 30.8849 39.6462L38.5771 39.5664C39.1212 39.5608 39.561 39.121 39.5666 38.5768L39.6465 30.8846C39.6491 30.6266 39.7515 30.3796 39.932 30.1953L45.3148 24.6996C45.6956 24.3109 45.6956 23.6889 45.3148 23.3002L39.932 17.8045C39.7515 17.6202 39.6491 17.3732 39.6465 17.1152L39.5666 9.42295C39.561 8.87878 39.1212 8.43903 38.5771 8.43338L30.8849 8.35355C30.6268 8.35087 30.3798 8.24856 30.1955 8.06801L24.6998 2.68525ZM25.4767 26.6196C25.7813 26.9712 25.9337 27.4556 25.9337 28.0728C25.9337 28.6274 25.7813 29.0649 25.4767 29.3853C25.172 29.6978 24.754 29.854 24.2228 29.854C23.4962 29.854 22.9337 29.6235 22.5353 29.1626C22.1446 28.6938 21.9493 28.0142 21.9493 27.1235H18.0001C18.0001 28.7407 18.4532 30.0454 19.3595 31.0376C20.2735 32.022 21.5821 32.604 23.2853 32.7837V35.1509H25.1485V32.7954C26.6095 32.6548 27.7618 32.1626 28.6056 31.3188C29.4571 30.4751 29.8829 29.3853 29.8829 28.0493C29.8829 27.2603 29.7501 26.5845 29.4845 26.022C29.2189 25.4595 28.8517 24.9673 28.3829 24.5454C27.9142 24.1235 27.3556 23.7485 26.7071 23.4204C26.0665 23.0845 25.3829 22.7642 24.6563 22.4595C23.9298 22.147 23.4024 21.8228 23.0743 21.4868C22.7462 21.1431 22.5821 20.6821 22.5821 20.104C22.5821 19.5337 22.7228 19.0884 23.004 18.7681C23.2931 18.4399 23.6954 18.2759 24.211 18.2759C24.7892 18.2759 25.2345 18.4946 25.547 18.9321C25.8595 19.3696 26.0157 19.9946 26.0157 20.8071H29.9767C29.9767 19.3228 29.5665 18.1001 28.7462 17.1392C27.9337 16.1704 26.8126 15.5806 25.3829 15.3696V12.8501H23.5196V15.3228C22.0353 15.4634 20.8478 15.9634 19.9571 16.8228C19.0665 17.6743 18.6212 18.7603 18.6212 20.0806C18.6212 20.8696 18.7462 21.5415 18.9962 22.0962C19.2462 22.6509 19.6056 23.1392 20.0743 23.561C20.5431 23.9829 21.1017 24.354 21.7501 24.6743C22.3985 24.9946 23.1056 25.311 23.8712 25.6235C24.6368 25.936 25.172 26.2681 25.4767 26.6196Z" fill="currentColor"/>
                                            <path d="M25.9336 28.0728C25.9336 27.4556 25.7812 26.9712 25.4766 26.6196C25.1719 26.2681 24.6367 25.936 23.8711 25.6235C23.1055 25.311 22.3984 24.9946 21.75 24.6743C21.1016 24.354 20.543 23.9829 20.0742 23.561C19.6055 23.1392 19.2461 22.6509 18.9961 22.0962C18.7461 21.5415 18.6211 20.8696 18.6211 20.0806C18.6211 18.7603 19.0664 17.6743 19.957 16.8228C20.8477 15.9634 22.0352 15.4634 23.5195 15.3228V12.8501H25.3828V15.3696C26.8125 15.5806 27.9336 16.1704 28.7461 17.1392C29.5664 18.1001 29.9766 19.3228 29.9766 20.8071H26.0156C26.0156 19.9946 25.8594 19.3696 25.5469 18.9321C25.2344 18.4946 24.7891 18.2759 24.2109 18.2759C23.6953 18.2759 23.293 18.4399 23.0039 18.7681C22.7227 19.0884 22.582 19.5337 22.582 20.104C22.582 20.6821 22.7461 21.1431 23.0742 21.4868C23.4023 21.8228 23.9297 22.147 24.6562 22.4595C25.3828 22.7642 26.0664 23.0845 26.707 23.4204C27.3555 23.7485 27.9141 24.1235 28.3828 24.5454C28.8516 24.9673 29.2188 25.4595 29.4844 26.022C29.75 26.5845 29.8828 27.2603 29.8828 28.0493C29.8828 29.3853 29.457 30.4751 28.6055 31.3188C27.7617 32.1626 26.6094 32.6548 25.1484 32.7954V35.1509H23.2852V32.7837C21.582 32.604 20.2734 32.022 19.3594 31.0376C18.4531 30.0454 18 28.7407 18 27.1235H21.9492C21.9492 28.0142 22.1445 28.6938 22.5352 29.1626C22.9336 29.6235 23.4961 29.854 24.2227 29.854C24.7539 29.854 25.1719 29.6978 25.4766 29.3853C25.7812 29.0649 25.9336 28.6274 25.9336 28.0728Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Ganti Cara Bayar</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Ganti Cara Bayar ====== -->

                        <!-- ====== Start Menu item Stock Out ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_pinjam?>" href="<?= base_url()?>admin/pinjam">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Stock Out</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Stock Out ====== -->

                        <!-- ====== Start Menu item Request Barang ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_req?>" href="<?= base_url()?>admin/moving">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.9071 28.5687L12.2176 23.5053L19.9072 18.2793L12.4072 10.7793L2.40723 17.7793L6.22071 21.7517V36.5676C6.22071 37.3124 6.63456 37.9955 7.2947 38.3403L22.9071 46.4957V28.5687Z" fill="currentColor"/>
                                            <path d="M25.9072 28.5688V46.4958L41.5198 38.3403C42.18 37.9955 42.5938 37.3124 42.5938 36.5676V21.7517L46.4073 17.7793L36.4073 10.7793L28.9073 18.2793L36.5969 23.5053L25.9072 28.5688Z" fill="currentColor"/>
                                            <path d="M26.4072 2.2793H22.4072V8.2793H17.4072L24.4072 16.2793L31.4072 8.2793H26.4072V2.2793Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Request Barang</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Request Barang ====== -->

                        <!-- ====== Start Menu item Konfirmasi Permintaan ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_confirm?>" href="<?= base_url()?>admin/moving/konfirm">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                       <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 7C4.89543 7 4 7.89543 4 9V39C4 40.1046 4.89543 41 6 41H42C43.1046 41 44 40.1046 44 39V13C44 11.8954 43.1046 11 42 11H24L19 7H6ZM26.5 17L26 28H22L21.5 17H26.5ZM22 35V31H26V35H22Z" fill="currentColor"/>
                                            <path d="M22 28H26L26.5 17H21.5L22 28Z" fill="#324558"/>
                                            <path d="M26 31H22V35H26V31Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Konfirmasi Permintaan</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Konfirmasi Permintaan ====== -->

                        <!-- ====== Start Menu item Penjualan ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_cashier?>" href="<?= base_url()?>staff/cashier">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30.6249 11.0928C30.8674 10.4412 31 9.73605 31 8.99994C31 8.54193 30.9487 8.09591 30.8515 7.6673C39.0853 9.38616 45 14.4744 45 23.4999C45 27.9957 42.7116 32.0715 39 35.0475V40.9999C39 42.1045 38.1046 42.9999 37 42.9999H33.0616C32.1438 42.9999 31.3439 42.3753 31.1213 41.485L30.5457 39.1826C28.4858 39.713 26.2856 39.9999 24 39.9999C22.0601 39.9999 20.1817 39.7932 18.3984 39.4064L17.8787 41.485C17.6561 42.3753 16.8562 42.9999 15.9384 42.9999H12C10.8954 42.9999 10 42.1045 10 40.9999V35.7985C9.57039 35.4964 9.1567 35.1806 8.76005 34.8519C4.85543 34.3117 0 29.7841 0 27.9049V23.9049C0 22.8031 0.890908 21.9095 1.99162 21.9049H1.73096C2.14333 21.9049 2.83715 21.7873 3.21057 20.7744C3.61913 18.2811 4.66275 15.9666 6.68906 14.0218L5.22176 11.7665C4.57061 10.7657 4.96377 9.46175 6.13574 9.23335C7.67875 8.93265 9.96119 8.79979 12.66 9.61005C14.6396 8.61025 16.8468 7.86457 19.207 7.43164C19.072 7.93156 19 8.45734 19 8.99994C19 9.66089 19.1069 10.2969 19.3043 10.8916C20.8218 10.6346 22.393 10.4999 24 10.4999C26.2859 10.4999 28.5138 10.6919 30.6249 11.0928ZM11 22.9999C12.1046 22.9999 13 22.1045 13 20.9999C13 19.8953 12.1046 18.9999 11 18.9999C9.89543 18.9999 9 19.8953 9 20.9999C9 22.1045 9.89543 22.9999 11 22.9999Z" fill="currentColor"/>
                                            <path d="M31 9C31 9.73611 30.8674 10.4413 30.6249 11.0929C28.5138 10.692 26.2859 10.5 24 10.5C22.393 10.5 20.8218 10.6346 19.3043 10.8916C19.1069 10.2969 19 9.66095 19 9C19 5.68629 21.6863 3 25 3C28.3137 3 31 5.68629 31 9Z" fill="#324558"/>
                                            <path d="M44.7212 20.251C44.5115 19.0842 44.1866 17.9989 43.7577 16.9934C44.2623 16.3368 44.4999 15.6523 44.4999 14.9999C44.4999 13.7899 43.5622 12.7684 42.5256 12.4229C41.7397 12.1609 41.3149 11.3115 41.5769 10.5255C41.8389 9.73966 42.6883 9.31492 43.4743 9.57689C45.4376 10.2313 47.4999 12.2098 47.4999 14.9999C47.4999 17.126 46.3599 18.9306 44.7212 20.251Z" fill="currentColor"/>
                                            <path d="M13 21C13 22.1046 12.1046 23 11 23C9.89543 23 9 22.1046 9 21C9 19.8954 9.89543 19 11 19C12.1046 19 13 19.8954 13 21Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Penjualan</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Penjualan ====== -->

                        <!-- ====== Start Menu item Kas ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_cash?>" href="<?= base_url()?>staff/kas">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.04063 12.4031C4.01399 12.2729 4 12.1381 4 12V38C4 39.1045 4.89543 40 6 40H42C43.1046 40 44 39.1045 44 38V14H6C5.0335 14 4.22713 13.3144 4.04063 12.4031ZM38 25C38 26.6569 36.6569 28 35 28C33.3431 28 32 26.6569 32 25C32 23.3431 33.3431 22 35 22C36.6569 22 38 23.3431 38 25Z" fill="currentColor"/>
                                            <path d="M4 11.9999C4 13.1045 4.89543 13.9999 6 13.9999H36V7.13981C36 6.53582 35.4687 6.06968 34.8698 6.14832L5.7396 9.97362C4.74423 10.1043 4 10.9527 4 11.9566V11.9999Z" fill="#324558"/>
                                            <path d="M35 27.9999C36.6569 27.9999 38 26.6568 38 24.9999C38 23.3431 36.6569 21.9999 35 21.9999C33.3431 21.9999 32 23.3431 32 24.9999C32 26.6568 33.3431 27.9999 35 27.9999Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kas</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Kas ====== -->

                        <!-- ====== Start Menu item Rekapan Harian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_tutup?>" href="<?= base_url()?>staff/kas/tutupharian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentColor"/>
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558"/>
                                            <path d="M13 20H23V24H13V20Z" fill="#324558"/>
                                            <path d="M13 30H23V34H13V30Z" fill="#324558"/>
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Rekapan Harian</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Rekapan Harian ====== -->

                        <!-- ====== Start Menu Retur Customer ====== -->
                        <div class="menu-item -accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_retur?>" href="<?= base_url()?>staff/retur">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 10C8.47715 10 4 14.4772 4 20V28H8V20C8 16.6863 10.6863 14 14 14H26V10H14Z" fill="currentColor"/>
                                            <path d="M34 38C39.5228 38 44 33.5228 44 28V20H40V28C40 31.3137 37.3137 34 34 34H22V38H34Z" fill="currentColor"/>
                                            <path d="M36.9333 11.2C37.4667 11.6 37.4667 12.4 36.9333 12.8L27.6 19.8C26.9408 20.2944 26 19.824 26 19V4.99998C26 4.17594 26.9408 3.70556 27.6 4.19998L36.9333 11.2Z" fill="currentColor"/>
                                            <path d="M11.067 35.2C10.5337 35.6 10.5337 36.4 11.067 36.8L20.4003 43.8C21.0596 44.2944 22.0003 43.824 22.0003 43V29C22.0003 28.1759 21.0596 27.7056 20.4003 28.2L11.067 35.2Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Retur Customer</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu Retur Customer ====== -->

                        <!-- ====== Start Menu  Pencarian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_cari?>" href="<?= base_url()?>staff/pencarian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20 32C26.6274 32 32 26.6274 32 20C32 13.3726 26.6274 8 20 8C13.3726 8 8 13.3726 8 20C8 26.6274 13.3726 32 20 32ZM20 36C28.8366 36 36 28.8366 36 20C36 11.1634 28.8366 4 20 4C11.1634 4 4 11.1634 4 20C4 28.8366 11.1634 36 20 36Z" fill="currentColor"/>
                                            <path d="M18 13H22V18H27V22H22V27H18V22H13V18H18V13Z" fill="currentColor"/>
                                            <path d="M32.0179 30.5627C31.5644 31.0784 31.0782 31.5646 30.5625 32.0181L30.9524 33.4163C31.0448 33.7478 31.2213 34.0499 31.4647 34.2933L41.1697 43.9984L43.9982 41.1699L34.2931 31.4649C34.0497 31.2215 33.7476 31.045 33.4161 30.9526L32.0179 30.5627Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"> Pencarian</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu  Pencarian ====== -->
                        
                    <?php } else { ?>
                        <!-- ====== Start Menu item Dashboard ====== -->
                        <div class="menu-item menu-accordion">

                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_dash?>" href="<?=base_url()?>staff/dashboard">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Dashboard ====== -->

                        <!-- ====== Start Menu item Penjualan ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_cashier?>" href="<?= base_url()?>staff/cashier">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M30.6249 11.0928C30.8674 10.4412 31 9.73605 31 8.99994C31 8.54193 30.9487 8.09591 30.8515 7.6673C39.0853 9.38616 45 14.4744 45 23.4999C45 27.9957 42.7116 32.0715 39 35.0475V40.9999C39 42.1045 38.1046 42.9999 37 42.9999H33.0616C32.1438 42.9999 31.3439 42.3753 31.1213 41.485L30.5457 39.1826C28.4858 39.713 26.2856 39.9999 24 39.9999C22.0601 39.9999 20.1817 39.7932 18.3984 39.4064L17.8787 41.485C17.6561 42.3753 16.8562 42.9999 15.9384 42.9999H12C10.8954 42.9999 10 42.1045 10 40.9999V35.7985C9.57039 35.4964 9.1567 35.1806 8.76005 34.8519C4.85543 34.3117 0 29.7841 0 27.9049V23.9049C0 22.8031 0.890908 21.9095 1.99162 21.9049H1.73096C2.14333 21.9049 2.83715 21.7873 3.21057 20.7744C3.61913 18.2811 4.66275 15.9666 6.68906 14.0218L5.22176 11.7665C4.57061 10.7657 4.96377 9.46175 6.13574 9.23335C7.67875 8.93265 9.96119 8.79979 12.66 9.61005C14.6396 8.61025 16.8468 7.86457 19.207 7.43164C19.072 7.93156 19 8.45734 19 8.99994C19 9.66089 19.1069 10.2969 19.3043 10.8916C20.8218 10.6346 22.393 10.4999 24 10.4999C26.2859 10.4999 28.5138 10.6919 30.6249 11.0928ZM11 22.9999C12.1046 22.9999 13 22.1045 13 20.9999C13 19.8953 12.1046 18.9999 11 18.9999C9.89543 18.9999 9 19.8953 9 20.9999C9 22.1045 9.89543 22.9999 11 22.9999Z" fill="currentColor"/>
                                            <path d="M31 9C31 9.73611 30.8674 10.4413 30.6249 11.0929C28.5138 10.692 26.2859 10.5 24 10.5C22.393 10.5 20.8218 10.6346 19.3043 10.8916C19.1069 10.2969 19 9.66095 19 9C19 5.68629 21.6863 3 25 3C28.3137 3 31 5.68629 31 9Z" fill="#324558"/>
                                            <path d="M44.7212 20.251C44.5115 19.0842 44.1866 17.9989 43.7577 16.9934C44.2623 16.3368 44.4999 15.6523 44.4999 14.9999C44.4999 13.7899 43.5622 12.7684 42.5256 12.4229C41.7397 12.1609 41.3149 11.3115 41.5769 10.5255C41.8389 9.73966 42.6883 9.31492 43.4743 9.57689C45.4376 10.2313 47.4999 12.2098 47.4999 14.9999C47.4999 17.126 46.3599 18.9306 44.7212 20.251Z" fill="currentColor"/>
                                            <path d="M13 21C13 22.1046 12.1046 23 11 23C9.89543 23 9 22.1046 9 21C9 19.8954 9.89543 19 11 19C12.1046 19 13 19.8954 13 21Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Penjualan</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Penjualan ====== -->

                        <!-- ====== Start Menu item Member ====== -->
                        <div class="menu-item menu-accordion">
                            <a class="menu-link <?=@$mn_member?>" href="<?= base_url()?>member">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.0003 5C27.8661 5 31 8.03054 31 11.7689C31 12.0173 30.9859 12.2655 30.9577 12.5123L30.5059 16.4657C30.1395 19.6728 27.3369 22.1 24.0003 22.1C20.6637 22.1 17.8612 19.6728 17.4947 16.4657L17.043 12.5123C16.6184 8.79658 19.3891 5.45153 23.2315 5.04095C23.4868 5.01367 23.7435 5 24.0003 5Z" fill="#B6C2CD"/>
                                            <path d="M10 34.6272C10 28.9293 15 24.95 24 24.95C33 24.95 38 28.9293 38 34.6272V43H10V34.6272Z" fill="#B6C2CD"/>
                                            <path d="M14.0624 12.8529C13.9553 11.916 13.9863 10.9999 14.1385 10.1221C13.7717 10.0421 13.3909 10 13.0002 10C12.8046 10 12.6092 10.0108 12.4147 10.0323C9.48858 10.3565 7.37857 12.9973 7.7019 15.9308L8.04592 19.0519C8.32499 21.5839 10.4592 23.5 13.0002 23.5C14.4746 23.5 15.8121 22.8548 16.7296 21.8185C15.5375 20.4535 14.7345 18.7354 14.5141 16.8063L14.0624 12.8529Z" fill="currentColor"/>
                                            <path d="M45.9999 40.0001H40.9999V34.6273C40.9999 31.1265 39.557 28.0582 36.9177 25.8325C42.778 26.3553 45.9999 29.3163 45.9999 33.39V40.0001Z" fill="currentColor"/>
                                            <path d="M31.271 21.8187C32.4631 20.4536 33.2662 18.7355 33.4866 16.8063L33.9384 12.8529C33.9795 12.493 34.0001 12.1311 34.0001 11.7689C34.0001 11.2065 33.9521 10.6569 33.8601 10.1232C34.0414 10.0837 34.2264 10.0532 34.4148 10.0323C34.6093 10.0108 34.8047 10 35.0003 10C37.9443 10 40.3308 12.3925 40.3308 15.3439C40.3308 15.54 40.3201 15.7359 40.2986 15.9308L39.9546 19.0519C39.6755 21.5839 37.5413 23.5 35.0003 23.5C33.5259 23.5 32.1885 22.8549 31.271 21.8187Z" fill="currentColor"/>
                                            <path d="M7 34.6273C7 31.1265 8.44285 28.0582 11.0822 25.8325C5.22191 26.3553 2 29.3163 2 33.39V40.0001H7V34.6273Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                </span>
                                <span class="menu-title">Member</span>
                            </a>
                        </div>
                        <!--====== End Menu item Member ====== -->

                        <!-- ===== Start Menu item Lapoan ====== -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                            <!--===== Start Menu item Laporan ====== -->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor" />
                                            <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="menu-title">Laporan</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--===== End Menu item Lapoan ====== -->

                            <!--===== Start Sub Menu Laporan ====== -->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <a class="menu-link <?=@$side10?>" href="<?= base_url()?>admin/laporan/mutasi">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Global</span>
                                    </a>
                                </div>
                                <!--===== End Menu item Persediaan Global ====== -->

                                <!--===== Start Menu item Persediaan Detail ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side20?>" href="<?= base_url()?>admin/laporan/mutasidetail">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Persediaan Detail</span>
                                    </a>
                                </div>
                                <!--End Menu item Persediaan Detail-->

                                <!--===== Start Menu item Penjualan Summary ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side11?>" href="<?= base_url()?>admin/laporan/penjualan">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Summary</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Summary ====== -->

                                <!--===== Start Menu item Penjualan Brand ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side15?>" href="<?= base_url()?>admin/laporan/brand">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Penjualan Brand</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Penjualan Brand ====== -->

                                <!--===== Start Menu item Drop In/Drop Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side12?>" href="<?= base_url()?>admin/laporan/barang">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Drop In/Drop Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Drop In/Drop Out ====== -->

                                <!--===== Start Menu item Non Tunai ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side14?>" href="<?= base_url()?>admin/laporan/nontunai">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Non Tunai</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Non Tunai ====== -->

                                <!--===== Start Menu item Permintaan ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side17?>" href="<?= base_url()?>admin/laporan/request">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Permintaan</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Permintaan ====== -->

                                <!--===== Start Menu item Retur Konsumen ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side18?>" href="<?= base_url()?>admin/laporan/retur">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Retur Konsumen</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Retur Konsumen ====== -->

                                <!--===== Start Menu item Stok Out ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side19?>" href="<?= base_url()?>admin/laporan/stokout">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Stok Out</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Stok Out ====== -->

                                <!--===== Start Menu item Kas ====== -->
                                <div class="menu-item">
                                    <a class="menu-link <?= @$side21?>" href="<?= base_url()?>admin/laporan/kaskeluar">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kas</span>
                                    </a>
                                </div>
                                <!-- ====== End Menu item Kas ====== -->

                            </div>
                            <!--===== End Sub Menu Laporan ======-->
                        </div>
                        <!--===== Start Menu item Lapoan ====== -->

                        <!-- ====== Start Menu item Kas ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_cash?>" href="<?= base_url()?>staff/kas">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.04063 12.4031C4.01399 12.2729 4 12.1381 4 12V38C4 39.1045 4.89543 40 6 40H42C43.1046 40 44 39.1045 44 38V14H6C5.0335 14 4.22713 13.3144 4.04063 12.4031ZM38 25C38 26.6569 36.6569 28 35 28C33.3431 28 32 26.6569 32 25C32 23.3431 33.3431 22 35 22C36.6569 22 38 23.3431 38 25Z" fill="currentColor"/>
                                            <path d="M4 11.9999C4 13.1045 4.89543 13.9999 6 13.9999H36V7.13981C36 6.53582 35.4687 6.06968 34.8698 6.14832L5.7396 9.97362C4.74423 10.1043 4 10.9527 4 11.9566V11.9999Z" fill="#324558"/>
                                            <path d="M35 27.9999C36.6569 27.9999 38 26.6568 38 24.9999C38 23.3431 36.6569 21.9999 35 21.9999C33.3431 21.9999 32 23.3431 32 24.9999C32 26.6568 33.3431 27.9999 35 27.9999Z" fill="#324558"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Kas</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Kas ====== -->

                        <!-- ====== Start Menu item Rekapan Harian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_tutup?>" href="<?= base_url()?>staff/kas/tutupharian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.917 8H39C40.1046 8 41 8.89543 41 10V42C41 43.1046 40.1046 44 39 44H9C7.89543 44 7 43.1046 7 42V10C7 8.89543 7.89543 8 9 8H18.083C18.559 5.16229 21.027 3 24 3C26.973 3 29.441 5.16229 29.917 8ZM26 9C26 10.1046 25.1046 11 24 11C22.8954 11 22 10.1046 22 9C22 7.89543 22.8954 7 24 7C25.1046 7 26 7.89543 26 9ZM36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142ZM13 20H23V24H13V20ZM13 30H23V34H13V30ZM36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="currentColor"/>
                                            <path d="M36.9142 19.4142L32.3284 24H27V20H30.6716L34.0858 16.5858L36.9142 19.4142Z" fill="#324558"/>
                                            <path d="M13 20H23V24H13V20Z" fill="#324558"/>
                                            <path d="M13 30H23V34H13V30Z" fill="#324558"/>
                                            <path d="M36.9142 29.4142L32.3284 34H27V30H30.6716L34.0858 26.5858L36.9142 29.4142Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Rekapan Harian</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Rekapan Harian ====== -->

                        
                        <!-- ====== Start Menu item Request Barang ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?= @$mn_req?>" href="<?= base_url()?>admin/moving">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22.9071 28.5687L12.2176 23.5053L19.9072 18.2793L12.4072 10.7793L2.40723 17.7793L6.22071 21.7517V36.5676C6.22071 37.3124 6.63456 37.9955 7.2947 38.3403L22.9071 46.4957V28.5687Z" fill="currentColor"/>
                                            <path d="M25.9072 28.5688V46.4958L41.5198 38.3403C42.18 37.9955 42.5938 37.3124 42.5938 36.5676V21.7517L46.4073 17.7793L36.4073 10.7793L28.9073 18.2793L36.5969 23.5053L25.9072 28.5688Z" fill="currentColor"/>
                                            <path d="M26.4072 2.2793H22.4072V8.2793H17.4072L24.4072 16.2793L31.4072 8.2793H26.4072V2.2793Z" fill="#324558"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Request Barang</span>
                            </a>
                            <!--====== End Menu link ====== -->
                        </div>
                        <!--====== End Menu item Request Barang ====== -->

                        <!-- ====== Start Menu item Stock Out ====== -->
                        <div  class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_pinjam?>" href="<?= base_url()?>admin/pinjam">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Stock Out</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu item Stock Out ====== -->


                        <!-- ====== Start Menu Retur Customer ====== -->
                        <div class="menu-item -accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_retur?>" href="<?= base_url()?>staff/retur">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 10C8.47715 10 4 14.4772 4 20V28H8V20C8 16.6863 10.6863 14 14 14H26V10H14Z" fill="currentColor"/>
                                            <path d="M34 38C39.5228 38 44 33.5228 44 28V20H40V28C40 31.3137 37.3137 34 34 34H22V38H34Z" fill="currentColor"/>
                                            <path d="M36.9333 11.2C37.4667 11.6 37.4667 12.4 36.9333 12.8L27.6 19.8C26.9408 20.2944 26 19.824 26 19V4.99998C26 4.17594 26.9408 3.70556 27.6 4.19998L36.9333 11.2Z" fill="currentColor"/>
                                            <path d="M11.067 35.2C10.5337 35.6 10.5337 36.4 11.067 36.8L20.4003 43.8C21.0596 44.2944 22.0003 43.824 22.0003 43V29C22.0003 28.1759 21.0596 27.7056 20.4003 28.2L11.067 35.2Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">Retur Customer</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu Retur Customer ====== -->

                        <!-- ====== Start Menu  Pencarian ====== -->
                        <div class="menu-item menu-accordion">
                            <!-- ====== Start Menu link ====== -->
                            <a class="menu-link <?=@$mn_cari?>" href="<?= base_url()?>staff/pencarian">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20 32C26.6274 32 32 26.6274 32 20C32 13.3726 26.6274 8 20 8C13.3726 8 8 13.3726 8 20C8 26.6274 13.3726 32 20 32ZM20 36C28.8366 36 36 28.8366 36 20C36 11.1634 28.8366 4 20 4C11.1634 4 4 11.1634 4 20C4 28.8366 11.1634 36 20 36Z" fill="currentColor"/>
                                            <path d="M18 13H22V18H27V22H22V27H18V22H13V18H18V13Z" fill="currentColor"/>
                                            <path d="M32.0179 30.5627C31.5644 31.0784 31.0782 31.5646 30.5625 32.0181L30.9524 33.4163C31.0448 33.7478 31.2213 34.0499 31.4647 34.2933L41.1697 43.9984L43.9982 41.1699L34.2931 31.4649C34.0497 31.2215 33.7476 31.045 33.4161 30.9526L32.0179 30.5627Z" fill="currentColor"/>
                                        </svg>

                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"> Pencarian</span>
                            </a>
                            <!--====== End Menu link ====== -->

                        </div>
                        <!--====== End Menu  Pencarian ====== -->
                    <?php } ?>
                    <?php */ ?>
                    <!-- **** END CONDITION LOGIN AS ROLE -->

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