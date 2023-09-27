 <?php
    
	$queryName = (string)$_GET['third'];
	
	If ($queryName == "player") {
    //Select query
	$PlayersQuery = "
	SELECT TOP 50 
	$dbs[SHARD].._RefObjCommon.ReqLevel1,
	$dbs[SHARD].._Char.CharName16,
	$dbs[SHARD].._Char.RefObjID,
	$dbs[SHARD].._Char.RemainGold,
	$dbs[SHARD].._Char.CurLevel,
	$dbs[SHARD].._Char.UQpoints,
	$dbs[SHARD].._Char.PvpPoints,
	$dbs[SHARD].._Char.killer,
	$dbs[SHARD].._Char.dead,
	SUM ($dbs[SHARD].._Items.OptLevel*3)+10 AS ItemPoints
    FROM
	$dbs[SHARD].._Char
    INNER JOIN $dbs[SHARD].._Inventory ON _Char.CharID = _Inventory.CharID
    INNER JOIN $dbs[SHARD].._Items ON _Inventory.ItemID = _Items.ID64
    INNER JOIN $dbs[SHARD].._RefObjCommon ON _Items.RefItemID = _RefObjCommon.ID
    WHERE
	$dbs[SHARD].._char.charname16 NOT LIKE '%[GM]%'
    AND $dbs[SHARD].._RefObjCommon.ReqLevel1 > 100
    AND $dbs[SHARD].._inventory.Slot between 1 and 12
    GROUP BY
	$dbs[SHARD].._Char.CharName16,
	$dbs[SHARD].._Char.RefObjID,
	$dbs[SHARD].._Char.RemainGold,
	$dbs[SHARD].._Char.CurLevel,
	$dbs[SHARD].._Char.UQpoints,
	$dbs[SHARD].._Char.PvpPoints,
	$dbs[SHARD].._RefObjCommon.ReqLevel1,
    $dbs[SHARD].._Char.killer,
	$dbs[SHARD].._Char.dead
    ORDER BY
	$dbs[SHARD].._Char.CurLevel DESC,
	SUM ($dbs[SHARD].._items.Optlevel)*5 DESC,
	$dbs[SHARD].._Char.UQpoints,
	$dbs[SHARD].._Char.PvpPoints DESC,
	$dbs[SHARD].._Char.killer DESC,
	$dbs[SHARD].._Char.RemainGold DESC
	";
	$query = $sql->Query($PlayersQuery);
	?>

			<?php
			$CountPlayers = 1;
            //if($sql->QueryHasRows($query) == true){
			?>
			
		    <div class="table-responsive">
			<table class="table">
			<thead>
			<tr>
					<th>Rank</th>
					<th>Name</th>
					<th>Race</th>
					<th>Level</th>
					<th>ItemPoints</th>
					<th>UniquePoints</th>
					<th>PvpPoints</th>
					<th>Kill/Death</th>		
			</tr>
			</thead>
			<tbody>
	
			
			<?php
			while ($row = $sql->QueryFetchArray($query)) {
			if($row['RefObjID'] < 3000) {
				$race="China";
			} else {
				$race="Europe";
			}
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
					<td><?= $CountPlayers; ?> <?=$Icon; ?></td>
					<td><a href="/"><?= $row['CharName16']; ?></a></td>
					<td><?= $race; ?></td>
					<td><?= $row['CurLevel']; ?></td>
					<td><?= $row['ItemPoints']; ?></td>
					<td><?= $row['UQpoints']; ?></td>
					<td><?= $row['PvpPoints']; ?></td>
					<td><?= $row['killer']; ?></td>
				  </tr>
				  <?php
				  $CountPlayers++;
		    }
			//} else {
			//	echo'<div class="nk-gap-1"></div><h3>Opps!!<br>There is no any characters.</h3>';
			//}
		?>
		</tbody>
		</table>
		</div>
		  
		   <div class="nk-gap-3"></div>

            <!-- START: Pagination -->
            <div class="nk-pagination nk-pagination-center">
                <a href="#" class="nk-pagination-prev disabled">
                    <span class="nk-icon-arrow-left"></span>
                </a>
                <nav>
                    <a class="nk-pagination-current-white" href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <span>...</span>
                </nav>
                <a href="#" class="nk-pagination-next">
                    <span class="nk-icon-arrow-right"></span>
                </a>
            </div>
            <!-- END: Pagination  -->

            <div class="nk-gap-3"></div>
	<?php
	} else {
		echo'no reslu';
	}
	?>