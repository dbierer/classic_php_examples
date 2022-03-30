<?php
class blogFeed {
	// Initialize Variables
	public $title;			// Title
	public $thumbnail;		// Thumbnail image
	public $rss;			// SimpleXML feed object
	// Constructor
	function __construct ($title, $image, $rss_url) {
		$feed = file_get_contents($rss_url);
		$this->title = $title;
		$this->thumbnail = $image;
		$this->rss = new SimpleXmlElement($feed);
	}
	// Show Info
	function showFeed () {
		echo '<div style="float: left; width=100px;">' . "\n";
		echo '<h3>' . $this->title . '</h3>' . "\n";
		echo '<img src="' . $this->thumbnail . '" width=100>' . "\n";
		$entry = $this->rss->channel->item[0];
		echo '<br><a href="' . $entry->link . '" title="' . $entry->title . '">' . $entry->title . "</a>\n";
		echo '</div>' . "\n";
	}
}

// Instantiate objects
$blog[] = new blogFeed(	"Top Stories",
						"http://news.bbcimg.co.uk/media/images/48353000/jpg/_48353242_48353243.jpg",
						"http://feeds.bbci.co.uk/news/rss.xml"
						);
$blog[] = new blogFeed(	"Latest published stories",
						"http://news.bbcimg.co.uk/view/1_4_4/cream/hi/news/img/red-masthead.png",
						"http://feeds.bbci.co.uk/news/system/latest_published_content/rss.xml"
						);
$blog[] = new blogFeed(	"Also in the news",
						"",
						"http://feeds.bbci.co.uk/news/also_in_the_news/rss.xml"
						);
$blog[] = new blogFeed(	"In Pictures",
						"http://newsimg.bbc.co.uk/nol/shared/img/v4/banner.jpg",
						"http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/in_pictures/rss.xml"
							);

// Display HTML
foreach ($blog as $item) {
	$item->showFeed();
}
?>
