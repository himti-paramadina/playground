<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<div class="row">
				<div class="col-md-9">
					<p class="no-margin no-padding"><?php echo $group['Group']['name'] ?></p>
					<h1 style="margin-top: 0; font-weight: bold;"><?php echo $quiz['Quiz']['name'] ?></h1>
				</div>
				<div class="col-md-3">
					<div style="text-align: right;">
						<a target="_blank" href="#" class="btn btn-success">Score Board</a>
						<a target="_blank" href="<?php echo Router::url('/submissions/history/' . $quiz['Quiz']['unique_name']) ?>" class="btn btn-info">Submissions</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p align="right">Token: <code><?php echo $participation['Participation']['token'] ?></code></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="page-header" style="margin-top: 0;">
			<h3 class="no-margin no-padding">Description</h3>
		</div>
	</div>
	<div class="col-md-10">
		<?php echo $this->Markdown->parse($quiz['Quiz']['description']) ?>		
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="page-header" style="margin-top: 0;">
			<h3 class="no-margin no-padding">Problem List</h3>
		</div>
	</div>
	<div class="col-md-10">
		<div class="panel-group" id="accordion">
			<?php foreach($problems as $problem): ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $problem['Problem']['unique_name'] ?>">
							<?php echo $problem['Problem']['name'] ?> <code><?php echo $problem['Problem']['unique_name'] ?></code>
						</a>
					</h4>
				</div>
				<div id="<?php echo $problem['Problem']['unique_name'] ?>" class="panel-collapse collapse">
					<div class="panel-body">
						<h1 align="center" style="margin: 0 0 30px 0; padding: 0;"><?php echo $problem['Problem']['name'] ?></h1>
						<?php echo $this->Markdown->parse($problem['Problem']['description']) ?>	
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>