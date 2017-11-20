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

	echo "<p>This page allows you to update the artifact's dimensions.";
	echo "<br>Note: Fields can be left blank, unless otherwise specified. ";
	echo "<br>If a dropdown does not contain the right information, please contact a database administrator to have that information updated.";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_Dimensions_Review.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<td><b>Note 1</b>: For the purposes of this database, length is considered the longest axis of the artifact, width the axis perpendicular to length, and thickness the value perpendicular to the plane created by the length/width axis. See, for example, <a href='img/dimensions.png' target='_blank'>this image</a>.";
	echo "<br><b>Note 2</b>: Mouseover the fields for format examples. Leading zeroes can be ignored, but if the value is smaller than one you will need to include a single leading zero for it to be accepted.";
	echo "</td>";
	echo "</tr><tr>";
	echo "</tr><tr>";
	echo "<td>Step 1: Please enter the artifact's length: ";
	echo "<input type='text' name='formLength' pattern='[0-9]{1,4}.[0-9]{1}' title='Value, in mm, formatted thusly: ####.#'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 2: Please enter the artifact's width: ";
	echo "<input type='text' name='formWidth' pattern='[0-9]{1,4}.[0-9]{1}' title='Value, in mm, formatted thusly: ####.#'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 3: Please enter the artifact's thickness: ";
	echo "<input type='text' name='formThickness' pattern='[0-9]{1,4}.[0-9]{1}' title='Value, in mm, formatted thusly: ####.#'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 4: Please enter the artifact's weight: ";
	echo "<input type='text' name='formWeight' pattern='[0-9]{1,5}.[0-9]{1,3}' title='Value, in grams, formatted thusly: #####.###'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $catalog . "'>";
	echo "<input type='submit' name='submitDimensions' value='Review Submission' />";
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