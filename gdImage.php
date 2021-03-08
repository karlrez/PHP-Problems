<?php
/* Problem 1: GD Image Primative
 *
 * Couldn't figure out how to do this on online fiddle. 
 * Running this on Apache server on Ubuntu 20.04.2 LTS
 *
 * Steps:
 * 1) Install Apache: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04
 * 2) Install PHP sudo apt install php libapache2-mod-php
 * 3) Enable GD: sudo apt-get install php7.4-gd
 */


$x = 480;
$y = 320;
$image = imagecreate($x,$y);
$white = imagecolorallocate($image, 252, 248, 3);

imagejpeg($image);
header('Content-Type: image/jpeg');
?>

