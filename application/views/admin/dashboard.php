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
    <title><?php echo isset($title) ? $title : 'Dashboard - Coffee Omwari'; ?></title>
    <meta name="description" content="Dashboard admin untuk Coffee Omwari." />
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
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
                        
                        <!-- Stats Cards -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-2">Penjualan Hari Ini</h6>
                                                <h4 class="mb-0">Rp <?php echo number_format($total_penjualan, 0, ',', '.'); ?></h4>
                                            </div>
                                            <span class="badge bg-label-primary rounded-circle p-2">
                                                <i class="ti ti-currency-dollar ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-2">Transaksi Hari Ini</h6>
                                                <h4 class="mb-0"><?php echo $total_transaksi; ?></h4>
                                            </div>
                                            <span class="badge bg-label-info rounded-circle p-2">
                                                <i class="ti ti-shopping-cart ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-2">Minuman Terlaris</h6>
                                                <h4 class="mb-0"><?php echo $minuman_terlaris->nama_menu ?: '-'; ?></h4>
                                                <small><?php echo $minuman_terlaris->total_jumlah ?: 0; ?> terjual</small>
                                            </div>
                                            <span class="badge bg-label-success rounded-circle p-2">
                                                <i class="ti ti-cup ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-2">Stok Rendah</h6>
                                                <h4 class="mb-0"><?php echo count($stok_rendah); ?> item</h4>
                                                <small>Lihat detail</small>
                                            </div>
                                            <span class="badge bg-label-warning rounded-circle p-2">
                                                <i class="ti ti-alert-triangle ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       <!-- Charts -->
<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Penjualan Mingguan</h5>
            </div>
            <div class="card-body">
                <canvas id="weeklySalesChart" height="150"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Transaksi per Kasir</h5>
            </div>
            <div class="card-body">
                <canvas id="cashierTransactionChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Top 5 Minuman Mingguan</h5>
            </div>
            <div class="card-body">
                <canvas id="topDrinksChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
                        <!-- Recent Transactions -->
                        <div class="row g-4 mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Transaksi Terbaru</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID Order</th>
                                                    <th>Tanggal</th>
                                                    <th>Kasir</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($transaksi_terbaru as $trx): ?>
                                                <tr>
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
    // Weekly Sales Chart
    const weeklySalesData = <?php echo $penjualan_mingguan; ?>;
    new Chart(document.getElementById('weeklySalesChart'), {
        type: 'line',
        data: {
            labels: weeklySalesData.map(item => item.date),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: weeklySalesData.map(item => item.total),
                borderColor: '#696cff',
                backgroundColor: 'rgba(105, 108, 255, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 10 // Smaller font size for y-axis
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10 // Smaller font size for x-axis
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 10 // Smaller font size for legend
                        }
                    }
                }
            }
        }
    });

    // Top Drinks Chart
    const topDrinks = <?php echo json_encode($top_minuman); ?>;
    new Chart(document.getElementById('topDrinksChart'), {
        type: 'bar',
        data: {
            labels: topDrinks.map(item => item.nama_menu),
            datasets: [{
                label: 'Jumlah Terjual',
                data: topDrinks.map(item => item.total_jumlah),
                backgroundColor: ['#696cff', '#03c3ec', '#ffab00', '#fd3e81', '#00d4bd']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 10 // Smaller font size for y-axis
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10 // Smaller font size for x-axis
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 10 // Smaller font size for legend
                        }
                    }
                }
            }
        }
    });

    // Cashier Transaction Chart
    const cashierData = <?php echo json_encode($transaksi_per_kasir); ?>;
    new Chart(document.getElementById('cashierTransactionChart'), {
        type: 'pie',
        data: {
            labels: cashierData.map(item => item.nama || 'Unknown'),
            datasets: [{
                data: cashierData.map(item => item.total_transaksi),
                backgroundColor: ['#696cff', '#03c3ec', '#ffab00', '#fd3e81']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 10 // Smaller font size for legend
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>