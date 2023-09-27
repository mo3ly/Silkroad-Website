<script>
function DeleteItem(ItemID){$("#ItemBtn").load("/webstall/DeleteItem/"+ItemID);}
function HotItem(ItemID){$("#ItemBtn").load("/webstall/HotItem/"+ItemID);}
</script>
<?  
if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}

If ($_GET['sup']){
  $Page = $_GET['sup'];
} else {
  $Page=1;
}

$AllRows =  count($sql->query("SELECT * FROM $dbs[WEB].._WebStall where CharName = '$_SESSION[CharName]' ")->fetchAll());
$Total = ceil($AllRows / $row_per_page);

If ($AllRows > 1){
if($Page > $Total){$func->userRedirect("/stall",false);}
}
?>  					<div id="pagination3">
						<div class="nk-box-2 bg-dark-1">
                        <h2 class="nk-title h3" >Your items!</h2>
                        <div class="nk-gap"></div>
						
						<!-- AddItem -->
						<div id="ItemBtn"></div>
						
                        <div class="table-responsive">
                            <table class="table table-bordered">
								<?php 
								$Start = ($Page - 1) * $row_per_page;
								$qry = "SELECT * FROM $dbs[WEB].._WebStall where CharName = '$_SESSION[CharName]' order by Date DESC OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								if($sql->QueryHasRows($qry)){
								?>
									<thead>
										<tr>
											<th>Item</th>
											<th>Character</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
									$QuryStall = $sql->query($qry);
									while($Data = $sql->QueryFetchArray($QuryStall)){
									$ItemSID = $Data['ItemID'];
									$Owner = $Data['CharName'];
									?>
                                    <tr class="order">
									    <!--Item Slot-->
										<td><div class="slot-back" >
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
										<td><?= $Owner;?></td>
										<td><a style="cursor: pointer;" onclick="HotItem(<?= $ItemSID;?>);" title="Set your item as hot item for 10 silks!" class="nk-btn link-effect-4">Hot</a></td>
                                        <td><a style="cursor: pointer;" onclick="DeleteItem(<?= $ItemSID;?>);" class="nk-btn link-effect-4">Delete</a></td>
                                    </tr>
									<?php }
									}else {
										//If there is no items
										echo"<h4>You don't have any items on the stall.</h4>";
									} ?>
                                </tbody>
                            </table>
                        </div>
						<!-- START: Pagination -->
						<div class="nk-pagination nk-pagination-left">
							<?php $pgn->PaginationAjax($Page,"/stalldelete/",$Total,"pagination3","ajaxpagena");?>
						</div>
						<!-- END: Pagination -->
					</div>
					</div>