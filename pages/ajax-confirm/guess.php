<?php

	$search = $_POST['search'];
	if (!empty ($search)){
   
	/** Character search **/
	If ($_POST['type'] == "char") {
			 //Check if query has rows
			$CheckRows = count($sql->query("select * from $dbs[SHARD].._Char where CharName16 like '$search%'")->fetchAll()); 
	
			//Select values from the _char table
			$SearchQuery = $sql->query("select top 20 * from $dbs[SHARD].._Char where CharName16 like '$search%'");

			if (!$CheckRows == 0){
			
			echo'<div class="row vertical-gap">';
			for ($x = 1; $Resulta = $sql->QueryFetchArray($SearchQuery); $x++) 
			{
					
				   $CharName = $Resulta['CharName16'];
				   $CurLevel = $Resulta['CurLevel'];
				   $CharID = $Resulta['CharID'];
				   
					
					echo "<div class='col-xs-6'><h6><a style='color:white;text-decoration: none;' href='profile/charid/$CharID'>
							  $x) Character  <span style='color:#e08821'>$CharName</span></a><h6>
						</div>";		
			}
			echo'</div>';
			}
			else 
			{
				echo $func->Alerts("Sorry, This character is not found!","exclamation");
			}
	
	/*Guild search*/
	} else if ($_POST['type'] == "guild") {
			$SearchQuery = $sql->query("select * from  $dbs[SHARD].._Guild where Name like '$search%'");
			//Check if query has rows
			$CheckRowsGuild = count($sql->query("select * from  $dbs[SHARD].._Guild where Name like '$search%'")->fetchAll()); 
			
			if (!$CheckRowsGuild == 0){
			
			echo'<div class="row vertical-gap">';
			for ($x = 1; $Resulta = $sql->QueryFetchArray($SearchQuery); $x++) 
			{
					
				   $GuildName = $Resulta['Name'];
				   $GuiledLevel = $Resulta['Lvl'];
				   $GuildID = $Resulta['ID'];
				   
					
					echo "<div class='col-xs-6'><h6>
							  <a style='color:white;text-decoration: none;' href='profile/guild/$GuildID'>
							  $x) Guild name  <span style='color:#e08821'>$GuildName</span></a><h6>
						</div>";
					
			}
			echo'</div>';
			}
			else 
			{
				echo $func->Alerts("Sorry, There is no result for this guild name.","exclamation");
			}
	
	}  else {
		echo $func->Alerts("Please select search type..","danger");
	}
	
	// If search box is empty
	} else {	echo $func->Alerts("Please, fill the search box with any letter.","danger");
	
	}
	
?>
