<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Submission History <small><?php echo $quiz['Quiz']['name'] ?></small></h1>
		</div>
	</div>
</div>
<div class="row" style="margin-bottom: 30px;">
	<div class="col-md-2">
		<div class="page-header" style="margin-top: 0;">
			<h3 class="no-margin no-padding">Scoreboard Entry</h3>
		</div>
		<a href="<?php echo Router::url('/scoreboards/view/' . $quiz['Quiz']['unique_name']) ?>" class="btn btn-info btn-block">Full Scoreboard</a>
	</div>
	<div class="col-md-10">
		<table class="table table-hover">
			<thead>
				<th>Name</th>
				<th style="text-align: center;" colspan="<?php echo count($problems) ?>">Problems</th>
				<th style="text-align: center;">Attempts/Solved</th>
				<th style="text-align: center;">Score</th>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<?php $count = 0; ?>
					<?php foreach ($problems as $problem): $count++; ?>
					<td style="text-align: center;"><?php echo $count ?></td>
					<?php endforeach; ?>
					<td></td>
					<td></td>
				</tr>
				<?php foreach ($scoreboardData as $datum): ?>
				<tr>
					<?php
						$totalScoreClass = "";
						$expectedTotalScore = count($problems) * 100;
						if ($datum[0]['_total'] == $expectedTotalScore) {
							$totalScoreClass = "bg-green";
						}
						else if ($datum[0]['_total'] >= 0.75 * $expectedTotalScore) {
							$totalScoreClass = "bg-orange";
						}
						else if ($datum[0]['_total'] >= 0.5 * $expectedTotalScore) {
							$totalScoreClass = "bg-red";
						}
						else {
							$totalScoreClass = "bg-gray";
						}
					?>
					<td>
						<p class="no-margin no-padding"><strong><?php echo $datum['users']['display_name'] ?></strong></p>
						<p class="no-margin no-padding" style="font-size: 0.8em; color: gray;"><?php echo $datum['roles']['name'] ?></p>
						<div class="<?php echo $totalScoreClass ?>" style="margin-top: 3px; width: <?php echo $datum[0]['_total'] / $expectedTotalScore * 100 ?>%; height: 4px; display: block;"></div>
					</td>
					
					<?php foreach ($problems as $problem): ?>

					<?php
						$scoreClass = "";
						if ($datum[0][$problem['Problem']['unique_name']] == 100) {
							$scoreClass = "bg-green";
						}
						else if ($datum[0][$problem['Problem']['unique_name']] >= 75) {
							$scoreClass = "bg-orange";
						}
						else if ($datum[0][$problem['Problem']['unique_name']] >= 50) {
							$scoreClass = "bg-red";
						}
						else {
							$scoreClass = "bg-gray";
						}
					?>

					<td><span class="score <?php echo $scoreClass ?>"><?php echo $datum[0][$problem['Problem']['unique_name']] ?></span></td>
					
					<?php endforeach; ?>

					<td style="text-align: center;"><?php echo $datum[0]['_attempts'] ?>/<?php echo $datum[0]['_solved'] ?></td>
					<td style="text-align: center;"><span class="score <?php echo $totalScoreClass ?>"><?php echo $datum[0]['_total'] ?></span></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>
<div class="row" style="margin-bottom: 30px;">
	<div class="col-md-2">
		<div class="page-header" style="margin-top: 0;">
			<h3 class="no-margin no-padding">Submission Entries</h3>
		</div>
		<p><em>Sorted by date, descending.</em></p>
	</div>
	<div class="col-md-10">
		<table class="table table-hover">
			<thead>
				<th>Submission Date</th>
				<th>Problem Name</th>
				<th>Score</th>
				<th>User</th>
			</thead>
			<tbody>
			<?php $count = 0; ?>
			<?php foreach ($submissions as $submission): $count++; ?>
				<tr>
					<td><?php echo $submission['Submission']['created'] ?></td>
					<td><span class="label <?php if ($submission['Submission']['score'] == 100): ?>label-success<?php else: ?>label-default<?php endif; ?>"><?php echo $submission['Problem']['name'] ?></span></td>
					<td style="text-align: center;">
						<?php
							$scoreClass = "";
							if ($submission['Submission']['score'] == 100) {
								$scoreClass = "bg-green";
							}
							else if ($submission['Submission']['score'] >= 75) {
								$scoreClass = "bg-orange";
							}
							else if ($submission['Submission']['score'] >= 50) {
								$scoreClass = "bg-red";
							}
							else {
								$scoreClass = "bg-gray";
							}
						?>
						<span class="score <?php echo $scoreClass ?>"><?php echo $submission['Submission']['score'] ?></span>
					</td>
					<td>
						<p class="no-margin no-padding"><strong><?php echo $submission['User']['display_name'] ?></strong></p>
						<p class="no-margin no-padding" style="font-size: 0.8em; color: gray;"><?php echo $submission['User']['Role']['name'] ?></p>
					</td>
				</tr>
			<?php endforeach; ?>

			<?php if ($count == 0): ?>
				<tr>
					<td colspan="4">
						<p align="center"><em>- no submission yet -</em></p>
					</td>
				</tr>
			<?php endif; ?>
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