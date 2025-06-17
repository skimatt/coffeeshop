<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?php echo site_url('admin/dashboard'); ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0"
                    />
                    <path
                        opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616"
                    />
                    <path
                        opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616"
                    />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0"
                    />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">CoffeeOmwari</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Utama</span>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Manajemen Menu -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Menu</span>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'menu') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/menu'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-coffee"></i>
                <div data-i18n="Kelola Menu">Kelola Menu</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'kategori') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/kategori'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-category"></i>
                <div data-i18n="Kategori Minuman">Kategori Minuman</div>
            </a>
        </li>

        <!-- Transaksi & Laporan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaksi & Laporan</span>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'transaksi') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/transaksi'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-receipt"></i>
                <div data-i18n="Transaksi">Transaksi</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'laporan') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/laporan'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-report-analytics"></i>
                <div data-i18n="Laporan Penjualan">Laporan Penjualan</div>
            </a>
        </li>

        <!-- Pengaturan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengaturan</span>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'pengguna') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/pengguna'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Manajemen Pengguna">Manajemen Pengguna</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'stok') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/stok'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-box"></i>
                <div data-i18n="Stok Bahan">Stok Bahan</div>
            </a>
        </li>
        <li class="menu-item <?php echo ($this->uri->segment(2) == 'pengaturan') ? 'active' : ''; ?>">
            <a href="<?php echo site_url('admin/pengaturan'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Pengaturan Toko">Pengaturan Toko</div>
            </a>
        </li>
    </ul>
</aside>