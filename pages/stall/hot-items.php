		<?
		$qry = "SELECT TOP 10 * FROM $dbs[WEB].._WebStall where HotItem = '1' Order by Date DESC";
		if($sql->QueryHasRows($qry)){
		?>
		<div class="col-md-12">
		<center><h2>Hot Items!! <a title="Hide/Show Hot Items." data-toggle="collapse" data-parent="#accordion" href="#HoItems"><b class="fa fa-arrow-down"></b></a></h2></center>
		<!-- START: Hitroducts -->
            <div class="nk-gap-1"></div>
			<div class="panel-collapse collapse" id="HoItems">
            <div class="nk-store nk-carousel-2 nk-carousel-x2 nk-carousel-no-margin nk-carousel-all-visible">
                <div class="nk-carousel-inner">
				
				<?php
					$QueryHot = $sql->query($qry);
					for($x = 1;$x <= $Data = $sql->QueryFetchArray($QueryHot); $x++){
					$ItemSID = $Data['ItemID'];
					$Owner = $Data['CharName'];
					$CharID = $sql->CharID($Owner);
					$Price = $sql->PriceType($Data['ItemID']);
					$Time = $Data['Date'];
					
					if ($x == 1){
						$Fresh = "<h6 style='color:darkred'>Fresh!!</h6>";
					} else {
						$Fresh = "";
					}
				?>
									
                    <div>
                        <div>
                            <div class="nk-product">
                                <div>
								<!--class="nk-img-stretch"-->
                                    <a class="nk-product-image">
									<center>
										<?= $Fresh;?>
										<div class="slot-back" >
										<div id="slot" data-itemInfo="1"   
										style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);">
											<?= $sql->Is_Sox($ItemSID);?>
											<span class="info"><?= $sql->Item_Amount($ItemSID);?></span>
										</div>
										<div class="itemInfo">
										<? include('/main/iteminfo.php');?>
										</div>
										
										</div>
									</center>
                                    </a>
									
                                    <h2 style="margin-top: 20px;" class="nk-product-title h5"><a href="/profile/charid/<?= $CharID;?>"><?= $Owner;?></a></h2><br>

									<h2 style="margin-top: 20px;" class="nk-product-title h5"><?= $Price;?></h2><br>
									 
                                    <button class="nk-btn link-effect-4" onclick="Buy(<?= $ItemSID;?>);">Buy</button>

										
                                </div>
                            </div>
                            <div class="nk-gap-4"></div>
                        </div>
                    </div>
					<? } ?>
                </div>
            </div>
			</div>
			<div class="nk-gap-2"></div>
            <!-- END: Related Products -->
			</div>
		<?  } ?>