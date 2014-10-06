<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('global');
		echo $this->Html->css('app');

		echo $this->Html->script('jquery-1.11.1');
		echo $this->Html->script('bootstrap');
	?>
</head>
<body>
	<div class="container">
		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
