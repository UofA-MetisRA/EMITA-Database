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

?>

<table>
	<tr>
		<p>Please select the artifact's:</p>
	</tr>
	<tr>
		<form action="Edit_AddArtifact_Unit.php" method="post">
		<td>Site:
		<br><select name='formBorden'>
			<option value=''> </option>
				<?php
					$sql = "SELECT Borden_Number FROM v_ShowAllSites";
					$result = $mysqli->query($sql);
					while ($row = $result->fetch_assoc())
					{
						echo "<option value='" . $row['Borden_Number'] . "'>" . $row['Borden_Number'] . "</option>";
					}
				?>
			</select>
		<input type="submit" name="submit" value="Select Site" />
		</form>
		</td>
	</tr>
</table>

<?php


echo "<div id='bottom'>";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>