<style>

/* Style applied to the spin button once a power has been selected */
.clickable
{
    cursor: pointer;
}

.diabled-spin {
	cursor:not-allowed;
	border-radius:4px
}
img:hover {
	background-image:url('/assets/images/spin/treasure-hover.png');
}
.treasure-effect{
animation: updown 200ms infinite alternate;
}

@keyframes updown { 
0%{
transform: translate(15px,15px);
}
100%{
transform: translate(0px,0px);
}
}
</style>
<?
if (!isset($_SESSION['LogIn'])){$func->userRedirect("/");}
?>

<? $TreasuresCount = "3";?>

<div class="nk-gap-3"></div>
<div class="container">
<h2 style="text-align:center">Treasure Box</h2>
<div class="nk-gap-2"></div>

<div id="MainTreasure"></div>
<div class="row vertical-gap">

<center>

<? for($T=1;$T <= $TreasuresCount;$T++){ ?>

<div class="col-xs-4">
<div id="Treasure<?= $T?>"></div>
<img id="TreasureBox<?= $T?>" style="margin-left:20px" onclick="OpenTreasure(<?= $T?>);" class="clickable" src="/assets/images/spin/closed-box.png">
</div>

<? } ?>

</center>
</div>
</div>

<?
	$q = $sql->query("select TOP 1 * from $dbs[WEB].._SpinLog where Username=:Username order by Date desc",array('Username'=>$_SESSION['username']));
	$qr = $q->fetchAll();
	$spinned = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) > $spinEvery ? 0 : 1 : 0;
	$lastSpin = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) : $spinEvery+1;
	
	$RemminingTime = $spinEvery - $lastSpin;
?>
<script>
function OpenTreasure(ID){
	 
	var Opened = "<?=$spinned?>";
	
	if(Opened == 1)
	{
		$('div#MainTreasure').html('<center><h3 style="color:darkred">Sorry you opened your box today, you have to wait <?= $RemminingTime;?> hours.</h3></center>');
		return;
	}else{
		$("#TreasureBox"+ID).addClass("treasure-effect");
		
		setTimeout(function(){
			$("#TreasureBox"+ID).removeClass("treasure-effect");
			document.getElementById('TreasureBox'+ID).src = 'assets/images/spin/box.png';
			TreasurePrize(ID);
		},3000); 
	}
	
 }
function TreasurePrize(ID)
            {
				$.ajax({
					url: '/spinreward/Treasure',
					type: 'post',
					data: 'treasure=true&number='+ID+'',
					success: function (data) {
						$('div#Treasure'+ID).html(data);
						window.setTimeout(function() {
						window.location.reload();
						}, 5000);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert(jqXHR);
					}		
				});
            }
 </script>

<div class="nk-gap-6"></div>