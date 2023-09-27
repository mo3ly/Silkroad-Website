<?  
//Check user online or no
if(!isset($_SESSION['LogIn'])){
	$func->userRedirect("/account/tickets");
}

//Get the ticket id
$TicketID = (int)$_GET['third'];

// If not admin do this
if (!$sql->Admin($_SESSION['username'],$Gm_Number)){

// Check if the user own this ticket
if (!$sql->QueryHasRows("SELECT * FROM $dbs[WEB].._Tickets where ID = '$TicketID' and StrUserID = '$_SESSION[username]'")){
	$func->userRedirect("/");
}

}

?>  			
<script>
function TicketMsgSend()
{

$.ajax({
	url: '/ticket/AddMessage',
	type: 'post',
	data: jQuery('#SendTicketMsg').serialize(),
	success: function (data) {
		 $('#MessageTicket').val('');
		 UpdateTicket(<?= $TicketID;?>);
		 TicketEnd();
	},
	error: function(jqXHR, textStatus, errorThrown) {
		alert(JSON.stringify(jqXHR));
	}		
});
}

//load notification count unread function
function UpdateTicket(ID)
{
$("#TicketUpdate").load("/ticket/Update/"+ID);
}
<? if ($sql->Admin($_SESSION['username'],$Gm_Number)){ ?>
//Close the ticket
function CloseTicket(ID)
{
$("#TicketProccess").load("/ticket/Close/"+ID);
}

//Open the ticket
function OpenTicket(ID)
{
$("#TicketProccess").load("/ticket/Open/"+ID);
}
<?}?>
//Chat end buttun
function TicketEnd(){
$('#TicketScrollBar').stop().animate({
scrollTop: $('#TicketScrollBar')[0].scrollHeight
}, 800);
}

//Update chat every 1 second
jQuery(document).ready(function() {
	setInterval(function(){ UpdateTicket(<?= $TicketID;?>) }, 1000);
	setInterval(function(){ TicketEnd() }, 20000);
});
</script>								
	<div class="nk-gap-3"></div>    
	  <div class="container">
		<div class="row">
          <div class="col-md-12">
		  
		    <center>
			<h6>Welcome, <?= $_SESSION['username']?>.</h6>
			<a title="Hide/Show Main ticket." data-toggle="collapse" data-parent="#accordion" href="#MainTicket"><b class="fa fa-arrow-down"></b> Show the main ticket.</a>
			
			<div class="panel-collapse collapse" id="MainTicket">
						<?php
						$Qry = $sql->query("SELECT * FROM $dbs[WEB].._Tickets where ID = '$TicketID'");
						$Data = $sql->QueryFetchArray($Qry);
						$Content = $Data['Ticket'];
						?>
						<div class="nk-gap"></div>
						<div style="border-radius:5px;background-color:rgb(21, 21, 21);border:1px solid #3c3a38;padding-top: 20px;">
						<h4><b class="ion-chatbubble"></b> Category [ <?= $Data['Category'];?> ]</h4>
						<?= $Content;?>
						</div>
						<div class="nk-gap-2"></div>
			</div>
			</center>
		
			<div class="chat-box">
		    <!-- Ticket Head -->
			<div class="chat-head">
		        <div class="row lg-gap">
				  <div class="col-xs-6">
						<?php
							//Ticket status
							if ($Data['Status'] == 0){
								$Status = "<em style='color:#a00000;font-weight:bold'>Not Solved</em>";
							} else {
								$Status = "<em style='color:#00a009;font-weight:bold'>Solved</em>";
							}
						?>
						<h3><b class="ion-chatbubble"></b> Ticket <?= $Status?></h3>
				  </div>
				  <div class="col-xs-6">
						<span class="nk-badge" style="cursor:pointer;" title="Hide/Show ticket box." data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><b class="fa fa-arrow-down"></b></span>
				  </div>
			    </div>
			</div>
			<div class="panel-collapse collapse in" id="collapseOne">
			  <!-- Ticket Content -->
                <div class="panel-body" id="TicketScrollBar">
                  <ul class="chat">
					<div id="CheckTicketUpdate"></div>
					    <center>
						<span class="nk-badge" style="padding: 0px 6px 20px 5px;"><h6><?= date('d M Y');?></h6></span>
						
						<span class="nk-badge" style="cursor:pointer;background-color: #000000;" title="Move to the last message." onclick="TicketEnd();"><b class="fa fa-arrow-down"></b></span>
						</center>
                        
						<div id="TicketUpdate">
						<center><br><h4>Please wait, Ticket is loading...</h4></center>
						</div>
						
                    </ul>
                </div>
				
				<? if(($Data['Status'] == 0)){?>
				<!-- Ticket footer-->
				<div class="chat-end">
				<form method="POST" onsubmit="TicketMsgSend();return false;" id="SendTicketMsg">
				<div class="input-group">
					
					<input type="text" id="MessageTicket" name="MessageTicket" placeholder="write your message here..." maxLength='150' class="form-control input-sm" autocomplete="off"/>
					<input type="hidden" name="TicketID" value="<?= $TicketID;?>">
					<span class="input-group-btn">
						<button type="submit" class="nk-btn nk-btn-lg link-effect-4 ready active">Send</button>
					</span>
					
				</div>
				</form>
				</div>
				<!--End Ticket footer-->
				<? } ?>
				</div>
				</div>
				
				<!-- Show admin buttons-->
				<? if ($sql->Admin($_SESSION['username'],$Gm_Number)){ ?>
					<div class="nk-gap"></div>
					<center>
					<div id="TicketProccess"></div>
					<button class="nk-btn nk-btn-lg link-effect-4 ready active" onclick="CloseTicket(<?= $TicketID;?>);">Close ticket </button>
					<button class="nk-btn nk-btn-lg link-effect-4 ready active" onclick="OpenTicket(<?= $TicketID;?>);">Open ticket </button>
					<center>
				<? } ?>
				
		   </div>
		</div>
	</div>
	<div class="nk-gap-4"></div>
	<div class="nk-gap-3"></div>