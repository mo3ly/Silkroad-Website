
			 <div class="nk-box-1 bg-dark-1">
			 <center>
			 <div class="nk-testimonial-name h4">Character logs</div>
			 <div class="nk-gap-1"></div>
			 <div class="nk-tabs">
                        <ul class="nav nav-tabs text-xs-center" role="tablist">
						
                            <li class="nav-item">
                                <a class="nav-link active" href="#Unique" role="tab" data-toggle="tab">Unique</a>
                            </li>
							
                            <li class="nav-item">
                                <a class="nav-link" href="#Pvp" role="tab" data-toggle="tab">Pvp</a>
                            </li>
							
							<li class="nav-item">
                                <a class="nav-link" href="#Global" role="tab" data-toggle="tab">Global</a>
                            </li>
							
							<li class="nav-item">
                                <a class="nav-link" href="#Achievements" role="tab" data-toggle="tab">Achieves</a>
                            </li>
							
                            <li class="nav-item">
                                <a class="nav-link" href="#Stall" role="tab" data-toggle="tab">Stall</a>
                            </li>
                       
					   </ul>
						
						
                        <div class="tab-content">
					    <!--Player ranking-->
 					    <div role="tabpanel" class="tab-pane fade in active" id="Unique">
							<div class="nk-gap"></div>
							<img  src='/pages/chars/signature.php?server=<?= $ServerName;?>&name=<?= $CharName16;?>&guild=<?= $sql->CharGuild($CharName16);?>&level=<?= $CurLevel;?>&race=<?= $sql->CharRace($CharName16);?>' />
							
						</div>
                           
						<div role="tabpanel" class="tab-pane fade" id="Pvp">
                             pvp
						</div>
						
						<div role="tabpanel" class="tab-pane fade" id="Global">
                             Global
						</div>
                        
						<div role="tabpanel" class="tab-pane fade" id="Achievements">
                             Achievements
                        </div>
						
						<div role="tabpanel" class="tab-pane fade" id="Stall">
                             Stall
                        </div>
                        
						</div>
                    </div>
			 </center>
			 </div>
