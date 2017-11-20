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

if(empty($_POST['formMaterial']))
{
	echo "<p>This page allows you to update the artifact's type.";
	echo "<br>Note: Fields can be left blank, unless otherwise specified. ";
	echo "<br>If a dropdown does not contain the right information, please contact a database administrator to have that information updated.";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_Type.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<td>Step 1: Please enter the artifact's material: ";
	echo "<select name='formMaterial'>";
	echo 	"<option value=''> </option>";
			$sql2 = "SELECT DISTINCT Material
					FROM v_FullArtifactDetails
					ORDER BY Material ASC";
			$result2 = $mysqli->query($sql2);
			while ($row = $result2->fetch_assoc())
			{
				echo "<option value='" . $row['Material'] . "'>" . $row['Material'] . "</option>";
			}
	echo 	"</select>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='submit' name='submitMaterial' value='Select Material' />";
	echo "</form>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
}
elseif(isset($_POST['formMaterial']))
{
	echo "<p>This page allows you to update the artifact's type.";
	echo "<br>Note: Fields can be left blank, unless otherwise specified. ";
	echo "<br>If a dropdown does not contain the right information, please contact a database administrator to have that information updated.";
	echo "<p>You're currently editing the data for artifact bag #<b>" . $updateBarcode . "</b>, <b>" . $catalog . "</b>";
	
	echo "<form action='Edit_UpdateArtifact_Type_Review.php' method='post'>";
	echo "<table>";
	echo "<tr>";
	echo "<td>Step 1: Please enter the artifact's material: ";
	echo "<select name='formMaterial'>";
	echo 	"<option value='" . $_POST['formMaterial'] . "'>" . $_POST['formMaterial'] . "</option>";
	echo "</td></tr>";
	echo "<tr>";
	echo "<td>Step 2: Please enter any notes on the material, such as a sub-type: ";
	echo "<select name='formMaterialNotes'>";
	echo 	"<option value=''> </option>";
			$sql3 = "SELECT DISTINCT Material_Notes
					FROM v_FullArtifactDetails
					WHERE Material='" . $_POST['formMaterial'] . "'
					ORDER BY Material_Notes ASC";
			$result3 = $mysqli->query($sql3);
			if($result3->num_rows > 1)
			{
				while ($row = $result3->fetch_assoc())
				{
					echo "<option value='" . $row['Material_Notes'] . "'>" . $row['Material_Notes'] . "</option>";
				}
			}
			else
			{
				echo "<option value=''>N/A</option>";
			}
	echo 	"</select>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $catalog . "'>";
	echo "<input type='hidden' name='formMaterial' value='" . $_POST['formMaterial'] . "'>";
	echo "<input type='submit' name='submitMaterialNotes' value='Review Submission' />";
	echo "<p><p>";
	echo "</form>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
}
echo "

<div id='bottom'>";
include 'footer.php';
echo "
</div>
</div>
</body>
</html>";

?>