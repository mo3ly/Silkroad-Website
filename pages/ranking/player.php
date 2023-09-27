<?  

if ($_GET['sup']){
  $Page = $_GET['sup'];
} else {
  $Page=1;
}

$AllRows =  count($sql->query("
SELECT DISTINCT 
_RefObjCommon.ReqLevel1,
_Char.CharName16,
_Char.CharID,
_Char.CurLevel,
SUM ($dbs[SHARD].._Items.OptLevel*3)+ 10 + _Char.CurLevel + count(_RefObjCommon.Codename128) + SUM (_Items.MagParamNum)  AS ItemPoints
FROM
$dbs[SHARD].._Char
INNER JOIN $dbs[SHARD].._Inventory ON _Char.CharID = _Inventory.CharID
INNER JOIN $dbs[SHARD].._Items ON _Inventory.ItemID = _Items.ID64
INNER JOIN $dbs[SHARD].._RefObjCommon ON _Items.RefItemID = _RefObjCommon.ID
WHERE
_char.charname16 NOT LIKE '%[GM]%' and Charname16 not like 'testtt'
AND _RefObjCommon.ReqLevel1 > 100
AND _inventory.Slot between 0 and 12
AND _RefObjCommon.Codename128 like '%RARE%'
GROUP BY
_Char.CharName16,
_Char.CharID,
_Char.RefObjID,
_Char.CurLevel,
_RefObjCommon.ReqLevel1
ORDER BY
ItemPoints DESC")->fetchAll());

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
			SELECT DISTINCT 
			_RefObjCommon.ReqLevel1,
			_Char.CharName16,
			_Char.CharID,
			_Char.CurLevel,
			SUM ($dbs[SHARD].._Items.OptLevel*3)+10 + _Char.CurLevel + count(_RefObjCommon.Codename128) + SUM (_Items.MagParamNum)  AS ItemPoints
			FROM
			$dbs[SHARD].._Char
			INNER JOIN $dbs[SHARD].._Inventory ON _Char.CharID = _Inventory.CharID
			INNER JOIN $dbs[SHARD].._Items ON _Inventory.ItemID = _Items.ID64
			INNER JOIN $dbs[SHARD].._RefObjCommon ON _Items.RefItemID = _RefObjCommon.ID
			WHERE
			_char.charname16 NOT LIKE '%[GM]%' and Charname16 not like 'testtt'
			AND _RefObjCommon.ReqLevel1 > 100
			AND _inventory.Slot between 0 and 12
			AND _RefObjCommon.Codename128 like '%RARE%'
			GROUP BY
			_Char.CharName16,
			_Char.CharID,
			_Char.RefObjID,
			_Char.CurLevel,
			_RefObjCommon.ReqLevel1
			ORDER BY
			ItemPoints DESC
			OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY
			";
			$query = $sql->Query($PlayersQuery);
			
			$CountPlayers = (($Page - 1) * $row_per_page) +1;
			
            if($sql->QueryHasRows($PlayersQuery)){
			?>
			<div id="Pagination">
			<div class="nk-box-2 bg-dark-1" style="background-image:url('/assets/images/chars/ninja.png'); background-repeat: no-repeat;">
			<h2 style="color:#e08821;margin-left:10px">Player Ranking</h2>
			<div class="nk-gap"></div>
		    <div class="table-responsive">
			<table class="table">
			<thead>
			<tr>
					<th><h5>Rank</h5></th>
					<th><h5>Name</h5></th>
					<th><h5>Race</h5></th>
					<th><h5>Level</h5></th>
					<th><h5>Sox parts</h5></th>
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
					<td><h6><a href="/profile/charid/<?= $row['CharID']; ?>"><?= $row['CharName16']; ?></a></h6></td>
					<td><h6><?= $sql->CharRace($row['CharName16']); ?></h6></td>
					<td><h6><?= $row['CurLevel']; ?></td>
					<td><h6><?= $sql->SoxParts($row['CharID']);?></h6></td>
					<td><h6><?= $sql->PlayerAllPoints($row['CharID']);?></h6></td>
					
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
                <?php $pgn->PaginationAjax($Page,"/playerrank/",$Total,"Pagination","Pagination");?>
            </div>
            <!-- END: Pagination  -->
		</div>
		</div>
	    <div class="nk-gap-3"></div>