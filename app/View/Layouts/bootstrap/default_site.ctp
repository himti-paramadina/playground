<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>

	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700' rel='stylesheet' type='text/css'>

	<?php
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('global');
		echo $this->Html->css('site');

		echo $this->Html->script('jquery-1.11.1');
		echo $this->Html->script('bootstrap');
	?>
</head>
<body>
	<?php
		if (AuthComponent::user('id_user') != null):
			echo $this->Element('navigation/user');
		else:
			echo $this->Element('navigation/site');
		endif; 
	?>
	
	<div class="container">
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>
	<?php echo $this->ELement('footer') ?>

	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
