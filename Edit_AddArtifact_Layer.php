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
		<form action="Edit_AddArtifact_Level.php" method="post">
		<td>Site:
		<br><select name='formBorden'>
				<option value=''><?php echo $_POST['formBorden']; ?></option>
		</td>
		<td>Unit:
		<br><select name='formUnit'>
				<option value=''><?php echo $_POST['formUnit']; ?></option>
		</td>
		
		
		
		<td>Layer:
		<br><select name='formLayer'>
				<option value=''> </option>
					<?php
						$sql = "SELECT Layer_Name 
								FROM v_SiteHasLayer
								WHERE Borden_Num='" . $_POST['formBorden'] . "' 
								ORDER BY Layer_ID";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc())
						{
							echo "<option value='" . $row['Layer_Name'] . "'>" . $row['Layer_Name'] . "</option>";
						}
					?>
			</select>
		<input type="hidden" name="formBorden" value='<?php echo $_POST['formBorden']; ?>'>
		<input type="hidden" name="formUnit" value='<?php echo $_POST['formUnit']; ?>'>
		
		<input type="submit" name="submit" value="Select Layer" />
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