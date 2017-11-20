<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) 
	{
		//Links for all account permissions (including Public)
		echo "
		<ul>
		<li><a href='index.php'><b>Home</b></a></li>
		<li><a href='user_settings.php'><b>User Settings</b></a></li>
		<li><a href='logout.php'><b>Logout</b></a></li>
		</ul>
		<ul>
		<li><b>Information on all artifacts:</b></li>
		<li> - <a href='FullArtifactDetails.php'><u>Full Details</u></a></li>
		<li> - <a href='ArtifactDimensions.php'><u>Physical Characteristics</u></a></li>
		<li> - <a href='ArtifactProvenience.php'><u>Provenience</u></a></li>
		<li> - <a href='ArtifactSHA_All.php'><u>SHA Classification</u></a></li>
		<li> - <a href='ArtifactLabLocation.php'><u>Lab Storage Location</u></a></li>
		</ul>
		<ul>
		<li>Information on a <a href='singleartifact.php'><u>single artifact or fauna bag</u></a></li>
		</ul>
		<ul>
		<li><b>Information on archaeological sites:</b></li>
		<li> - <a href='ShowAllSites.php'><u>Sites</u></a></li>
		<li> - <a href='ShowAllUnits.php'><u>Units</u></a></li>
		<li> - <a href='ShowAllQuads.php'><u>All Quads</u></a></li>
		<li> - <a href='ShowAllLayers.php'><u>All Layers</u></a></li>
		<li> - <a href='ShowAllLevels.php'><u>All Levels</u></a></li>
		</ul>";

		//Links for permission level 2 (Administrator)
		if ($loggedInUser->checkPermission(array(2)))
		{
			echo "
			<ul>
			<li><b>Edit the database:</b></li>
			<li> - <a href='Edit_AddArtifact.php'><u>Add a new artifact</u></a></li>
			<li> - <a href='Edit_UpdateArtifact.php'><u>Edit an existing artifact</u></a></li>
			</ul>
			<ul>
			<li><b>---Admin Settings------------</b></li>
			<br>
			<li><a href='admin_configuration.php'><u>Website Configuration</u></a></li>
			<li><a href='admin_users.php'><u>User Settings</u></a></li>
			<li><a href='admin_permissions.php'><u>Admin Permissions</u></a></li>
			<li><a href='admin_pages.php'><u>Admin Pages</u></a></li>
			</ul>";
		}	

		//Links for permission level 5 (Lab Assistant)
		if ($loggedInUser->checkPermission(array(5)))
		{
			echo "
			<ul>
			<li><b>Edit the database:</b></li>
			<li> - <a href='Edit_AddArtifact.php'><u>Add a new artifact</u></a></li>
			<li> - <a href='Edit_UpdateArtifact.php'><u>Edit an existing artifact</u></a></li>
			</ul>";
		}
	} 

	//Links for users not logged in
else 
	{
		echo "
		<ul>
		<li><a href='index.php'><b>Home</b></a></li>
		<li><a href='login.php'><b>Login</b></a></li>
		<li><a href='register.php'><b>Register</b></a></li>
		<li><a href='forgot-password.php'><b>Forgot Password</b></a></li>";
		
		if ($emailActivation)
		{
			echo "<li><a href='resend-activation.php'><b>Resend Activation Email</b></a></li>";
		}
		echo "</ul>";
	}

?>
