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

echo "<h2>Add Artifact to Database</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

?>

<table>
	<tr>
		<p>Was the artifact from a <b>Feature?</b></p>
	</tr>
	<tr>
		<form method="post">
			<br>Yes <input type="submit" name="feature" value="Submit" formaction="Edit_AddArtifact_Feature.php">
			<br>No <input type="submit" name="site" value="Submit" formaction="Edit_AddArtifact_Site.php">
		</form>
		</td>
	</tr>
</table>

<?php


echo "<div id='bottom'>";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>