function Bar() {
	var elem = document.getElementById("AlchemyBar"); 
	var width = 0;
	var id = setInterval(frame, 30);
	function frame() {
		if (width >= 100) {
			clearInterval(id);
		} else {
			width++; 
			elem.style.width = width + '%'; 
		}
	}
}

function AllowInventory (){
	document.getElementById('LoadInv').style.pointerEvents = 'auto';
	$("#LoadInv").css("opacity","1");
}

function AlchemyProgress(){
	$('#AlchemyResult').html('<span class="h6">Item is Fusing, Please wait..</span>');
	DisableAlchemyBtn();
	$('#StartAlchemy').html('<img src="/assets/images/item/slots/alchemy.gif" class="sox" style="width: 200%;opacity:0.5;margin-right:-15px">').fadeIn(100);
	Bar();
	$("#AlchemyResult").load("/alchemyaction/alchemyprogress");
	document.getElementById('LoadInv').style.pointerEvents = 'none';
	$("#LoadInv").css("opacity","0.6");
	document.getElementById("LoadPlus").disabled = true;
	document.getElementById("LoadSwitcher").disabled = true;
}

function Inventory(Num){
	$("#LoadingInv").html("<div class='nk-preloader-animation'></div>");
	$('#LoadInv').load('/alchemyitem/'+Num+'');
}

function LoadItem(ItemID){
	if (ItemID != 0){
		$("#chooseitem").load("/alchemyaction/chooseitem");
		$('#AlchemyItemSlot').load('/alchemyaction/loaditem/'+ItemID+'');
		document.getElementById("AlchemyBar").style.width = '0%';
		document.getElementById("AlchemyBtn").disabled = false;
		$("#AlchemyBtn").addClass('nk-btn-color-main-1');
	}
}

function DisableAlchemyBtn (){
	document.getElementById("AlchemyBtn").disabled = true;
	$("#AlchemyBtn").removeClass('nk-btn-color-main-1');
}

function EnableAlchemyBtn (){
	document.getElementById("AlchemyBtn").disabled = false;
	$("#AlchemyBtn").addClass('nk-btn-color-main-1');
}

function DisableAlchemy(){
	document.getElementById("AlchemyBtn").disabled = true;
	$("#AlchemyBtn").removeClass('nk-btn-color-main-1');
	document.getElementById("AlchemyBar").style.width = '0%';
	AllowInventory();
}

function Msg(Div , Msg){
	$("#"+Div+"").html(""+Msg+"");
}