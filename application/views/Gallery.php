<link type="text/css" rel="stylesheet" href="css/tn3.css"></link>
<script type="text/javascript" src="js/jquery.tn3lite.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		//Thumbnailer.config.shaderOpacity = 1;
		var tn1 = $('.mygallery').tn3({
skinDir:"skins",
imageClick:"fullscreen",
image:{
maxZoom:1.5,
crop:true,
clickEvent:"dblclick",
transitions:[{
type:"blinds"
},{
type:"grid"
},{
type:"grid",
duration:460,
easing:"easeInQuad",
gridX:1,
gridY:8,
// flat, diagonal, circle, random
sort:"random",
sortReverse:false,
diagonalStart:"bl",
// fade, scale
method:"scale",
partDuration:360,
partEasing:"easeOutSine",
partDirection:"left"
}]
}
		});
	});
</script>

<div id="container" class = "" style = 'width: 900px; margin: 10px auto;  background: #FFF; padding: 10px; min-height: 590px;'>
<h1><?php echo $title; ?></h1>
<p><?php echo $description; ?></p>

<div id="container" style = 'width: 600px; margin: 10px auto;'>
    <div class="mygallery" style = 'margin: 10px auto;'>
	<div class="tn3 album">
	    <!--<h4>Fixed Dimensions</h4>
	    <div class="tn3 description">Images with fixed dimensions</div>
	    <div class="tn3 thumb">images/35x35/1.jpg</div>-->
	    <ol>
		<?php foreach($images->result() as $image): ?>
		<li>
		    <h4><?php echo $image->title; ?></h4>
		    <!--<div class="tn3 description">Salzburg, Austria</div>-->
		    <a href="gallery_images/<?php echo $image->image ?>">
			<img src="gallery_images/<?php echo 'thumb__' . $image->image; ?>" />
		    </a>
		</li>
		<?php endforeach; ?>
		<!--<li>
		    <h4>Isolated sandy cove</h4>
		    <div class="tn3 description">Zakynthos island, Greece</div>
		    <a href="images/620x378/2.jpg">
			<img src="images/35x35/2.jpg" />
		    </a>
		</li>
		<li>
		    <h4>A view from the Old Town</h4>
		    <div class="tn3 description">Herceg Novi, Montenegro</div>
		    <a href="images/620x378/3.jpg">
			<img src="images/35x35/3.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Walls of the Old Town</h4>
		    <div class="tn3 description">Kotor, Montenegro</div>
		    <a href="images/620x378/4.jpg">
			<img src="images/35x35/4.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Boat in the port</h4>
		    <div class="tn3 description">Sousse, Tunis</div>
		    <a href="images/620x378/5.jpg">
			<img src="images/35x35/5.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Wall of the Jain temple</h4>
		    <div class="tn3 description">Jaisalmer, India</div>
		    <a href="images/620x378/6.jpg">
			<img src="images/35x35/6.jpg" />
		    </a>
		</li>
		<li>
		    <h4>City park</h4>
		    <div class="tn3 description">Negotin, Serbia</div>
		    <a href="images/620x378/7.jpg">
			<img src="images/35x35/7.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Taj Mahal mausoleum</h4>
		    <div class="tn3 description">Agra, India</div>
		    <a href="images/620x378/8.jpg">
			<img src="images/35x35/8.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Zante Port</h4>
		    <div class="tn3 description">Zakynthos, Greece</div>
		    <a href="images/620x378/9.jpg">
			<img src="images/35x35/9.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Rustovo Monastery</h4>
		    <div class="tn3 description">Budva, Montenegro</div>
		    <a href="images/620x378/10.jpg">
			<img src="images/35x35/10.jpg" />
		    </a>
		</li>
		<li>
		    <h4>The Mezquita, Cathedral and former Great Mosque</h4>
		    <div class="tn3 description">Cordoba, Spain</div>
		    <a href="images/620x378/11.jpg">
			<img src="images/35x35/11.jpg" />
		    </a>
		</li>
		<li>
		    <h4>Wine Cellars</h4>
		    <div class="tn3 description">Rajac, Serbia</div>
		    <a href="images/620x378/12.jpg">
			<img src="images/35x35/12.jpg" />
		    </a>
		</li>-->
	    </ol>
	</div>
    </div>
    </div>

</div>