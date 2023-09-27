<script>
function Buy(ItemID){$("#buy").load("/webstall/BuyItem/"+ItemID);}
$(function(){
      $('#sort_select').on('change', function () {
          var url = $(this).val(); 
          if (url) { // require a URL
			  $("#pagination").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
              $("#pagination").load("/mainstall/"+url); // redirect
          }
          return false;
      });
    });
</script>
<?  
if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}
	

If ($_GET['third']){
  $Page = $_GET['third'];
} else {
  $Page = 1;
}

//Switch quries
$Sup = $_GET['sup'];

if($Sup == "Weapon"){
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall where ItemType = 'weapon'")->fetchAll());
} elseif ($Sup == "Set"){
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall where ItemType = 'Set'")->fetchAll());
} elseif ($Sup == "Shield"){
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall where ItemType = 'Shield'")->fetchAll());
} elseif ($Sup == "Accessory"){
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall where ItemType = 'Accessory'")->fetchAll());
} elseif ($Sup == "Other"){
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall where ItemType = 'Other'")->fetchAll());
} elseif ($Sup == "all") {
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall")->fetchAll());
} else {
	$AllRows =  count($sql->query("select * from $dbs[WEB].._WebStall")->fetchAll());
}

$Total = ceil($AllRows / $row_per_page);

If ($AllRows > 1){
if($Page > $Total){$func->userRedirect("/stall",false);}
}
?>			
						<div id="pagination">
						<div id="buy"></div>
						<div class="nk-box-2 bg-dark-1">
						
						<div class="row lg-gap">
						<div class="col-xs-6"><h2 class="nk-title h3" >Stall</h2>
						</div>
						<div class="col-xs-2"></div>
						<div class="col-xs-4">
						<select class="nk-btn nk-btn-lg link-effect-4 ready" id="sort_select">
						<option value="/all">Sorty by</option>
						<option value="/all">All</option>
						<option value="/Weapon">Weapon</option>
						<option value="/Set">Set</option>
						<option value="/Shield">Shield</option>
						<option value="/Accessory">Accessory</option>
						<option value="/Other">Others</option>
						</select>
						</div>
						</div>
						<h6 style="color:orange">[ <?= $AllRows;?> ] item on [ <?= $Sup;?> ] Corner</h6>
                        <div class="nk-gap"></div>
						
                        <div class="table-responsive">
                            <table class="table table-bordered">
								<?php 
								$Start = ($Page - 1) * $row_per_page;
								// Switch quries
								if($Sup == "Weapon"){
									$qry = "SELECT * FROM $dbs[WEB].._WebStall where ItemType = 'weapon' Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								} elseif ($Sup == "Set"){
									$qry = "SELECT * FROM $dbs[WEB].._WebStall where ItemType = 'Set' Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								} elseif ($Sup == "Shield"){
									$qry = "SELECT * FROM $dbs[WEB].._WebStall where ItemType = 'Shield' Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								} elseif ($Sup == "Accessory"){
									$qry = "SELECT * FROM $dbs[WEB].._WebStall where ItemType = 'Accessory' Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								} elseif ($Sup == "Other"){
									$qry = "SELECT * FROM $dbs[WEB].._WebStall where ItemType = 'Other' Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								} elseif ($Sup == "all") {
									$qry = "SELECT * FROM $dbs[WEB].._WebStall Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								}else{
									$qry = "SELECT * FROM $dbs[WEB].._WebStall Order by Date DESC  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								}
								if($sql->QueryHasRows($qry)){
								?>
									<thead>
										<tr>
											<th>Item</th>
											<th>Owner</th>
											<th>Price</th>
											<th>Time</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
									$QuryStall = $sql->query($qry);
									while($Data = $sql->QueryFetchArray($QuryStall)){
									$ItemSID = $Data['ItemID'];
									$Owner = $Data['CharName'];
									$CharID = $sql->CharID($Owner);
									$Price = $sql->PriceType($ItemSID);
									$Time = $Data['Date'];
									?>
                                    <tr class="order">
									    <!--Item Slot-->
										<td>
										<div class="slot-back" style="margin-top:-10px">
										<div id="slot" data-itemInfo="1"   
										style="background-image:url(<?= $sql->ItemIcon($ItemSID);?>);">
											<?= $sql->Is_Sox($ItemSID);?>
											<span class="info"><?= $sql->Item_Amount($ItemSID);?></span>
										</div>
										<div class="itemInfo">
										<? include('/main/iteminfo.php');?>
										</div>
										
										</div>
										</td>
										
										<td><h6 style='font-size:15px;margin-bottom:0rem;'><a href="/profile/charid/<?= $CharID;?>"><?= $Owner;?></a></h6></td>
                                        <td><?= $Price;?></td>
                                        <td><h6 style='font-size:15px;margin-bottom:0rem;'><?= $func->time_ago($Time);?></div></td>
                                        <td><a style="cursor: pointer;margin-top:-10px" onclick="Buy(<?= $ItemSID;?>);" class="nk-btn link-effect-4">Buy</a></td>
                                    </tr>
									<?php }
									}else {
										//If there is no items
										echo'<h4>There is no items on the stall</h4>';
									} ?>
                                </tbody>
                            </table>
                        </div>
						<!-- START: Pagination -->
						<div class="nk-pagination nk-pagination-left">
							<?php $pgn->PaginationAjax($Page,"/mainstall/$Sup/",$Total,"pagination","ajaxpagn");?>
						</div>
						<!-- END: Pagination -->
                      </div>
					</div>