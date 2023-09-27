<div class="nk-box-1 bg-dark-1" >
			
			  <center>
			  <div class="nk-testimonial-name h4">Character Information</div>
			  <div class="nk-gap"></div>
			  
			  <img data-mouse-parallax-z="2" 
			  src="<?= $CharImage ?>" style="opacity:0.5;border-radius:10px;border:1px solid black;margin-bottom:-400px">
			  
			  
			  
			  <div class="row equal-height">
                <div class="col-xs-6">
				
				<span class="h5" style="color:olive">HEALTH</span><br> 
			    <span class="h6" title="<span class='h6'>Str : <?= $Str?></span>"><b class="fa fa-heart"></b> <?= $Health ?></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">LEVEL</span><br> 
			    <span class="h6"><b class="fa fa-legal"></b> <?= $CurLevel?> 
				<span style="font-size:12px;color:orange"><?= number_format($next_level, 2);?>%</span></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive" title="<span class='h6'>This char has 100 job points.</span>">JOB</span><br> 
			    <span class="h6" title="<span class='h6'>Level [ <?= $sql->JobType($CharName16,true);?> ]</span>"><b class="fa fa-bomb"></b> <?= $sql->JobType($CharName16);?> 
				<span style="font-size:12px;color:orange"><?= $NickName?></span></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">TITLE</span><br> 
			    <span class="h6"><b class="fa fa-star"></b> <?= $sql->CharTitle($CharName16,$TitleID);?> </span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">PVP POINTS</span><br> 
			    <span class="h6"><b class="fa fa-key"></b> 90
				<span style="font-size:12px;color:orange">point(s)</span></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">LAST LOGOUT</span><br> 
			    <span class="h6"><b class="fa fa-sign-out"></b> <?= $LastLogOut?></span>
			    <div class="nk-gap"></div>
				
				</div>
				
                <div class="col-xs-6">
				
				<span class="h5" style="color:olive">MANA</span><br> 
			    <span class="h6" title="<span class='h6'>Int : <?= $Int?></span>"><b class="fa fa-flask"></b> <?= $Mana ?></span>
			    <div class="nk-gap"></div>
			  
			  
				<span class="h5" style="color:olive">RACE</span><br> 
			    <span class="h6"><b class="fa fa-shield"></b> <?= $sql->CharRace($CharName16);?></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">Guild</span><br> 
			    <span class="h6"><b class="fa fa-flag"></b> <?= $sql->CharGuild($CharName16);?> 
				<span style="font-size:12px;color:orange">Lvl <?= $sql->CharGuild($CharName16,true);?> </span></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">SOX PARTS</span><br> 
			    <span class="h6"><b class="fa fa-plus"></b> <?= $sql->SoxParts($charID);?> 
				<span style="font-size:12px;color:orange">part</span></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">ITEM POINTS</span><br> 
			    <span class="h6" title="<?= $sql->PlayerPoints($charID);?>"><b class="fa fa-globe"></b> <?= $sql->PlayerAllPoints($charID);?>
				<span style="font-size:12px;color:orange">point(s)</span></span>
			    <div class="nk-gap"></div>
				
				<span class="h5" style="color:olive">STATUS</span><br> 
			    <span class="h6"><b class="fa fa-shield"></b> <?= $sql->CharStatus($CharName16,true);?></span>
			    <div class="nk-gap"></div>
			  
			    </div>
			  
              </div>
			  </center>
			  
			  
</div>