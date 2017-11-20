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

echo "<h2>Artifact SHA Identification/Descriptions</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

// Selects all columns from a preconstructed view on the MySQL Server, v_ArtifactSHA_All
$sql = "SELECT * FROM v_ArtifactSHA_All ";
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
		$sql .= "WHERE SHA_ArtifactGroup IS NOT NULL
					OR SHA_ArtifactType IS NOT NULL
					OR SHA_Description IS NOT NULL
					OR SHA_DescrNotes IS NOT NULL
					OR SHA_Condition IS NOT NULL
					OR SHA_Mark IS NOT NULL
					OR SHA_Maker IS NOT NULL
					OR SHA_Origin IS NOT NULL
					OR SHA_Datable IS NOT NULL ";
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
				<th>SHA Artifact Group</th>
				<th>SHA Artifact Type</th>
				<th>SHA Description</th>
				<th>SHA Description Notes</th>
				<th>Condition</th>
				<th>Mark</th>
				<th>Maker</th>
				<th>Origin</th>
				<th>Dateable?</th>
			</tr>";

	// The output for each row retrieved from the database
    while($row = $result->fetch_assoc()) 
	{
        echo "<tr>
				<td>" . $row["Barcode"]. "</td>
				<td>" . $row["Catalog_Number"]. "</td>
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