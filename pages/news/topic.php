<? 
  /** If get pagination number for comments**/
  If ($_GET['third']){
	  $Page = $_GET['third'];
  } else {
	  $Page=1;
  }
  
  /** If Post Delete comment **/
  
  /*If ($_POST['Delete']){
	  $DeleteID = $_POST['Delete'];
	  if($sql->query("DELETE FROM $dbs[WEB]..ForumComments where ID = '$DeleteID'");
	  $func->Notification("Your Comment delete successfully.","5");
	  $_POST = array();
  }*/
  
  /** If Get topic ID**/
  IF ((int)$_GET['sup']) {
	  $NewsID = $_GET['sup'];
	  
	  $Qury = "SELECT * FROM $dbs[WEB].._News where ID = '$NewsID'";
	  
	  If (!$sql->QueryHasRows($Qury)){$func->userRedirect("/error",false);}
	  
	  /** Fetch topic data **/
	  $TopicQry = $sql->query($Qury);
	  $Data = $sql->QueryFetchArray($TopicQry);
	  
	  $Title = $Data['Title'];
	  $Body  = $Data['Content'];
	  $Owner = $Data['Posted_by'];
	  $Date  = $Data['Date'];
	  
	  /** Fetch owner information **/
	  $OwnerQry = $sql->query("SELECT * FROM $dbs[WEB].._Users where Username = '$Owner'");
	  $Row = $sql->QueryFetchArray($OwnerQry);
	  
	  $NickName = $Row['NickName'];
	  $OwnerImage = $Row['Image'];
	  $MemSince = $func->time_ago($Row['RegisterDate']);
	  
      } else {$func->userRedirect("/forum/discussions/1",false);}
  
  /** For Pagination **/
  $AllRows =  count($sql->query("select * from $dbs[WEB]..ForumComments where TopicID = '$TopicID'")->fetchAll());
  $Total = ceil($AllRows / $row_per_page);
  
  /** Redirect when sth went wrong **/
  If ($AllRows > 1){
  if($Page > $Total){$func->userRedirect("/forum/discussions/1",false);}
  }
  
?>

<div class="nk-gap-4"></div>

        <div class="container">

            <!-- START: Pagination -->
            <div class="row">
                <div class="col-md-3 push-md-9 text-xs-right"><div class="nk-gap"></div><h6>Total Comments : <?= $AllRows ?></h6></div>
                <div class="col-md-9 pull-md-3">
                    <?php $pgn->Pagination($Page,"/forum/DiscussionsTopic/".$ID."/",$Total);?>
                </div>
            </div>
            <!-- END: Pagination -->

            <div class="nk-gap-2"></div>

            <!-- START: Forums List -->
            <ul class="nk-forum nk-forum-topic">
			 <?php if ($Page == 1){?>
                <li>
                    <div class="nk-forum-topic-author">
                        <img src="<?= $OwnerImage; ?>" alt="<?= $Owner; ?>">
                        <div class="nk-forum-topic-author-name" title="<?= $Owner; ?>">
                            <a href="#"><?= $Owner; ?></a>
                        </div>
                        <div class="nk-forum-topic-author-role"><?= $NickName; ?></div>
                        <div class="nk-forum-topic-author-since">
                            Member since <?= $MemSince; ?>
                        </div>
                    </div>
					
                    <div class="nk-forum-topic-content">
					    
						<h1 style="color:olive" class="text-xs-center"><?= $Title?></h1>
					
                        <?= $Body ?>
						
                    </div>
                    <div class="nk-forum-topic-footer">
                        <span class="nk-forum-topic-date"><?= $func->time_ago($Date); ?></span>

                        <span class="nk-forum-action-btn">
                            <a href="#forum-reply" class="nk-anchor">
                                <span class="fa fa-reply"></span> Reply</a>
                        </span>
                        <span class="nk-forum-action-btn">
                            <a href="#">
                                <span class="fa fa-flag"></span> Spam</a>
                        </span>
                        <span class="nk-forum-action-btn">
                            <span class="nk-action-heart">
                                <span class="num">18</span>
                                <span class="like-icon ion-android-favorite-outline"></span>
                                <span class="liked-icon ion-android-favorite"></span>
                                Like
                            </span>
                        </span>
                    </div>
                </li>
				<!-- End Topic -->
				
				<div class="nk-gap-2"></div>
				<?php } ?>
				
				
        </div>

        <div class="nk-gap-4"></div>
        <div class="nk-gap-4"></div>