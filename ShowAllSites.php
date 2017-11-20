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

echo "<h2>Sites<p></h2>";
// The actual SQL statement, selecting all columns from a 
// pre-constructed view already existing on the server
$sql_site = "SELECT * FROM v_ShowAllSites";
$result_site = $mysqli->query($sql_site);

// Outputs the results of the SQL query
if ($result_site->num_rows > 0) 
{
	if(!isset($_POST['submitSite']))
	{
		echo "<br>The following Sites are associated with this database. <b>For more information</b>, please select a Site from the dropdown below.
			<br><br>";

		// Formats the table nicely
		echo "<div class='ZebraTable'>";

		// Displays the output with proper column headings
		echo "<table>
			<tr>
				<th>Borden #</th>
				<th>Site Name</th>
			</tr>";

		// The output for each row retrieved from the database
		while($row_site = $result_site->fetch_assoc()) 
		{
			echo "<tr>
			<td>" . $row_site["Borden_Number"]. "</td>
			<td>" . $row_site["Site_Name"]. "</td>";
		}

	// Closes off the SQL statement table 
	echo "</table>
		</div>";
	
	echo "<div class='body'>
		<form action='ShowAllSites.php' method='post'>
			<br>
			<br>
			<b>Site: </b>
			<select name='formSiteID'>
				<option value=''> </option>";
				$sql_site = "SELECT *
							FROM v_ShowAllSites 
							ORDER BY Borden_Number ";
				$result_site = $mysqli->query($sql_site);
				while ($row_site = $result_site->fetch_assoc())
				{
					echo "<option value='" . $row_site['Site_ID'] . "'>" . $row_site['Borden_Number'] . "</option>";
				}
	echo "	</select>
			<input type='submit' name='submitSite' value='Select Site' />
		</form>
		</div>";

	}
	
	elseif(isset($_POST['submitSite']))
	{
		
		$sql_site = "SELECT *
					FROM v_ShowAllSites 
					WHERE Site_ID = '" . $_POST['formSiteID'] . "' 
					 ORDER BY Borden_Number ";
		$result_site = $mysqli->query($sql_site);
		
		while ($row_site = $result_site->fetch_assoc())
		{
			$sql_unit = "SELECT * FROM v_SiteHasUnit WHERE Site_ID='" . $row_site['Site_ID'] . "' ORDER BY Borden_Num ";
			$result_unit = $mysqli->query($sql_unit);

			$sql_layer = "SELECT * FROM v_SiteHasLayer WHERE Site_ID='" . $row_site['Site_ID'] . "' ORDER BY Layer_Name ";
			$result_layer = $mysqli->query($sql_layer);
			
			$sql_feature = "SELECT * FROM v_SiteHasFeature WHERE Site_ID='" . $row_site['Site_ID'] . "' ORDER BY Feature_Name ";
			$result_feature = $mysqli->query($sql_feature);
			
			$sql_year = "SELECT * FROM v_SiteHasYear WHERE Site_ID='" . $row_site["Site_ID"] . "' ORDER BY Year ";
			$result_year = $mysqli->query($sql_year);
		
			$sql_crew = "SELECT * FROM v_SiteHasCrew WHERE Site_ID='" . $row_site["Site_ID"] . "' ORDER BY Last_Name ";
			$result_crew = $mysqli->query($sql_crew);
			
			$sql_form = "SELECT * FROM v_SiteHasForms WHERE Site_ID='" . $row_site['Site_ID'] . "' ORDER BY Borden_Num ";
			$result_form = $mysqli->query($sql_form);
			
			echo "<br>
			<br>
			
			<div class='ZebraTableSingle'>
				<table>
					<tr></tr>
					<tr>
						<th><b>Details: </b>" . $row_site['Borden_Number'] . " (" . $row_site['Site_Name'] . ")</th>
					</tr>
					<tr>
						<td>Contains <b>Units: </b><br><br>";
							while($row_unit = $result_unit->fetch_assoc())
							{
								echo "<b>" . $row_unit["Unit_Name"] . "</b> (" . $row_unit['Unit_ID'] . ")<br>";
							}
							
						echo "</td>
						<td>Contains <b>Layers: </b><br><br>";
							while($row_layer = $result_layer->fetch_assoc())
							{
								echo "<b>" . $row_layer['Layer_Name'] . "</b> (" . $row_layer['Layer_ID'] . ")<br>";
							}
						echo "</td>
						<td>Contains <b>Features: </b><br><br>";
							while($row_feature = $result_feature->fetch_assoc())
							{
								echo "<b>" . $row_feature['Feature_Name'] . "</b> (" . $row_feature['Feature_ID'] . ")<br>";
							}
						echo "</td>
					</tr>
					<tr>
						<td style=border-bottom-style:none>Was excavated during: <br><br>";
							while($row_year = $result_year->fetch_assoc())
							{
								echo $row_year['Year'] . "<br>";
							}
						 echo "</td>
						 <td style=border-style:none none>Was excavated by: <br><br>";
							while($row_crew = $result_crew->fetch_assoc())
							{
								echo "<b>" . $row_crew['Last_Name'] . ", " . $row_crew['First_Name'] . "</b> (" . $row_crew['Crew_ID'] . ")<br>";
							}
						echo "</td>";
						while ($row_form = $result_form->fetch_assoc())
						{
							if (!empty($row_form["Forms_ID"])) 
								{
									echo "<td style=border-bottom-style:none><b>Site Forms: </b>
											<br>
											<br><a href='" . $row_form["Address"]. "'>Link</a>
										</td>";
								}
							else 
								{
									echo "<td style=border-left-style:none>
										</td>";
								}
						}				
					echo "</tr>
				</table>
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