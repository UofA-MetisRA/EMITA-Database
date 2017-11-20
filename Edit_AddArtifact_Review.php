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

echo "<h2>Add Artifact to Database</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

if(empty($_POST['submitFinal']))
{
echo "<table>
		<tr>
			<p>Please review the artifact's information below:</p>
		</tr>
		<tr>
			<td> Site: <b>" . $_POST['formBorden'] . "</b></td>
		</tr>
		<tr>
			<td>Unit: <b>" . $_POST['formUnit'] . "</b></td>
		</tr>
		<tr>
			<td>Layer: <b>" . $_POST['formLayer'] . "</b></td>
		</tr>
		<tr>
			<td>Level: <b>" . $_POST['formLevel'] . "</b></td>
		</tr>
		<tr>
			<td>Quad: <b>" . $_POST['formQuad'] . "</b></td>
		</tr>
		<tr>
			<td>Catalog Number: <b>" . $_POST['formCatalog'] . "</b></td>
		</tr>
		<tr>
			<td>Barcode: <b>" . $_POST['formBarcode'] . "</b></td>
		</tr>
		<tr>
			<td>Artifact Count: <b>" . $_POST['formCount'] . "</b></td>	
		</tr>
		<tr>
			<td>
			<form action='Edit_AddArtifact_Review.php' method='post'>
			<input type='hidden' name='formBorden' value='" . $_POST['formBorden'] . "'>
			<input type='hidden' name='formUnit' value='" . $_POST['formUnit'] . "'>
			<input type='hidden' name='formLayer' value='" . $_POST['formLayer'] . "'>
			<input type='hidden' name='formLevel' value='" . $_POST['formLevel'] . "'>
			<input type='hidden' name='formQuad' value='" . $_POST['formQuad'] . "'>
			<input type='hidden' name='formCatalog' value='" . $_POST['formCatalog'] . "'>
			<input type='hidden' name='formBarcode' value='" . $_POST['formBarcode'] . "'>
			<input type='hidden' name='formCount' value='" . $_POST['formCount'] . "'>
			<input type='submit' name='submitFinal' value='Confirm Submit' />
			</form>
			</td>
		</tr>
	</table>";
}
elseif(!empty($_POST['submitFinal']))
{
	$sql = "SELECT Site_ID, Unit_ID
			FROM v_SiteHasUnit
			WHERE Borden_Num='" . $_POST['formBorden'] . "'
			AND Unit_Name='" . $_POST['formUnit'] . "'";
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc())
	{
		$site_id = $row['Site_ID'];
		$unit_id = $row['Unit_ID'];
	}
	
	$sql = "SELECT Layer_ID
			FROM v_SiteHasLayer
			WHERE Borden_Num='" . $_POST['formBorden'] . "'
			AND Layer_Name='" . $_POST['formLayer'] . "'";
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc())
	{
		$layer_id = $row['Layer_ID'];
	}
	
	$sql = "SELECT Level_ID
			FROM v_UnitLayerHasLevel
			WHERE Unit_Name='" . $_POST['formUnit'] . "'
			AND Layer_Name='" . $_POST['formLayer'] . "'
			AND Level_Name='" . $_POST['formLevel'] . "'";
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc())
	{
		$level_id = $row['Level_ID'];
	}
	
	$sql = "SELECT Quad_ID
			FROM v_UnitHasQuad
			WHERE Unit_Name='" . $_POST['formUnit'] . "'
			AND Quad_Name='" . $_POST['formQuad'] . "'";
	$result = $mysqli->query($sql);
	while ($row = $result->fetch_assoc())
	{
		$quad_id = $row['Quad_ID'];
	}
	
	$barcode = $_POST['formBarcode'];
	$catalog = $_POST['formCatalog'];
	$count = $_POST['formCount'];
	
	$sql = "INSERT INTO artifact (artifact_id, catalog_num, artifact_count)
			VALUES ('" . $barcode . "', '" . $catalog . "', '" . $count . "')";
	$result = $mysqli->query($sql);
	
	$sql = "INSERT INTO artifact_has_site (artifact_artifact_id, site_site_id)
			VALUES ('" . $barcode . "', '" . $site_id . "')";
	$result = $mysqli->query($sql);
	
	$sql = "INSERT INTO artifact_has_unit (artifact_artifact_id, unit_unit_id)
			VALUES ('" . $barcode . "', '" . $unit_id . "')";
	$result = $mysqli->query($sql);
	
	$sql = "INSERT INTO artifact_has_layer (artifact_artifact_id, layer_layer_id)
			VALUES ('" . $barcode . "', '" . $layer_id . "')";
	$result = $mysqli->query($sql);
	
	$sql = "INSERT INTO artifact_has_level (artifact_artifact_id, level_level_id)
			VALUES ('" . $barcode . "', '" . $level_id . "')";
	$result = $mysqli->query($sql);
	
	$sql = "INSERT INTO artifact_has_quad (artifact_artifact_id, quad_quad_id)
			VALUES ('" . $barcode . "', '" . $quad_id . "')";
	$result = $mysqli->query($sql);
	
	echo "<table>
			<tr>
				<td>Artifact " . $catalog . " has been inserted into the database.</td>
			</tr>
		</table>";
}	

echo "<div id='bottom'>";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>