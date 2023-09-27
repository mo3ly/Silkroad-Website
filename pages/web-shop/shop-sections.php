<?php
$Sections = array("hot","devil","dress","hat","attach","pets","others","weaponeu","equipeu","accessoryeu","weaponch","equipch","accessorych");
$Sort = $_GET['sup'];
if (in_array($Sort, $Sections)){
	$Section = $Sort;
} else {
	$Section = "hot";
}
	
If ($_GET['third']){
  $Page = $_GET['third'];
} else {
  $Page = 1;
}
$AllRows =  count($sql->query("SELECT * FROM $dbs[WEB].._WebShop where Sort = '$Section' order by Date DESC")->fetchAll());

$Total = ceil($AllRows / $row_per_page);
if ($AllRows > 1){
	if($Page > $Total){$func->userRedirect("/shop",false);}
}
?>

<div id="pagination">
<div class="shop-box">
	<h4 class="nk-widget-title" style="margin-bottom: 0px;">ITEM SHOP</h4>
	<span style="color: #878584">There is [ <?= $AllRows;?> ] item(s) on this section.</span>
	
	<div class="row vertical-gap">
	
	<?php
	$Start = ($Page - 1) * $row_per_page;
	$ShopQuery = "SELECT * FROM $dbs[WEB].._WebShop where Sort = '$Section' order by Date DESC OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
	if($sql->QueryHasRows($ShopQuery)){
		$QueryExec = $sql->query($ShopQuery);
		while ($Data = $sql->QueryFetchArray($QueryExec)){
		if ($Data['Gender'] == "male"){
			$Gender = "(M)";
		} else if ($Data['Gender'] == "female"){
			$Gender = "(F)";
		} else {
			$Gender = "";
		}
	?>
	<!-- ITEM -->
		<div id="ShopResult"></div>
		<div class="col-lg-6 col-md-6">
			<div class="item-box">
				<div class="row vertical-gap">
					<div class="col-xs-6">
						<div class="slot-back">
							<div id="slot" data-iteminfo="1" style="background-image:url(<?= $sql->ItemIcon($Data['ItemCode'],true);?>)">
								<?= $sql->Is_Sox($Data['ItemCode'],true);?>
							</div>
						</div>
					</div>
					
					<div class="col-xs-6" style="padding-top: 32px;">
						<h6 style="margin-bottom:0px"><?= $Data['ItemName'];?> <?= $Gender?></h6>
						<h6 style="margin-top:5px;color: #bd8100;"><?= number_format($Data['Price']);?> Web Points</h6>
					</div>
					
				</div>
				
				<div class="divider"></div>
				<p style="color:#878584;min-height:50px">
						<?= $Data['Description'];?>
				</p>
				
				<button class="nk-btn nk-btn-md link-effect-4" onclick="Submetor('/shopaction/buy/<?= $Data['ID']?>','ShopResult','none');"><span>Buy</span></button>
				&nbsp; 
				<button class="nk-btn nk-btn-md nk-btn-color-main-1  link-effect-4" onclick="Submetor('/shopaction/cartadd/<?= $Data['ID'];?>','ShopResult','none')"><span><b class="fa fa-cart-plus"></b> </span></button>
				
				<? if ($sql->Admin($_SESSION['username'],$Gm_Number)){ ?>
				&nbsp; 
				<button class="nk-btn nk-btn-md link-effect-4" onclick="Submetor('/adminshop/delete/<?= $Data['ID'];?>','ShopResult','none');"><span>Delete</span></button>
				<? } ?>
				
			</div>
		</div>
	<? 
		}
		} else {
			echo'<div class="nk-gap-2"></div><div class="col-lg-6"><h4>There is no items on the shop!</h4></div>';
		}
	?>
		
	
	</div>
</div>

<!-- START: Pagination -->
<div class="nk-pagination nk-pagination-left">
	<?php $pgn->PaginationAjax($Page,"/webshop/$Section/",$Total,"pagination","paginator");?>
</div>
<!-- END: Pagination -->
</div>