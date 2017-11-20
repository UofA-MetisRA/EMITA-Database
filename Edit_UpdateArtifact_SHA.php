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

	echo "<p>This page allows you to update the artifact's Society for Historical Archaeology (SHA) descriptions.";
	echo "<br><b>Note 1</b>: To record these descriptions accurately, please refer to these resources: <a href='/documents/SHARD_group.pdf' target='_blank'>SHARD by Group</a>, <a href='/documents/SHARD_description.pdf' target='_blank'>SHARD by Description</a>.";
	echo "<br><b>Note 2</b>: Personally, I find the SHARD by Description resource less confusing; search the left column by what you're entering, then work from the right column to the left (Group -> Category -> Type) - Aaron";
	echo "<br><b>Note 3</b>: Fields can be left blank, unless otherwise specified. ";
	echo "<br><b>Note 4</b>: If a dropdown does not contain the right information, please contact a database administrator to have that information updated.";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_SHA_Review.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<br><b>Additional Note</b>: Mouseover the fields for format examples.";
	echo "</td>";
	echo "</tr><tr>";
	echo "</tr><tr>";
	echo "<td>Step 1: Please enter the SHA Artifact Group: ";
	echo "<input type='text' name='formSHA_artifactgroup' title='Ex. Domestic, Structural, Indefinite Use, etc.'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 2: Please enter the SHA Artifact Category: ";
	echo "<input type='text' name='formSHA_artifactcategory' title='Ex. Hardware, Cleaning, Misc. Containers'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 3: Please enter the SHA Artifact Type: ";
	echo "<input type='text' name='formSHA_artifacttype' title='Fastener, Toiletry, Ammunition, etc.'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 4: Please enter the SHA Artifact Description: ";
	echo "<input type='text' name='formSHA_artifactdescr' title='Ex. Bottle, Eyeglasses, Ornamental Basket, etc. (ie. what the object actually is)'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 5: Please enter any additional personal descriptive notes: ";
	echo "<input type='text' name='formSHA_personaldescr' title='Anything you want to add'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 6: Please enter the artifact's Condition: ";
	echo "<select name='formSHA_condition'>";
	echo 	"<option value=''> </option>";
	echo	"<option value='Complete'>Complete</option>";
	echo	"<option value='Fragment'>Fragment</option>";
	echo	"<option value='Reconstructible'>Reconstructible</option>";
	echo	"</select>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 7: Please enter the SHA Mark. See <a href='/img/SHARD_mark.png' target='_blank'>here</a> for an example: ";
	echo "<input type='text' name='formSHA_mark' title='Seriously, see the linked image.'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 8: Please enter the SHA Maker. See <a href='/img/SHARD_maker.png' target='_blank'>here</a> for an example: ";
	echo "<input type='text' name='formSHA_maker' title='Not as bad as figuring out the Mark, but still, see the linked image.'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 9: Please enter the origin of the artifact: ";
	echo "<input type='text' name='formSHA_origin' title='Ex. Pittsburgh, PA, or Burslem, Staffordshire'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Step 10: Please enter whether the artifact is marked or datable, and if known enter a date or range: ";
	echo "<input type='text' name='formSHA_datable' title='Ex. No, Yes, 1840-1870, etc.'>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $catalog . "'>";
	echo "<input type='submit' name='submitSHA' value='Review Submission' />";
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