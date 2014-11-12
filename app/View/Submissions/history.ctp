<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Submission History <small><?php echo $quiz['Quiz']['name'] ?></small></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-hover">
			<thead>
				<th>Submission Date</th>
				<th>Problem Name</th>
				<th>Score</th>
				<th>User</th>
			</thead>
			<tbody>

			<?php foreach ($submissions as $submission): ?>
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