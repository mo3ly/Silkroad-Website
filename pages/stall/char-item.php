<script>
function AddItem(ItemID){$("#AddItemBtn").load("/webstall/AddItem/"+ItemID);}
</script>
<?  
if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}

If ($_GET['sup']){
  $Page = $_GET['sup'];
} else {
  $Page=1;
}

$AllRows =  count($sql->query("
SELECT c.CharName16, i.*, r.CodeName128, it.ID64
FROM $dbs[SHARD].._Inventory i 
JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
WHERE  Slot >= '13' 
and c.CharName16 = '$_SESSION[CharName]' and ItemID <> 0 
ORDER BY Slot asc")->fetchAll());
$Total = ceil($AllRows / $row_per_page);

If ($AllRows > 1){
if($Page > $Total){$func->userRedirect("/stall",false);}
}
?>  					<div id="pagination2">
						<div class="nk-box-2 bg-dark-1">
                        <h2 class="nk-title h3" >Add Item</h2>
                        <div class="nk-gap"></div>
						
						<!-- AddItem -->
						<div id="AddItemBtn"></div>
						
                        <div class="table-responsive">
                            <table class="table table-bordered">
								<?php 
								$Start = ($Page - 1) * $row_per_page;
								$qry = "
								SELECT c.CharName16, i.*, r.CodeName128, it.ID64
								FROM $dbs[SHARD].._Inventory i 
								JOIN $dbs[SHARD].._Items it on i.ItemID = it.ID64 
								JOIN $dbs[SHARD].._RefObjCommon r on it.RefItemID = r.ID 
								LEFT JOIN $dbs[SHARD].._RefObjItem ri on r.Link = ri.ID 
								JOIN $dbs[SHARD].._Char c on i.CharID = c.CharID
								WHERE  Slot >= '13' 
								and c.CharName16 = '$_SESSION[CharName]' and ItemID <> 0 
								ORDER BY Slot asc  OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								if($sql->QueryHasRows($qry)){
								?>
									<thead>
										<tr>
											<th>Item</th>
											<th>CharName</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
									$QuryStall = $sql->query($qry);
									while($Data = $sql->QueryFetchArray($QuryStall)){
									$ItemSID = $Data['ItemID'];
									$Owner = $Data['CharName16'];
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
                                        <td><a style="cursor: pointer;" onclick="AddItem(<?= $ItemSID;?>);" class="nk-btn link-effect-4">Add</a></td>
                                    </tr>
									<?php }
									}else {
										//If there is no items
										echo'<h4>There is no items on the inventory</h4>';
									} ?>
                                </tbody>
                            </table>
                        </div>
						<!-- START: Pagination -->
						<div class="nk-pagination nk-pagination-left">
							<?php $pgn->PaginationAjax($Page,"/stallchar/",$Total,"pagination2","koka");?>
						</div>
						<!-- END: Pagination -->
					</div>
					</div>