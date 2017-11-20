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

echo "<h2>Single Artifact Search</h2>";

echo "<div id='left-nav'>";
		include("left-nav.php");
echo "</div>";
echo "<div id='main'>";

$barcode = "";
$barcodeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (empty($_POST["barcode"])) 
	{
		$barcodeErr = "Artifact ID is required";
    } 
}

?>

<p>Here you can search the database for information on a single artifact or fauna bag.</p>
<p>Note: Currently the database is searchable only by a bag's unique barcode number. Other functionality will come in future updates.</p>
<p>To begin, please scan the barcode then click Submit.</p>

<?php
	echo "	<form method='post' action='SingleArtifactDetails.php' autocomplete='off'>
				Barcode: <input type='text' name='barcode' pattern='[0-9]{9}' title='Barcode must be 9 digits and use only numerals 0-9' value='$barcode'>" . $barcodeErr;
	echo "		<input type='submit' name='submit' value='Submit'>
			</form>";

	
echo "<div id='bottom'>";
	include 'footer.php';
echo "</div>";
echo "</div>";
echo "</body>";
echo "</html>";

?>