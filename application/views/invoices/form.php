<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$invoice = is_array($invoice) ? $invoice : array();
$invoice_items = isset($invoice['items']) && !empty($invoice['items']) ? $invoice['items'] : array(array('product_id' => '', 'unit_id' => '', 'quantity' => 1, 'price' => 0));
?>
<div class="card">
	<?php echo form_open(); ?>
		<div class="form-grid">
			<div class="form-group">
				<label for="invoice_no">Nomor Faktur</label>
				<input type="text" readonly id="invoice_no" name="invoice_no" value="<?php echo set_value('invoice_no', isset($invoice['invoice_no']) ? $invoice['invoice_no'] : $invoice_no); ?>">
				<div class="error-text"><?php echo form_error('invoice_no'); ?></div>
			</div>
			<div class="form-group">
				<label for="invoice_date">Tanggal Faktur</label>
				<input type="date" id="invoice_date" name="invoice_date" value="<?php echo set_value('invoice_date', isset($invoice['invoice_date']) ? $invoice['invoice_date'] : date('Y-m-d')); ?>">
				<div class="error-text"><?php echo form_error('invoice_date'); ?></div>
			</div>
			<div class="form-group">
				<label for="supplier_id">Supplier</label>
				<select id="supplier_id" name="supplier_id">
					<option value="">Pilih supplier</option>
					<?php foreach ($suppliers as $supplier): ?>
						<option value="<?php echo $supplier['id']; ?>" <?php echo set_select('supplier_id', $supplier['id'], isset($invoice['supplier_id']) && (int) $invoice['supplier_id'] === (int) $supplier['id']); ?>>
							<?php echo html_escape($supplier['name']); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<div class="error-text"><?php echo form_error('supplier_id'); ?></div>
			</div>
			<div class="form-group">
				<label for="customer_id">Customer</label>
				<select id="customer_id" name="customer_id">
					<option value="">Pilih customer</option>
					<?php foreach ($customers as $customer): ?>
						<option value="<?php echo $customer['id']; ?>" <?php echo set_select('customer_id', $customer['id'], isset($invoice['customer_id']) && (int) $invoice['customer_id'] === (int) $customer['id']); ?>>
							<?php echo html_escape($customer['name']); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<div class="error-text"><?php echo form_error('customer_id'); ?></div>
			</div>
			<div class="form-group">
				<label for="purchasing_name">Nama Purchasing</label>
				<input type="text" id="purchasing_name" name="purchasing_name" value="<?php echo set_value('purchasing_name', isset($invoice['purchasing_name']) ? $invoice['purchasing_name'] : ''); ?>">
				<div class="error-text"><?php echo form_error('purchasing_name'); ?></div>
			</div>
			<div class="form-group">
				<label for="recipient_name">Nama Penerima / Up</label>
				<input type="text" id="recipient_name" name="recipient_name" value="<?php echo set_value('recipient_name', isset($invoice['recipient_name']) ? $invoice['recipient_name'] : ''); ?>">
				<div class="error-text"><?php echo form_error('recipient_name'); ?></div>
			</div>
			<div class="form-group full">
				<label for="notes">Catatan</label>
				<textarea id="notes" name="notes"><?php echo set_value('notes', isset($invoice['notes']) ? $invoice['notes'] : ''); ?></textarea>
			</div>
		</div>

		<div class="card" style="margin-top: 18px;">
			<div class="btn-row" style="justify-content: space-between; margin-top: 0; margin-bottom: 14px;">
				<h3 style="margin: 0;">Item Faktur</h3>
				<button type="button" class="btn btn-secondary" data-add-item>Tambah Baris</button>
			</div>

			<div class="invoice-items">
				<table>
					<thead>
						<tr>
							<th>Produk</th>
							<th>Satuan</th>
							<th>Jumlah</th>
							<th>Harga</th>
							<th>Total</th>
							<th></th>
						</tr>
					</thead>
					<tbody data-items-body>
						<?php foreach ($invoice_items as $item): ?>
							<tr>
								<td>
									<select name="product_id[]">
										<option value="">Pilih produk</option>
										<?php foreach ($products as $product): ?>
											<option value="<?php echo $product['id']; ?>" <?php echo (isset($item['product_id']) && (int) $item['product_id'] === (int) $product['id']) ? 'selected' : ''; ?>>
												<?php echo html_escape($product['code'] . ' - ' . $product['name']); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<select name="unit_id[]">
										<option value="">Pilih satuan</option>
										<?php foreach ($units as $unit): ?>
											<option value="<?php echo $unit['id']; ?>" <?php echo (isset($item['unit_id']) && (int) $item['unit_id'] === (int) $unit['id']) ? 'selected' : ''; ?>>
												<?php echo html_escape($unit['name']); ?>
											</option>
										<?php endforeach; ?>
									</select>
								</td>
								<td><input type="number" step="0.01" min="0" name="quantity[]" value="<?php echo isset($item['quantity']) ? $item['quantity'] : 1; ?>" data-qty></td>
								<td><input type="number" step="0.01" min="0" name="price[]" value="<?php echo isset($item['price']) ? $item['price'] : 0; ?>" data-price></td>
								<td><input type="text" value="<?php echo number_format(isset($item['total_price']) ? $item['total_price'] : ((isset($item['quantity']) ? $item['quantity'] : 1) * (isset($item['price']) ? $item['price'] : 0)), 0, ',', '.'); ?>" data-total readonly></td>
								<td><button type="button" class="btn btn-danger" data-remove-item>Hapus</button></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="btn-row">
			<button type="submit" class="btn btn-primary">Simpan Faktur</button>
			<a href="<?php echo site_url('invoices'); ?>" class="btn btn-secondary">Kembali</a>
		</div>
	<?php echo form_close(); ?>
</div>

<template id="invoice-item-template">
	<tr>
		<td>
			<select name="product_id[]">
				<option value="">Pilih produk</option>
				<?php foreach ($products as $product): ?>
					<option value="<?php echo $product['id']; ?>"><?php echo html_escape($product['code'] . ' - ' . $product['name']); ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		<td>
			<select name="unit_id[]">
				<option value="">Pilih satuan</option>
				<?php foreach ($units as $unit): ?>
					<option value="<?php echo $unit['id']; ?>"><?php echo html_escape($unit['name']); ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		<td><input type="number" step="0.01" min="0" name="quantity[]" value="1" data-qty></td>
		<td><input type="number" step="0.01" min="0" name="price[]" value="0" data-price></td>
		<td><input type="text" value="0" data-total readonly></td>
		<td><button type="button" class="btn btn-danger" data-remove-item>Hapus</button></td>
	</tr>
</template>
