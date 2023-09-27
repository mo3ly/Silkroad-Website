    <!-- START: Features -->
        <div class="container">
            <div class="nk-gap-4"></div>
			<center><h1 class="text-center">Informations</h1></center>
            <div class="nk-gap-4"></div>
            <div class="row vertical-gap lg-gap">
                <div class="col-md-4">
                    <div class="nk-ibox">
                        <div class="nk-ibox-icon nk-ibox-icon-circle">
                            <span class="ion-ios-game-controller-b"></span>   
							<h2 style="color:#e08821" class="nk-ibox-title">Rates</h2>
                        </div>
                        <div class="nk-ibox-cont">
                            <h6><b class="fa fa-laptop"></b> Races: <?= $Races ?></h6>
							<h6><b class="fa fa-user"></b> Solo Exp Rate: <?= $SoloExp ?>x</h6>
							<h6><b class="fa fa-users"></b> Party Exp Rate: <?= $PartyExp ?>x</h6>
							<h6><b class="ion-flash"></b> Item Drop Rate: <?= $ItemRate ?>x</h6>
							<h6><b class="ion-social-usd"></b> Gold Drop Rate: <?= $GoldRate ?>x</h6>
							<h6><b class="fa fa-toggle-down" style="color:#FFF" ></b> Alchemy Rate: <?= $AlchemyRate ?>x</h6>
							<h6><b class="fa fa-exclamation"></b> PC Limit: <?= $PCLimit ?></h6>
                        </div>
                    </div>
                </div>
               
			   <div class="col-md-4">
                    <div class="nk-ibox">
                        <div class="nk-ibox-icon nk-ibox-icon-circle">
                            <span class="ion-clock"></span>
							 <h2 style="color:#e08821" class="nk-ibox-title">Timer</h2>
                        </div>
                        <div class="nk-ibox-cont">
						
                          <h6> <b class="ion-ios-clock"></b> Server Time: <span id="timerClock"></span></h6>
						  <h6> <b class="fa fa-shield"></b> Fortress Timer: <span id="castleTimer"></span></h6>
                          <h6> <b class="fa fa-pencil"></b> Fortress Register: Friday 6:00 - 10:00</h6>
						  <h6> <b class="ion-ios-time-outline"></b> Medusa Spawn: <span id="medusaTimer"></span></h6>
						  <h6> <b class="ion-trophy"></b> Roc Spawn: <span id="specialTimer"></span></h6>
						  <h6> <b class="fa fa-flag"></b> So-Ok Timer: <span id="battleParty"></span></h6>
						  <h6> <b class="ion-nuclear"></b> CTF Timer: <span id="ctfTimer"></span></h6>
                        </div>
                    </div>
                </div>
                
				<div class="col-md-4">
                    <div class="nk-ibox">
                        <div class="nk-ibox-icon nk-ibox-icon-circle">
                            <span class="ion-fireball"></span>
							     <h2 style="color:#e08821" class="nk-ibox-title">History</h2>
                        </div>
                        <div class="nk-ibox-cont">
                       <script>
					   function SwitchIcon(Ico){
							if ($("#"+Ico+"").hasClass('fa-toggle-down')){
								$("#"+Ico+"").removeClass('fa-toggle-down').addClass('fa-toggle-up');
							}else if ($("#"+Ico+"").hasClass('fa-toggle-up')){
								$("#"+Ico+"").removeClass('fa-toggle-up').addClass('fa-toggle-down');
							} 
					   }
					   </script>
								<!-- Fortress History -->
								<h6>Fortress History <a data-toggle="collapse" data-parent="#accordion" href="#Fortress"><b id="FwIco" onclick="SwitchIcon('FwIco');" class="fa fa-toggle-down" style="color:#FFF" ></b></a></h6>
								<div id="Fortress" class="panel-collapse collapse fade">
									<?php
									
									// Hotan fortress
									$HotanQry = $sql->Query("SELECT GuildID, TaxRatio FROM $dbs[SHARD]..[_SiegeFortress] WHERE FortressID = '3' ");
									$HnRow = $sql->QueryFetchArray($HotanQry);
									$HotanID  = $HnRow['GuildID'];
									$HotanTax = $HnRow['TaxRatio'];
									
									$HotanNameQry = $sql->Query("SELECT Name FROM $dbs[SHARD]..[_Guild] WHERE ID = '$HotanID'");
									$HtnData = $sql->QueryFetchArray($HotanNameQry);
									if ($HtnData['Name'] == "dummy"){
										$HotanFotress = "No Guild";
									} else {
										$HotanFotress = $HtnData['Name'];
									}
									
									// Janjan fortress
									$JanjanQry = $sql->Query("SELECT GuildID, TaxRatio FROM $dbs[SHARD]..[_SiegeFortress] WHERE FortressID = '1' ");
									$JnRow = $sql->QueryFetchArray($JanjanQry);
									$JanjanID  = $JnRow['GuildID'];
									$JanjanTax = $JnRow['TaxRatio'];
									
									$JanjanNameQry = $sql->Query("SELECT Name FROM $dbs[SHARD]..[_Guild] WHERE ID = '$JanjanID'");
									$JnData = $sql->QueryFetchArray($JanjanNameQry);
									if ($JnData['Name'] == "dummy"){
										$JanjanFotress = "No Guild";
									} else {
										$JanjanFotress = $JnData['Name'];
									}
									
									// Bandit fortress
									$BanditQry = $sql->Query("SELECT GuildID, TaxRatio FROM $dbs[SHARD]..[_SiegeFortress] WHERE FortressID = '6' ");
									$BnRow = $sql->QueryFetchArray($BanditQry);
									$BanditID  = $BnRow['GuildID'];
									$BanditTax = $BnRow['TaxRatio'];
									
									$BaanditNameQry = $sql->Query("SELECT Name FROM $dbs[SHARD]..[_Guild] WHERE ID = '$BanditID'");
									$BnData = $sql->QueryFetchArray($BaanditNameQry);
									if ($BnData['Name'] == "dummy"){
										$BanditFotress = "No Guild";
									} else {
										$BanditFotress = $BnData['Name'];
									}
									
									?>
									<h6 style="font-size: 0.9rem;"><b class="fa fa-shield"></b> Hotan Fotress: <a href="/profile/guild/<?= $HotanID?>"><?= $HotanFotress?></a> </h6>
									<h6 style="font-size: 0.9rem;"><b class="fa fa-flag"></b> Janjan Fotress: <a href="/profile/guild/<?= $JanjanID?>"><?= $JanjanFotress?></a> </h6>
									<h6 style="font-size: 0.9rem;"><b class="fa fa-flag"></b> Bandit Fotress: <a href="/profile/guild/<?= $BanditID?>"><?= $BanditFotress?></a>  </h6>
								</div>
								<!-- END: Fortress History -->
							
								<!-- START: Unique History -->
								<h6>Unique History <a data-toggle="collapse" data-parent="#accordion" href="#UQHistory"><b id="UQIco" onclick="SwitchIcon('UQIco');" class="fa fa-toggle-down" style="color:#FFF" ></b></a></h6>
								<div id="UQHistory" class="panel-collapse collapse fade">
									<?php
										$Query = "SELECT TOP 10 * FROM $dbs[ACC]..Evangelion_uniques Order by time DESC";
										if ($sql->QueryHasRows($Query)){
										$UniquesQuery = $sql->query($Query);
										while ($UQData = $sql->QueryFetchArray($UniquesQuery)){
										$QueryName = $sql->query("SELECT TOP 1 Mob_Name FROM $dbs[WEB].._RefNames where Mob_Code = '$UQData[MobName]'");
										if($Row = $sql->QueryFetchArray($QueryName)){
											$MobName = $Row['Mob_Name'];
										} else {
											$MobName = $UQData['MobName'];
										}
										
										/** Mo2kt **/
										switch($UQData['MobName']){
										case 'MOB_CH_TIGERWOMAN' : $mob = "Tiger Girl"; break;
										case 'MOB_RM_ROC' : $mob = "Roc"; break;
										case 'MOB_OA_URUCHI' : $mob = 'Uruchi'; break;
										case 'MOB_KK_ISYUTARU' : $mob = 'Isyutaru'; break;
										case 'MOB_RM_TAHOMET' : $mob = 'Demon Shaitan'; break;
										case 'MOB_TK_BONELORD' : $mob = 'Lord Yarkan'; break;
										case 'MOB_EU_KERBEROS' : $mob = 'Cerberus'; break;
										case 'MOB_AM_IVY' : $mob = 'Captain Ivy'; break;
										case 'MOB_CH_TIGERWOMAN_STR' : $mob = "Tiger Girl [STR]"; break;
										case 'MOB_OA_URUCHI_STR' : $mob = 'Uruchi [STR]'; break;
										case 'MOB_KK_ISYUTARU_STR' : $mob = 'Isyutaru [STR]'; break;
										case 'MOB_RM_TAHOMET_STR' : $mob = 'Demon Shaitan [STR]'; break;
										case 'MOB_TK_BONELORD_STR' : $mob = 'Lord Yarkan [STR]'; break;
										case 'MOB_EU_KERBEROS_STR' : $mob = 'Cerberus [STR]'; break;
										case 'MOB_AM_IVY_STR' : $mob = 'Captain Ivy [STR]'; break;
										case 'MOB_SD_NEITH' : $mob = 'Neith'; break;

										case 'MOB_SD_HAROERIS' : $mob = 'Haroeris'; break;
										case 'MOB_SD_ANUBIS' : $mob = 'Anubis'; break;
										case 'MOB_SD_SELKIS' : $mob = 'Selkis'; break;
										case 'MOB_SD_ISIS' : $mob = 'Isis'; break;
										case 'MOB_RM_TAHOMET' : $mob = 'Tahoment'; break;
										case 'MOB_ARABIA_GIANT_DEMON' : $mob = 'Giant Demon'; break;
										case 'MOB_ARABIA_GIANT_DEMON' : $mob = 'Giant Demon'; break;
										case 'MOB_FW_TAESE_045' : $mob = 'Big Demon'; break;
										case 'MOB_FW_TAESE_050' : $mob = 'Monster Demon'; break;
										
										default : $mob = $UQData['MobName'];
										}
									?>
									
									<h6 style="font-size: 0.9rem;"><b class="fa fa-star"></b> <a href="/profile/charid/<?= $sql->CharID($UQData['CharName']);?>"><?= $UQData['CharName'];?></a> killed [ <?= $mob?> ] <?= $func->time_ago($UQData['time']);?>.</h6>
									
									<?php   }
											} else {
									?>
									<h6>Sorry there isn't any uniques log!!</h6>
									<?php	} ?>
									<div class="nk-gap"></div>
								</div>
								
								<!-- END: Unique History -->
								
								<!-- Statics -->
                                <h6>Job Statics <a data-toggle="collapse" data-parent="#accordion" href="#Statics"><b id="StaticIco" onclick="SwitchIcon('StaticIco');" class="fa fa-toggle-down" style="color:#FFF" ></b></a></h6>
                                <div id="Statics" class="panel-collapse collapse fade">
                                    <div class="row vertical-gap">
										<?php
										
										//Trader
										$TraderQuery = $sql->query("SELECT COUNT (*) AS [Trader] FROM $dbs[SHARD]..[_CharTriJob] WHERE [JobType] = 1");
										$TraderData = $sql->QueryFetchArray($TraderQuery);
										$Trader = $TraderData['Trader'];
										
										//Thief
										$ThiefQuery = $sql->query("SELECT COUNT (*) AS [Thief] FROM $dbs[SHARD]..[_CharTriJob] WHERE [JobType] = 2");
										$ThiefData = $sql->QueryFetchArray($ThiefQuery);
										$Thief = $ThiefData['Thief'];
										
										//Hunter
										$HunterQuery = $sql->query("SELECT COUNT (*) AS [Hunter] FROM $dbs[SHARD]..[_CharTriJob] WHERE [JobType] = 3");
										$HunterData = $sql->QueryFetchArray($HunterQuery);
										$Hunter = $HunterData['Hunter'];
										
										?>
                                        <div class="col-md-4">
                                            <div class="nk-counter-2">
                                                <div class="nk-count" style="font-size:2rem"><?= $Thief;?></div>
												<h6>Thief</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="nk-counter-2">
                                                <div class="nk-count" style="font-size:2rem"><?= $Hunter;?></div>
                                                <h6>Hunter</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="nk-counter-2">
                                                <div class="nk-count" style="font-size:2rem"><?= $Trader?></div>
                                                <h6>Trader</h6>
                                            </div>
                                        </div>
									  <div class="nk-gap"></div>
                                    </div>
                                </div>
							<!-- End Statics -->
							
							<!-- Top One -->
							<h6>Top One <a data-toggle="collapse" data-parent="#accordion" href="#TopOne"><b id="TopOneICo" onclick="SwitchIcon('TopOneICo');" class="fa fa-toggle-down" style="color:#FFF" ></b></a></h6>
							<div id="TopOne" class="panel-collapse collapse fade">
								<h6 style="font-size: 0.9rem;"><b class="fa fa-trophy"></b> Player: <a href="/">Anixo</a></h6>
								<h6 style="font-size: 0.9rem;"><b class="fa fa-trophy"></b> UniqueKiller: <a href="/">HellWar</a></h6>
								<h6 style="font-size: 0.9rem;"><b class="fa fa-trophy"></b> Pvper: <a href="/">Madonna</a> </h6>
							</div>
							<!-- END: Top One -->
							
						</div> 	   
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Information -->
		<div class="nk-gap-4"></div><div class="nk-gap-4"></div>
		 <!-- START: Rev Slider -->
		
		<center><h1 class="text-center">Gallery</h1></center>
        <div class="nk-gap-6"></div> <div class="nk-gap-1"></div>
        <div class="mnt-80">
            <div id="rev_slider_50_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="photography-carousel48" style="padding:0px;">
                <div id="rev_slider_50_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.0.7">
                    <ul>
                        <!-- SLIDE  -->
                        <li data-index="rs-185" data-transition="slideoverhorizontal" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="assets/images/gallery-3-thumb.jpg" data-rotate="0" data-saveperformance="off">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/gallery-3.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        </li>
                        <!-- SLIDE  -->
                        <li data-index="rs-192" data-transition="slideoververtical" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="assets/images/gallery-5-thumb.jpg" data-rotate="0" data-saveperformance="off">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/gallery-5.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        </li>
                        <!-- SLIDE  -->
                        <li data-index="rs-186" data-transition="slideoverhorizontal" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="assets/images/gallery-4-thumb.jpg" data-rotate="0" data-saveperformance="off">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/gallery-4.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        </li>
                        <!-- SLIDE  -->
                        <li data-index="rs-183" data-transition="slideoververtical" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="assets/images/gallery-1-thumb.jpg" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off">
                            <!-- MAIN IMAGE -->
                            <img src="assets/images/gallery-1.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        </li>
                    </ul>
                    <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                </div>
            </div>
        </div>
		<div class="nk-gap-2"></div>
        <!-- END: Rev Slider -->
		