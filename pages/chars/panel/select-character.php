<!-- START: SELECT CHARACTER -->
<div class="nk-box bg-dark-1">
<div class="bg-image bg-image-parallax op-5" style="background-image: url('assets/images/image-.jpg');"></div>
<div class="nk-gap-3"></div>
<div class="container">
<div class="row">
<h2> SELECT ONE OF YOUR CHARACTERS</h2>
<div id="SetCharResult"></div>
<div class="nk-gap-1"></div>
<?
$Query = "SELECT * FROM $dbs[SHARD].._Char tb1, $dbs[SHARD].._User tb2 WHERE tb1.CharID = tb2.CharID AND tb2.UserJID = (select JID from $dbs[ACC]..TB_User where StrUserID = '$_SESSION[username]' ) ";
//Check there is chars!
if ($sql->QueryHasRows($Query)){
?>
<script>
function SelectChar(CharName)
{
	$.ajax({
		url: '/webstall/setchar',
		type: 'post',
		data: 'Charname='+CharName+'',
		success: function (data) {
			 $('div#SetCharResult').html(data);
		}		
	});
}
</script>
<div class="nk-carousel-2 nk-carousel nk-carousel-no-margin nk-carousel-all-visible" data-arrows="true">
	<div class="nk-carousel-inner">
	
	<?
	//Execute the query
	$QueryExec = $sql->query($Query);
	while($Data = $sql->QueryFetchArray($QueryExec))	
	{
		$CharName = $Data['CharName16'];
		$CharImage = $Data["RefObjID"];
	?>
		
		<div>
			<div>
				<div class="nk-image-box-4 nk-no-effect">
					<a style="cursor:pointer" onclick="SelectChar('<?= $CharName;?>')" class="nk-image-box-link"></a>
				   <img src="/assets/images/chars/<?= $CharImage; ?>.gif" alt="" class="nk-img-fit">
					<div class="nk-image-box-overlay nk-image-box-bottom">
						<div>
							<h3 class="nk-image-box-title h4 mb-20"><?= $CharName;?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div>
			<div>
				<div class="nk-image-box-4 nk-no-effect">
					<a class="nk-image-box-link"></a>
				   <img  alt="" class="nk-img-fit">
					<div class="nk-image-box-overlay nk-image-box-bottom">
						<div>
							<h3 class="nk-image-box-title h4 mb-20"></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<? } ?>
		
	</div>
</div>
<?
} else {
?>
<div class="nk-gap-1"></div>
<h4 style="color:darkred">Sorry, you have to create a character!</h4>
<? } ?>
</div>
</div>
<!-- END: SELECT CHARACTER -->
<div class="nk-gap-4"></div>
<div class="nk-gap-4"></div>
