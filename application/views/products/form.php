<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<?php echo form_open(); ?>
		<div class="form-grid">
			<div class="form-group">
				<label for="code">Kode Produk</label>
				<input type="text" id="code" name="code" value="<?php echo set_value('code', isset($product['code']) ? $product['code'] : ''); ?>">
				<div class="error-text"><?php echo form_error('code'); ?></div>
			</div>
			<div class="form-group">
				<label for="name">Nama Produk</label>
				<input type="text" id="name" name="name" value="<?php echo set_value('name', isset($product['name']) ? $product['name'] : ''); ?>">
				<div class="error-text"><?php echo form_error('name'); ?></div>
			</div>
			<div class="form-group">
				<label for="unit_id">Satuan</label>
				<select id="unit_id" name="unit_id">
					<option value="">Pilih satuan</option>
					<?php foreach ($units as $unit): ?>
						<option value="<?php echo $unit['id']; ?>" <?php echo set_select('unit_id', $unit['id'], isset($product['unit_id']) && (int) $product['unit_id'] === (int) $unit['id']); ?>>
							<?php echo html_escape($unit['name']); ?>
						</option>
					<?php endforeach; ?>
				</select>
				<div class="error-text"><?php echo form_error('unit_id'); ?></div>
			</div>
			<div class="form-group">
				<label for="default_price">Harga Default</label>
				<input type="number" id="default_price" name="default_price" value="<?php echo set_value('default_price', isset($product['default_price']) ? $product['default_price'] : 0); ?>">
				<div class="error-text"><?php echo form_error('default_price'); ?></div>
			</div>
		</div>

		<div class="btn-row">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?php echo site_url('products'); ?>" class="btn btn-secondary">Kembali</a>
		</div>
	<?php echo form_close(); ?>
</div>