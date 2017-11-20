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
echo "<div id='left-nav'>";
	include("left-nav.php");
echo "</div>
		<div id='main'>";

echo "<h2>Units<p></h2>";
// The actual SQL statement, selecting all columns from a 
// pre-constructed view already existing on the server
$sql_site = "SELECT * FROM v_ShowAllSites ";
$result_site = $mysqli->query($sql_site);

// Outputs the results of the SQL query
if ($result_site->num_rows > 0) 
{
	if(!isset($_POST['submitUnit']))
	{
	echo "<br>The following Units are associated with this database. <b>For more information</b>, please select a Unit from the dropdown below.<br><br>";

	// Formats the table nicely
		echo "<div class='ZebraTable'>";

	// Displays the output with proper column headings
		echo "<table>
				<tr>
					<th>Borden #</th>
					<th>Site Name</th>
					<th>Unit Name</th>
				</tr>";

	// The output for each row retrieved from the database
		while($row_site = $result_site->fetch_assoc()) 
		{
			$sql_unit = "SELECT * FROM v_ShowAllUnits WHERE Site_ID='" . $row_site["Site_ID"] . "'";
			$result_unit = $mysqli->query($sql_unit);
		
			echo "<tr>
					<td>" . $row_site["Borden_Number"]. "</td>
					<td>" . $row_site["Site_Name"]. "</td>
					<td>";
			while($row_site = $result_unit->fetch_assoc())
			{
			echo "<b>" . $row_site["Unit_Name"] . "</b> (" . $row_site["Unit_ID"] . ")<br>";
			}
			echo "</td>
		</tr>";
		}	
	
	// Closes off the SQL statement table 
	echo "</table>
		</div>";
	
	echo "<div class='body'>
		<form action='ShowAllUnits.php' method='post'>
			<br>
			<br>
			<b>Unit: </b>
			<select name='formUnitID'>
				<option value=''> </option>";
				$sql_unit = "SELECT *
							FROM v_ShowAllUnits 
							ORDER BY Borden_Number ";
				$result_unit = $mysqli->query($sql_unit);
				while ($row_unit = $result_unit->fetch_assoc())
				{
					echo "<option value='" . $row_unit['Unit_ID'] . "'>" . $row_unit['Unit_Name'] . " (" . $row_unit['Unit_ID'] . ")</option>";
				}
	echo "	</select>
			<input type='submit' name='submitUnit' value='Select Site' />
		</form>
		</div>";
	}
	
	elseif(isset($_POST['submitUnit']))
	{
		$sql_unit = "SELECT *
					FROM v_ShowAllUnits 
					WHERE Unit_ID = '" . $_POST['formUnitID'] . "' 
					 ORDER BY Borden_Number ";
		$result_unit = $mysqli->query($sql_unit);
		
		while ($row_unit = $result_unit->fetch_assoc())
		{
			$sql_layer = "SELECT * FROM v_UnitHasLayer WHERE Unit_ID='" . $row_unit['Unit_ID'] . "' ORDER BY Layer_Name ";
			$result_layer = $mysqli->query($sql_layer);
			
			$sql_feature = "SELECT * FROM v_FeatureHasUnit WHERE Unit_ID='" . $row_unit['Unit_ID'] . "' ORDER BY Feature_Name ";
			$result_feature = $mysqli->query($sql_feature);
			
			$sql_quad = "SELECT * FROM v_UnitHasQuad WHERE Unit_ID='" . $row_unit['Unit_ID'] . "' ORDER BY Quad_Name";
			$result_quad = $mysqli->query($sql_quad);
			
			$sql_leveltype = "SELECT * FROM v_UnitHasLevelType WHERE Unit_ID='" . $row_unit['Unit_ID'] . "' ORDER BY Unit_Name ";
			$result_leveltype = $mysqli->query($sql_leveltype);
			
			$sql_year = "SELECT * FROM v_UnitHasYear WHERE Unit_ID='" . $row_unit["Unit_ID"] . "' ORDER BY Year ";
			$result_year = $mysqli->query($sql_year);
		
			$sql_crew = "SELECT * FROM v_UnitHasCrew WHERE Unit_ID='" . $row_unit["Unit_ID"] . "' ORDER BY Last_Name ";
			$result_crew = $mysqli->query($sql_crew);
			
			$sql_forms = "SELECT * FROM v_UnitHasForms WHERE Unit_ID='" . $row_unit['Unit_ID'] . "' ORDER BY Unit_Name ";
			$result_forms = $mysqli->query($sql_forms);
			
			$sql_photos = "SELECT * FROM v_UnitHasPhotos WHERE Unit_ID='" . $row_unit['Unit_ID'] . "' ORDER BY Photo_ID ";
			$result_photos = $mysqli->query($sql_photos);
			
			$i = 0;
			
			echo "<br>
				<br>
				
				<div class='ZebraTableSingle'>
					<table>
						<tr></tr>
						<tr>
							<th><b>Details: </b>" . $row_unit['Unit_Name'] . " at " . $row_unit['Site_Name'] . "</th>
						</tr>
					</table>
					<table>
						<tr>
							<td style=border-left-style:none><u>Datum: </u>
								<br>
								<br><b>Coordinate System: </b>" . $row_unit['Datum_CoordSys'] . "
								<br><b>Northing: </b>" . $row_unit['Datum_Northing'] . "
								<br><b>Easting: </b>" . $row_unit['Datum_Easting'] . "
								<br><b>Elevation: </b>" . $row_unit['Datum_Elevation'] . "
								<br><b>Datum Description: </b>" . $row_unit['Datum_Descr'] . "
							</td>
							<td style='min-width:200px'>
								<u>Unit Details: </u>
								<br>
								<br><b>Length: </b>" . $row_unit['Unit_Length'] . " m
								<br><b>Width: </b>" . $row_unit['Unit_Width'] . " m
								<br><b>Depth: </b>" . $row_unit['Unit_Depth'] . " 
								<br>";
								while ($row_leveltype = $result_leveltype->fetch_assoc())
								{
									$i++;
									echo "<br><b>Leveltype " . $i . ":</b> " . $row_leveltype['LevelType'] . " " . $row_leveltype['LevelType_Depth'] . " ";
								}
							echo "</td>
							<td style='max-width:500px'>
								<u>Screen Details:</u>
								<br>
								<br><b>Screened?: </b>" . $row_unit['Screen'] . "
								<br><b>Screen Size: </b>" . $row_unit['Screen_Mesh'] . "
								<br><b>Notes: </b>" . $row_unit['Notes'] . "
							</td>
						</tr>
						<tr>
							<td>
								<b>" . $row_unit['Unit_Name'] . "</b> is associated with the following <b>Layers</b>: 
								<br>";
								while ($row_layer = $result_layer->fetch_assoc())
								{
									echo "<br><b>Layer " . $row_layer['Layer_Name'] . "</b> (" . $row_layer['Layer_ID'] . ")";
								}
							echo "</td>
							<td>
								<b>" . $row_unit['Unit_Name'] . "</b> is associated with the following <b>Quads</b>:
								<br>";
								while ($row_quad = $result_quad->fetch_assoc())
								{
									echo "<br><b>" . $row_quad['Quad_Name'] . "</b> (" . $row_quad['Quad_ID'] . ")";
								}
							echo "</td>
							<td>
								<b>" . $row_unit['Unit_Name'] . "</b> is associated with the following <b>Features</b>:
								<br>";
								while ($row_feature = $result_feature->fetch_assoc())
								{
									echo "<br><b>" . $row_feature['Feature_Name'] . "</b> (" . $row_feature['Feature_ID'] . ")";
								}
							echo "</td>
						</tr>
						<tr>
							<td>Was excavated during: 
								<br>";
								while ($row_year = $result_year->fetch_assoc())
								{
									echo "<br><b>" . $row_year['Year'] . "</b>";
								}
							echo "</td>
							<td style=border-right-style:none>Was excavated by: 
								<br>";
								while ($row_crew = $result_crew->fetch_assoc())
								{
									echo "<br><b>" . $row_crew['Last_Name'] . ", " . $row_crew['First_Name'] . "</b> (" . $row_crew['Crew_ID'] . ")";
								}
							echo "</td>";
							
							if (!empty($row_forms['Forms_ID']))
							{
								while ($row_forms = $result_forms->fetch_assoc())
								{
									echo "<td><b>Unit Forms: </b>
										<br><a href='" . $row_forms['Address'] . "'Link</a>
									</td>";
								}
							}
							else
							{
								echo "<td style=border-left-style:none>
									</td>";
							}
							
							echo "
						</tr>";
						if (!empty($row_photos['Photo_ID']))
						{
							echo "</table>
								<table>
									<tr>
										<td style=border-style:none>
											<u>Photos:</u>
											<br>
											<br>(insert photos here)";
											//In this section, simply list that there are photos associated with this Unit.
											//Make a new page called Photos, and use a form here that links to that page with a 'submitUnit' clause
											//Use this clause to pull up the relevant photos associated with that unit, so this page doesn't get cluttered and insanely long, 
												//and so that we can format that page nicely for photos
										echo "</td>
									</tr>";
						}
						else
						{
							echo "";
						}
						
					echo "</table>
				</div>";
		}
	}
} 
else 
{
	echo "0 results";
}

echo "

<div id='bottom'>";
include 'footer.php';
echo "
</div>
</div>
</body>
</html>";

?>
