<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="btn-row" style="justify-content: space-between; margin-top: 0; margin-bottom: 18px;">
		<span class="badge">Transaksi Faktur</span>
		<a href="<?php echo site_url('invoices/create'); ?>" class="btn btn-primary">Tambah Faktur</a>
	</div>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>No. Faktur</th>
				<th>Tanggal</th>
				<th>Supplier</th>
				<th>Customer</th>
				<th>Grand Total</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($invoices)): ?>
				<tr>
					<td colspan="7">Belum ada transaksi faktur.</td>
				</tr>
			<?php else: ?>
				<?php foreach ($invoices as $index => $invoice): ?>
					<tr>
						<td><?php echo $index + 1; ?></td>
						<td><?php echo html_escape($invoice['invoice_no']); ?></td>
						<td><?php echo date('d M Y', strtotime($invoice['invoice_date'])); ?></td>
						<td><?php echo html_escape($invoice['supplier_name']); ?></td>
						<td><?php echo html_escape($invoice['customer_name']); ?></td>
						<td>Rp <?php echo number_format($invoice['grand_total'], 0, ',', '.'); ?></td>
						<td>
							<div class="btn-row" style="margin: 0;">
								<a href="<?php echo site_url('invoices/show/' . $invoice['id']); ?>" class="btn btn-secondary">Detail</a>
								<a href="<?php echo site_url('invoices/edit/' . $invoice['id']); ?>" class="btn btn-secondary">Edit</a>
								<a href="<?php echo site_url('invoices/delete/' . $invoice['id']); ?>" class="btn btn-danger" onclick="return confirm('Hapus faktur ini?')">Hapus</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>