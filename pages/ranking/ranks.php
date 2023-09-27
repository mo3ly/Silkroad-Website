       <!-- START: RANKING -->
 
        <div class="nk-gap-4"></div>
       
	    <div class="container">
		 <div class="col-md-12">
                    <div class="nk-tabs">
                        <ul class="nav nav-tabs" role="tablist">
						
                            <li class="nav-item">
                                <a class="nav-link active" href="#player" role="tab" data-toggle="tab">Player</a>
                            </li>
							
                            <li class="nav-item">
                                <a class="nav-link" href="#unique" role="tab" data-toggle="tab">Unique</a>
                            </li>
							
                            <li class="nav-item">
                                <a class="nav-link" href="#pvp" role="tab" data-toggle="tab">Pvp</a>
                            </li>
                       
					   </ul>
						
						
                        <div class="tab-content">
                      
					    <!--Player ranking-->
 					    <div role="tabpanel" class="tab-pane fade in active" id="player">
							<?php include_once __DIR__ . '../../ranking/player.php'; ?>
						</div>
                           
						<div role="tabpanel" class="tab-pane fade" id="unique">
                             <?php include_once __DIR__ . '../../ranking/unique.php'; ?>
						</div>
                        
						<div role="tabpanel" class="tab-pane fade" id="pvp">
                                
                        </div>
                        
						</div>
                    </div>
					
		 </div>
		</div>
        
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
        <!-- END: RANKING -->