<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; min-height: 590px;'>
<h1><?php echo $details->title; ?></h1>

<?php echo $details->text; ?>
<br>
<?php foreach ($activities->result() as $activity): ?>
<h3><?php echo $activity->title; ?></h3>

<?php echo $activity->description; ?>
<br>
<a href = "contact/activity/<?php echo $activity->id ?>"><?php echo $activity->link_text; ?></a>
<br>
<br>
<?php endforeach; ?>
</div>