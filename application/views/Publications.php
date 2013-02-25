<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; min-height: 590px;'>
<h1><?php echo $title; ?></h1>

<br>
<?php foreach ($publications->result() as $publication): ?>
<h2 class = "summary-h2"><?php echo $publication->title; ?></h2>

<?php echo strip_tags($publication->description,'<br><br/><br />'); ?>
<br>
<a href = "publications/<?php echo $publication->publication_file ?>">Download Publication</a>
<br>
<br>
<?php endforeach; ?>
</div>