<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="invoice-paper">
	<div class="invoice-header">
		<div>
			<h2 style="margin: 0 0 8px;">PT. Bhinneka Sangkuriang Transport</h2>
			<div><?php echo html_escape($invoice['supplier_address']); ?></div>
			<div><?php echo html_escape($invoice['supplier_city']); ?></div>
		</div>
		<div>
			<div style="margin-bottom: 8px;"><strong>Kepada Yth:</strong></div>
			<div><strong><?php echo html_escape($invoice['customer_name']); ?></strong></div>
			<div><?php echo html_escape($invoice['customer_address']); ?></div>
			<div><?php echo html_escape($invoice['customer_city']); ?></div>
			<div>Up: <?php echo html_escape($invoice['recipient_name']); ?></div>
		</div>
	</div>

	<div style="margin-bottom: 18px;"><strong>No. Faktur:</strong> <?php echo html_escape($invoice['invoice_no']); ?></div>

	<table>
		<thead>
			<tr>
				<th>Kode</th>
				<th>Nama</th>
				<th>Satuan</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Total Harga</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($invoice['items'] as $item): ?>
				<tr>
					<td><?php echo html_escape($item['product_code']); ?></td>
					<td><?php echo html_escape($item['product_name']); ?></td>
					<td><?php echo html_escape($item['unit_name']); ?></td>
					<td><?php echo number_format($item['quantity'], 0, ',', '.'); ?></td>
					<td><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
					<td><?php echo number_format($item['total_price'], 0, ',', '.'); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3" style="text-align:center;">TOTAL</th>
				<th><?php echo number_format($invoice['total_quantity'], 0, ',', '.'); ?></th>
				<th><?php echo number_format($invoice['total_unit_price'], 0, ',', '.'); ?></th>
				<th><?php echo number_format($invoice['grand_total'], 0, ',', '.'); ?></th>
			</tr>
		</tfoot>
	</table>

	<div style="display: flex; justify-content: space-between; margin-top: 26px;">
			<table class="invoice-summary" style="margin-top: 26px;margin-left: 0;">
			<tr>
				<td>Purchasing</td>
			</tr>
			<tr>
				<td style="padding-top: 54px;"><strong><?php echo html_escape($invoice['purchasing_name']); ?></strong></td>
			</tr>
		</table>
			<table class="invoice-summary" style="margin-top: 26px;">
			<tr>
				<td style="text-align:right;">Cirebon, <?php echo date('d F Y', strtotime($invoice['invoice_date'])); ?></td>
			</tr>
			<tr>
				<td style="padding-top: 54px; text-align:right;"><strong><?php echo html_escape($invoice['recipient_name']); ?></strong></td>
			</tr>
		</table>
	</div>
	
</div>

<div class="btn-row">
	<a href="<?php echo site_url('invoices'); ?>" class="btn btn-secondary">Kembali</a>
	<a href="<?php echo site_url('invoices/edit/' . $invoice['id']); ?>" class="btn btn-primary">Edit Faktur</a>
</div>
