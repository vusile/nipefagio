<!DOCTYPE html>
<html lang="en">
  <head>
	<base href = "<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <title>Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
		 
        padding-top: 0px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/bootstrap.js"></script>

    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
	
	<script type = "text/javascript">
	$('.dropdown-toggle').dropdown();
	</script>
	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
	  
	
      <a  href="<?php echo base_url(); ?>"><img src = 'images/Homepage_background_Header.jpg' style = 'margin:5px 0'></a>

    </div>
	<div id="container" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; '>
		<h1>Page Not Found</h1>
		<?php echo $message; ?>Please pick up your Broom and got back to the <a href ="<?php echo base_url()?>">Home Page</a>. 
	</div>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
-->
	<div style = "width: 1024px; margin: 0 auto">
	<img src = 'images/Homepage_background_Footer.jpg' style = "margin:0 auto;" >
	<p style = "color:white; font-weight: bold; margin-top:-30px; margin-left:300px; font-size:10px;"> Copyright &copy; Nipe Fagio. All rights reserved. Design by DJPA</p>
	
	</div>
  </body>
</html>