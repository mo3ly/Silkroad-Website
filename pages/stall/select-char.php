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
	<div class="nk-gap-1"></div>  
	<center>
	<h1>Stall!!</h1>
	<p style="color:orange">Welcome to the online stall.<br>Please select one of your characters to enter the stall with it.</p>
	</center>
	<div class="nk-gap-1"></div>    
	<div class="container">
			<div class="col-md-8 offset-md-2">
			<div id="SetCharResult"></div>
			<form id="SetChar" onsubmit="SetChar(); return false;" method="POST">
			<div class="col-md-8">
			<select name="Charname" class="form-control">
			<?= $sql->CharsByAcc($_SESSION['username']);?>
			</select>
			</div>
			
			<div class="col-md-4">
			<button type="submit" class="nk-btn nk-btn-lg link-effect-4 pull-right">Set your character</button>
			</div>
			</form>
			
			</div>
	</div>