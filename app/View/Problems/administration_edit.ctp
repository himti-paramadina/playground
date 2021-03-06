<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Edit Problem: <?php echo $this->request->data['Problem']['name'] ?> <small><?php echo $problem['Quiz']['name'] ?></small></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<?php echo $this->Form->create('Problem') ?>

		<?php echo $this->Form->input('Problem.name', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Problem.unique_name', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Problem.order', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Problem.description', array('data-provide' => 'markdown', 'div' => 'form-group', 'class' => 'form-control', 'style' => 'height: 450px;')) ?>
		<?php echo $this->Form->input('Problem.test_cases', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Problem.solutions', array('div' => 'form-group', 'class' => 'form-control')) ?>

		<input type="submit" value="Save" class="btn btn-lg btn-success btn-block" style="margin-bottom: 30px;" />

		<?php echo $this->Form->end(); ?>
	</div>
	<div class="col-md-6 markdown" style="border: 2px dotted #ebebeb;">
		<h1 align="center"><?php echo $this->request->data['Problem']['name'] ?></h1>
		<div id="preview"></div>
	</div>
</div>

<?php
	echo $this->Html->script('bootstrap-markdown');
?>

<script type="text/javascript">
$(document).ready(function() {
	$("div#preview").generateMarkdownPreview("textarea#ProblemDescription");
	$("textarea#ProblemDescription").listenOnKeyboardPause(function () {
		$("div#preview").generateMarkdownPreview("textarea#ProblemDescription");
	});
});
</script>