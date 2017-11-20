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
	echo "<td>SHA Artifact Group: <b>" . $_POST['formSHA_artifactgroup'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>SHA Artifact Category: <b>" . $_POST['formSHA_artifactcategory'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>SHA Artifact Type: <b>" . $_POST['formSHA_artifacttype'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>SHA Artifact Description: <b>" . $_POST['formSHA_artifactdescr'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Personal Description: <b>" . $_POST['formSHA_personaldescr'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Condition: <b>" . $_POST['formSHA_condition'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>SHA Mark: <b>" . $_POST['formSHA_mark'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>SHA Maker: <b>" . $_POST['formSHA_maker'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Origin: <b>" . $_POST['formSHA_origin'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>Datable?: <b>" . $_POST['formSHA_datable'] . "</b></td>
	</tr>
	<tr>";
	echo "<td>";
	echo "<form action='Edit_UpdateArtifact_SHA_Review.php' method='post'>";
	echo "<input type='hidden' name='updateBarcode' value='" . $_POST['updateBarcode'] . "'>";
	echo "<input type='hidden' name='updateCatalog' value='" . $_POST['updateCatalog'] . "'>";
	echo "<input type='hidden' name='formSHA_artifactgroup' value='" . $_POST['formSHA_artifactgroup'] . "'>";
	echo "<input type='hidden' name='formSHA_artifactcategory' value='" . $_POST['formSHA_artifactcategory'] . "'>";
	echo "<input type='hidden' name='formSHA_artifacttype' value='" . $_POST['formSHA_artifacttype'] . "'>";
	echo "<input type='hidden' name='formSHA_artifactdescr' value='" . $_POST['formSHA_artifactdescr'] . "'>";
	echo "<input type='hidden' name='formSHA_personaldescr' value='" . $_POST['formSHA_personaldescr'] . "'>";
	echo "<input type='hidden' name='formSHA_condition' value='" . $_POST['formSHA_condition'] . "'>";
	echo "<input type='hidden' name='formSHA_mark' value='" . $_POST['formSHA_mark'] . "'>";
	echo "<input type='hidden' name='formSHA_maker' value='" . $_POST['formSHA_maker'] . "'>";
	echo "<input type='hidden' name='formSHA_origin' value='" . $_POST['formSHA_origin'] . "'>";
	echo "<input type='hidden' name='formSHA_datable' value='" . $_POST['formSHA_datable'] . "'>";
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
	$artifactgroup	= $_POST['formSHA_artifactgroup'];
	$artifactcategory = $_POST['formSHA_artifactcategory'];
	$artifacttype = $_POST['formSHA_artifacttype'];
	$artifactdescr	= $_POST['formSHA_artifactdescr'];
	$personaldescr = $_POST['formSHA_personaldescr'];
	$condition = $_POST['formSHA_condition'];
	$mark = $_POST['formSHA_mark'];
	$maker = $_POST['formSHA_maker'];
	$origin = $_POST['formSHA_origin'];
	$datable = $_POST['formSHA_datable'];
		
	$sql = "SELECT artifact_id
			FROM artifact_sha_ident
			WHERE artifact_id='" . $_POST['updateBarcode'] . "'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0)
	{
		$sql2 = "UPDATE artifact_sha_ident
					SET sha_artifactGroup='" . $artifactgroup . "',
						sha_artifactCategory='" . $artifactcategory . "',
						sha_artifactType='" . $artifacttype . "',
						sha_descr='" . $artifactdescr . "',
						sha_descrNotes='" . $personaldescr . "',
						sha_condition='" . $condition . "',
						sha_mark='" . $mark . "',
						sha_maker='" . $maker . "',
						sha_origin='" . $origin . "',
						sha_datable='" . $datable . "'
					WHERE artifact_id='" . $barcode . "'";
		$result2 = $mysqli->query($sql2);
	}
	else
	{
		$sql3 = "INSERT INTO artifact_sha_ident 
						(artifact_id, 
						sha_artifactGroup, 
						sha_artifactCategory, 
						sha_artifactType, 
						sha_descr, 
						sha_descrNotes, 
						sha_condition, 
						sha_mark, 
						sha_maker, 
						sha_origin, 
						sha_datable)
				VALUES ('" . $barcode . "', 
						'" . $artifactgroup . "', 
						'" . $artifactcategory . "', 
						'" . $artifacttype . "', 
						'" . $artifactdescr . "', 
						'" . $personaldescr . "', 
						'" . $condition . "',
						'" . $mark . "',
						'" . $maker . "',
						'" . $origin . "',
						'" . $datable . "')";
		$result3 = $mysqli->query($sql3);
	}
	
	echo "<table>
			<tr>
			<td><b>" . $catalog . "</b>'s SHA identifications have been edited in the database.
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