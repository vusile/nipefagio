<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; min-height: 590px;'>
<h1><?php echo $title; ?></h1>
<p><?php echo $intro; ?></p>
<?php foreach($albums->result() as $album): ?>
<div style = 'width: 200px; float: left; clear: none; text-align: center'>
<a href = 'album/<?php echo $album->id; ?>' ><h2 style = 'font-size: 14px;line-height:normal'><?php echo $album->title; ?></h2></a>
<a href = 'album/<?php echo $album->id; ?>' ><img src = 'gallery_images/<?php echo $album->featured_image; ?>' width = '150px' /></a>
</div>
<?php endforeach; ?>    


</div>