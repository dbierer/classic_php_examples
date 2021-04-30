<?php
// Initialize variables
$full_image = "http://www.unlikelysource.com/assets/images/unlikely_home_2.jpg";
$img_subdir = "/images/";
$img_dir = dirname(__FILE__) . $img_subdir;
$new_img_url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . $img_subdir;
$new_lw_limit = 10000;
$new_width = 0;
$new_height = 0;
$error = "";
$output = ""; 
// Read image from website
$img = "";
if ( $img = file_get_contents($full_image)) { 
	// Break URL up into an array
	$a = explode("/",$full_image);
	// Take filename off end of array
	$fn = array_pop($a);
	// Full path to write file
	$write_fn = $img_dir . $fn;
	if ( file_put_contents($write_fn,$img)) {
		// Newly written full image URL
		$full_image = $new_img_url . $fn;
		$output .= "<br><b style='color:green;'>SUCCESS:</b> wrote file $full_image \n";
		// Get L and W
		list($width, $height) = getimagesize($write_fn);
		// Calculate new L and W
		$new_width = $width;
		$new_height = $height;
		while($new_width * $new_height > $new_lw_limit) {
			$new_width *= .9;
			$new_height *= .9;
			$new_width = (int) $new_width;
			$new_height = (int) $new_height;
		}
		// Resample
		$image_p = imagecreatetruecolor($new_width, $new_height);
		$thumb_img = imagecreatefromjpeg($write_fn);
		imagecopyresampled($image_p, $thumb_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		// Full path to thumbnail
		$write_fn = $img_dir . "thumb_" . $fn;
		// If successful, this function will write out the resized image; 100 = 100% surface
		if ( imagejpeg($image_p, $write_fn, 100)) {
			// Newly written thumbnail URL
			$thumb_image = $new_img_url . "thumb_" . $fn;
			$output .= 	"<br><b style='color:green;'>SUCCESS:</b> wrote file $thumb_image <br>\n";
			$output .= 	"<a href='" . $full_image . "' title='Click to expand'>"; 
			$output .= 	"<img src='" . $thumb_image . "' />";
			$output .= 	"</a></p>\n";
		} else {
			$error .= "<br><b style='color:red;'>ERROR: </b> unable to write thumbnail $write_fn \n";
		}
	} else {
		$error .= "<br><b style='color:red;'>ERROR: </b> unable to write image $write_fn \n";
	}
} else {
	$error .= "<br><b style='color:red;'>ERROR: </b> unable to open image for read\n";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
Click to expand the thumbnail!
<br />
<?php 
echo @$output;
echo @$error;
?>
</body>
</html>
