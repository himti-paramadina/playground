<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Index of Quizzes</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-hover">
			<thead>
				<th>Name</th>
				<th>Unique Name</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php foreach ($quizzes as $quiz): ?>
				<tr>
					<td>
						<p class="no-margin no-padding"><strong><?php echo $quiz['Quiz']['name'] ?></strong> <?php if (!$quiz['Quiz']['published']): ?><span class="label label-default">Draft</span><?php endif; ?></p>
						<p class="no-margin no-padding" style="font-size: 0.8em;"><?php echo $quiz['Group']['name'] ?></p>
					</td>
					<td><code><?php echo $quiz['Quiz']['unique_name'] ?></code></td>
					<td><?php echo $quiz['Quiz']['start_time'] ?></td>
					<td><?php echo $quiz['Quiz']['end_time'] ?></td>
					<td>
						<a href="<?php echo Router::url(array('controller' => 'problems', 'action' => 'index', $quiz['Quiz']['identifier'], 'administration' => true)) ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Manage Problems"><span class="glyphicon glyphicon-tasks"></span></a>
						<a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Detail"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if (!$quiz['Quiz']['published']): ?>
						<a href="#" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Publish"><span class="glyphicon glyphicon-eye-open"></span></a>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="paging" style="text-align: center;">
            <ul class="pagination pagination-sm" style="margin: auto auto;">
            <?php
                echo $this->Paginator->prev('&laquo; ', array('escape' => false, 'class' => '', 'tag' => 'li'), '&laquo;', array('tag' => 'li', 'disabledTag' => 'a', 'escape' => false));
                echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentClass' => 'active', 'currentTag' => 'a'));
                echo $this->Paginator->next('&raquo; ', array('escape' => false, 'class' => '', 'tag' => 'li'), '&raquo;', array('tag' => 'li', 'disabledTag' => 'a', 'escape' => false));
            ?>
            </ul>
        </div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('a').tooltip();
});
</script>