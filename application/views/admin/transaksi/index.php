<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?php echo base_url('assets/'); ?>"
    data-template="vertical-menu-template"
    data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?php echo isset($title) ? $title : 'Coffee Omwari - Transaksi'; ?></title>
    <meta name="description" content="Lihat semua transaksi untuk Coffee Omwari." />
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon/favicon.ico'); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/tabler-icons.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/rtl/core.css'); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/rtl/theme-default.css'); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/node-waves/node-waves.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/vendor/js/helpers.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/js/template-customizer.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/config.js'); ?>"></script>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php $this->load->view('templates/admin/sidebar'); ?>
            <div class="layout-page">
                <?php $this->load->view('templates/admin/header'); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-4 mb-6">Transaksi</h4>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Daftar Transaksi</h5>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Order</th>
                                            <th>Tanggal</th>
                                            <th>Kasir</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($transaksi as $trx): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $trx->id_order; ?></td>
                                            <td><?php echo date('d-m-Y H:i', strtotime($trx->tanggal_order)); ?></td>
                                            <td><?php echo $trx->nama_kasir ?: '-'; ?></td>
                                            <td>Rp <?php echo number_format($trx->total_harga, 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('templates/admin/footer'); ?>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>
    <script src="<?php echo base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/js/bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/libs/node-waves/node-waves.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/libs/hammer/hammer.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/js/menu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>
</html>