<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Laporan Penjualan - Coffee Omwari</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 100%; margin: 0 auto; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Penjualan Coffee Omwari</h1>
        <p>Periode: <?php echo date('d-m-Y', strtotime($tanggal_mulai)); ?> s/d <?php echo date('d-m-Y', strtotime($tanggal_selesai)); ?></p>

        <table>
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
                <?php $no = 1; $total = 0; foreach ($laporan as $item): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('d-m-Y H:i', strtotime($item->tanggal_order)); ?></td>
                    <td><?php echo $item->nama_kasir ?: '-'; ?></td>
                    <td><?php echo $item->nama_menu; ?></td>
                    <td><?php echo $item->jumlah; ?></td>
                    <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                </tr>
                <?php $total += $item->subtotal; ?>
                <?php endforeach; ?>
                <tr class="total">
                    <td colspan="5">Total</td>
                    <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>