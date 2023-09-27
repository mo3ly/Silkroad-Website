<script>
function SetChar()
{
	
$("div#SetCharResult").html(" <div class='nk-preloader-animation'></div>");

$.ajax({
	url: '/webstall/setchar',
	type: 'post',
	data: jQuery('#SetChar').serialize(),
	success: function (data) {
		 $('div#SetCharResult').html(data);
	},
	error: function(jqXHR, textStatus, errorThrown) {
		alert(JSON.stringify(jqXHR));
	}		
});
}
</script>
<?  
if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}
?>  				
<div class="nk-box-2 bg-dark-1">

			<center>
			<h1 class="nk-title h3" >Set your stall character!!</h1>
			<h4 style='color:orange'>Your stall character now is [ <?= $_SESSION['CharName'] ?> ]</h4>
			</center>
			<div class="nk-gap-2"></div>

			<div id="SetCharResult"></div>
			<form id="SetChar" onsubmit="SetChar(); return false;" method="POST">
			<div class="col-md-8">
			<select name="Charname" class="form-control">
			<?= $sql->CharsByAcc($_SESSION['username']);?>
			</select>
			</div>
			
			<div class="col-md-4">
			<button type="submit" class="nk-btn nk-btn-lg link-effect-4">GO</button>
			</div>
			</form>

</div>