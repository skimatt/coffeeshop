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
    <title><?php echo isset($title) ? $title : 'Pemesanan Baru - Coffee Omwari'; ?></title>
    <meta name="description" content="Buat pemesanan baru untuk Coffee Omwari." />
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
            <?php $this->load->view('templates/kasir/sidebar'); ?>
            <div class="layout-page">
                <?php $this->load->view('templates/admin/header'); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-4 mb-6">Pemesanan Baru</h4>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <div class="card">
                            <div class="card-body">
                                <?php echo form_open('kasir/pemesanan_baru'); ?>
                                    <div class="mb-3">
                                        <label>Nama Pembeli</label>
                                        <input type="text" name="nama_pembeli" class="form-control" value="<?php echo set_value('nama_pembeli'); ?>" placeholder="Masukkan nama pembeli (opsional)">
                                        <?php echo form_error('nama_pembeli', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <div id="order-items">
                                        <div class="row mb-3 order-item">
                                            <div class="col-md-6">
                                                <label>Menu</label>
                                                <select name="menu[]" class="form-control">
                                                    <option value="">Pilih Menu</option>
                                                    <?php foreach ($menu as $item): ?>
                                                        <option value="<?php echo $item->id_menu; ?>" data-harga="<?php echo $item->harga; ?>">
                                                            <?php echo $item->nama_menu; ?> (Rp <?php echo number_format($item->harga, 0, ',', '.'); ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php echo form_error('menu[]', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Jumlah</label>
                                                <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1">
                                                <?php echo form_error('jumlah[]', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger btn-remove-item">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" id="add-item">Tambah Item</button>
                                    </div>
                                    <div class="mb-3">
                                        <h5>Total: <span id="total-harga">Rp 0</span></h5>
                                        <small>Pajak <?php echo $pengaturan->pajak; ?>% akan ditambahkan.</small>
                                    </div>
                                    <button type="submit" class="btn btn-success">Buat Order</button>
                                <?php echo form_close(); ?>
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
    <script>
        $(document).ready(function() {
            const pajak = <?php echo $pengaturan->pajak; ?> / 100;

            function updateTotal() {
                let total = 0;
                $('.order-item').each(function() {
                    const harga = $(this).find('select').find(':selected').data('harga') || 0;
                    const jumlah = $(this).find('.jumlah').val() || 0;
                    total += harga * jumlah;
                });
                const totalWithTax = total * (1 + pajak);
                $('#total-harga').text('Rp ' + totalWithTax.toLocaleString('id-ID'));
            }

            $('#add-item').click(function() {
                const itemHtml = $('.order-item:first').clone();
                itemHtml.find('select').val('');
                itemHtml.find('.jumlah').val('1');
                $('#order-items').append(itemHtml);
                updateTotal();
            });

            $(document).on('click', '.btn-remove-item', function() {
                if ($('.order-item').length > 1) {
                    $(this).closest('.order-item').remove();
                    updateTotal();
                }
            });

            $(document).on('change', 'select[name="menu[]"], input[name="jumlah[]"]', updateTotal);

            updateTotal();
        });
    </script>
</body>
</html>