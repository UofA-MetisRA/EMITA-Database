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

if(empty($_POST['submitFinal']))
{
	echo "
	<table>
	<tr>
	<p>Please review the artifact's information below:</p>
	<p>Note: Information will be passed to the database <b>exactly</b> as it appears.
	</tr>
	<tr>";
	echo "<td>Barcode: <b>" . $_POST['updateBarcode'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Catalog Number: <b>" . $_POST['updateCatalog'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Artifact Type: <b>" . $_POST['formMaterial'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Material Notes: <b>" . $_POST['formMaterialNotes'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>";
	echo "<form action='Edit_UpdateArtifact_Type_Review.php' method='post'>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $_POST['updateCatalog'] . "'>";
	echo "<input type='hidden' name='formMaterial' value='" . $_POST['formMaterial'] . "'>";
	echo "<input type='hidden' name='formMaterialNotes' value='" . $_POST['formMaterialNotes'] . "'>";
	echo "<input type='submit' name='submitFinal' value='Confirm Submit' />";
	echo "</form>
	</td>
	</tr>
	</table>";
}
elseif(!empty($_POST['submitFinal']))
{
	$barcode = $_POST['updateBarcode'];
	$catalog = $_POST['updateCatalog'];
	$material = $_POST['formMaterial'];
	$material_notes = $_POST['formMaterialNotes'];
	
	$sql = "SELECT artifact_id
			FROM artifact_type
			WHERE artifact_id='" . $_POST['updateBarcode'] . "'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0)
	{
		$sql2 = "UPDATE artifact_type
					SET material='" . $material . "',
						material_notes='" . $material_notes . "'
					WHERE artifact_id='" . $barcode . "'";
		$result2 = $mysqli->query($sql2);
	}
	else
	{
		$sql3 = "INSERT INTO artifact_type (artifact_id, material, material_notes)
				VALUES ('" . $barcode . "', '" . $material . "', '" . $material_notes . "')";
		$result2 = $mysqli->query($sql3);
	}
	
	echo "<table>
				<tr>
				<td><b>" . $catalog . "</b>'s artifact type has been edited in the database.
				</td>
				</tr>
				</table>";
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