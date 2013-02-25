<script type = "text/javascript">
$(document).ready(function(){
$('#defaultCube').imagecube({speed: 1000,pause: 3000});
});
</script>
<?php $count = 0; ?>
<div class="container">

	<div class = 'span4' style = 'margin-top:10px;font-size:12px;'>
    
<img src="images/Homepage_Side_banner_box.jpg" style = "text-align: left; width:300px; margin:0;"/>
    <h2 class = "sidebar-titles" >News</h2>
	<div class = 'sidebar-container' >
		<?php foreach ($news->result() as $item): ?>
<?php


		if($item->thumb_nail != '')	
			echo "<a href='article/" . $item->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $item->thumb_nail ."'  style = 'width: 50px; float: right;'></a>";

?>
<a href = "article/<?php echo $item->url ?>"><h2 class = "sidebar-news-titles"><?php echo $item->title; ?></h2></a><br>
<?php echo substr(strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$item->text) ),0,65); ?> ... <a class="readmore" href = "article/<?php echo $item->url ?>">Read More</a>
<?php 
$count++;
if($count <= 2	):
?>
<div style = 'clear:both; margin:10px 0; border-top: 1px solid #cdcdcd;  '></div>
<?php endif; ?>
<?php endforeach; ?>
	</div>
	<div style = 'clear:both;'></div>
<?php $count = 0; ?>
	<img src="images/Homepage_Side_banner_box.jpg" style = "text-align: left; width:300px; margin:0;"/>
    <h2 class = "sidebar-titles" >Featured Projects</h2>
	<div class = 'sidebar-container' >
<?php foreach($featured_projects->result() as $feat): ?>

	
<a href = "project/<?php echo $feat->url ?>"><h2 class = "sidebar-news-titles"><?php echo $feat->title; ?></h2></a><br>


<?php

		if($feat->thumb_nail != '')	
		
			echo "<a href='project/" . $feat->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $feat->thumb_nail ."'  style = 'width: 90px; float: left;'></a>";
		

?>
<?php echo substr(strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$feat->text)),0,100); ?>
... <a class="readmore" href = "project/<?php echo $feat->url ?>">Read More</a>
<?php 
$count++;
if($count <= 2	):
?>
<div style = 'clear:both; margin:10px 0; border-top: 1px solid #cdcdcd;  '></div>
<?php endif; ?>
<?php endforeach; ?>
	</div>
    <div style = 'clear:both; '></div>
	    <img src="images/Homepage_Side_banner_box.jpg" style = "text-align: left; width:300px; margin:0;"/>
    <h2 class = "sidebar-titles">Partners</h2>
	
	<div class = 'sidebar-container' style = 'height:115px;' >
		<div id="defaultCube" style="width: 200px; height: 100px; margin-left: 30px;">
			<?php foreach($partners->result() as $partner): ?>
				<!--<a href = "<?php echo $partner->website;?>">--><img src = 'images/<?php echo $partner->logo; ?>' alt = '<?php echo $partner->company_name ?>' title = '<?php echo $partner->company_name ?>' /><!--</a>-->
			<?php endforeach; ?>
		</div>
	</div>
	
	</div><!-- /span4 -->
	<div class = 'container' style = 'float: left; margin-left: 30px; clear: none; width: 620px;'>
		<h1><?php echo $title; ?></h1>
		<?php echo $home; ?>
	</div>
	
	
	
	  
 </div> <!-- /container -->
