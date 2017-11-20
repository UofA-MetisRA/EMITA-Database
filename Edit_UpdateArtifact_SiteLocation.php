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

	echo "<p>This page allows you to update the artifact's 3D site provenience.";
	echo "<br>Note: Fields can be left blank, unless otherwise specified. ";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_SiteLocation_Review.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<td><b>Note 1</b>: For the purposes of this database, we're assuming the SW corner of the unit was used as the datum, as at FdPe-1.";
	echo "<br><b>Note 2</b>: Please enter the coordinate in cm to one decimal place. Leading zeroes can be ignored, unless the total value is a decimal, in which case you will need to enter a single leading zero for the value to be accepted. If the value is an integer, please include a trailing zero (ex. 21.0).";
	echo "<br><br>";
	echo "</td>";
	echo "</tr><tr>";
	echo "</tr><tr>";
	echo "<td>Step 1: Please enter the artifact's northing location: ";
	echo "<input type='text' name='formNorthing' pattern='[0-9]{1,3}.[0-9]{1}' title='Value, in cm, formatted thusly: ###.#'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 2: Please enter the artifact's easting location: ";
	echo "<input type='text' name='formEasting' pattern='[0-9]{1,3}.[0-9]{1}' title='Value, in cm, formatted thusly: ###.#'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 3: Please enter the artifact's depth below datum (DBD): ";
	echo "<input type='text' name='formElevation' pattern='[0-9]{1,3}.[0-9]{1}' title='Value, in cm, formatted thusly: ###.#'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $catalog . "'>";
	echo "<input type='submit' name='submitProvenience' value='Review Submission' />";
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