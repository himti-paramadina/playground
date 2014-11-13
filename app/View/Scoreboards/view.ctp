<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Scoreboard <small><?php echo $quiz['Quiz']['name'] ?></small></h1>
			<p align="right"><em>Last updated at <?php echo date('Y-m-d H:i:s') ?></em></p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-hover">
			<thead>
				<th style="text-align: center;">Rank</th>
				<th>Name</th>
				<th style="text-align: center;" colspan="<?php echo count($problems) ?>">Problems</th>
				<th style="text-align: center;">Attempts/Solved</th>
				<th style="text-align: center;">Score</th>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<?php $count = 0; ?>
					<?php foreach ($problems as $problem): $count++; ?>
					<td style="text-align: center;">Problem <?php echo $count ?></td>
					<?php endforeach; ?>
					<td></td>
					<td></td>
				</tr>
				<?php $rank = 0; ?>
				<?php foreach ($scoreboardData as $datum): $rank++; ?>

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
				<tr>
					<td style="text-align: center;">
						<p class="no-margin no-padding"><?php echo '#' . $rank ?></p>
					</td>
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

					<td style="text-align: center;">
						<p class="no-margin no-padding"><?php echo $datum[0]['_attempts'] ?>/<?php echo $datum[0]['_solved'] ?></p>
						<p class="no-margin no-padding" style="font-size: 0.6em;"><span class="glyphicon glyphicon-time"></span> <?php echo $datum[0]['_elapsed_time'] ?></p>
					</td>
					<td style="text-align: center;"><span class="score <?php echo $totalScoreClass ?>"><?php echo $datum[0]['_total'] ?></span></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>