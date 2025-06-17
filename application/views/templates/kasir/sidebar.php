<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?php echo site_url('kasir/dashboard'); ?>" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold">Coffee Omwari</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti ti-x ti-sm d-none d-lg-block align-middle"></i>
            <i class="ti ti-menu-2 ti-sm d-block d-lg-none align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item <?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
            <a href="<?php echo site_url('kasir/dashboard'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <li class="menu-item <?php echo $this->uri->segment(2) == 'pemesanan_baru' ? 'active' : ''; ?>">
            <a href="<?php echo site_url('kasir/pemesanan_baru'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div>Pemesanan Baru</div>
            </a>
        </li>
        <li class="menu-item <?php echo $this->uri->segment(2) == 'riwayat_transaksi' ? 'active' : ''; ?>">
            <a href="<?php echo site_url('kasir/riwayat_transaksi'); ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-history"></i>
                <div>Riwayat Transaksi</div>
            </a>
        </li>
    </ul>
</aside>