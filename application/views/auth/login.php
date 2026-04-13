<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="login-wrap">
	<div class="login-card">
		<span class="badge">CodeIgniter 3 Admin</span>
		<h1>Login Dashboard</h1>
		<p>Masuk untuk mengelola database faktur, master data, dan transaksi PT Sentosa.</p>

		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-error"><?php echo html_escape($this->session->flashdata('error')); ?></div>
		<?php endif; ?>

		<?php echo form_open('login'); ?>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" autofocus>
				<div class="error-text"><?php echo form_error('username'); ?></div>
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" id="password" name="password">
				<div class="error-text"><?php echo form_error('password'); ?></div>
			</div>

			<div class="btn-row">
				<button type="submit" class="btn btn-primary">Masuk</button>
			</div>
		<?php echo form_close(); ?>

		<p style="margin-top:18px;font-size:13px;">Default login: <strong>admin</strong> / <strong>admin123</strong></p>
	</div>
</div>