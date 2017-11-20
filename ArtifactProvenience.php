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

echo "<h2>Artifact Site Provenience</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

// Selects all columns from a preconstructed view on the MySQL Server, v_ArtifactProvenience
$sql = "SELECT * FROM v_ArtifactProvenience ";
	//If this page was redirected from singleartifact.php, the query is restricted to a single artifact ID
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (!empty($_POST["barcode"])) 
		{
			$sql .= "WHERE Barcode = '" .$_POST['barcode']. "'";
		}
	}
	else 
	{
			$sql .= "WHERE Borden_Number IS NOT NULL
						OR Site_Name IS NOT NULL
						OR Unit_Name IS NOT NULL
						OR Quad_Name IS NOT NULL
						OR Layer_Name IS NOT NULL
						OR Level_Name IS NOT NULL
						OR Northing IS NOT NULL
						OR Easting IS NOT NULL
						OR Elevation IS NOT NULL ";
	}
	$sql .= "ORDER BY Catalog_Number";
	
$result = $mysqli->query($sql);

// Outputs the results of the SQL query
if ($result->num_rows > 0) 
{
	// Formats the table nicely
    echo "<div class='ZebraTable'>";

	// Displays the output with proper column headings
    echo "<table>
			<tr>
				<th>Barcode</th>
				<th>Catalog Number</th>
				<th>Borden Number</th>
				<th>Site</th>
				<th>Unit</th>
				<th>Quad</th>
				<th>Layer</th>
				<th>Level</th>
				<th>Northing</th>
				<th>Easting</th>
				<th>Elevation</th>
			</tr>";

	// The output for each row retrieved from the database
    while($row = $result->fetch_assoc()) 
	{
        echo "<tr>
				<td>" . $row["Barcode"]. "</td>
				<td>" . $row["Catalog_Number"]. "</td>
				<td>" . $row["Borden_Number"]. "</td>
				<td>" . $row["Site_Name"]. "</td>
				<td>" . $row["Unit_Name"]. "</td>
				<td>" . $row["Quad_Name"]. "</td>
				<td>" . $row["Layer_Name"]. "</td>
				<td>" . $row["Level_Name"]. "</td>
				<td>" . $row["Northing"]. "</td>
				<td>" . $row["Easting"]. "</td>
				<td>" . $row["Elevation"]. "</td>
			</tr>";
    }

	// Closes off the SQL statement table 
	echo "</table>";
} 
else 
{
    echo "0 results";
}

echo "</div>";
echo "<div id='bottom'>";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>