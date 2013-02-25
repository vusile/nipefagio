<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px;'>
<h1><?php echo $title; ?></h1>



<?php foreach ($news->result() as $item): ?>
<a href = "article/<?php echo $item->url ?>"><h2 class = "summary-h2" ><?php echo $item->title; ?></h2></a>

<?php

			
	if($item->thumb_nail != '')	
		echo "<a href='article/" . $item->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $item->thumb_nail ."'  style = 'width: 90px; float: left;'></a>";


?>


<?php echo substr(strip_tags($item->text),0,480); ?> ... <a class="readmore" href = "article/<?php echo $item->url ?>">Read More</a>
<div style = 'clear:both; margin-top:10px'></div><br>
<?php endforeach; ?>

</div>