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
	echo "<td>Tray Number: <b>" . $_POST['formTray'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>";
	echo "<form action='Edit_UpdateArtifact_LabLocation_Review.php' method='post'>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $_POST['updateCatalog'] . "'>";
	echo "<input type='hidden' name='formTray' value='" . $_POST['formTray'] . "'>";
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
	$tray = $_POST['formTray'];
		
	$sql = "SELECT artifact_artifact_id
			FROM artifact_has_phys_loc
			WHERE artifact_artifact_id='" . $_POST['updateBarcode'] . "'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0)
	{
		$sql2 = "UPDATE artifact_has_phys_loc
					SET phys_loc_tray_id='" . $tray . "'
					WHERE artifact_artifact_id='" . $barcode . "'";
		$result2 = $mysqli->query($sql2);
	}
	else
	{
		$sql3 = "INSERT INTO artifact_has_phys_loc (artifact_artifact_id, phys_loc_tray_id)
				VALUES ('" . $barcode . "', '" . $tray . "')";
		$result3 = $mysqli->query($sql3);
	}
	
	$sql4 = "SELECT tray_name
				FROM phys_loc
				WHERE tray_id='" . $tray . "'";
	$result4 = $mysqli->query($sql4);
	while ($row = $result4->fetch_assoc())
	{
		$trayname = $row['tray_name'];
	}
	
	echo "<table>
			<tr>
			<td><b>" . $catalog . "</b> has been added to the tray <b>" . $trayname . "</b>
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