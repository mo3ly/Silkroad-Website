<?  if (!isset($_SESSION['LogIn'])) { $func->userRedirect("/"); }
	if(!isset($_SESSION['CharName'])){
		include('/pages/stall/select-char.php');
	}else{ ?>
<script>
	$(function() {
		$("div#AlchemyType").html("<span class='nk-preloader-animation'></span>");
		$("#AlchemyType").load("/alchemypages/loadplus/");
	});
	
	function AlchemySwitch(Type){
		$("div#AlchemyType").fadeOut(200);
		$("#AlchemyType").load("/alchemypages/"+Type+"");
		$("div#AlchemyType").fadeIn(200);
	}
	
	function allowDrop(ev) {
    ev.preventDefault();
	}

	function drag(ev) {
		ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop(ev) {
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		ev.target.appendChild(document.getElementById(data));
	}
</script>
<script src="/pages/alchemy/Alchemy.js"></script>
<div class="nk-gap-3"></div>
	<div class="container">
		<div class="row">
		<div class="col-md-1"></div>
			<div class="col-md-3">
					<? include("/pages/alchemy/alchemy-item.php");?>	
			</div>
			<div class="col-md-1"></div>
			<div class="hidden-lg-up hidden-md-up">
			<div class="nk-gap-2"></div>
			</div>
			
			<div class="col-md-6">
				<div style="min-height:450px;border: 1px solid rgb(74, 71, 71);background:rgba(0, 0, 0, 0.6);padding:10px">
				<!-- TITLE -->
				<div class="nk-gap" style="height:10px"></div>
					<center><span style="text-align:center" class="h4">Alchemy Window</span></center>
				<div class="nk-gap"></div>
				
				<div class="divider"></div>
				
				<!-- START: Buttons -->
					<center>
						<a onclick="AlchemySwitch('loadplus');" id="LoadPlus" class="nk-btn nk-btn-lg link-effect-4">
									<span><b class="fa fa-plus"></b></span>
						</a>
						<a onclick="AlchemySwitch('loadswitcher');" id="LoadSwitcher" class="nk-btn nk-btn-lg link-effect-4">
									<span><b class="fa fa-flask"></b></span>
						</a>
					</center>
				<!-- END: Buttons -->
				
				
				<!--Alchemy Type-->
				<div id="AlchemyType"></div>
					
					
				</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>
<div class="nk-gap-6"></div>
<? } ?>