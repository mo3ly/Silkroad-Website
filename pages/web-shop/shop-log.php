<? if (isset($_SESSION['username'])){ ?>
<div id="ShopLog" class="modal nk-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalShopLog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ion-android-close"></span>
                    </button>
                    <h4 class="modal-title nk-title" id="myModalShopLog">Shop Logs</h4>
                </div>
                <div class="modal-body">
				
				<?
				$LogQuery = "SELECT DISTINCT 
							_WebShopLogs.ItemCode,
							_WebShop.ItemName,
							Sum (_WebShopLogs.Price) as Price,
							count (_WebShopLogs.ItemCode) as Quantity
							FROM 
							EPIC_WEBSITE.._WebShopLogs 
							INNER JOIN EPIC_WEBSITE.._WebShop ON _WebShopLogs.ItemCode = _WebShop.ItemCode
							where CharName = '$_SESSION[CharName]'
							group by
							_WebShopLogs.ItemCode,
							_WebShopLogs.Price,
							_WebShop.ItemName";
				$query = $sql->Query($LogQuery);
				
				$Logs = 1;
				
				if($sql->QueryHasRows($LogQuery)){
				?>
				<div style="height: 350px;overflow-y: auto;">
				<div class="table-responsive">
				<table class="table">
				<thead>
				<tr>
						<th><h5>& </h5></th>
						<th><h5>Item</h5></th>
						<th><h5>Name</h5></th>
						<th><h5>Price</h5></th>
						<th><h5>Quantity</h5></th>
				</tr>
				</thead>
				<tbody>
		
				
				<?php
				while ($Data = $sql->QueryFetchArray($query)) {
					$QueryQuantity = $sql->query("SELECT SUM (Price) as TotalPrice FROM $dbs[WEB].._WebShopLogs where CharName = '$_SESSION[CharName]'");
					$Row = $sql->QueryFetchArray($QueryQuantity);
					$Total = $Row['TotalPrice'];
				?>
					 
					<tr>
						
						<td><h6><?= $Logs; ?></td>
						<td>
							<div class="slot-back" style="margin-top:-10px">
							<div id="slot" data-iteminfo="1" style="background-image:url(<?= $sql->ItemIcon($Data['ItemCode'],true);?>)">
								<?= $sql->Is_Sox($Data['ItemCode'],true);?>
							</div>
						</div>
						</td>
						
						<td><h6><?= $Data['ItemName']; ?></h6></td>
						<td><h6><?= $Data['Price']; ?></h6></td>
						<td><h6><?= $Data['Quantity']; ?> Unit(s)</td>
						
				  </tr>
				<?php
				  $Logs++;
				}
				?>
				</tbody>
				</table>
				</div>
				</div>
				<?php
					$QueryQuantity = $sql->query("SELECT SUM (Price) as TotalPrice FROM $dbs[WEB].._WebShopLogs where CharName = '$_SESSION[CharName]'");
					$Row = $sql->QueryFetchArray($QueryQuantity);
					$Total = $Row['TotalPrice'];
				?>
				<div class="divider"></div>
				<h5>Total : <?= number_format($Total);?> WebPoint(s)</h5>
				<?
				} else {
					echo'<center><div class="nk-gap-1"></div><h3>There is no logs.</h3><div class="nk-gap-1"></div></center>';
				}
				?>
				
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- END: Modal -->
</div>
<? } ?>