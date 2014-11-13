</div>

<div class="home-cover">
	<div class="container">
		<div class="row">
			<div class="col-md-12 highlight">
				<h1>You know what this is for, right?</h1>
				<p align="center"><a class="button" href="<?php echo Router::url(array('controller' => 'users', 'action' => 'login')) ?>">Yes I know. Bring it on!</a></p>
				<p align="center">Or, <a href="#">you don't know yet?</a></p>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p class="lead" align="center" style="margin: 30px 0 0 0;">Playground is a portal for organizing programming quizzes in Universitas Paramadina.</p>
		</div>
	</div9	<div class="row">
		<div class="col-md-3">
			<div class="page-header">
				<h3>Currently Running Quizzes</h3>
			</div>
		</div>
		<div class="col-md-9">
			<?php foreach ($userGroups as $userGroup): ?>
				<div class="row group">
					<div class="col-md-12">
						
						<h2 style="font-weight: bold;"><?php echo $userGroup['Group']['name'] ?></h2>
						
						<div class="row">
							<div class="col-md-12">
								<?php $count = 0; ?>
								<?php foreach ($userGroup['Quiz'] as $quiz): ?>
								<?php 	  if (($quiz['published']) && ( strtotime(date('Y-m-d H:i:s')) >= strtotime(date($quiz['start_time'])) && strtotime(date('Y-m-d H:i:s')) <= strtotime(date($quiz['end_time'])) )): $count++; ?>
								<div class="row">
									<div class="col-md-12">
										<div class="entry-item-style-1" style="padding: 20px;">
											<h1 class="no-margin no-padding"><?php echo $quiz['name'] ?></h1>
											<p class="no-margin no-padding">
												<span class="glyphicon glyphicon-time"></span><em> <?php echo $quiz['start_time'] ?> - until - <span class="glyphicon glyphicon-time"></span> <?php echo $quiz['end_time'] ?></em>
											</p>
											<p align="right">
												<a href="<?php echo Router::url('/scoreboards/view/' . $quiz['unique_name']) ?>" class="btn btn-info">Scoreboards</a>
											</p>						
										</div>
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
		</div>
	</div>
</div>

<div class="container">