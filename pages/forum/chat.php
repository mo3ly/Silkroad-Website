<script type="text/javascript" src="/assets/js/chat.js"></script>
       <div class="row">
        <div class="col-md-12">
			<div class="chat-box">
			
			  <!-- Chat Head -->
			  <div class="chat-head">
			  <div class="row lg-gap">
			  <div class="col-xs-6">
			   <h3><b class="ion-chatbubble"></b> Chat</h3>
			  </div>
			  <div class="col-xs-6">
                <span class="nk-badge" style="cursor:pointer;" title="Show chat box." data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><b class="fa fa-arrow-down"></b></span>
			  </div>
			  </div>
			  </div>
			  <div class="panel-collapse collapse" id="collapseOne">
			  <!-- Chat Content -->
                <div class="panel-body" id="ScrollBar">
                    <ul class="chat">
					<div id="CheckUpdate"></div>
					    <center>
						<h6>Welcome, <?= $_SESSION['username']?>.</h6>
						<span class="nk-badge" style="padding: 0px 6px 20px 5px;"><h6><?= date('d M Y');?></h6></span>
						
						<span class="nk-badge" style="cursor:pointer;background-color: #000000;" title="Move to the last message." onclick="ChatEnd();"><b class="fa fa-arrow-down"></b></span>
						</center>
                        
						<div id="ChatUpdate">
						<center><br><h4>Please wait,Chat is loading...</h4></center>
						</div>
						
                    </ul>
                </div>
				
				<!-- Chat footer-->
				<div class="chat-end">
				<form method="POST" onsubmit="ChatSend();return false;" id="SendChat">
				<div class="input-group">
					
					<input type="text" id="msg" name="msg" placeholder="write your message here..." maxLength='100' class="form-control input-sm" autocomplete="off"/>
					<span class="input-group-btn">
						<button type="submit" class="nk-btn nk-btn-lg link-effect-4 ready active">Send</button>
					</span>
				</div>
				</form>
				</div>
				<!--End Chat footer-->
				</div>
				</div>
		   </div>
		</div>