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

// The actual SQL statement, selecting all columns from a 
// pre-constructed view already existing on the server
$sql = "SELECT * FROM v_ShowAllQuads";
$result = $mysqli->query($sql);

// Outputs the results of the SQL query
if ($result->num_rows > 0) {

// Formats the table nicely
    echo "<div class='ZebraTable'>";

// Displays the output with proper column headings
    echo "<table><tr>
	<th>Borden #</th>
	<th>Site Name</th>
	<th>Unit Name</th>
	<th>Quad</th>
	<th>Quad Form</th>
	</tr>";

// The output for each row retrieved from the database
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	<td>" . $row["Borden_Number"]. "</td>
	<td>" . $row["Site_Name"]. "</td>
	<td>" . $row["Unit_Name"]. "</td>
	<td>" . $row["Quad_Name"]. "</td>
	<td>";
	 if (!empty($row["quad_form"])) {
		echo "<a href='" . $row["Quad_Form"]. "'>Link</a>";
	}
	echo "
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