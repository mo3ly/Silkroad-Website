<? 
  
  If ($_GET['sup']){
	  $Page = $_GET['sup'];
  } else {
	  $Page=1;
  }
  
  $AllRows =  count($sql->query("select * from $dbs[WEB].._News")->fetchAll());
  $Total = ceil($AllRows / $row_per_page);
  
  If ($AllRows > 1){
  if($Page > $Total){$func->userRedirect("/archive",false);}
  }
?>
<div class="nk-gap-4"></div>

        <div class="container">

           	<!-- START: Pagination -->
			<div class="nk-pagination nk-pagination-left">
                    <?php $pgn->Pagination($Page,"/archive/",$Total);?>
            </div>
            <!-- END: Pagination -->
			
            <div class="nk-gap-2"></div>
    
            <!-- START: Archive -->
			<h3>News Archive</h3>
            <ul class="nk-forum">
			<?php 
			$Start = ($Page - 1) * $row_per_page;

			$ForumQuery = "SELECT  * FROM $dbs[WEB].._News ORDER BY Date DESC OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
			
		    $QueryForum = $sql->query($ForumQuery);
			
			  if ($sql->QueryHasRows($ForumQuery)){
				  
				for ($i=1; $Result = $sql->QueryFetchArray($QueryForum); $i++)
			     {
					
					If ($func->Files($Result['ImageUrl'])){ $Image = $Result['ImageUrl']; } else { $Image = "/assets/images/avatar-2-sm.jpg"; }
		    ?>
                <li>
                    <div class="nk-forum-icon">
                        <span class="ion-fireball"></span>
                    </div>
					
                    <div class="nk-forum-title">
                        <h3 style="color:orange"><a href="/news/<?= $Result['ID']?>"><?= $Result['Title']?></a></h3><br>
						<h5><?= $func->text_trim($Result['Content'],'120');?></h5>
                        <div class="nk-forum-title-sub"> 
						<b class="fa fa-user"></b> Posted by <a href="/profile/user/<?= $Result['Posted_by']?>"><?= $Result['Posted_by']?></a> 
						<span class="pull-right"><b class="fa fa-calendar"></b> <?= $func->time_ago($Result['Date']); ?></span></div>
                    </div>
					
                </li>
				<div class="nk-gap-1"></div>
				<?php 
				}
				/** IF There is no result **/
				  } 
				  else 
				  {
					  Echo'
					  <li>
					  <div class="nk-gap-1"></div>
					  <h4><b class="ion-alert-circled"></b> There is no news.</h4>
					  <div class="nk-gap-1"></div>
					  </li>';
				  }
				?>
            </ul>
				  
            <!-- END: News -->

            <div class="nk-gap-2"></div>

           	<!-- START: Pagination -->
			<div class="nk-pagination nk-pagination-left">
                    <?php $pgn->Pagination($Page,"/archive/",$Total);?>
            </div>
            <!-- END: Pagination -->
			
        </div>

        <div class="nk-gap-4"></div>
        <div class="nk-gap-4"></div>