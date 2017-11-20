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
<h2>Single Artifact Details</h2>
<div id='left-nav'>";
include("left-nav.php");
echo "
</div>

<div id='main'>";

// The actual SQL statement, selecting all columns from a 
// pre-constructed view already existing on the server
$sql = "SELECT * 
		FROM v_FullArtifactDetails
		WHERE Barcode = '" . $_POST['barcode'] . "' 
		 ORDER BY Barcode ";
$result = $mysqli->query($sql);

// Outputs the results of the SQL query
while($row = $result->fetch_assoc()) 
	{
		$Barcode = $row['Barcode'];
		$Catalog_Number = $row['Catalog_Number'];
		$Cabinet = $row['Cabinet'];
		$Tray_ID = $row['Tray_ID'];
		$Tray_Name = $row['Tray_Name'];
		$Borden_Number = $row['Borden_Number'];
		$Site_Name = $row['Site_Name'];
		$Unit_Name = $row['Unit_Name'];
		$Quad_Name = $row['Quad_Name'];
		$Layer_Name = $row['Layer_Name'];
		$Level_Name = $row['Level_Name'];
		$Material = $row['Material'];
		$Material_Notes = $row['Material_Notes'];
		$Northing = $row['Northing'];
		$Easting = $row['Easting'];
		$Elevation = $row['Elevation'];
		$Length = $row['Length'];
		$Width = $row['Width'];
		$Thickness = $row['Thickness'];
		$Weight = $row['Weight'];
		$PC_Hue = $row['PC_Hue'];
		$PC_ValueChroma = $row['PC_ValueChroma'];
		$PC_Descr = $row['PC_Descr'];
		$SC_Hue = $row['SC_Hue'];
		$SC_ValueChroma = $row['SC_ValueChroma'];
		$SC_Descr = $row['SC_Descr'];
		$SHA_ArtifactGroup = $row['SHA_ArtifactGroup'];
		$SHA_ArtifactType = $row['SHA_ArtifactType'];
		$SHA_Description = $row['SHA_Description'];
		$SHA_DescrNotes = $row['SHA_DescrNotes'];
		$SHA_Condition = $row['SHA_Condition'];
		$SHA_Mark = $row['SHA_Mark'];
		$SHA_Maker = $row['SHA_Maker'];
		$SHA_Origin = $row['SHA_Origin'];
		$SHA_Datable = $row['SHA_Datable'];
		$Feature_Name = '';
		$Feature_BordenNumber = '';
		$Feature_SiteName = '';
		$Feature_UnitName = '';
		$Feature_QuadName = '';
		$Feature_LevelName = '';
		
	
	}

$sql2 = "SELECT * 
		FROM v_ArtifactHasFeature
		WHERE Barcode = '" . $_POST['barcode'] . "' 
		 ORDER BY Barcode ";
$result2 = $mysqli->query($sql2);

while($row = $result2->fetch_assoc()) 
	{
		$Feature_Name = $row['Feature_Name'] . "<br>";
		$Feature_BordenNumber = $row['Borden_Num'];
		$Feature_SiteName = $row['Feature_SiteName'];
		$Feature_UnitName = $row['Feature_UnitName'];
		$Feature_QuadName = $row['Feature_QuadName'];
		$Feature_LevelName = $row['Feature_LevelName'];
	}


	echo "<br><br>
		
		<div class='ZebraTableSingle'>
			<table>
				<tr>
				</tr>
				<th>
					<u>Lab Provenience</u>
				</th>
				<tr></tr>
				<tr>
					<th>(insert photo)<th>
				</tr>
				<tr>
					<td><b>Artifact ID (Barcode): </b>" . $Barcode . "</td>
					<td><b>Catalog Number: </b>" . $Catalog_Number . "</td>
				</tr>
				<tr>
					<td><b>Cabinet: </b>" . $Cabinet . "</td>
					<td><b>Tray: </b>" . $Tray_ID . " (" . $Tray_Name . ")</td>
				</tr>
			</table>
		</div>
		
		<div class='body'>
			<br>
		</div>
		
		<div class='ZebraTableSingle'>
			<table>
				<tr></tr>
				<th>
					<u>Field Provenience</u>
				</th>
				<tr>
					<td style=border-right-style:none><b>Site: </b>" . $Borden_Number . $Feature_BordenNumber . " (" . $Site_Name . $Feature_SiteName . ")</td>
					<td style=border-left-style:none></td>
				</tr>
				<tr>
					<td>
						<b>Unit: </b>" . $Unit_Name . $Feature_UnitName . "
						<br><b>Layer: </b>" . $Layer_Name . "
						<br><b>Level: </b>" . $Level_Name . $Feature_LevelName . "
						<br><b>Quad: </b>" . $Quad_Name . $Feature_QuadName . "
						<br><b>" . $Feature_Name . "</b>
						
					</td>
					<td>
						<b>Northing: </b>" . $Northing . "&emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
						<br><b>Easting: </b>" . $Easting . "&emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
						<br><b>Elevation: </b>" . $Elevation . "
					</td>
				</tr>
			</table>
		</div>
		
		<div class='body'>
			<br>
		</div>
		
		<div class='ZebraTableSingle'>
			<table>
				<tr></tr>
				<th>
					<u>Physical Characteristics</u>
				</th>
				<tr>
					<td><b>Material: </b>" . $Material . "</td>
					<td><b>Notes: </b>" . $Material_Notes . "</td>
				</tr>
				<tr>
					<td style=border-right-style:none>
						<b>Length: </b>" . $Length . "
						<br><b>Width: </b>" . $Width . "
						<br><b>Thickness: </b>" . $Thickness . "
						<br><b>Weight: </b>" . $Weight . "
					</td>
					<td style=border-left-style:none>
					</td>
				</tr>
				<tr>
					<td>
						<b>Primary Colour: </b>
						<br>
						<br><b>Hue: </b>" . $PC_Hue . "
						<br><b>Value/Chroma: </b>" . $PC_ValueChroma . "
						<br><b>Desription: </b>" . $PC_Descr . "
					</td>
					<td>
						<b>Secondary Colour: </b>
						<br>
						<br><b>Hue: </b>" . $SC_Hue . "
						<br><b>Value/Chroma: </b>" . $SC_ValueChroma . "
						<br><b>Desription: </b>" . $SC_Descr . "
					</td>
				</tr>
			</table>
		</div>

		<div class='body'>
			<br>
		</div>
		
		<div class='ZebraTableSingle'>
			<table>
				<tr></tr>
				<th>
					<u><a href='https://sha.org/resources/artifact-cataloging-system/' style=color:rgb(0,0,255)>SHA Description</a></u>
				</th>
				<tr>
					<td>
						<b>Group: </b>" . $SHA_ArtifactGroup . "
						<br><b>Type: </b>" . $SHA_ArtifactType . "
						<br><b>Description: </b>" . $SHA_Description . "
					</td>
					<td>
						<b>Notes: </b>" . $SHA_DescrNotes . "
					</td>
				</tr>
				<tr>
					<td>
						<b>Condition: </b>" . $SHA_Condition . "
						<br><b>Mark: </b>" . $SHA_Mark . "
						<br><b>Maker: </b>" . $SHA_Maker . "
					</td>
					<td>
						<b>Origin: </b>" . $SHA_Origin . "
						<br><b>Datable? </b>" . $SHA_Datable . "
					</td>
				</tr>
			</table>
		</div>
		
		";



echo "

<div id='bottom'>";
include 'footer.php';
echo "

</div>
</body>
</html>";

?>