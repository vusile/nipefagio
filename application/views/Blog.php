<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px; '>
<h1><?php echo $title; ?></h1>

<?php

//$response = simplexml_load_file('http://feeds.feedburner.com/TerysGeekyUpdates?format=xml');


// URL location of your feed
$feedUrl = "http://feeds.feedburner.com/TerysGeekyUpdates?format=xml";
$feedContent = "";
 
// Fetch feed from URL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $feedUrl);
curl_setopt($curl, CURLOPT_TIMEOUT, 3);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
 
// FeedBurner requires a proper USER-AGENT...
curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");
 
$feedContent = curl_exec($curl);
curl_close($curl);
 
// Did we get feed content?
if($feedContent && !empty($feedContent)):
	$feedXml = @simplexml_load_string($feedContent);
	if($feedXml):
?>
	
	
	  <?php foreach($feedXml->channel->item as $item): ?>
		
		<a href="<?php echo $item->link; ?>"><h2 class = "summary-h2"><?php echo $item->title; ?></h2></a>
		<?php
		$doc = new DOMDocument();
		@$doc->loadHTML($item->description);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
			if($count > 0)
				break;
			else
				if(!strpos ($tag->getAttribute('src'),'tracker'))
					echo "<a href='" . $item->link . "'><img src = '" . $tag->getAttribute('src') ."' / style = 'width: 150px; height:110px; float: left;'></a>";
			$count++;
			}
		}
     
?>
		
		<p style = 'display: inline;'> <?php echo substr(strip_tags($item->description),0,650); ?>... <a class="readmore" href="<?php echo $item->link; ?>">Read More</a></p>
		<br><Br>
	  <?php endforeach; ?>
	
	<?php endif; ?>
<?php endif; ?>



</div>