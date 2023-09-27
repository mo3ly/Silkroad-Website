<div class="nk-box-1 bg-dark-1">
			 
			<!--Character items Inventory-->
			<div id="idInventorySet" style="display: block;">
							
							<center>
							<div class="nk-testimonial-name h4">Items Inventory</div>
							<div class="nk-gap"></div>
							<!--<img src="/assets/images/chars/thief.gif" data-mouse-parallax-z="3" style="opacity:0.5;margin-bottom:-310px;margin-right:100px">-->
							<img src="/assets/images/chars/monkey.png" data-mouse-parallax-z="3" style="width:60%;opacity:0.5;margin-bottom:-310px;margin-right:100px">
							
							<div class="row equal-height">
							
							<?php
							$charID = (int)$_GET['sup'];
							$queryItems = $sql->query("
							SELECT * FROM $dbs[SHARD].._Inventory WHERE CharID = '$charID' and Slot in(0,1,2,3,4,5,6,7,9,10,11,12) ORDER BY 
							(CASE Slot
							WHEN 7 THEN 1
							WHEN 6 THEN 2
							WHEN 2 THEN 3
							WHEN 0 THEN 4
							WHEN 3 THEN 5
							WHEN 1 THEN 6
							WHEN 5 THEN 7
							WHEN 4 THEN 8
							WHEN 9 THEN 9
							WHEN 10 THEN 10
							WHEN 12 THEN 11
							WHEN 11 THEN 12

							ELSE 100 END)");
							echo'';
							while ($query = $sql->QueryFetchArray($queryItems)){
							$Slota = $query['Slot'];
							$ItemSID = $query['ItemID'];
							
							?>
							
							<!--Start loop for slots-->
							<div class="col-xs-6 pull-right">
							
							<div class="slot-back" style="background-image:url(<?= $instance->EmptySlot($ItemSID,$Slota)?>)">
							<div id="slot" data-itemInfo="1"   
							style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);">
							    <?= $sql->Is_Sox($ItemSID);?>
								<span class="info"><?= $sql->Item_Amount($ItemSID);?></span>
							</div>
							<div class="itemInfo">
							<? include('/main/iteminfo.php');?>
							</div>
							
							</div>
							
							<div class="nk-gap"></div>
							</div>
							
						    <?php }  ?>
							
							</div>
                            </div>
							</center>
							
							
	
							
			<!--Avatar Inventory-->
			<div id="idAvatarSet" style="display: none;">
			
							<center>
							<div class="nk-testimonial-name h4">Avatar Inventory</div>
							<div class="nk-gap"></div>
							<img src="/assets/images/chars/shild.png"  data-mouse-parallax-z="3" style="opacity:0.5;margin-bottom:-210px;margin-left:20px;width:20%">
							<div class="row equal-height">
                            <?php
							$queryItems = $sql->query("
							SELECT * FROM $dbs[SHARD].._InventoryForAvatar WHERE CharID = '$charID' and Slot in(0,1,2,3,4) ORDER BY 
							(CASE Slot
							WHEN 3 THEN 0
							WHEN 3 THEN 1
							WHEN 0 THEN 2
							WHEN 1 THEN 3
							WHEN 4 THEN 4

							ELSE 100 END)");
							while ($query = $sql->QueryFetchArray($queryItems)){
							$Slota = $query['Slot'];
							$ItemSID = $query['ItemID'];
							
							?>
							
							<!--Start loop for slots-->
							<div class="col-xs-6 pull-left">
							<div class="slot-back">
							<div id="slot" data-itemInfo="1"   
							style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);">
							    <?= $sql->Is_Sox($ItemSID);?>
								<span class="info"><?= $sql->Item_Amount($ItemSID);?></span>
							</div>
							
							<div class="itemInfo">
							<? include('/main/iteminfo.php');?>
							</div>
							
							</div>
							
							<div class="nk-gap"></div>
							</div>
							
						    <?php }  ?>
							
                            </div>

							</center>
			</div>
						    
			<div class="nk-gap-1"></div>
			<div id="idShowSet" >
				            <center><button id="idInventoryButton" data-type="Avatar" class="nk-btn nk-btn-lg link-effect-4" style="display: block;">Avatar Inventory
						    </button></center>
						    <center><button id="idAvatarButton" data-type="Inventory" class="nk-btn nk-btn-lg link-effect-4" style="display: none;">Items Inventory
		                    </button></center>
            </div>
							
</div>
<script type="text/javascript">jQuery('#idShowSet button').click(function(){sType=jQuery(this).data('type');jQuery('#idAvatarSet,#idAvatarButton,#idInventorySet,#idInventoryButton').hide('blind',function(){jQuery(this).removeClass('hidden')});jQuery('#id'+sType+'Set,#id'+sType+'Button').show('blind');});</script>