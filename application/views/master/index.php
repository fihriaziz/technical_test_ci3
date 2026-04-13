<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
	<div class="btn-row" style="justify-content: space-between; margin-top: 0; margin-bottom: 18px;">
		<div>
			<span class="badge"><?php echo html_escape($config['title']); ?></span>
		</div>
		<a href="<?php echo site_url('master/' . $entity . '/create'); ?>" class="btn btn-primary">Tambah Data</a>
	</div>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<?php foreach ($config['columns'] as $label): ?>
					<th><?php echo html_escape($label); ?></th>
				<?php endforeach; ?>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($rows)): ?>
				<tr>
					<td colspan="<?php echo count($config['columns']) + 2; ?>">Belum ada data.</td>
				</tr>
			<?php else: ?>
				<?php foreach ($rows as $index => $row): ?>
					<tr>
						<td><?php echo $index + 1; ?></td>
						<?php foreach (array_keys($config['columns']) as $column): ?>
							<td><?php echo nl2br(html_escape($row[$column])); ?></td>
						<?php endforeach; ?>
						<td>
							<div class="btn-row" style="margin: 0;">
								<a href="<?php echo site_url('master/' . $entity . '/edit/' . $row['id']); ?>" class="btn btn-secondary">Edit</a>
								<a href="<?php echo site_url('master/' . $entity . '/delete/' . $row['id']); ?>" class="btn btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>