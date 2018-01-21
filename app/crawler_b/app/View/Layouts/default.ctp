<!DOCTYPE html>
<html>
<head>
	<title>Crawler - WEBX </title>
	<?php echo $this->Html->charset(); ?>
	<?php echo $this->Html->meta('icon'); ?>
	<?php echo $this->Html->css('cake.generic'); ?>
	<?php echo $this->Html->script('jquery-2.1.3.min'); ?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Crawler - WEBX</h1>
		</div>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
</body>
</html>
