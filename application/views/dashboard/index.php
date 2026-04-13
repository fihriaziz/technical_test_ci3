<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="grid stats">
	<div class="stat-card">
		<span>Total User</span>
		<strong><?php echo $stats['users']; ?></strong>
	</div>
	<div class="stat-card">
		<span>Supplier</span>
		<strong><?php echo $stats['suppliers']; ?></strong>
	</div>
	<div class="stat-card">
		<span>Customer</span>
		<strong><?php echo $stats['customers']; ?></strong>
	</div>
	<div class="stat-card">
		<span>Produk</span>
		<strong><?php echo $stats['products']; ?></strong>
	</div>
	<div class="stat-card">
		<span>Faktur</span>
		<strong><?php echo $stats['invoices']; ?></strong>
	</div>
</div>

<div class="card">
	<h3>Faktur Terbaru</h3>
	<table>
		<thead>
			<tr>
				<th>No. Faktur</th>
				<th>Tanggal</th>
				<th>Supplier</th>
				<th>Customer</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($latest_invoices)): ?>
				<tr>
					<td colspan="5">Belum ada data faktur.</td>
				</tr>
			<?php else: ?>
				<?php foreach ($latest_invoices as $invoice): ?>
					<tr>
						<td><?php echo html_escape($invoice['invoice_no']); ?></td>
						<td><?php echo date('d M Y', strtotime($invoice['invoice_date'])); ?></td>
						<td><?php echo html_escape($invoice['supplier_name']); ?></td>
						<td><?php echo html_escape($invoice['customer_name']); ?></td>
						<td>Rp <?php echo number_format($invoice['grand_total'], 0, ',', '.'); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>