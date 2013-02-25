<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; '>
<h1><?php echo $details->title; ?></h1>

<?php 
	if(isset($details->text)) echo $details->text; 
?>
</div>