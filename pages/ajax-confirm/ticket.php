<?php
if(isset($_SESSION['LogIn'])){

/** Create a new ticket **/
if ($_GET['sup'] == "create"){
	
	$Ticket = $_POST['ticket'];
	$Title = $_POST['Title'];
	$Category = $_POST['Category'];
	$Charname = $_POST['Charname'];
	$time = date('Y-m-d H:i:s');
	$Owner = $_SESSION['username'];
	
	// filter the ticket content
	$Ticket = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Ticket);
	$Ticket = trim($Ticket);
	$Ticket = addslashes($Ticket);
	$Ticket = stripslashes($Ticket);
	$Ticket = str_replace("'", "''", $Ticket);
	
	if(!empty ($Charname) && ($Title) && ($Ticket)) {
		
		if ($sql->CharInUser($_SESSION['username'],$Charname)){
			
			if (strlen($Title) < 25) {
				
				if (in_array($Category, $TicketCategories)){
				
					$sql->query("INSERT INTO $dbs[WEB].._Tickets values ('$Charname','$Owner','$Category','$Title','$Ticket','0','$time')");
					echo $func->Alerts("Your ticket created successfully!","success");
					$func->Reload();
				
				} else {echo $func->Alerts("This category is not included!","exclamation");}
		
			} else { echo $func->Alerts("Title s too long!","exclamation");}
			
		}else{echo $func->Alerts("Sorry, you don't own this character!","danger");}
		
	} else {echo $func->Alerts("All fields are required!","exclamation");}
}

/** Create a new ticket **/
if ($_GET['sup'] == "AddMessage"){
	
	$time = date('Y-m-d H:i:s');
	$Owner = $_SESSION['username'];
	$TicketID = $_POST['TicketID'];
	$Ticket = $_POST['MessageTicket'];
	
	// filter the ticket content
	$Ticket = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Ticket);
	$Ticket = trim($Ticket);
	$Ticket = addslashes($Ticket);
	$Ticket = stripslashes($Ticket);
	$Ticket = str_replace("'", "''", $Ticket);
	
	
	
	if (!$sql->Admin($_SESSION['username'],$Gm_Number)){
		
		$Query = "SELECT * FROM $dbs[WEB].._Tickets where StrUserID = '$_SESSION[username]' and ID = '$TicketID' and Status = '0' ";
		
		if ($sql->QueryHasRows($Query)){
			
			$QueryCharName = $sql->query($Query);
			$Data = $sql->QueryFetchArray($QueryCharName);
			$Charname = $Data['CharName'];
			
			$sql->query("INSERT INTO $dbs[WEB].._TicketsAnswer values ('$TicketID','$Charname','$Owner','$Ticket','Un Seen','$time')");
		
		} else {
			$func->Notification("Sorry, this ticket is closed.",15);
		}
		
	} else {
		//if admin
		$Charname = "Admin";
		$sql->query("INSERT INTO $dbs[WEB].._TicketsAnswer values ('$TicketID','$Charname','$Owner','$Ticket','Un Seen','$time')");
		$sql->query("UPDATE $dbs[WEB].._TicketsAnswer set Status = 'Seen' where TicketID = '$TicketID' ");
	}
}

/** Update ticket **/
if (($_GET['sup']) == "Update"){
	$TicketID = $_GET['third'];
	
	//if not admin
	if (!$sql->Admin($_SESSION['username'],$Gm_Number)){
	
	   $Query = "SELECT * FROM $dbs[WEB].._TicketsAnswer where (StrUserID = '$_SESSION[username]' or Sender = 'Admin') and TicketID = '$TicketID' order by Date ASC";
	   
	} else {
		//if the sender is admin
		$Query = "SELECT * FROM $dbs[WEB].._TicketsAnswer where TicketID = '$TicketID' order by Date ASC";
		
	}
	if ($sql->QueryHasRows($Query)){
	$qry = $sql->query($Query);
	while($Data = $sql->QueryFetchArray($qry)){
	$Owner = $Data['Sender'];
	$Message = $Data['Message'];
	$Time = $func->time_ago($Data['Date']);
	
	/** Right or left mssage**/
	if($Data['StrUserID'] == $_SESSION['username']){
		
		echo'<div class="message"><li class="right clearfix"><span class="chat-img pull-right">
						<img src="/assets/images/avatar-2-sm.jpg" alt="User Avatar" class="img-circle chat-image" />
					</span>
						<div class="chat-body clearfix">
							<div class="header">
								<small class=" text-muted"><span class="ion-ios-time-outline"></span> '.$Time.'</small>
								<strong class="pull-right primary-font"><b class="fa fa-user"></b> '.$Owner.'</strong>
							</div>
							<p>
								'.$Message.'
							</p>
						</div>
					</li></div>';
		} else {
			
		echo'<li class="left clearfix"><span class="chat-img pull-left">
							<img src="/assets/images/avatar-1-sm.jpg" alt="User Avatar" class="img-circle chat-image" />
						</span>
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font"><b class="fa fa-user"></b> '.$Owner.'</strong> <small class="pull-right text-muted">
										<span class="ion-ios-time-outline"></span> '.$Time.'</small>
								</div>
								<p>
									'.$Message.'
								</p>
							</div>
						</li>';
		}
	}
		/** if there is no data **/
		} else { echo'<center><br><h4>There is no answers.</h4></center>';}
	
	}
	
	/** Close ticket **/
	if ($_GET['sup'] == "Close"){
		$TicketID = $_GET['third'];
		if ($sql->Admin($_SESSION['username'],$Gm_Number)){
			
			$sql->query("UPDATE $dbs[WEB].._Tickets set Status = '1' where ID = '$TicketID' ");
			$func->Notification("This ticket closed successfully!",10);
			$func->Reload();
			
		}
	}
	
	/** Open ticket **/
	if ($_GET['sup'] == "Open"){
		$TicketID = $_GET['third'];
		if ($sql->Admin($_SESSION['username'],$Gm_Number)){
			
			$sql->query("UPDATE $dbs[WEB].._Tickets set Status = '0' where ID = '$TicketID' ");
			$func->Notification("This ticket re-opened successfully!",10);
			$func->Reload();
			
		}
	}


}
?>
