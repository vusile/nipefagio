<!DOCTYPE html>
<html lang="en">
  <head>
	<base href = "<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <title><?php if( isset($title)) echo $title; ?></title>
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
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.imagecube.min.js"></script>
    
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
	  
	  <!--<a  href="<?php echo base_url(); ?>"><img src = 'images/header.jpg' style = 'margin:5px 0'></a>-->
     <!-- <a  href="<?php echo base_url(); ?>">--><img src = 'images/Homepage_background_Header.jpg' style = 'margin:5px 0'><!--</a>-->
      <div class="navbar-inner">
        <div class="container" style = "width:850px">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li  <?php if($this->uri->segment(1) == '') echo "class = 'active'" ?> ><a class = "first"  href="<?php echo base_url(); ?>">Home</a></li>
              <li class = "dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Projects <b class="caret"></b></a>
			  
				<?php echo $projects ?>
			  
			  </li>
             <!-- <li <?php if($this->uri->segment(1) == 'blog') echo "class = 'active'" ?> ><a href="blog">Blog</a></li>-->
              <li <?php if($this->uri->segment(1) == 'the-directory') echo "class = 'active'" ?> ><a href="the-directory">Directory</a></li>
              <li class = "dropdown"><a class="dropdown-toggle" data-toggle="dropdown" >Publications <b class="caret"></b></a>
			  <?php echo $publications ?>
				<!--<ul class="dropdown-menu">
				
				<li >
					<a  href="#">second link <i class="icon-arrow-right"></i> </a>
					<ul class="dropdown-menu sub-menu">
						<li><a href="#">second link </a></li>
						<li><a href="#">third link </a></li>
					</ul>
				</li>
				<li><a href="#">third link </a></li>
				</ul>-->
			  
			  </li>
			  
              <li <?php if($this->uri->segment(1) == 'news') echo "class = 'active'" ?> ><a href="news">News</a></li>
              <li <?php if($this->uri->segment(1) == 'newsletter-archive') echo "class = 'active'" ?> ><a href="newsletter-archive">Newsletter</a></li>
              <li  class = "dropdown"><a class="dropdown-toggle" data-toggle="dropdown">About Us <b class="caret"></b></a>
				<ul class="dropdown-menu">
				
				<li >
					<a href="about-us">About Nipe Fagio </a>
					<a href="the-team">The Team</a></li>
				</ul>
			  
			  </li>
              <li <?php if($this->uri->segment(1) == 'contact-us') echo "class = 'active'" ?> ><a class = "last"  href="contact-us">Contact Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  