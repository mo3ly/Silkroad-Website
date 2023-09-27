<?php
if(!isset($_SESSION['username'])){
	$func->userRedirect("/");
}

include('/pages/web-shop/shop-log.php'); 
include('/pages/web-shop/shop-cart.php');		
?>
<script>
	$( document ).ready(function() {
		$("#WebSections").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
		$("#WebSections").load("/webshop/");
		setInterval(function(){ $('#cartcount').load('/shopaction/countcart'); } , 1000);
	});
	
	function ShopLoader (Name){
		$("#WebSections").html(" <h3><center>Loading please wait...</center></h3><br><span class='nk-preloader-animation'></span>");
		$.ajax({
			url: "/webshop/"+Name+"",
			type: 'post',
			data: "action="+Name+"",
			success: function (data) {
				 $("#WebSections").html(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(JSON.stringify(jqXHR));
			}		
		});
	}
	
	function Submetor(url,div,form){
		
		$.ajax({
			url: ''+url+'',
			type: 'post',
			data: jQuery('#'+form+'').serialize(),
			success: function (data) {
				 $('#'+div+'').html(data);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert(JSON.stringify(jqXHR));
			}		
		});
		
	}
</script>
<style>
	div.nk-widget-post:hover { 
		background-color:rgba(0, 0, 0, 0.6);
	}
	.pointer {
		cursor:pointer;
	}
	.shop-box {
		background-color:rgba(0, 0, 0, 0.25);
		padding: 10px;
	}
	div.item-box:hover {
		background-color:rgba(0, 0, 0, 0.9);
		box-shadow: 0px 0px 10px rgba(181,109,25,0.5);
	}
	
	.item-box {
		background-color:rgba(0, 0, 0, 0.3);
		padding: 10px;
	}
</style>
<div style="background: url(/assets/images/shop/dragon.ng);background-repeat:no-repeat;">
<div class="nk-gap-3"></div>
<div class="container">
	<div class="row">
		<!-- Information -->
		<div class="col-lg-12">
				<span class="h5">Welcome <?= $_SESSION['CharName'];?>.</span><br>
				<span style="color: #878584;">Balance <?= number_format($sql->UserPoints($_SESSION['username'],"Web"));?> WebPoint</span>
				
				<!-- ADMIN -->
				<? if ($sql->Admin($_SESSION['username'],$Gm_Number)){ ?>
					<br>
					<span class="pointer link-effect-4 h6" data-toggle="modal" data-target="#AddItemModal"><b class="fa fa-plus-circle"></b> Add an Item</span>
					<? include('/pages/web-shop/add-item.php'); ?>
				<? } ?>
				
				<br><span class="pointer link-effect-4 h6" data-toggle="modal" data-target="#ShopLog"><b class="fa fa-area-chart"></b> Shop Log</span>
				
				
				<br><span onclick="Submetor('/shopaction/loadcart','LoadCart','none')" class="pointer h6" data-toggle="modal" data-target="#ShopCart">
				<b id="cartcount"></b><b class="fa fa-shopping-cart"></b> Shop Cart
				</span>
					
				<div class="nk-gap"></div>
		</div>
		
		<!-- Sections -->
		<div class="col-lg-4">
			<div class="nk-widget" style="height: 550px;overflow-y: auto;">
					
					<div class="shop-box">
						<h4 class="nk-widget-title">SHOP SECTIONS</h4>
						
						<!-- Hot -->
						<div class="nk-widget-post">
							<a class="nk-image-box-1 nk-post-image">
								<img src="assets/images/shop/hot.png" alt="">
							</a>
							<h3 class="nk-post-title"><a class="pointer" onclick="ShopLoader('hot');">HOT</a></h3>
							<div class="nk-post-meta-date">Get your rare items.</div>
						</div>
						
						<!-- Avatars -->
						<div class="nk-widget-post">
							<a class="nk-image-box-1 nk-post-image">
								<img src="assets/images/shop/devil.png" alt="">
							</a>
							<h3 class="nk-post-title"><a data-toggle="collapse" data-target="#CollapseAvatar" href="#">AVATARS</a></h3>
							
							<div id="CollapseAvatar" class="collapse">
								<h6>
								<span class="pointer" onclick="ShopLoader('devil');"><b class="fa fa-caret-right"></b> Devil</span><br>
								<span class="pointer" onclick="ShopLoader('dress');"><b class="fa fa-caret-right"></b> Dress</span><br>
								<span class="pointer" onclick="ShopLoader('hat');"><b class="fa fa-caret-right"></b> Hat</span><br>
								<span class="pointer" onclick="ShopLoader('attach');"><b class="fa fa-caret-right"></b> Attach</span>
								</h6>
							</div>
							
							<div class="nk-post-meta-date">Find your cool avatar.</div>
						</div>
						
						<!-- Pets -->
						<div class="nk-widget-post">
							<a class="nk-image-box-1 nk-post-image">
								<img src="assets/images/shop/pet.png" alt="">
							</a>
							<h3 class="nk-post-title"><a class="pointer" onclick="ShopLoader('pets');">PETS</a></h3>
							<div class="nk-post-meta-date">Buy your big pet.</div>
						</div>
						
						<!-- Equipment -->
						<div class="nk-widget-post">
							<a class="nk-image-box-1 nk-post-image">
								<img src="assets/images/shop/equip.png" alt="">
							</a>
							<h3 class="nk-post-title"><a href="#" data-toggle="collapse" data-target="#CollapseEquip">GEARS</a></h3>
							<div id="CollapseEquip" class="collapse">
							
								<h6 style="margin-bottom:0rem" class="pointer" data-toggle="collapse" data-target="#CollapseEquipEur"><b class="fa fa-circle"></b> Europen</h6>
								<div id="CollapseEquipEur" class="collapse">
									<span class="pointer" onclick="ShopLoader('weaponeu');"><b class="fa fa-caret-right"></b> EUR Weapons</span><br>
									<span class="pointer" onclick="ShopLoader('equipeu');"><b class="fa fa-caret-right"></b> EUR Equipment</span><br>
									<span class="pointer" onclick="ShopLoader('accessoryeu');"><b class="fa fa-caret-right"></b> EUR Accessory</span>
								</div>
								
								<h6 style="margin-bottom:0rem" class="pointer" data-toggle="collapse" data-target="#CollapseEquipChn"><b class="fa fa-circle"></b> Chines</h6>
								<div id="CollapseEquipChn" class="collapse">
									<span class="pointer" onclick="ShopLoader('weaponch');"><b class="fa fa-caret-right"></b> CHN Weapons</span><br>
									<span class="pointer" onclick="ShopLoader('equipch');"><b class="fa fa-caret-right"></b> CHN Equipment</span><br>
									<span class="pointer" onclick="ShopLoader('accessorych');"><b class="fa fa-caret-right"></b> CHN Accessory</span>
								</div>
							</div>
							
							<div class="nk-post-meta-date">Look for your item.</div>
						</div>
						
						<!-- Others -->
						<div class="nk-widget-post">
							<a class="nk-image-box-1 nk-post-image">
								<img src="assets/images/shop/others.png" alt="">
							</a>
							<h3 class="nk-post-title"><a class="pointer" onclick="ShopLoader('others');">OTHERS</a></h3>
							<div class="nk-post-meta-date">Here other items.</div>
						</div>

					</div>
			</div>
		</div>
		
		<!-- END: SECTIONS -->
		<div class="hidden-lg-up">
				<div class="nk-gap-2"></div>
		</div>
		
		<!--START: MAIN SHOP -->
		<div class="col-lg-8">
			<div class="nk-widget" style="height: 550px;overflow-y: auto;">
				<div id="WebSections"></div>
			</div>
		</div>
		<!-- END: MAIN SHOP -->
		
	</div>
</div>
<div class="nk-gap-6"></div>
<div class="nk-gap-3"></div>
</div>