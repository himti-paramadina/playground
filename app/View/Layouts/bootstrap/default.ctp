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
		echo $this->Html->css('bootstrap-markdown.min');
		echo $this->Html->css('global');
		echo $this->Html->css('site');

		echo $this->Html->script('jquery-1.11.1');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('playground');
	?>

	<script>
        var currenttime = '<?php echo date("F d, Y H:i:s", time())?>';
        var CONFIG = {
        	url: '<?php echo Router::url('/', true) ?>'
        };
    </script>
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
	<?php echo $this->Element('footer') ?>
	<?php // echo $this->element('sql_dump'); ?>

	<script type="text/javascript">
		// Current Server Time script (SSI or PHP)- By JavaScriptKit.com (http://www.javascriptkit.com)
		// For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
		// This notice must stay intact for use.

		// Depending on whether your page supports SSI (.shtml) or PHP (.php), UNCOMMENT the line below your page supports and COMMENT the one it does not:
		// Default is that SSI method is uncommented, and PHP is commented:

		var montharray = new Array(
		    "January", "February", "March", "April", "May", "June",
		    "July", "August", "September", "October", "November", "December"
		)
		var serverdate = new Date(currenttime)

		function padlength(what){
		    var output = (what.toString().length == 1) ? "0" + what : what
		    return output
		}

		function displaytime(){
		    serverdate.setSeconds(serverdate.getSeconds() + 1)
		    var datestring = montharray[serverdate.getMonth()] + " " + padlength(serverdate.getDate()) + ", " + serverdate.getFullYear()
		    var timestring = padlength(serverdate.getHours()) + ":" + padlength(serverdate.getMinutes()) + ":" + padlength(serverdate.getSeconds())

		    document.getElementById("servertime").innerHTML = datestring + " " + timestring
		}

		window.onload=function(){
		    setInterval("displaytime()", 1000)
		}
	</script>
</body>
</html>
