<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Index of Users</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-hover">
			<thead>
				<th>Display Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
				<tr>
					<td><?php echo $user['User']['display_name'] ?></td>
					<td><code><?php echo $user['User']['email'] ?></code></td>
					<td><span class="label label-default"><?php echo $user['Role']['name'] ?></span></td>
					<td>
						<a href="#" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Detail"><span class="glyphicon glyphicon-th-list"></span></a>
						<a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit Detail"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="#" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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