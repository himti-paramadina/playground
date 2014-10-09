<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->Form->create() ?>

		<h1>Personal Data</h1>
		<?php echo $this->Form->input('User.display_name', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('User.email', array('div' => 'form-group', 'class' => 'form-control')) ?>

		<h1>Authentication Data</h1>
		<?php echo $this->Form->input('User.role_id', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('User.password', array('div' => 'form-group', 'class' => 'form-control')) ?>

		<input type="submit" value="Save" class="btn btn-success btn-block" style="margin-bottom: 30px;"/>

		<?php echo $this->Form->end() ?>
	</div>
</div>
