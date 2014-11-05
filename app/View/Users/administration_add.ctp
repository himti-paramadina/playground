<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Add New User</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php echo $this->Form->create() ?>

		<div class="page-header">
			<h2>Personal Data</h2>
		</div>

		<?php echo $this->Form->input('User.display_name', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('User.email', array('div' => 'form-group', 'class' => 'form-control')) ?>

		<div class="page-header">
			<h2>Authentication Data</h2>
		</div>

		<?php echo $this->Form->input('User.role_id', array('div' => 'form-group', 'class' => 'form-control')) ?>
		<?php echo $this->Form->input('User.password', array('div' => 'form-group', 'class' => 'form-control')) ?>

		<input type="submit" value="Save" class="btn btn-success btn-block" style="margin-bottom: 30px;"/>

		<?php echo $this->Form->end() ?>
	</div>
</div>
