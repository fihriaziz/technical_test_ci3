<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="btn-row" style="justify-content: space-between; margin-top: 0; margin-bottom: 18px;">
		<span class="badge">Master Produk</span>
		<a href="<?php echo site_url('products/create'); ?>" class="btn btn-primary">Tambah Produk</a>
	</div>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Produk</th>
				<th>Satuan</th>
				<th>Harga Default</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($products)): ?>
				<tr>
					<td colspan="6">Belum ada data produk.</td>
				</tr>
			<?php else: ?>
				<?php foreach ($products as $index => $product): ?>
					<tr>
						<td><?php echo $index + 1; ?></td>
						<td><?php echo html_escape($product['code']); ?></td>
						<td><?php echo html_escape($product['name']); ?></td>
						<td><?php echo html_escape($product['unit_name']); ?></td>
						<td>Rp <?php echo number_format($product['default_price'], 0, ',', '.'); ?></td>
						<td>
							<div class="btn-row" style="margin: 0;">
								<a href="<?php echo site_url('products/edit/' . $product['id']); ?>" class="btn btn-secondary">Edit</a>
								<a href="<?php echo site_url('products/delete/' . $product['id']); ?>" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>