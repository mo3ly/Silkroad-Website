  <!-- START: Test imonials -->
 
 <div class="nk-gap-4"></div>
       <center><h1 class="text-center">Latest News</h1></center>
       
        <div class="nk-gap-2"></div>
        <div class="nk-carousel-2" data-autoplay="12000" data-dots="true">
            <div class="nk-carousel-inner">
			
			<?php
			
			$Count = 1;
			// Select Query
			
			$News_Query = "SELECT TOP 5 * FROM EPIC_WEBSITE.._News ORDER BY ID DESC";
			
			$NewsQuery = $sql->Query($News_Query);
			
			If ($sql->QueryHasRows($News_Query) == true) {
				
		    while( $data = $sql->QueryFetchArray($NewsQuery)){
				
				$time = $data['Date'];
                $time = $func->time_ago($time);
				$Author = $data['Posted_by'];
				$NewsTitle = $data['Title'];
				$NewsImageUrl = $data['ImageUrl'];
				$Content = $func->text_trim($data['Content'],'150','...');
				
				If ($Count == 1){
					$NewsStatu_s = "<span style='color:red;font-size:12px'> New!</span>";
				} else {
					$NewsStatu_s = "";
				}
                ?>				
			      <div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-photo" style="background-image: url('<?= $NewsImageUrl ?>');"></div>
                            <div class="nk-testimonial-body">
							    <div class="nk-testimonial-name h2"><b class="ion-fireball"></b> <?=$NewsTitle ?> <?=$NewsStatu_s ?></div>
								<div class="nk-testimonial-source"><b class="fa fa-pencil"></b> Posted by: <?= $Author ?> </div><br>
                                <em><?= $Content ?></em>
                            </div>
                           <div class="nk-testimonial-source"><b class="fa fa-calendar"></b> <?= $time ?></div><br>
                            
							<a style="color:white" href="news/<?=$data['ID'] ?>"><button class="nk-btn">Read More</button></a>
                        </blockquote>
                    </div>
                </div>
				<?php
				$Count++;
			}
			} else 
			{
				echo'<div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-body">
							    <div class="nk-testimonial-name h2"><b class="ion-fireball"></b> No News</div>
								<div class="nk-testimonial-source"><b class="fa fa-pencil"></b> Posted by: Admin </div><br>
                                <em>There is no news. The admin might add news soon.</em>
                            </div>
                           <div class="nk-testimonial-source"><b class="fa fa-calendar"></b> Today</div><br>
                            
							
                        </blockquote>
                    </div>
                </div>';
			}
			?>
               
               
            </div>
        </div>

        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        <!-- END: Testimonials -->