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

if(empty($_POST['submitFinal']))
{
	echo "
	<table>
	<tr>
	<p>Please review the artifact's information below:</p>
	<p>Note: Information will be passed to the database <b>exactly</b> as it appears.
	</tr>
	<tr>";
	echo "<td>Barcode: <b>" . $_POST['updateBarcode'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Catalog Number: <b>" . $_POST['updateCatalog'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Primary Colour (Hue): <b>" . $_POST['formPC_Hue'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Primary Colour (Value/Chroma): <b>" . $_POST['formPC_VC'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Primary Colour (Description): <b>" . $_POST['formPC_Descr'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Secondary Colour (Hue): <b>" . $_POST['formSC_Hue'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Secondary Colour (Value/Chroma): <b>" . $_POST['formSC_VC'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Secondary Colour (Description): <b>" . $_POST['formSC_Descr'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>";
	echo "<form action='Edit_UpdateArtifact_Colour_Review.php' method='post'>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $_POST['updateCatalog'] . "'>";
	echo "<input type='hidden' name='formPC_Hue' value='" . $_POST['formPC_Hue'] . "'>";
	echo "<input type='hidden' name='formPC_VC' value='" . $_POST['formPC_VC'] . "'>";
	echo "<input type='hidden' name='formPC_Descr' value='" . $_POST['formPC_Descr'] . "'>";
	echo "<input type='hidden' name='formSC_Hue' value='" . $_POST['formSC_Hue'] . "'>";
	echo "<input type='hidden' name='formSC_VC' value='" . $_POST['formSC_VC'] . "'>";
	echo "<input type='hidden' name='formSC_Descr' value='" . $_POST['formSC_Descr'] . "'>";
	echo "<input type='submit' name='submitFinal' value='Confirm Submit' />";
	echo "</form>
	</td>
	</tr>
	</table>";
}
elseif(!empty($_POST['submitFinal']))
{
	$barcode = $_POST['updateBarcode'];
	$catalog = $_POST['updateCatalog'];
	$PC_Hue	= $_POST['formPC_Hue'];
	$PC_VC = $_POST['formPC_VC'];
	$PC_Descr = $_POST['formPC_Descr'];
	$SC_Hue	= $_POST['formSC_Hue'];
	$SC_VC = $_POST['formSC_VC'];
	$SC_Descr = $_POST['formSC_Descr'];
	
	$sql = "SELECT artifact_id
			FROM artifact_dimensions
			WHERE artifact_id='" . $_POST['updateBarcode'] . "'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0)
	{
		$sql2 = "UPDATE artifact_colour
					SET artifact_pc_h='" . $PC_Hue . "',
						artifact_pc_vc='" . $PC_VC . "',
						artifact_pc_d='" . $PC_Descr . "',
						artifact_sc_h='" . $SC_Hue . "',
						artifact_sc_vc='" . $SC_VC . "',
						artifact_sc_d='" . $SC_Descr . "'
					WHERE artifact_id='" . $barcode . "'";
		$result2 = $mysqli->query($sql2);
	}
	else
	{
		$sql3 = "INSERT INTO artifact_colour (artifact_id, artifact_pc_h, artifact_pc_vc, artifact_pc_d, artifact_sc_h, artifact_sc_vc, artifact_sc_d)
				VALUES ('" . $barcode . "', '" . $PC_Hue . "', '" . $PC_VC . "', '" . $PC_Descr . "', '" . $SC_Hue . "', '" . $SC_VC . "', '" . $SC_Descr . "')";
		$result3 = $mysqli->query($sql3);
	}
	
	echo "<table>
			<tr>
			<td><b>" . $catalog . "</b>'s colour descriptions have been edited in the database.
			</td>
			</tr>
			</table>";
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