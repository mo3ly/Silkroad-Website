<? 
  /** If get pagination number for comments**/
  If ($_GET['forth']){
	  $Page = $_GET['forth'];
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
  IF ((int)$_GET['third']) {
	  $TopicID = $_GET['third'];
	  
	  $Qury = "SELECT * FROM $dbs[WEB]..ForumTopic where TopicID = '$TopicID'";
	  
	  If (!$sql->QueryHasRows($Qury)){$func->userRedirect("/error",false);}
	  
	  /** Fetch topic data **/
	  $TopicQry = $sql->query($Qury);
	  $Data = $sql->QueryFetchArray($TopicQry);
	  
	  $TopicType = $Data['TopicType'];
	  $Title = $Data['Title'];
	  $Body  = $Data['TheContent'];
	  $Owner = $Data['Owner'];
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
                    <?php $pgn->Pagination($Page,"/forum/DiscussionsTopic/".$TopicID."/",$Total);?>
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
				
				<!--Comments -->
				<h1>Comments</h1>
				<?php 
				    $Start = ($Page - 1) * $row_per_page;
				    $CommentQry = "SELECT * FROM $dbs[WEB]..ForumComments where TopicID = '$TopicID' ORDER BY Date OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
					if ($sql->QueryHasRows($CommentQry)){
					$QueryComments = $sql->Query($CommentQry);
					for ($i=1;$Comm = $sql->QueryFetchArray($QueryComments);$i++){
						$OwnReply = $Comm['Owner'];
						/** Fetch owner information **/
	                    $OwnQry = $sql->query("SELECT * FROM $dbs[WEB].._Users where Username = '$OwnReply'");
	                    $Row = $sql->QueryFetchArray($OwnQry);
	  
	                    $NickNameRe = $Row['NickName'];
	                    $OwnerImageRe = $Row['Image'];
	                    $MemSinceRe = $func->time_ago($Row['RegisterDate']);
				?>
                <li>
				
                    <div class="nk-forum-topic-author">
                        <img src="<?= $OwnerImageRe; ?>" alt="<?= $OwnReply; ?>">
                        <div class="nk-forum-topic-author-name" title="<?= $OwnReply; ?>">
                            <a href="#"><?= $OwnReply; ?></a>
                        </div>
                        <div class="nk-forum-topic-author-role"><?= $NickName; ?></div>
                        <div class="nk-forum-topic-author-since">
                            Member since <?= $MemSinceRe; ?>
                        </div><br>
						
						<!--Delete comment-->
						<? if ($OwnReply = $_SESSION['username']){?>
						<form method="POST" action="/forum/DiscussionsTopic/<?= $TopicID;?>">
                        <span class="nk-forum-action-btn">
                            <button type="submit" class="nk-btn nk-btn-md nk-btn-rounded link-effect-4 ready">Delete</button>
							<input type="hidden" value="<?= $Comm['ID'];?>" name="Delete">
                        </span>
						</form>
						<?}?>
						
                    </div>
                    <div class="nk-forum-topic-content">
                        <?= $Comm['TheContent']; ?>
                    </div>
                    <div class="nk-forum-topic-footer">
                        <span class="nk-forum-topic-date"><?= $func->time_ago($Comm['Date']); ?></span>
						
						<span class="nk-forum-action-btn">
                            <a href="#forum-reply" class="nk-anchor">
                                <span class="fa fa-reply"></span> Reply</a>
                        </span>
                        <span class="nk-forum-action-btn">
                            <span class="nk-action-heart liked">
                                <span class="num">1</span>
                                <span class="like-icon ion-android-favorite-outline"></span>
                                <span class="liked-icon ion-android-favorite"></span>
                                Like
                            </span>
                        </span>
                    </div>
                </li>
				<?php }
					} else {
						 Echo'
					  <li>
					  <h3><b class="ion-alert-circled"></b> There is no comments.</h3>
					  </li>';
					}
				?>
            </ul>
            <!-- END: Forums List -->

            
            <!-- START: Reply -->
			<?php if (isset($_SESSION['LogIn'])) { ?>
			
			<div class="nk-gap-2"></div>
            <h1>Reply</h1>
			
			<form id="forumReply" class="nk-form nk-form-ajax nk-form-style-1" onsubmit="ForumReply();return false;" method="POST">
            <div id="Forms-Reply"></div>
			<textarea id="summernote" rows="6" name="reply"  class="nk-summernote" required></textarea>
			<input type="hidden" value="<?= $TopicID;?>" name="ID">
			<input type="hidden" value="<?= $TopicType;?>" name="TopicType">
            <div class="nk-gap-1"></div>
            <button type="submit" href="#" class="nk-btn nk-btn-lg link-effect-4">Reply</button>
			</form>
			
			<?php 
			
			}else {
				
			echo'
			<div class="nk-gap-1"></div>
            <h4><b class="fa fa-reply"></b> Please, Login to be able to reply here.</h4>
            <div class="nk-gap-1"></div>';
			} ?>
            <!-- END: Reply -->
			
			<div class="nk-gap-2"></div>
			 
			<!-- START: Pagination -->
			<div class="nk-pagination nk-pagination-left">
                    <?php $pgn->Pagination($Page,"/forum/DiscussionsTopic/".$TopicID."/",$Total);?>
            </div>
            <!-- END: Pagination -->
			</div>
        </div>

        <div class="nk-gap-4"></div>
        <div class="nk-gap-4"></div>