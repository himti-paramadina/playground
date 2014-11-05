<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $quiz['Quiz']['name'] ?> Problems<?php if (!$quiz['Quiz']['published']): ?> <small>Draft</small><?php endif; ?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 user-action">
		<div class="page-header" style="margin-top: 0;">
			<h3 class="no-margin no-padding">Actions</h3>
		</div>

		<div class="list-group">
			<a href="<?php echo Router::url(array('controller' => 'problems', 'action' => 'add', $quiz['Quiz']['identifier'], 'administration' => true)) ?>" class="list-group-item">Add New Problem</a>
			<a href="<?php echo Router::url(array('controller' => 'quizzes', 'action' => 'edit', $quiz['Quiz']['identifier'], 'administration' => true)) ?>" class="list-group-item">Edit Quiz Detail</a>
			<?php if (!$quiz['Quiz']['published']): ?><a href="<?php echo Router::url(array('controller' => 'quizzes', 'action' => 'publish', $quiz['Quiz']['identifier'], 'administration' => true)) ?>" class="list-group-item">Publish</a><?php endif; ?>
		</div>
	</div>
	<div class="col-md-8">
		<table class="table table-hover">
			<thead>
				<th>Unique Name</th>
				<th>Problem Name</th>
				<th>Order</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php $count = 0; ?>
				<?php foreach ($problems as $problem): $count++; ?>
				<tr>
					<td><code><?php echo $problem['Problem']['unique_name'] ?></code></td>
					<td><?php echo $problem['Problem']['name'] ?></td>
					<td><?php echo $problem['Problem']['order'] ?></td>
					<td>
						<a href="<?php echo Router::url(array('controller' => 'problems', 'action' => 'edit', $problem['Problem']['id_problem'], 'administration' => true)) ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
				<?php endforeach; ?>

				<?php if ($count == 0): ?>
				<tr>
					<td colspan="4"><p align='center'><em>This quiz still has no problem.</em> <a href="<?php echo Router::url(array('controller' => 'problems', 'action' => 'add', $quiz['Quiz']['identifier'], 'administration' => true)) ?>" class="btn btn-success">Create One</a></p></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('a').tooltip();
});
</script>