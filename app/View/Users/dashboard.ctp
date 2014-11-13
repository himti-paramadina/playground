<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><span class="glyphicon glyphicon-dashboard"></span> Dashboard</h1>
		</div>
	</div>
</div>

<?php foreach ($userGroups as $userGroup): ?>
<div class="row group">
	<div class="col-md-12">
		<div class="page-header">
			<h2 style="font-weight: bold;"><?php echo $userGroup['Group']['name'] ?></h2>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="page-header" style="margin-top: 0;">
					<h3 class="no-margin no-padding">Available Quizzes</h3>
				</div>
			</div>
			<div class="col-md-9">
				<?php $count = 0; ?>
				<?php foreach ($userGroup['Group']['Quiz'] as $quiz): ?>
				<?php 	  if (($quiz['published']) && ( strtotime(date('Y-m-d H:i:s')) >= strtotime(date($quiz['start_time'])) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date($quiz['end_time'])) )): $count++; ?>
				<div class="row entry-item-style-1">
					<div class="col-md-12">
						<h1 class="no-margin no-padding"><?php echo $quiz['name'] ?></h1>
						<p class="no-margin no-padding">
							<span class="glyphicon glyphicon-time"></span><em> <?php echo $quiz['start_time'] ?> - until - <span class="glyphicon glyphicon-time"></span> <?php echo $quiz['end_time'] ?></em>
						</p>
						<p class="no-margin no-padding">&nbsp;</p>

						<?php echo $this->Markdown->parse($quiz['description']) ?>

						<p class="no-margin no-padding">&nbsp;</p>
						<p align="right">
							<a href="<?php echo Router::url('/quizzes/detail/' . $quiz['unique_name']) ?>" class="btn btn-success">Participate and Show Me!</a>
						</p>						
					</div>
				</div>
				<?php     endif; ?>
				<?php endforeach; ?>

				<?php if ($count == 0): ?>
				<p style="border: solid 1px #ebebeb; margin: 0; padding: 20px;" align="center"><em>There are no quiz available for this group right now.</em></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>