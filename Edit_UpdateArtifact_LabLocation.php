<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'>";
include 'banner.php';
echo "</div>";
include 'title.php';
echo "
<div id='left-nav'>";
include("left-nav.php");
echo "
</div>

<div id='main'>";

$updateBarcode = $_POST['updateBarcode'];

$sql = "SELECT catalog_num 
		FROM artifact 
		WHERE artifact_id='" . $updateBarcode . "'";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc())
{
	$catalog = $row['catalog_num'];
}

	echo "<p>This page allows you to update the artifact's location within the UofA lab space.";
	echo "<br>Note: Fields can be left blank, unless otherwise specified. ";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_LabLocation_Review.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "</td>";
	echo "</tr><tr>";
	echo "</tr><tr>";
	echo "<td>Step Only: Please enter the artifact's tray number: ";
	echo "<input type='text' name='formTray' pattern='[0-9]{6}' title='The six-digit tray number (ie. 106013)'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $catalog . "'>";
	echo "<input type='submit' name='submitLabLoc' value='Review Submission' />";
	echo "</td>";
	echo "</tr>";
	echo "</form>";
	echo "</table>";

echo "

<div id='bottom'>";
include 'footer.php';
echo "
</div>
</div>
</body>
</html>";

?>