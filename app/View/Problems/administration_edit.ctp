<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Edit Problem: <?php echo $this->request->data['Problem']['name'] ?> <small><?php echo $problem['Quiz']['name'] ?></small></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
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
</div>

<?php
	echo $this->Html->script('bootstrap-markdown');
?>