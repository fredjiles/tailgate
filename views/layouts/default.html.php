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
	<title><?php echo $this->title(); ?> -> Tailgate With Me</title>
	<?php echo $this->html->style(array('debug', 'style')); ?>
	<?php echo $this->html->script(array('jquery-1.4.2.min','jquery-ui-1.8.2.custom.min')); ?>
	<!--[if lt IE 9]>
	<?php echo $this->html->script(array('html5')); ?>
	<![endif]-->
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
   <!-- <script type="text/javascript" src="http://use.typekit.com/qan8tvw.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
-->
    <script type="text/javascript">
        $(document).ready(function(){
           $('.datepicker').datepicker();
        });
    </script>

</head>
<body class="app">
	<header>
			<h1>TailgateWith.Me</h1>
			
		</header>
	<div id="container">
		
			<div id="page">
				
				<?php echo $this->content(); ?>
				
			</div>



		</div>
</body>
</html>
