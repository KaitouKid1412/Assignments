<?php

include 'connect.inc.php';

$query = "SELECT * FROM sale_items WHERE id='21' ";
if($query_run = mysql_query($query))
{
   	$image = mysql_result($query_run, 0, 'image_name');
}
else
{
	die(mysql_error());

header('Content-type: image/jpeg');

$image = 'Uploads/'.$image.'.JPG';

$image_size = getimagesize($image);
$image_width = $image_size[0];
$image_height = $image_size[1];

$new_size = ($image_width + $image_height)/($image_width*($image_height/100));
$new_width = $new_size * $image_width;
$new_height = $new_size * $image_height;

$new_image = imagecreatetruecolor($new_width, $new_height);
$old_image = imagecreatefromjpeg($image);

imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
echo imagejpeg($new_image);
 
}

?>