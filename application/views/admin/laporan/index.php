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
    <title><?php echo isset($title) ? $title : 'Coffee Omwari - Laporan Penjualan'; ?></title>
    <meta name="description" content="Generate laporan penjualan untuk Coffee Omwari." />
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
                        <h4 class="py-4 mb-6">Laporan Penjualan</h4>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <?php echo form_open('admin/laporan'); ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" name="tanggal_mulai" class="form-control" value="<?php echo set_value('tanggal_mulai'); ?>">
                                                <?php echo form_error('tanggal_mulai', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <input type="date" name="tanggal_selesai" class="form-control" value="<?php echo set_value('tanggal_selesai'); ?>">
                                                <?php echo form_error('tanggal_selesai', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary">Tampilkan</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <?php if (!empty($laporan)): ?>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Hasil Laporan</h5>
                                <div>
                                    <a href="<?php echo site_url('admin/laporan_export/pdf/' . set_value('tanggal_mulai') . '/' . set_value('tanggal_selesai')); ?>" class="btn btn-success">Export PDF</a>
                                    <a href="<?php echo site_url('admin/laporan_export/excel/' . set_value('tanggal_mulai') . '/' . set_value('tanggal_selesai')); ?>" class="btn btn-info">Export Excel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kasir</th>
                                            <th>Menu</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($laporan as $item): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo date('d-m-Y H:i', strtotime($item->tanggal_order)); ?></td>
                                            <td><?php echo $item->nama_kasir ?: '-'; ?></td>
                                            <td><?php echo $item->nama_menu; ?></td>
                                            <td><?php echo $item->jumlah; ?></td>
                                            <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>
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