<?php
	if(isset($_SESSION['LogIn'])){
	
	if ($_GET['sup'] == "Send"){
		
	$Message = $_POST['msg'];
	$time = date('Y-m-d H:i:s');
	$Owner = $_SESSION['username'];
	$Message = preg_replace("/(#|\*|--|\\\\)/", "", $Message);
    $Message = trim($Message);
    $Message = htmlspecialchars($Message);
    $Message = addslashes($Message);
    $Message = stripslashes($Message);
    $Message = str_replace("'", "''", $Message);
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    if(preg_match($reg_exUrl, $Message, $url)) {$Message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $Message);} 
	
	
	$sql->query("INSERT INTO $dbs[WEB].._Chat values ('$Owner','$Message','Un Send','$time')");
	
	}
	
	
	if (($_GET['sup']) == "Update"){
		
		$Query = "SELECT * FROM $dbs[WEB].._Chat order by Time ASC";
		if ($sql->QueryHasRows($Query)){
		$qry = $sql->query($Query);
		while($Data = $sql->QueryFetchArray($qry)){
		$Owner = $Data['Sender'];
		$Message = $Data['Msg'];
		$Time = $func->time_ago($Data['Time']);
		
		/** Right or left mssage**/
		if($Owner == $_SESSION['username']){
			echo'<div class="message"><li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
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
		}else{
			echo'<center><br><h4>There is no messages.</h4></center>';
		}
	    }
		
		/** Check if there is new updates **/
		If (($_GET['sup']) == "CheckUpdate"){
			if($sql->QueryHasRows("SELECT * FROM $dbs[WEB].._Chat where Status = 'Un Send'")){
				echo'<script>
					$(function(){
					ChatEnd();
					});
					</script>';
				$sql->query("UPDATE $dbs[WEB].._Chat set Status = 'Sent' ");
			} else {
				echo'';
			}
		}
	
	}
?>
