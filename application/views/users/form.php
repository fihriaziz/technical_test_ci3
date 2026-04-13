<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<?php echo form_open(); ?>
		<div class="form-grid">
			<div class="form-group">
				<label for="name">Nama</label>
				<input type="text" id="name" name="name" value="<?php echo set_value('name', isset($user['name']) ? $user['name'] : ''); ?>">
				<div class="error-text"><?php echo form_error('name'); ?></div>
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" value="<?php echo set_value('username', isset($user['username']) ? $user['username'] : ''); ?>">
				<div class="error-text"><?php echo form_error('username'); ?></div>
			</div>
			<div class="form-group">
				<label for="role">Role</label>
				<select id="role" name="role">
					<option value="admin" <?php echo set_select('role', 'admin', isset($user['role']) && $user['role'] === 'admin'); ?>>Admin</option>
					<option value="staff" <?php echo set_select('role', 'staff', isset($user['role']) && $user['role'] === 'staff'); ?>>Staff</option>
				</select>
				<div class="error-text"><?php echo form_error('role'); ?></div>
			</div>
			<div class="form-group">
				<label for="password">Password <?php echo isset($user['id']) ? '(kosongkan jika tidak diubah)' : ''; ?></label>
				<input type="password" id="password" name="password">
				<div class="error-text"><?php echo form_error('password'); ?></div>
			</div>
		</div>

		<div class="btn-row">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="<?php echo site_url('users'); ?>" class="btn btn-secondary">Kembali</a>
		</div>
	<?php echo form_close(); ?>
</div>