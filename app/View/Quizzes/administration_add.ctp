<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Add New Quiz</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->Form->create('Quiz') ?>

		<?php echo $this->Form->input('Quiz.name', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Quiz.unique_name', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Quiz.start_time', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Quiz.end_time', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('Quiz.description', array('data-provide' => 'markdown', 'div' => 'form-group', 'class' => 'form-control')) ?>

		<input type="submit" value="Save" class="btn btn-success btn-lg" style="margin-bottom: 30px;" />

		<?php echo $this->Form->end() ?>
	</div>
</div>

<?php
	echo $this->Html->script('bootstrap-markdown');
?>