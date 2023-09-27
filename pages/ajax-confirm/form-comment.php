<?php
    $Reply = $_POST['reply'];
	$ID = $_POST['ID'];
	$TopicType = $_POST['TopicType'];
	$time = date('Y-m-d H:i:s');
	    
	
	/*If ((strlen($Reply) > $ForumCommentMax) || (strlen($Reply) < $ForumCommentMin)){
		echo $func->Alerts("Reply letters must be between $ForumCommentMin - $ForumCommentMax.","danger");
	}*/
	
	If (empty($Reply)){
		echo $func->Alerts("Reply box cannot be empty!","exclamation");
	}else{
	
	$Owner = $_SESSION['username'];
	$Reply = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Reply);
    $Reply = trim($Reply);
    //$Reply = htmlspecialchars($Reply);
    $Reply = addslashes($Reply);
    $Reply = stripslashes($Reply);
    $Reply = str_replace("'", "''", $Reply);
	
	$sql->query("INSERT INTO $dbs[WEB]..ForumComments values ('$ID','$TopicType','$Owner','Reply','$Reply','yes','$time','$time')");
	echo $func->Alerts("Your reply posted successfully .","success");
	$func->Reload();
	}
	
?>
