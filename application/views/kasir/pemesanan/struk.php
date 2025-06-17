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
    <title>Struk Pemesanan - Coffee Omwari</title>
    <meta name="description" content="Struk pemesanan untuk Coffee Omwari." />
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
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            color: #2a2a2a;
            background-color: #f8f7f3;
            margin: 0;
            padding: 0;
        }
        .receipt-container {
            max-width: 80mm;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .receipt-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }
        .receipt-header p {
            font-size: 12px;
            color: #555;
            margin: 2px 0;
        }
        .receipt-details p {
            font-size: 12px;
            margin: 5px 0;
            color: #333;
        }
        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .receipt-table th, .receipt-table td {
            font-size: 12px;
            padding: 8px 5px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .receipt-table th {
            font-weight: 600;
            color: #1a1a1a;
        }
        .receipt-table td:last-child, .receipt-table th:last-child {
            text-align: right;
        }
        .receipt-summary p {
            font-size: 12px;
            margin: 5px 0;
            text-align: right;
            color: #333;
        }
        .receipt-summary p strong {
            font-weight: 600;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 11px;
            color: #555;
        }
        .receipt-footer p {
            margin: 3px 0;
        }
        .divider {
            border-top: 1px dashed #ccc;
            margin: 10px 0;
        }
        .no-print {
            margin: 20px 0;
            text-align: center;
        }
        .btn-print {
            background-color: #3b2f2b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-print:hover {
            background-color: #5c4b3f;
        }
        .btn-back {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            margin-left: 10px;
        }
        @media print {
            .no-print { display: none !important; }
            .receipt-container {
                width: 80mm;
                margin: 0 auto;
                border: none;
                box-shadow: none;
                padding: 10px;
            }
            body {
                background: none;
            }
        }
    </style>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php $this->load->view('templates/kasir/sidebar'); ?>
            <div class="layout-page">
                <?php $this->load->view('templates/admin/header'); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-4 mb-6 no-print">Order Receipt</h4>
                        <div class="receipt-container">
                            <div class="receipt-header">
                                <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Coffee Omwari Logo" />
                                <h2>Coffee Omwari</h2>
                                <p><?php echo $order->alamat; ?></p>
                                <p>Phone: 0812-3456-7890</p>
                                <div class="divider"></div>
                            </div>
                            <div class="receipt-details">
                                <p><strong>Order ID:</strong> #<?php echo $order->id_order; ?></p>
                                <p><strong>Date:</strong> <?php echo date('d M Y H:i', strtotime($order->tanggal_order)); ?></p>
                                <p><strong>Customer:</strong> <?php echo $order->nama_pembeli ?: 'Guest'; ?></p>
                                <p><strong>Cashier:</strong> <?php echo $order->nama_kasir ?: 'N/A'; ?></p>
                                <div class="divider"></div>
                            </div>
                            <table class="receipt-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order->items as $item): ?>
                                    <tr>
                                        <td><?php echo $item->nama_menu; ?></td>
                                        <td><?php echo $item->jumlah; ?></td>
                                        <td>Rp <?php echo number_format($item->harga, 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="receipt-summary">
                                <div class="divider"></div>
                                <p><strong>Subtotal:</strong> Rp <?php echo number_format($order->total_harga / (1 + $order->pajak / 100), 0, ',', '.'); ?></p>
                                <p><strong>Tax (<?php echo $order->pajak; ?>%):</strong> Rp <?php echo number_format($order->total_harga - ($order->total_harga / (1 + $order->pajak / 100)), 0, ',', '.'); ?></p>
                                <p><strong>Total:</strong> Rp <?php echo number_format($order->total_harga, 0, ',', '.'); ?></p>
                            </div>
                            <div class="receipt-footer">
                                <div class="divider"></div>
                                <p>Thank you for dining with us!</p>
                                <p>Visit us again at Coffee Omwari</p>
                                <p>www.coffeeomwari.com</p>
                            </div>
                        </div>
                        <div class="no-print">
                            <button class="btn btn-print" onclick="window.print()">Print Receipt</button>
                            <a href="<?php echo site_url('kasir/riwayat_transaksi'); ?>" class="btn btn-back">Back</a>
                        </div>
                    </div>
                    <?php $this->load->view('templates/admin/footer'); ?>
                </div>
            </div>
        </div>
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