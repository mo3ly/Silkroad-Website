	<?  
	if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}
	If ($_GET['sup']){
	  $Page = $_GET['sup'];
	} else {
	  $Page=1;
	}

	$AllRows =  count($sql->query("select * from $dbs[WEB].._Notifications where Owner = '$_SESSION[username]' ")->fetchAll());
	$Total = ceil($AllRows / $row_per_page);

	If ($AllRows > 1){
	if($Page > $Total){$func->userRedirect("/notifications",false);}
	}
	?>

	<div class="nk-gap-4"></div>

	<div class="container">


	<!-- START: Archive -->
	<h1>Notifications</h1>
	<div class="nk-gap"></div>
	
	<!-- START: Pagination -->
	<div class="nk-pagination nk-pagination-left">
			<?php $pgn->Pagination($Page,"/notifications/",$Total);?>
	</div>
	<div class="nk-gap-2"></div>
	<!-- END: Pagination -->
	<script>
		function DeleteNotification(ID)
		{$("#DeletedDiv").load("/notification/DeleteOne/"+ID);}
	</script>
	<div id="DeletedDiv"></div>
	<?php
	$Start = ($Page - 1) * $row_per_page;
	$Noti = "SELECT * FROM $dbs[WEB].._Notifications where Owner = '$_SESSION[username]' order by Time DESC OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
	$Qry = $sql->query($Noti);  
	if ($sql->QueryHasRows($Noti)){
	while ($Data = $sql->QueryFetchArray($Qry)){
	$Content = $Data['Text'];
	$ID = $Data['ID'];
	$From = $Data['Sender'];
	$Time = $func->time_ago($Data['Time']);
	?>
	<div class="nk-info-box bg-dark-2">
			<div class="nk-info-box-icon"><i class="ion-chatbubble"></i></div>
			<div class="nk-info-box-close nk-info-box-close-btn" title="Delete" onclick="DeleteNotification(<?= $ID;?>);">
			<i class="ion-android-close"></i>
			</div>
			<span><?=$Content;?></span>
			<h6>
			<div class="divider"></div>
			<span class="pull-right"><b class="fa fa-user"></b> <?= $From;?></span>
			<span class="pull-left"><b class="fa fa-calendar"></b> <?= $Time;?></span>
			</h6>
			<br>
	</div>
	<?php
	}
	} else {
	   echo'<h4 style="color:darkred"><br><br>There is no notifications.</h4>';
	}
	?>
	
	<!-- END: Notifications -->

	<div class="nk-gap-2"></div>

	<!-- START: Pagination -->
	<div class="nk-pagination nk-pagination-left">
			<?php $pgn->Pagination($Page,"/notifications/",$Total);?>
	</div>
	<!-- END: Pagination -->

	</div>

	<div class="nk-gap-4"></div>
	<div class="nk-gap-4"></div>