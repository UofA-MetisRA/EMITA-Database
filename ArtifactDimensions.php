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

echo "<h2>Artifact Dimensions/Descriptions</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

// Selects all columns from a preconstructed view on the MySQL Server, v_ArtifactDetails
$sql = "SELECT * FROM v_ArtifactDetails ";
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
			$sql .= "WHERE Material_Notes IS NOT NULL
						OR Length IS NOT NULL
						OR Width IS NOT NULL
						OR Thickness IS NOT NULL
						OR Weight IS NOT NULL
						OR PC_Hue IS NOT NULL
						OR PC_ValueChroma IS NOT NULL
						OR PC_Descr IS NOT NULL
						OR SC_Hue IS NOT NULL
						OR SC_ValueChroma IS NOT NULL
						OR SC_Descr IS NOT NULL ";
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
				<th>Material</th>
				<th>Material Notes</th>
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
			</tr>";

	// The output for each row retrieved from the database
    while($row = $result->fetch_assoc()) 
	{
        echo "<tr>
				<td>" . $row["Barcode"]. "</td>
				<td>" . $row["Catalog_Number"]. "</td>
				<td>" . $row["Material"]. "</td>
				<td>" . $row["Material_Notes"]. "</td>
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