<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Concrete Pumping Software > <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('debug', 'site','jquery-ui-1.8.2.custom')); ?>
	<?php echo $this->html->script(array('jquery-1.4.2.min','jquery-ui-1.8.2.custom.min')); ?>
	<!--[if lt IE 9]>
	<?php echo $this->html->script(array('html5')); ?>
	<![endif]-->
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
	<div id="container">
		<header>
			
			
			<hgroup class="clear">
				<h1>Concrete Pumping Software</h1>
				<h2>Time is money and we save you both.</h2>
			</hgroup>
		</header>
		<div id="main-menu" class="clear">
			<h3><a href="#">Jobs</a></h3>
			<nav>
					<ul>
						<li><a href="/jobs/day/">By Day</a></li>
						<li><a href="/jobs/day/">By Week</a></li>
						<li><a href="/jobs/day/">By Month</a></li>
						<li><a href="/jobs/day/">3 Months</a></li>
					</ul>
				</nav>
			<h3><a href="#">Pumps</a></h3>
			<nav>
					<ul>
						<li><a href="/jobs/day/">All Pumps</a></li>
						<li><a href="/jobs/day/">Add Pump</a></li>
						<li><a href="/jobs/day/">Pumps by size</a></li>

					</ul>
				</nav>
		</div>

		<div id="content" style="float:left; clear:none; border:1px solid #ccc; overflow: hidden; padding:10px;">
			<?php echo $this->content(); ?>
		</div>
		<footer>

			&copy;<?php echo date('Y');?> ConcretePumpingSoftware.co
		</footer>
	</div>
	<script type="text/javascript">
	$(function() {
		$("#main-menu").accordion();
		$(".datepicker").datepicker();
	});
	</script>
</body>
</html>