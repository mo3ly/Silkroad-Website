<?php

    $GuildID = (int)$_GET['third'];

    if(!empty($GuildID)){
	   
    $qryGuild = $sql->query("SELECT * FROM $dbs[SHARD]..[_Guild] WHERE [ID] = '$GuildID'");
    $CheckAvaliable = count($sql->query("SELECT * FROM $dbs[SHARD]..[_Guild] WHERE [ID] = '$GuildID' ")->fetchAll()); 
	
	if (!$CheckAvaliable == 0){
		
        $Data = $sql->QueryFetchArray($qryGuild);
		$originalDate = $Data['FoundationDate'];
		$FoundDate = date('d.M.Y', strtotime($originalDate));
		
		//Get members
		$MembersNumQry = $sql->query("select count (*) as num from $dbs[SHARD].._GuildMember where GuildID='$GuildID'");
		$Row = $sql->QueryFetchArray($MembersNumQry);
		$Members = $Row['num'];
	} else {
		$func->userRedirect("/error",false);
	}
	
    } else {
		$func->userRedirect("/error",false);
	}
	?>

  <div class="nk-gap-3"></div>
	<div class="container">
	<!-- Guild Information -->
	<div class="col-md-3" >
	<div class="nk-box bg-dark-1">
	  <img src="/assets/images/chars/eur.png" style="margin-bottom:-350px;width:90%;opacity:0.1">
		<div class="nk-ibox">
			<div class="nk-ibox-cont">
				<h2><?= $GuildName;?><br>
				<span style="color:white;font-size:20px!important">[ Level <?= $Data['Lvl']?> ]</span><br>
				</h2>
				<h4><span style="color:orange">Foundation Date</span><br>
				<span style="font-size:20px!important"><?= $FoundDate?></span></h4>
				<h4><span style="color:orange">Donate Points</span><br>
				<span style="font-size:20px!important"><?= $Data['GatheredSP'];?></span></h4>
				<h4><span style="color:orange">Members</span><br>
				<span style="font-size:20px!important"><?= $Members;?> Member</span></h4>
			</div>
		</div>
	</div>
	</div>
	 
	<!--Guild members -->
	<div class="hidden-lg-up hidden-md-up">
		<div class="nk-gap-2"></div>
	</div>
	<div class="col-md-9">
	    <h2>Members</h2>
		<div class="table-responsive">
		<table class="table">
		<tbody>
		<tr>
		<th>Name</th>
		<th>Race</th>
		<th>NickName</th>
		<th>Donate</th>
		<th>Type</th>
		</tr>
		
		<?php 
		$MembersQry = "select * from $dbs[SHARD].._GuildMember where GuildID='$GuildID' order by MemberClass asc,Contribution DESC,GuildWarKill DESC,CharLevel DESC,GP_Donation DESC";
		if($sql->QueryHasRows($MembersQry)){
		$Qry = $sql->query($MembersQry);
		while($DataMember = $sql->QueryFetchArray($Qry)){
		  
		//Check if master Guild
		if($DataMember['MemberClass'] == 0) {$MemberType = "<font color='orange'><b class='fa fa-star'></b> Master</font>";}else{$MemberType = "Member";}
		
		//Nick Name fix
		if(empty($DataMember['Nickname'])) {$Nickname = "None";}else{$Nickname = $DataMember['Nickname'];} 
		?>
		<tr>
			<td><a href="/profile/charid/<?= $DataMember['CharID'];?>"><?= $DataMember['CharName'];?> [<?= $DataMember['CharLevel']?>]</a></td>
			<td><?= $sql->CharRace($DataMember['CharName']);?></td>
			<td><?= $Nickname;?></td>
			<td><?= $DataMember['GP_Donation'];?></td>
			<td><?= $MemberType;?></td>
		</tr>
		
		<?
		}
		}else {
		  echo"<tr><h3>There is no members.<h3></tr>";
		}
		?>
			  
		</tbody>
	    </table>
	   </div>
	</div>
	
	</div>
	<div class="nk-gap-6"></div>
	<div class="nk-gap-2"></div>
	