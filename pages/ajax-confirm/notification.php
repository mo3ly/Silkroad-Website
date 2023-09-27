<?php
if(isset($_SESSION['LogIn'])){

	if ($_GET['sup'] == "Read"){
		//Make the notification as read
		$sql->query("UPDATE $dbs[WEB].._Notifications set Status = 'Seen' , NStatus = 'Sent' Where Owner = '$_SESSION[username]' ");
	}


	//Add the new Notification
	if ($_GET['sup'] == "Load"){
		$Noti = "SELECT * FROM $dbs[WEB].._Notifications where Owner = '$_SESSION[username]' and Status = 'Un Seen' order by Time DESC ";
		$Qry = $sql->query($Noti);  
		if ($sql->QueryHasRows($Noti)){
			while ($Data = $sql->QueryFetchArray($Qry)){
			$Content = $Data['Text'];
			$ID = $Data['ID'];
			$From = $Data['Sender'];
			$Time = $func->time_ago($Data['Time']);

			echo'<div class="nk-info-box bg-dark-2">
			<div class="nk-info-box-icon"><i class="ion-chatbubble"></i></div>
			<div class="nk-info-box-close nk-info-box-close-btn">
			<i> Hide</i>
			</div>
			<span>'.$Content.'</span>
			<h6>
			<div class="divider"></div>
			<span class="pull-right"><b class="fa fa-user"></b> '.$From.'</span>
			<span class="pull-left"><b class="fa fa-calendar"></b> '.$Time.'</span>
			</h6>
			<br>
			</div>';
			}
		} else {
			echo'<center><h4 style="color:darkred"><br><br>There is no unread notifications.</h4><center>';
		}
	}

	//Get the number of un read notifications
	if ($_GET['sup'] == "LoadNoti"){
		$Qary = $sql->query("SELECT COUNT (*) as Notif FROM $dbs[WEB].._Notifications where Owner = '$_SESSION[username]' and Status = 'Un Seen'");
		$Data = $sql->QueryFetchArray($Qary);
		$Number = $Data['Notif'];
		if ($Number != 0){echo'<span class="nk-badge">'.$Number.'</span>';}else{echo'';}
	}


	//New Notification
	if ($_GET['sup'] == "SmallNoti"){
		$Qry = $sql->query("SELECT TOP 1 * FROM $dbs[WEB].._Notifications where Owner = '$_SESSION[username]' and NStatus = 'Un Send' order by Time DESC ");  

		if ($Data = $sql->QueryFetchArray($Qry)){
			$Content = $Data['Text'];
			$ID = $Data['ID'];
			$From = $Data['Sender'];
			$Time = $func->time_ago($Data['Time']);
			$Content = '<b class="fa fa-calendar"></b> '.$Time.'<br>'.$Content.'';
			echo $func->Notification($Content,10);
			$Qry = $sql->query("UPDATE $dbs[WEB].._Notifications set NStatus = 'Sent' where ID = '$ID' and Owner = '$_SESSION[username]' ");
		}
	}

	//Delete Notification
	if ($_GET['sup'] == "DeleteOne"){
		$ID  = (int)$_GET['third'];
		$Qry = $sql->query("DELETE  FROM $dbs[WEB].._Notifications where Owner = '$_SESSION[username]' and ID = '$ID' ");  
		echo'<h4>The Notification Deleted successfully!</h4>';
		echo $func->Notification("<h5>Your notification deleted successfully!<h5>",5);
	}

}

?>
