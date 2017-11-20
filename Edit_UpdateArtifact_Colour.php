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

	echo "<p>This page allows you to update the artifact's colour descriptions.";
	echo "<br>Note: Fields can be left blank, unless otherwise specified. ";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_Colour_Review.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<td><b>Note 1</b>: Please use the Munsell Color System when updating these fields.";
	echo "<br><b>Note 2</b>: Mouseover the fields for format examples.";
	echo "</td>";
	echo "</tr><tr>";
	echo "</tr><tr>";
	echo "<td>Step 1: Please enter the artifact's Primary Colour (Hue): ";
	echo "<input type='text' name='formPC_Hue' pattern='[0-9.]{1,4}[BGNPRY]{1,2}' title='Ex. 5R, 10G, 8.75Y'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 2: Please enter the artifact's Primary Colour (Value/Chroma): ";
	echo "<input type='text' name='formPC_VC' pattern='[2-9.]{1,3}[/]{1}[12468]{1,2}' title='Ex. 5/2, 8.5/6, 3/12'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 3: Please enter the artifact's Primary Colour (Description): ";
	echo "<input type='text' name='formPC_Descr' pattern='[a-zA-Z\s]+' title='Very Dark Gray, Dark Brown, Yellowish Red'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 4: Please enter the artifact's Secondary Colour (Hue): ";
	echo "<input type='text' name='formSC_Hue' pattern='[0-9.]{1,4}[BGNPRY]{1,2}' title='Ex. 5R, 10G, 8.75Y'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 5: Please enter the artifact's Secondary Colour (Value/Chroma): ";
	echo "<input type='text' name='formSC_VC' pattern='[2-9.]{1,3}[/]{1}[12468]{1,2}' title='Ex. 5/2, 8.5/6, 3/12'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 6: Please enter the artifact's Secondary Colour (Description): ";
	echo "<input type='text' name='formSC_Descr' pattern='[a-zA-Z\s]+' title='Very Dark Gray, Dark Brown, Yellowish Red'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $catalog . "'>";
	echo "<input type='submit' name='submitColour' value='Review Submission' />";
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