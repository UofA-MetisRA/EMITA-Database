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
		<p>You have selected:</p>
	</tr>
	<tr>
		<form action="Edit_AddArtifact_Review.php" method="post">
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
				<option value=''><?php echo $_POST['formLayer']; ?></option>
		</td>
		<td>Level:
		<br><select name='formLevel'>
				<option value=''><?php echo $_POST['formLevel']; ?></option>
		</td>
	</tr>
</table>

<table>
	<tr>
		<p>Step 1: Create a barcode for the artifact: 
			<a href='https://www.random.org/integers/?num=1&min=100000000&max=999999999&col=1&base=10&format=html&rnd=new' target="_blank">Random.org Barcode Generator</a>
		<p>Step 2: Copy that barcode into this field:
			<input type="text" name='formBarcode' pattern='[0-9]{9}' title='Barcode must be 9 digits and use only numerals 0-9'>
		<p>Step 3: How many artifacts are in this bag?
			<input type="number" name='formCount' title='Must be an integer between 1 and 999' min='1' max='999'>
		<p>Step 4: Enter a catalog number for this artifact:
			<input type="text" name='formCatalog' title='Catalog numbers typically contain the Borden Number followed by a unique numeric identifier or range (ie. FdPe1:0097-0103), and should be equal in length to the number of artifacts entered above'>
		<br>Note: The <u>next available</u> catalog number for <?php echo $_POST['formBorden']; ?> is: 
			<?php 
				$sql = "SELECT MAX(Catalog_Number)
						AS HighestCatalog
						FROM v_FullArtifactDetails 
						WHERE Borden_Number='" . $_POST['formBorden'] . "'";
				$result = $mysqli->query($sql);
				
				while ($row = $result ->fetch_assoc())
				{
					echo "<b>" . ++$row['HighestCatalog'] . "</b><br>";
				}
			?>
		<br>Step 5: What Quad do the artifact(s) belong to? 
			<select name='formQuad'>
				<option value=''> </option>
				<option value='na'>Don't Know or N/A</option>
					<?php
						$sql = "SELECT Quad_Name
								FROM v_UnitHasQuad
								WHERE Unit_Name='" . $_POST['formUnit'] . "'
								ORDER BY Unit_Name";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc())
						{
							echo "<option value='" . $row['Quad_Name'] . "'>" . $row['Quad_Name'] . "</option>";
						}
					?>
			</select>
		
		<p>
		<p>
		<p>
		<p>
		<p>
		<p><b>Don't forget</b> to print out a copy of the barcode and catalog number for the artifact bag!
		<p> 
	
		<input type="hidden" name='formBorden' value='<?php echo $_POST['formBorden']; ?>'>
		<input type="hidden" name='formUnit' value='<?php echo $_POST['formUnit']; ?>'>
		<input type="hidden" name='formLayer' value='<?php echo $_POST['formLayer']; ?>'>
		<input type="hidden" name='formLevel' value='<?php echo $_POST['formLevel']; ?>'>
		<input type="submit" name='submit' value="Review Submission" />
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