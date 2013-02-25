<style>
img.team { width:400px}
p.team {text-align: center; font-family: Trebuchet, Georgia; font-size: 24px;}
p.info {margin-top:40px;}
</style>

<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; '>
<h1><?php echo $details->title; ?></h1>

<?php 
	if(isset($details->text)) echo $details->text; 
?>
<hr>
<?php 
	$count = 1;
	foreach($team->result() as $member): 
	if($count%2 == 0)
	{
		$imgdiv = "float:left;";
		$infodiv = "float:left;";
	}
	else
	{
		$imgdiv = "float:right;";
		$infodiv = "float:left;";
	}
	$count++;
	
?>
	<div style = "width:450px; <?php echo $imgdiv; ?> clear: none;">
	<h2><?php echo $member->name; ?></h2>
		<div style = "max-width:412px; clear: none; background: #D6D6D6; min-height:400px;">
		<?php if($member->photo != ''): ?>
			<img class = "team" src = "images/<?php echo $member->photo; ?>" />
		<?php else: ?>
			<img class = "team" src = "images/no_photo.jpg" />
		<?php endif; ?>
		<p class = "team"><?php echo $member->name; ?></p>
		<p class = "team"><?php echo $member->position_or_title; ?></p>
		</div>
	</div>
	<div style = "width:412px; <?php echo $infodiv; ?> clear: none;">
	<p class = "info" ><?php echo $member->info; ?></p>
	</div>
	<div style = "clear:both;"></div>
<?php endforeach; ?>
</div>