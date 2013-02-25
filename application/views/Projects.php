<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px;'>
<h1><?php echo $title; ?></h1>



<?php foreach ($projects->result() as $project): ?>
<a href = "project/<?php echo $project->url ?>"><h2 class = "summary-h2"><?php echo $project->title; ?></h2></a>

<?php

			
	if($project->thumb_nail != '')	
		echo "<a href='project/" . $project->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $project->thumb_nail ."'  style = 'width: 90px; float: left;'></a>";
?>


<?php echo substr(strip_tags($project->text),0,480); ?> ... <a class="readmore" href = "project/<?php echo $project->url ?>">Read More</a>
<div style = 'clear:both; margin-top:10px'></div><br>
<?php endforeach; ?>

</div>