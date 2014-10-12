<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<p class="no-margin no-padding"><?php echo $quiz['Group']['name'] ?></p>
			<h1 style="margin-top: 0; font-weight: bold;"><?php echo $quiz['Quiz']['name'] ?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="page-header" style="margin-top: 0;">
			<h2 class="no-margin no-padding">Description</h2>
		</div>
	</div>
	<div class="col-md-8">
		<?php echo $this->Markdown->parse($quiz['Quiz']['description']) ?>		
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="page-header" style="margin-top: 0;">
			<h2 class="no-margin no-padding">Problem List</h2>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel-group" id="accordion">
			<?php foreach($quiz['Problem'] as $problem): ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $problem['unique_name'] ?>">
							<?php echo $problem['name'] ?>
						</a>
					</h4>
				</div>
				<div id="<?php echo $problem['unique_name'] ?>" class="panel-collapse collapse">
					<div class="panel-body">
						<?php echo $this->Markdown->parse($problem['description']) ?>	
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>