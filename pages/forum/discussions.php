<? 
  
  If ($_GET['third']){
	  $Page = $_GET['third'];
  } else {$Page=1;}
  
  $AllRows =  count($sql->query("select * from $dbs[WEB]..ForumTopic where TopicType = 'discussion'")->fetchAll());
  $Total = ceil($AllRows / $row_per_page);
  
  If ($AllRows > 1){
  if($Page > $Total){$func->userRedirect("/forum/discussions/1",false);}
  }
?>
<div class="nk-gap-4"></div>

        <div class="container">

            <!-- START: Pagination -->
            <div class="row">
               
			   <div class="col-md-3 push-md-9 text-xs-right">
                    <a href="#" class="nk-btn nk-btn-lg link-effect-4">New Topic</a>
                </div>
                   
				    <div class="col-md-9 pull-md-3">
                      <?= $pgn->Pagination($Page,"/forum/discussions/",$Total);?>
                    </div>
					
                
            </div>
            <!-- END: Pagination -->

			<div class="nk-gap-2"></div>
			
			<!-- START: Pined topic -->
			<h3>Pined Topics</h3>
            <ul class="nk-forum">
			<?php 
			
			$PinedQuery = "SELECT TOP 5  * FROM EPIC_WEBSITE..ForumTopic Where Pin = 'Yes' ORDER BY Date ";
		    $QueryForumPined = $sql->query($PinedQuery);
			  if ($sql->QueryHasRows($PinedQuery)){
				for ($i=1; $Result = $sql->QueryFetchArray($QueryForumPined); $i++)
			     {
		    ?>
                <li>
                    <div class="nk-forum-icon">
                        <span class="ion-pin"></span>
                    </div>
                    <div class="nk-forum-title">
                        <h3><a href="/forum/DiscussionsTopic/<?= $Result['TopicID']?>"><?= $Result['Title']?></a></h3>
                        <div class="nk-forum-title-sub"> <b class="fa fa-user"></b> Posted by <a href="#"><?= $Result['Owner']?></a> 
						<b class="fa fa-calendar"></b> <?= $func->time_ago($Result['Date']); ?></div>
                    </div>
                    <div class="nk-forum-count">
                        178 posts
                    </div>
                    <div class="nk-forum-activity-avatar">
                        <img src="/assets/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                    </div>
                    <div class="nk-forum-activity">
                        <div class="nk-forum-activity-title" title="Lesa Cruz">
                            <a href="#">Lesa Cruz</a>
                        </div>
                        <div class="nk-forum-activity-date">
                            September 11, 2016
                        </div>
                    </div>
                </li>
				<?php 
				}
				/** IF There is no result **/
				  } 
				  else 
				  {
					  Echo'
					  <li>
					  <div class="nk-gap-1"></div>
					  <h4><b class="ion-alert-circled"></b>There is pined topics.</h4>
					  <div class="nk-gap-1"></div>
					  </li>';
				  }
				?>
            </ul>
            <!-- END: Pined Topics -->
			
            <div class="nk-gap-2"></div>
    
            <!-- START: Normal topic -->
			<h3>Normal topics</h3>
            <ul class="nk-forum">
			<?php 
			$Start = ($Page - 1) * $row_per_page;

			$ForumQuery = "SELECT  * FROM $dbs[WEB]..ForumTopic where TopicType = 'Discussion' ORDER BY Date OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
			
		    $QueryForum = $sql->query($ForumQuery);
			
			  if ($sql->QueryHasRows($ForumQuery)){
				  
				for ($i=1; $Result = $sql->QueryFetchArray($QueryForum); $i++)
			     {
					/** Comments Fetch data fuck my english **/
					$Comments =  count($sql->query("select * from $dbs[WEB]..ForumComments where TopicType = 'discussion' and TopicID = '".$Result['TopicID']."'")->fetchAll());
					$QuryComment = "SELECT TOP 1 * FROM $dbs[WEB]..ForumComments Where TopicType = 'discussion' and TopicID = '".$Result['TopicID']."' order by Date Desc";
					IF ($sql->QueryHasRows($QuryComment)){
						$CommentQury = $sql->query($QuryComment);
						$CommData = $sql->QueryFetchArray($CommentQury);
						$CommOwner = $CommData['Owner'];
						$CommTime = date('d,M,Y', strtotime($CommData['Date']));
					}else {
						$CommOwner = "Sorry, There";
						$CommTime = "is no Comments";
					}
					
					
					If ($func->Files($Result['Image'])){ $Image = $Result['Image']; } else { $Image = "/assets/images/avatar-2-sm.jpg"; }
		    ?>
                <li>
                    <div class="nk-forum-icon">
                        <span class="ion-pin"></span>
                    </div>
					
                    <div class="nk-forum-title">
                        <h3><a href="/forum/DiscussionsTopic/<?= $Result['TopicID']?>"><?= $Result['Title']?></a></h3>
                        <div class="nk-forum-title-sub"> <b class="fa fa-user"></b> Posted by <a href="/profile/user/<?= $Result['Owner']?>"><?= $Result['Owner']?></a> 
						<b class="fa fa-calendar"></b> <?= $func->time_ago($Result['Date']); ?></div>
                    </div>
					
                    <div class="nk-forum-count">
                        <?= $Comments;?> <b class="ion-chatbox"></b>
                    </div>
					
                    <div class="nk-forum-activity-avatar">
                        <img src="<?= $Image?> " alt="<?= $Result['Title'] ?>">
                    </div>
					
                    <div class="nk-forum-activity">
                        <div class="nk-forum-activity-title" title="">
                            <a href="#"><?= $CommOwner;?></a>
                        </div>
                        <div class="nk-forum-activity-date">
                            <?= $CommTime;?>
                        </div>
                    </div>
                </li>
				<?php 
				}
				/** IF There is no result **/
				  } 
				  else 
				  {
					  Echo'
					  <li>
					  <div class="nk-gap-1"></div>
					  <h4><b class="ion-alert-circled"></b> There is no topics.</h4>
					  <div class="nk-gap-1"></div>
					  </li>';
				  }
				?>
            </ul>
				  
            <!-- END: Normal Topic -->

            <div class="nk-gap-2"></div>

            <!-- START: Pagination -->
            <div class="row">
                <div class="col-md-3 push-md-9 text-xs-right">
                    <a href="#" class="nk-btn nk-btn-lg link-effect-4">New Topic</a>
                </div>
                <div class="col-md-9 pull-md-3">
                    <?= $pgn->Pagination($Page,"/forum/discussions/",$Total);?>
                </div>
            </div>
            <!-- END: Pagination -->
        </div>

        <div class="nk-gap-4"></div>
        <div class="nk-gap-4"></div>