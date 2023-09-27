       <!-- START: RANKING -->
 

        <div class="nk-gap-4"></div>
       
	    <div class="container">
		 <div class="nk-tabs">  
		 
		 <div class="col-md-3">
		        <ul  style=" -webkit-padding-start: 0px;" role="tablist">
					<a href="#intro" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Introduction</span>
					</a>
					<a href="#player" onclick="RankLoader('player');" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Players</span>
					</a>
					<a href="#unique" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Unique</span>
					</a>
					<a href="#pvp" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>PvP</span>
					</a>
					<a href="#job" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Job</span>
					</a>
					<a href="#Alchemy" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Alchemy</span>
					</a>
					
					<a href="#guild" onclick="RankLoader('guild');" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Guilds</span>
					</a>
					<a href="#union" role="tab" data-toggle="tab" class="nk-btn nk-btn-block nk-btn-lg link-effect-4">
                                <span>Unions</span>
					</a>
				</ul>
		</div>
		<script>
		function RankLoader(Type){
			var Loading = '<center> <h3>Loading, please wait...</h3><br> <span class="nk-preloader-animation"></span> </center>';
			$("#Load"+Type).html(Loading);
			$("#Load"+Type).load("/"+Type+"rank");
		}
		</script>
		<div class="col-md-9">
		 <div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="intro">
				<? include('/pages/ranking/intro.php'); ?>
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="player">
				<div id="Loadplayer"></div>
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="unique">
				<div id="UniquesLoad"></div>
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="pvp">
			    pvp
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="job">
               job
			</div>
			<div role="tabpanel" class="tab-pane fade" id="Alchemy">
               Alchemy
			</div>
			<div role="tabpanel" class="tab-pane fade" id="guild">
               <div id='Loadguild'></div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="union">
               union
			</div>
			
		 </div>
		</div>
			
	
    	</div>
	   </div>
		
        <div class="nk-gap-2"></div>
        <div class="nk-gap-4"></div>
     <!-- END: RANKING -->