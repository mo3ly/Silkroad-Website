<script>
	$(function() {
		$("div#ElixerLoader").html("<span class='nk-preloader-animation'></span>");
		$("#ElixerLoader").load("/alchemyaction/loadelixer/");
		
		$("div#SwitcherTokens").html("<span class='nk-preloader-animation'></span>");
		$("#SwitcherTokens").load("/alchemyaction/loadswitchers/");
	});
	
	function SwitchProgress(){
		$('#AlchemyResult').html('<span class="h6">Item is switching, Please wait..</span>');
		DisableAlchemyBtn();
		$('#StartAlchemy').html('<img src="/assets/images/item/slots/alchemy.gif" class="sox" style="width: 200%;opacity:0.5;margin-right:-15px">').fadeIn(100);
		Bar();
		
		var Choosen = document.getElementById("chooseitem").value;
		
		$("#AlchemyResult").load("/alchemyaction/switchprogress/"+Choosen+"");
		document.getElementById('LoadInv').style.pointerEvents = 'none';
		$("#LoadInv").css("opacity","0.6");
		document.getElementById("LoadPlus").disabled = true;
		document.getElementById("LoadSwitcher").disabled = true;
		
		
	}
</script>

<? if ($_GET['sup'] == 'loadplus'){ ?>
		
		<div style="border:1px solid rgba(107, 107, 107, 0.8);background:rgba(0, 0, 0, 0.6);padding:20px">
					<div style="border:1px solid rgba(255, 255, 255, 0.9);background:rgba(0, 0, 0, 0.6);padding:20px">
					
						<div class="row vertical-gap">
						
							<div class="col-xs-3">
								<div id="AlchemyItemSlot" ondrop="drop(event)" ondragover="allowDrop(event)">
									<div class="slot-back"></div>
								</div>
							</div>
							
							<div class="col-xs-9">
								<div id="AlchemyResult"><span class="h6"> Please select an item!</span></div>
							</div>
							
						</div>
					</div>
					<div class="nk-gap-1"></div>
					
					<h6>Hello this is our alchemy system on our new server, can try as good wishes  want and you have to know that this system!!</h6>
					
					<div class="nk-gap"></div>
					<div class="row vertical-gap" id="ElixerLoader"></div>
							
					<!-- Alchemy bar -->
					<div class="nk-gap-2"></div>
					<div id="AlchemyBarProgress">
						<div id="AlchemyBar"></div>
					</div>
					
		</div>
						
		<div class="nk-gap-2"></div>
		<button id='AlchemyBtn' class="nk-btn nk-btn-lg link-effect-4 nk-btn-block" onclick="AlchemyProgress();" disabled><span>Strenghten</span></button>
		
<? } ?>

<? if ($_GET['sup'] == 'loadswitcher'){ ?>

		<div style="border:1px solid rgba(107, 107, 107, 0.8);background:rgba(0, 0, 0, 0.6);padding:20px">
				<div style="border:1px solid rgba(255, 255, 255, 0.9);background:rgba(0, 0, 0, 0.6);padding:20px">
				
					<div class="row vertical-gap">
					
						<div class="col-xs-3">
							<div id="AlchemyItemSlot" ondrop="drop(event)" ondragover="allowDrop(event)">
								<div class="slot-back"></div>
							</div>
						</div>
						
						<div class="col-xs-9">
							<div id="AlchemyResult"><span class="h6"> Please select an item!</span></div>
						</div>
						
					</div>
				</div>
				<div class="nk-gap-1"></div>
				
				<center>
				<select class="form-control" name="SwitchType" id="chooseitem">
					<option>select an item!</option>
				</select>
				
				<div class="nk-gap-1"></div>
					<h6>Here you can switch your item to any other item!</h6>
				</center>
				
				<div class="nk-gap"></div>
				<div class="row vertical-gap" id="SwitcherTokens"></div>
						
				<!-- bar -->
				<div class="nk-gap-1"></div>
				<div id="AlchemyBarProgress">
					<div id="AlchemyBar"></div>
				</div>
				
			</div>
			
		<div class="nk-gap-1"></div>
		<button id='AlchemyBtn' class="nk-btn nk-btn-lg link-effect-4 nk-btn-block" onclick="SwitchProgress();" disabled><span>Switch</span></button>
		
<? } ?>