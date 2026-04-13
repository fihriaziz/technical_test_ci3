<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<?php echo form_open(); ?>
		<div class="form-grid">
			<?php foreach ($config['fields'] as $field): ?>
				<?php $value = set_value($field['name'], isset($row[$field['name']]) ? $row[$field['name']] : ''); ?>
				<div class="form-group <?php echo $field['type'] === 'textarea' ? 'full' : ''; ?>">
					<label for="<?php echo $field['name']; ?>"><?php echo html_escape($field['label']); ?></label>
					<?php if ($field['type'] === 'textarea'): ?>
						<textarea id="<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>"><?php echo html_escape($value); ?></textarea>
					<?php else: ?>
						<input type="text" id="<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" value="<?php echo html_escape($value); ?>">
					<?php endif; ?>
					<div class="error-text"><?php echo form_error($field['name']); ?></div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="btn-row">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?php echo site_url('master/' . $entity); ?>" class="btn btn-secondary">Kembali</a>
		</div>
	<?php echo form_close(); ?>
</div>