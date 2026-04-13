<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo html_escape($page_title); ?> | PT Sentosa</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<style>
		:root {
			--bg: #f4efe7;
			--paper: #fffdf8;
			--panel: #12343b;
			--panel-soft: #1f4e57;
			--accent: #d97706;
			--accent-soft: #f59e0b;
			--text: #172026;
			--muted: #64748b;
			--border: #dccfbd;
			--success: #166534;
			--danger: #b91c1c;
			--shadow: 0 18px 40px rgba(18, 52, 59, 0.12);
		}

		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			font-family: 'Plus Jakarta Sans', sans-serif;
			background:
				radial-gradient(circle at top left, rgba(217, 119, 6, 0.20), transparent 28%),
				linear-gradient(180deg, #f7f2ea 0%, #f0e5d6 100%);
			color: var(--text);
		}

		a {
			color: inherit;
			text-decoration: none;
		}

		.shell {
			display: flex;
			min-height: 100vh;
		}

		.sidebar {
			width: 280px;
			background: linear-gradient(180deg, var(--panel) 0%, #0d252a 100%);
			color: #eff6ff;
			padding: 28px 22px;
			position: sticky;
			top: 0;
			height: 100vh;
		}

		.brand {
			display: flex;
			flex-direction: column;
			gap: 8px;
			margin-bottom: 28px;
		}

		.brand small {
			text-transform: uppercase;
			letter-spacing: 0.16em;
			color: rgba(239, 246, 255, 0.7);
			font-size: 11px;
		}

		.brand strong {
			font-size: 24px;
			line-height: 1.2;
		}

		.user-box {
			background: rgba(255, 255, 255, 0.08);
			border: 1px solid rgba(255, 255, 255, 0.12);
			border-radius: 18px;
			padding: 16px;
			margin-bottom: 24px;
		}

		.user-box span,
		.user-box small {
			display: block;
		}

		.user-box small {
			margin-top: 4px;
			color: rgba(239, 246, 255, 0.7);
		}

		.nav-title {
			font-size: 11px;
			text-transform: uppercase;
			letter-spacing: 0.14em;
			color: rgba(239, 246, 255, 0.55);
			margin: 22px 0 10px;
		}

		.nav-menu {
			display: grid;
			gap: 8px;
		}

		.nav-menu a {
			padding: 12px 14px;
			border-radius: 14px;
			font-size: 14px;
			color: rgba(239, 246, 255, 0.88);
			transition: 0.2s ease;
		}

		.nav-menu a.active,
		.nav-menu a:hover {
			background: linear-gradient(90deg, rgba(245, 158, 11, 0.22), rgba(245, 158, 11, 0.1));
			color: #fff7ed;
		}

		.main {
			flex: 1;
			padding: 28px;
		}

		.topbar {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 16px;
			margin-bottom: 24px;
		}

		.page-heading h1 {
			margin: 0;
			font-size: 30px;
		}

		.page-heading p {
			margin: 8px 0 0;
			color: var(--muted);
		}

		.topbar .date-pill {
			background: rgba(255, 255, 255, 0.7);
			border: 1px solid rgba(220, 207, 189, 0.8);
			padding: 12px 16px;
			border-radius: 999px;
			box-shadow: var(--shadow);
			font-size: 13px;
		}

		.card {
			background: rgba(255, 253, 248, 0.92);
			border: 1px solid rgba(220, 207, 189, 0.9);
			border-radius: 24px;
			box-shadow: var(--shadow);
			padding: 24px;
			margin-bottom: 22px;
		}

		.grid {
			display: grid;
			gap: 18px;
		}

		.grid.stats {
			grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
		}

		.stat-card {
			padding: 22px;
			border-radius: 22px;
			background: linear-gradient(180deg, #fffaf1 0%, #f8ecda 100%);
			border: 1px solid #ead7b7;
		}

		.stat-card strong {
			display: block;
			font-size: 30px;
			margin-top: 12px;
		}

		.stat-card span {
			color: var(--muted);
			font-size: 13px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 14px 12px;
			border-bottom: 1px solid #eadfce;
			text-align: left;
			font-size: 14px;
			vertical-align: top;
		}

		th {
			color: var(--muted);
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 0.08em;
		}

		.form-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
			gap: 16px;
		}

		.form-group {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.form-group.full {
			grid-column: 1 / -1;
		}

		label {
			font-size: 13px;
			font-weight: 600;
		}

		input,
		select,
		textarea {
			width: 100%;
			padding: 12px 14px;
			border-radius: 14px;
			border: 1px solid #d9c9b2;
			background: #fffdfa;
			font: inherit;
		}

		textarea {
			min-height: 110px;
			resize: vertical;
		}

		.btn-row {
			display: flex;
			flex-wrap: wrap;
			gap: 10px;
			margin-top: 18px;
		}

		.btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			padding: 11px 16px;
			border: none;
			border-radius: 14px;
			font: inherit;
			font-weight: 700;
			cursor: pointer;
		}

		.btn-primary {
			background: linear-gradient(135deg, var(--accent) 0%, var(--accent-soft) 100%);
			color: #fff;
		}

		.btn-secondary {
			background: #e7dccd;
			color: var(--text);
		}

		.btn-danger {
			background: #fee2e2;
			color: var(--danger);
		}

		.alert {
			padding: 14px 16px;
			border-radius: 16px;
			margin-bottom: 16px;
			font-size: 14px;
		}

		.alert-success {
			background: #dcfce7;
			color: var(--success);
		}

		.alert-error {
			background: #fee2e2;
			color: var(--danger);
		}

		.error-text {
			font-size: 12px;
			color: var(--danger);
		}

		.badge {
			display: inline-block;
			padding: 6px 10px;
			border-radius: 999px;
			background: #fff1d6;
			color: #a16207;
			font-size: 12px;
			font-weight: 700;
		}

		.invoice-items {
			overflow-x: auto;
		}

		.invoice-paper {
			background: #fff;
			border: 1px solid #d9d9d9;
			padding: 28px;
			border-radius: 20px;
		}

		.invoice-header {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
			gap: 20px;
			margin-bottom: 24px;
		}

		.invoice-summary {
			width: 100%;
			max-width: 320px;
			margin-left: auto;
		}

		.login-wrap {
			min-height: 100vh;
			display: grid;
			place-items: center;
			padding: 24px;
		}

		.login-card {
			width: 100%;
			max-width: 450px;
			background: rgba(255, 253, 248, 0.94);
			border: 1px solid rgba(220, 207, 189, 0.9);
			border-radius: 28px;
			padding: 32px;
			box-shadow: var(--shadow);
		}

		.login-card h1 {
			margin: 0 0 8px;
		}

		.login-card p {
			margin: 0 0 22px;
			color: var(--muted);
		}

		@media (max-width: 960px) {
			.shell {
				flex-direction: column;
			}

			.sidebar {
				width: 100%;
				height: auto;
				position: static;
			}

			.main {
				padding: 18px;
			}

			.topbar {
				flex-direction: column;
				align-items: flex-start;
			}
		}
	</style>
</head>
<body>
<?php if ($this->router->class !== 'auth'): ?>
	<div class="shell">
		<aside class="sidebar">
			<div class="brand">
				<small>Dashboard Admin</small>
				<strong>PT Sentosa Invoice App</strong>
			</div>

			<div class="user-box">
				<span><?php echo html_escape($current_user['name']); ?></span>
				<small><?php echo html_escape($current_user['role']); ?> | <?php echo html_escape($current_user['username']); ?></small>
			</div>

			<div class="nav-title">Menu Utama</div>
			<div class="nav-menu">
				<a href="<?php echo site_url('dashboard'); ?>" class="<?php echo $active_menu === 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
				<a href="<?php echo site_url('users'); ?>" class="<?php echo $active_menu === 'users' ? 'active' : ''; ?>">Master User</a>
				<a href="<?php echo site_url('master/suppliers'); ?>" class="<?php echo $active_menu === 'suppliers' ? 'active' : ''; ?>">Master Supplier</a>
				<a href="<?php echo site_url('master/customers'); ?>" class="<?php echo $active_menu === 'customers' ? 'active' : ''; ?>">Master Customer</a>
				<a href="<?php echo site_url('master/units'); ?>" class="<?php echo $active_menu === 'units' ? 'active' : ''; ?>">Master Satuan</a>
				<a href="<?php echo site_url('products'); ?>" class="<?php echo $active_menu === 'products' ? 'active' : ''; ?>">Master Produk</a>
				<a href="<?php echo site_url('invoices'); ?>" class="<?php echo $active_menu === 'invoices' ? 'active' : ''; ?>">Transaksi Faktur</a>
			</div>

			<div class="nav-title">Akun</div>
			<div class="nav-menu">
				<a href="<?php echo site_url('logout'); ?>">Logout</a>
			</div>
		</aside>
		<main class="main">
			<div class="topbar">
				<div class="page-heading">
					<h1><?php echo html_escape($page_title); ?></h1>
					<p>Manajemen master data, transaksi faktur, dan detail invoice PT Sentosa.</p>
				</div>
				<div class="date-pill"><?php echo date('d F Y'); ?></div>
			</div>

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success"><?php echo html_escape($this->session->flashdata('success')); ?></div>
			<?php endif; ?>

			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-error"><?php echo html_escape($this->session->flashdata('error')); ?></div>
			<?php endif; ?>
<?php endif; ?>