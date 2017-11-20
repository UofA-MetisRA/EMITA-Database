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

echo "<h2>Edit Artifact in Database</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

$updateBarcode = "";
$updateBarcodeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (empty($_POST["updateBarcode"])) 
	{
		$updateBarcodeErr = "Artifact ID is required";
    } 
}
?>

<p>From here you can update the details of an artifact that has already been added to the database.

<?php
if(empty($_POST['updateBarcode']))
{
	echo "	<form method='post' action='Edit_UpdateArtifact.php'>
			<p>To begin, please enter the artifact's unique barcode here: 
				<input type='text' name='updateBarcode' pattern='[0-9]{9}' title='Barcode must be 9 digits and use only numerals 0-9' value='$updateBarcode'>" . $updateBarcodeErr;
	echo "		<input type='submit' name='submitBarcode' value='Submit Barcode'>
			</form>";
}
else
{
	echo "	<form method='post'>
				<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>
				Barcode: <b>" . $_POST['updateBarcode'] . "</b>
				<br>
				<br>What type of information would you like to update for this artifact/fauna bag?
				<br>
				<br> - Type (including material) <input type='submit' name='choice' value='Submit' formaction='Edit_UpdateArtifact_Type.php'>
				<br> - Dimensions (length, width, thickness, weight) <input type='submit' name='choice' value='Select' formaction='Edit_UpdateArtifact_Dimensions.php'>
				<br> - Colour (Primary and secondary hue, chroma, and verbal description) <input type='submit' name='choice' value='Select' formaction='Edit_UpdateArtifact_Colour.php'>
				<br> - 3D Unit Provenience (northing, easting, DBD) <input type='submit' name='choice' value='Submit' formaction='Edit_UpdateArtifact_SiteLocation.php'>
				<br> - Lab Location (tray and cabinet number) <input type='submit' name='choice' value='Submit' formaction='Edit_UpdateArtifact_LabLocation.php'>
				<br> - SHA Identification (artifact group and type, maker's marks, origin, etc.) <input type='submit' name='choice' value='Submit' formaction='Edit_UpdateArtifact_SHA.php'>
				<br>
			</form>";
}

echo "<div id='bottom'>";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>