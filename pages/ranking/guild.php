<?  

if ($_GET['sup']){
  $Page = $_GET['sup'];
} else {
  $Page=1;
}

$AllRows =  count($sql->query("
SELECT  DISTINCT
_Guild.Name as Name,Lvl, SUM(_Items.OptLevel) AS ItemPoint ,_Guild.ID,_Guild.GatheredSP, Count(_GuildMember.GuildID) as Members
FROM         
SRO_VT_SHARD.._Char INNER JOIN
SRO_VT_SHARD.._Inventory ON _Char.CharID = _Inventory.CharID INNER JOIN
SRO_VT_SHARD.._Items ON _Inventory.ItemID = _Items.ID64 INNER JOIN
SRO_VT_SHARD.._GuildMember ON _Char.CharID = _GuildMember.CharID INNER JOIN
SRO_VT_SHARD.._Guild ON _GuildMember.GuildID = _Guild.ID
Where _Guild.Name != _char.Charname16 and _Guild.ID != 0
AND _inventory.Slot between 1 and 12
GROUP BY _Guild.Name, _Guild.GatheredSP,_Guild.Lvl,_Guild.ID
Order by SUM(_Items.OptLevel) desc,_Guild.GatheredSP desc")->fetchAll());

$Total = ceil($AllRows / $row_per_page);

if ($AllRows > 1){
	
	if($Page > $Total){
		$func->userRedirect("/ranking",false);
	}
}
?>  
<?php
			//Select query
			$Start = ($Page - 1) * $row_per_page;
			$PlayersQuery = "
			SELECT  DISTINCT
			_Guild.Name as Name,Lvl, SUM(_Items.OptLevel) AS ItemPoint ,_Guild.ID,_Guild.GatheredSP, Count(_GuildMember.GuildID) as Members
			FROM         
			SRO_VT_SHARD.._Char INNER JOIN
			SRO_VT_SHARD.._Inventory ON _Char.CharID = _Inventory.CharID INNER JOIN
			SRO_VT_SHARD.._Items ON _Inventory.ItemID = _Items.ID64 INNER JOIN
			SRO_VT_SHARD.._GuildMember ON _Char.CharID = _GuildMember.CharID INNER JOIN
			SRO_VT_SHARD.._Guild ON _GuildMember.GuildID = _Guild.ID
			Where _Guild.Name != _char.Charname16 and _Guild.ID != 0
			AND _inventory.Slot between 1 and 12
			GROUP BY _Guild.Name, _Guild.GatheredSP,_Guild.Lvl,_Guild.ID
			Order by SUM(_Items.OptLevel) desc,_Guild.GatheredSP desc
			OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY
			";
			$query = $sql->Query($PlayersQuery);
			
			$CountPlayers = (($Page - 1) * $row_per_page) +1;
			
            if($sql->QueryHasRows($PlayersQuery)){
			?>
			<div id="PaginationGuild">
			<div class="nk-box-2 bg-dark-1" style="background-image:url('/assets/images/chars/ninja.png'); background-repeat: no-repeat;">
			<h2 style="color:#e08821;margin-left:10px">Guild Ranking</h2>
			<div class="nk-gap"></div>
		    <div class="table-responsive">
			<table class="table">
			<thead>
			<tr>
					<th><h5>Rank</h5></th>
					<th><h5>Name</h5></th>
					<th><h5>Level</h5></th>
					<th><h5>Member points</h5></th>
					<th><h5>Item points</h5></th>	
			</tr>
			</thead>
			<tbody>
	
			
			<?php
			while ($row = $sql->QueryFetchArray($query)) {
				
					If ($CountPlayers == 1){
						$Icon="<b class='ion-trophy'style='color:orange'></b>";
					} else If ($CountPlayers == 2){
						$Icon="<b class='ion-ribbon-a' style='color:yellow'></b>";
					} else If ($CountPlayers == 3){
						$Icon="<b class='ion-ribbon-b'></b>";
					} else {
						$Icon="";
					}
					
			?>
			     
				<tr>
					
					<td><h6><?= $CountPlayers; ?> <?=$Icon; ?></h6></td>
					<td><h6><a href="/profile/guild/<?= $row['ID']; ?>"><?= $row['Name']; ?></a></h6></td>
					<td><h6><?= $row['Lvl']; ?></td>
					<td><h6><?= $row['ItemPoint'];?></h6></td>
					<td><h6><?= $row['GatheredSP'];?></h6></td>
					
			  </tr>
			<?php
			  $CountPlayers++;
		    }
			
		} else {
			echo'<center><div class="nk-gap-1"></div><h5>Opps!! There is no any characters.</h5></center>';
		}
		?>
		</tbody>
		</table>
		</div>
			<!-- START: Pagination -->
            <div class="nk-pagination nk-pagination-center">
                <?php $pgn->PaginationAjax($Page,"/guildrank/",$Total,"PaginationGuild","PaginationGuild");?>
            </div>
            <!-- END: Pagination  -->
		</div>
		</div>
	    <div class="nk-gap-3"></div>