<div class="nk-box-2 bg-dark-1">
<h2 style="color:orange">Web stroage</h2>
<div class="nk-gap-1"></div>

<?php
//Get data from table
$Query = $sql->Query("SELECT WebBank FROM $dbs[WEB].._Users where Username = '$_SESSION[username]'"); 
$Data  = $sql->QueryFetchArray($Query);
$Gold  = $Data['WebBank'];
?>	
			
<h4>You have [ <span style="color:orange"><?= number_format($Gold);?></span> ] gold in your bank.</h4>

<button onclick="CollectGold();" class="nk-btn nk-btn-lg link-effect-4">
	<span><b class="fa fa-money"></b> Collect</span>
</button>

<div id="WebStroNoti"></div>
			
<script>
function CollectGold(){
	$('div#WebStroNoti').load('/webstroage');
}
</script>		
					
					
					
</div>