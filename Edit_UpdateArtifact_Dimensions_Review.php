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
	echo "<td>Artifact Length: <b>" . $_POST['formLength'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Artifact Width: <b>" . $_POST['formWidth'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Artifact Thickness: <b>" . $_POST['formThickness'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Artifact Weight: <b>" . $_POST['formWeight'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>";
	echo "<form action='Edit_UpdateArtifact_Dimensions_Review.php' method='post'>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $_POST['updateCatalog'] . "'>";
	echo "<input type='hidden' name='formLength' value='" . $_POST['formLength'] . "'>";
	echo "<input type='hidden' name='formWidth' value='" . $_POST['formWidth'] . "'>";
	echo "<input type='hidden' name='formThickness' value='" . $_POST['formThickness'] . "'>";
	echo "<input type='hidden' name='formWeight' value='" . $_POST['formWeight'] . "'>";
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
	$length	= $_POST['formLength'];
	$width = $_POST['formWidth'];
	$thickness = $_POST['formThickness'];
	$weight = $_POST['formWeight'];
	
	$sql = "SELECT artifact_id
			FROM artifact_dimensions
			WHERE artifact_id='" . $_POST['updateBarcode'] . "'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0)
	{
		$sql2 = "UPDATE artifact_dimensions
					SET artifact_length='" . $length . "',
						artifact_width='" . $width . "',
						artifact_thickness='" . $thickness . "',
						artifact_weight='" . $weight . "'
					WHERE artifact_id='" . $barcode . "'";
		$result2 = $mysqli->query($sql2);
	}
	else
	{
		$sql3 = "INSERT INTO artifact_dimensions (artifact_id, artifact_length, artifact_width, artifact_thickness, artifact_weight)
				VALUES ('" . $barcode . "', '" . $length . "', '" . $width . "', '" . $thickness . "', '" . $weight . "')";
		$result3 = $mysqli->query($sql3);
	}
	
	echo "<table>
			<tr>
			<td><b>" . $catalog . "</b>'s dimensions has been edited in the database.
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