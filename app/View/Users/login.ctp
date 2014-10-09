<div class="row">
	<div class="col-md-12">
		<h1 style="font-weight: 300; margin: 50px 0 0 0; font-size: 3em;" align="center">Log In, Code, and Defeat all problems.</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="page-header">
			<h2>Who are you?</h2>
		</div>

		<?php echo $this->Form->create('User') ?>
              
        <?php echo $this->Form->input('User.email', array('div' => 'form-group', 'class' => 'form-control')) ?>
        <?php echo $this->Form->input('User.password', array('div' => 'form-group', 'class' => 'form-control')) ?>
            
        <input type="submit" value="Go!" class="btn btn-success btn-block" style="margin: 20px 0;"/>
            
        <?php echo $this->Form->end() ?>

        <p class="lead">Don't know who you are? <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'register')) ?>">It's a pity.</a></p>
	</div>
</div>
