<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="btn-row" style="justify-content: space-between; margin-top: 0; margin-bottom: 18px;">
		<span class="badge">Master User</span>
		<a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary">Tambah User</a>
	</div>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Role</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($users)): ?>
				<tr>
					<td colspan="5">Belum ada user.</td>
				</tr>
			<?php else: ?>
				<?php foreach ($users as $index => $user): ?>
					<tr>
						<td><?php echo $index + 1; ?></td>
						<td><?php echo html_escape($user['name']); ?></td>
						<td><?php echo html_escape($user['username']); ?></td>
						<td><?php echo html_escape($user['role']); ?></td>
						<td>
							<div class="btn-row" style="margin: 0;">
								<a href="<?php echo site_url('users/edit/' . $user['id']); ?>" class="btn btn-secondary">Edit</a>
								<a href="<?php echo site_url('users/delete/' . $user['id']); ?>" class="btn btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>