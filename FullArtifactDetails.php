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
<h2>Full Artifact Details</h2>
<div id='left-nav'>";
include("left-nav.php");
echo "
</div>

<div id='main'>";

// The actual SQL statement, selecting all columns from a 
// pre-constructed view already existing on the server
$sql = "SELECT * FROM v_FullArtifactDetails ";
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
		if (!empty($_POST["barcode"])) 
		{
			$sql .= "where Barcode = '" .$_POST['barcode']. "'";
		}
	}
	$sql .= "ORDER BY Catalog_Number";
	
$result = $mysqli->query($sql);

// Outputs the results of the SQL query
if ($result->num_rows > 0) {

// Formats the table nicely
    echo "<div class='ZebraTable'>";

// Displays the output with proper column headings
    echo "<table><tr>
	<th>Barcode</th>
	<th>Catalog Number</th>
	<th>Cabinet</th>
	<th>Tray Number</th>
	<th>Tray Name</th>
	<th>Borden Number</th>
	<th>Site Name</th>
	<th>Unit</th>
	<th>Quad</th>
	<th>Layer</th>
	<th>Level</th>
	<th>Material</th>
	<th>Material Notes</th>
	<th>Northing</th>
	<th>Easting</th>
	<th>Elevation</th>
	<th>Length</th>
	<th>Width</th>
	<th>Thickness</th>
	<th>Weight</th>
	<th>Primary Colour (Hue)</th>
	<th>Primary Colour (Value/Chroma)</th>
	<th>Primary Colour (Description)</th>
	<th>Secondary Colour (Hue)</th>
	<th>Secondary Colour (Value/Chroma)</th>
	<th>Secondary Colour (Description)</th>
	<th>SHA Artifact Group</th>
	<th>SHA Artifact Type</th>
	<th>SHA Description</th>
	<th>SHA Description Notes</th>
	<th>Condition</th>
	<th>Mark</th>
	<th>Maker</th>
	<th>Origin</th>
	<th>Datable?</th>
	</tr>";

// The output for each row retrieved from the database
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	<td>" . $row["Barcode"]. "</td>
	<td>" . $row["Catalog_Number"]. "</td>
	<td>" . $row["Cabinet"]. "</td>
	<td>" . $row["Tray_ID"]. "</td>
	<td>" . $row["Tray_Name"]. "</td>
	<td>" . $row["Borden_Number"]. "</td>
	<td>" . $row["Site_Name"]. "</td>
	<td>" . $row["Unit_Name"]. "</td>
	<td>" . $row["Quad_Name"]. "</td>
	<td>" . $row["Layer_Name"]. "</td>
	<td>" . $row["Level_Name"]. "</td>
	<td>" . $row["Material"]. "</td>
	<td>" . $row["Material_Notes"]. "</td>
	<td>" . $row["Northing"]. "</td>
	<td>" . $row["Easting"]. "</td>
	<td>" . $row["Elevation"]. "</td>
	<td>" . $row["Length"]. "</td>
	<td>" . $row["Width"]. "</td>
	<td>" . $row["Thickness"]. "</td>
	<td>" . $row["Weight"]. "</td>
	<td>" . $row["PC_Hue"]. "</td>
	<td>" . $row["PC_ValueChroma"]. "</td>
	<td>" . $row["PC_Descr"]. "</td>
	<td>" . $row["SC_Hue"]. "</td>
	<td>" . $row["SC_ValueChroma"]. "</td>
	<td>" . $row["SC_Descr"]. "</td>
	<td>" . $row["SHA_ArtifactGroup"]. "</td>
	<td>" . $row["SHA_ArtifactType"]. "</td>
	<td>" . $row["SHA_Description"]. "</td>
	<td>" . $row["SHA_DescrNotes"]. "</td>
	<td>" . $row["SHA_Condition"]. "</td>
	<td>" . $row["SHA_Mark"]. "</td>
	<td>" . $row["SHA_Maker"]. "</td>
	<td>" . $row["SHA_Origin"]. "</td>
	<td>" . $row["SHA_Datable"]. "</td>
	</tr>";
    }

// Closes off the SQL statement table 
echo "</td></tr></table>";

} else {
    echo "0 results";
}
echo "

</div>
<div id='bottom'>";
include 'footer.php';
echo "
</div>
</div>
</body>
</html>";

?>