<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
	if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

echo "<body>
	<div id='wrapper'>
	<div id='top'>";
		include 'banner.php';
echo "</div>";
	include 'title.php';

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

echo "<table>";
	echo "<tr>";
		echo "<td>";
			echo "<p>Welcome to the Métis Archaeology Project Database! Here you will be able to search information on the various artifacts and excavations that we have undertaken since beginning this project in the summer of 2014.";
			echo "<p>Some features of this database require authentication, so please create an account and log-in to access these areas.";

echo "<div id='bottom' >";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>
