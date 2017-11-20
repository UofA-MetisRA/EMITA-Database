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

echo "<h2>Add Artifact to Feature</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

if(empty($_POST['submitFinal']))
{
	
	echo "<br>
			<br>Adding artifact to the following provenience:
			<br> &emsp; &emsp; <b>Site Name: </b>" . $_POST['formSiteName'] . "
			<br> &emsp; &emsp; <b>Unit: </b>" . $_POST['formUnitName'] . "
			<br> &emsp; &emsp; <b>Level: </b>" . $_POST['formLevelName'] . "
			<br> &emsp; &emsp; <b>Quad: </b>" . $_POST['formQuadName'] . "
			<br> &emsp; &emsp; <b>Feature: </b>" . $_POST['formFeatureName'] . "";
	
echo "<form action='Edit_AddArtifact_Feature_Review.php' method='post'>
	<table>
		<tr>
			<p>Step 1: Create a barcode for the artifact: 
				<a href='https://www.random.org/integers/?num=1&min=100000000&max=999999999&col=1&base=10&format=html&rnd=new' target='_blank'>Random.org Barcode Generator</a>
			<p>Step 2: Copy that barcode into this field:
				<input type='text' name='formBarcode' pattern='[0-9]{9}' title='Barcode must be 9 digits and use only numerals 0-9' autocomplete='off'>
			<p>Step 3: How many artifacts are in this bag?
				<input type='number' name='formCount' title='Must be an integer between 1 and 999' min='1' max='999'>
			<p>Step 4: Enter a catalog number for this artifact:
				<input type='text' name='formCatalog' title='Catalog numbers typically contain the Borden Number followed by a unique numeric identifier or range (ie. FdPe1:0097-0103), and should be equal in length to the number of artifacts entered above' autocomplete='off'>
			<br>Note: The <u>next available</u> catalog number for" . $_POST['formSiteName'] . "is: ";
				
					$sql = "SELECT MAX(Catalog_Number)
							AS HighestCatalog
							FROM v_FullArtifactDetails 
							WHERE Site_Name='" . $_POST['formSiteName'] . "'";
					$result = $mysqli->query($sql);
					
					while ($row = $result ->fetch_assoc())
					{
						echo "<b>" . ++$row['HighestCatalog'] . "</b><br>";
					}
				
		echo "		
				<p>
				<p>
				<p>
				<p>
				<p>
				<p><b>Don't forget</b> to print out a copy of the barcode and catalog number for the artifact bag!
				<p> 
	
				<input type='hidden' name='formSiteID' value='" . $_POST['formSiteID'] . "'>
				<input type='hidden' name='formUnitID' value='" . $_POST['formUnitID'] . "'>
				<input type='hidden' name='formLevelID' value='" . $_POST['formLevelID'] . "'>
				<input type='hidden' name='formQuadID' value='" . $_POST['formQuadID'] . "'>
				<input type='hidden' name='formFeatureID' value='" . $_POST['formFeatureID'] . "'>
				<input type='submit' name='submitFinal' value='Review Submission' />
			</form>
		</td>
	</tr>
</table>";
}
elseif(!empty($_POST['submitFinal']))
{
	
	echo "" . $_POST['formBarcode'] . 
		"<br>" . $_POST['formCatalog'] . 
		"<br>" . $_POST['formCount'] . 
		"<br>" . $_POST['formFeatureID'] . 
		"<br>" . $_POST['formSiteID'] . 
		"<br>" . $_POST['formUnitID'] . 
		"<br>" . $_POST['formQuadID'] . 
		"<br>" . $_POST['formLevelID'] . "";

	$sql = "INSERT INTO artifact (artifact_id, catalog_num, artifact_count)
			VALUES ('" . $_POST['formBarcode'] . "', '" . $_POST['formCatalog'] . "', '" . $_POST['formCount'] . "')";
	$result = $mysqli->query($sql);
	
	$sql2 = "INSERT INTO artifact_has_feature (artifact_artifact_id, feature_feature_id, site_site_id, unit_unit_id, quad_quad_id, level_level_id)
			VALUES ('" . $_POST['formBarcode'] . "', '" . $_POST['formFeatureID'] . "', '" . $_POST['formSiteID'] . "', '" . $_POST['formUnitID'] . "', '" . $_POST['formQuadID'] . "', '" . $_POST['formLevelID'] . "')";
	$result2 = $mysqli->query($sql2);
		
	echo "<table>
			<tr>
				<td>Artifact " . $_POST['formBarcode'] . " has been inserted into the database.</td>
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