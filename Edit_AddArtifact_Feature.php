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

if(isset($_POST['feature']))
{
	echo "<table>
		<tr>
			<p>What <b>Site</b> does the artifact belong to:</p>
		</tr>
		<tr>
			<form action='Edit_AddArtifact_Feature.php' method='post'>
			<td>Site:
			<br><select name='formSiteID'>
				<option value=''> </option>";
						$sql1 = "SELECT * 
								FROM v_ShowAllSites 
								ORDER BY Borden_Number ";
						$result1 = $mysqli->query($sql1);
						while ($row = $result1->fetch_assoc())
						{
							echo "<option value='" . $row['Site_ID'] . "'>" . "(<b>" . $row['Borden_Number'] . "</b>) " . $row['Site_Name'] . "</option>";
						}
	echo "		</select>
			<input type='submit' name='submitSite' value='Select Site' />
			</form>
			</td>
		</tr>
	</table>";
}

if(isset($_POST['submitSite']))
{
	
	$sql1 = "SELECT Site_Name 
			FROM v_ShowAllSites 
			WHERE Site_ID='" . $_POST['formSiteID'] . "'";
	$result1 = $mysqli->query($sql1);
	while ($row = $result1->fetch_assoc())
	{
		$formSiteName=$row['Site_Name'];
	}
	
	echo " " . $_POST['formSiteID'] . 
		"<br>" . $formSiteName . "";
	
	echo "<table>
		<tr>
			<p>Please select the <b>Feature</b> to add the artifact to:</p>
		</tr>
		<tr>
			<form action='Edit_AddArtifact_Feature.php' method='post'>
			<td>Feature:
			<br><select name='formFeatureID'>
				<option value=''> </option>";
						$sql1 = "SELECT * 
								FROM v_SiteHasFeature 
								WHERE Site_ID='" . $_POST['formSiteID'] . "' 
								ORDER BY Site_ID ";
						$result1 = $mysqli->query($sql1);
						while ($row = $result1->fetch_assoc())
						{
							echo "<option value='" . $row['Feature_ID'] . "'>" . $row['Feature_Name'] . "</option>";
						}
	echo "		</select>
			<input type='hidden' name='formSiteID' value='" . $_POST['formSiteID'] . "'>
			<input type='hidden' name='formSiteName' value='" . $formSiteName . "'>
			<input type='submit' name='submitFeature' value='Select Feature' />
			</form>
			</td>
		</tr>
	</table>";
}

if(isset($_POST['submitFeature']))
{
	$sql1 = "SELECT Feature_Name 
			FROM v_SiteHasFeature 
			WHERE Feature_ID='" . $_POST['formFeatureID'] . "'";
	$result1 = $mysqli->query($sql1);
	while ($row = $result1->fetch_assoc())
	{
		$formFeatureName=$row['Feature_Name'];
	}
	
	echo " " . $_POST['formSiteID'] . 
		"<br>" . $_POST['formSiteName'] . 
		"<br>" . $_POST['formFeatureID'] . 
		"<br>" . $formFeatureName . "";
	
	echo "<table>
		<tr>
			<p><b>" . $formFeatureName . "</b> at <b>" . $_POST['formSiteName'] . "</b> is associated with the following Units. Please select a Unit to add this artifact to:</p>
		</tr>
		<tr>
			<form action='Edit_AddArtifact_Feature.php' method='post'>
			<td>Unit:
			<br><select name='formUnitID'>
				<option value=''> </option>";
						$sql1 = "SELECT * 
								FROM v_FeatureHasUnit 
								WHERE Feature_ID='" . $_POST['formFeatureID'] . "'
								 ORDER BY Feature_Name ";
						$result1 = $mysqli->query($sql1);
						while ($row = $result1->fetch_assoc())
						{
							echo "<option value='" . $row['Unit_ID'] . "'>" . $row['Unit_Name'] . "</option>";
						}
	echo "		</select>
			<input type='hidden' name='formSiteID' value='" . $_POST['formSiteID'] . "'>
			<input type='hidden' name='formSiteName' value='" . $_POST['formSiteName'] . "'>
			<input type='hidden' name='formFeatureID' value='" . $_POST['formFeatureID'] . "'>
			<input type='hidden' name='formFeatureName' value='" . $formFeatureName . "'>
			<input type='submit' name='submitUnit' value='Select Unit' />
			</form>
			</td>
		</tr>
	</table>";
}

if(isset($_POST['submitUnit']))
{
	$sql3 = "SELECT Unit_Name 
			FROM v_FeatureHasUnit 
			WHERE Unit_ID='" . $_POST['formUnitID'] . "' ";
	$result3 = $mysqli->query($sql3);
	while ($row = $result3->fetch_assoc())
	{
		$formUnitName=$row['Unit_Name'];
	}
	
	echo " " . $_POST['formSiteID'] . 
		"<br>" . $_POST['formSiteName'] . 
		"<br>" . $_POST['formFeatureID'] . 
		"<br>" . $_POST['formFeatureName'] . 
		"<br>" . $_POST['formUnitID'] . 
		"<br>" . $formUnitName . "";
	
	echo "<table>
		<tr>
			<p><b>" . $formUnitName . "</b> within <b>" . $_POST['formFeatureName'] . "</b> is divided into the following <b>Levels</b>.
				Please select a Level to add this artifact to:</p>
		</tr>
		<tr>
			<form action='Edit_AddArtifact_Feature.php' method='post'>
				<td>Level: 
				<br><select name='formLevelID'>
					<option value=''> </option>
					<option value=''>Unknown or N/A</option>";
						$sql1 = "SELECT *
								FROM v_FeatureUnitHasLevel 
								WHERE Feature_ID='" . $_POST['formFeatureID'] . "'
								 AND Unit_ID='" . $_POST['formUnitID'] . "'
								 ORDER BY Level_Name ";
						$result1 = $mysqli->query($sql1);
						while ($row = $result1->fetch_assoc())
						{
							echo "<option value='" . $row['Level_ID'] . "'>" . $row['Level_Name'] . "</option>";
						}
	echo "			</select>
				</td>
			</tr>
		</table>";
				
	
	
	
	echo "<table>
		<tr>
			<p><b>". $formUnitName . "</b> within <b>" . $_POST['formFeatureName'] . "</b> is further broken into the following <b>Quads</b>. 
				Please select a Quad to add this artifact to:</p>
		</tr>
		<tr>
			<td>Quad:
			<br><select name='formQuadID'>
				<option value=''> </option>
				<option value=''>Unknown or N/A</option>";
						$sql2 = "SELECT * 
								FROM v_FeatureUnitHasQuad 
								WHERE Feature_ID='" . $_POST['formFeatureID'] . "'
								 AND Unit_ID='" . $_POST['formUnitID'] . "'
								 ORDER BY Quad_Name ";
						$result2 = $mysqli->query($sql2);
						while ($row = $result2->fetch_assoc())
						{
							echo "<option value='" . $row['Quad_ID'] . "'>" . $row['Quad_Name'] . "</option>";
						}
	echo "		</select>
			<input type='hidden' name='formSiteID' value='" . $_POST['formSiteID'] . "'>
			<input type='hidden' name='formSiteName' value='" . $_POST['formSiteName'] . "'>
			<input type='hidden' name='formFeatureID' value='" . $_POST['formFeatureID'] . "'>
			<input type='hidden' name='formFeatureName' value='" . $_POST['formFeatureName'] . "'>
			<input type='hidden' name='formUnitID' value='" . $_POST['formUnitID'] . "'>
			<input type='hidden' name='formUnitName' value='" . $formUnitName . "'>
			<input type='submit' name='submitLevel_Quad' value='Select Level and Quad' />
			</form>
			</td>
		</tr>
	</table>";
}

if(isset($_POST['submitLevel_Quad']))
{
	
	$sql1 = "SELECT Level_Name 
			FROM v_FeatureUnitHasLevel 
			WHERE Level_ID='" . $_POST['formLevelID'] . "' ";
	$result1 = $mysqli->query($sql1);
	while ($row = $result1->fetch_assoc())
	{
		$formLevelName=$row['Level_Name'];
	}
	
	$sql2 = "SELECT Quad_Name 
			FROM v_FeatureUnitHasQuad 
			WHERE Quad_ID='" . $_POST['formQuadID'] . "' ";
	$result2 = $mysqli->query($sql2);
	while ($row = $result2->fetch_assoc())
	{
		$formQuadName=$row['Quad_Name'];
	}
	
	echo " " . $_POST['formSiteID'] . 
		"<br>" . $_POST['formSiteName'] . 
		"<br>" . $_POST['formFeatureID'] . 
		"<br>" . $_POST['formFeatureName'] . 
		"<br>" . $_POST['formUnitID'] . 
		"<br>" . $_POST['formUnitName'] . 
		"<br>" . $_POST['formLevelID'] . 
		"<br>" . $formLevelName . 
		"<br>" . $_POST['formQuadID'] . 
		"<br>" . $formQuadName . " ";
	
	
	echo "<br>
			<br>You are about to add an artifact to the following provenience. Is this information correct?";
	
	echo "<br>
			<br><b>Site Name: </b>" . $_POST['formSiteName'] . "
			<br><b>Unit: </b>" . $_POST['formUnitName'] . "
			<br><b>Level: </b>" . $formLevelName . "
			<br><b>Quad: </b>" . $formQuadName . "
			<br><b>Feature: </b>" . $_POST['formFeatureName'] . "
		
		<br><br>
		<table>
			<tr>
				<td>
		<form action='Edit_AddArtifact_Feature_Review.php' method='post'>
			<input type='hidden' name='formSiteID' value='" . $_POST['formSiteID'] . "'>
			<input type='hidden' name='formSiteName' value='" . $_POST['formSiteName'] . "'>
			<input type='hidden' name='formFeatureID' value='" . $_POST['formFeatureID'] . "'>
			<input type='hidden' name='formFeatureName' value='" . $_POST['formFeatureName'] . "'>
			<input type='hidden' name='formUnitID' value='" . $_POST['formUnitID'] . "'>
			<input type='hidden' name='formUnitName' value='" . $_POST['formUnitName'] . "'>
			<input type='hidden' name='formLevelID' value='" . $_POST['formLevelID'] . "'>
			<input type='hidden' name='formLevelName' value='" . $formLevelName . "'>
			<input type='hidden' name='formQuadID' value='" . $_POST['formQuadID'] . "'>
			<input type='hidden' name='formQuadName' value='" . $formQuadName . "'>
			<input type='submit' name='submitComfirm' value='Yes' />
		</form>
		</td>
		<td>
		<form action='SingleArtifactDetails.php' method='post'>
			<input type='submit' name='submitConfirm' value='No' />
		</form>
		</td>
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