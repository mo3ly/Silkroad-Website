<?php
class SQL
{
	public $connect = null;

	public function __construct ($host,$user,$password,$dbs = array())
	{
		try {
		$this->connect = new PDO("sqlsrv:Server=$host;Database=$dbs[WEB]",$user,$password);
		$this->connect->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		}catch (PDOException $erorrs) {
			echo 'Failed connection due to: ' . $erorrs->getMessage();
		}
	}
	
	public function query($query,$array)
	{
		$q = $this->connect->prepare($query);
		
		if(is_array($array)){
			$q->execute($array);
		}else {
		    $q->execute();
		}

		return $q;
	}
	
	
	/* FetchArray_Query*/
	public function QueryFetchArray($query)
	{
		$last = $query->fetch(PDO::FETCH_ASSOC);

		return $last;
	}
	
	/*If query has rows return true else return no*/
	public function QueryHasRows($query)
	{
		$checkRows = $this->query($query);
		
		if($checkRows->execute())
		{
			$rows = $checkRows->fetchAll();
			$rowsCount = count($rows);
		}
		If ($rowsCount >= 1) 
		{
			return true;
		} else {
			return false;
		}
	}
	
	Public function CheckFirstLogin($username)
	{
		global $dbs;
		$query = $this->query("SELECT Password FROM $dbs[ACC]..[TB_User] WHERE ([StrUserID] = '$username')");
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$Pass = $result["Password"];
		If ($Pass != 'unset')
        return false;
		else
		return true;
	}
	
	/** Check admin **/
	public function Admin($username,$GM_Num)
	{
		global $dbs;
		$query = $this->query("SELECT * FROM $dbs[ACC]..TB_user where StrUserID = '$username' ");
		$Data = $this->QueryFetchArray($query);
		if (($Data['sec_primary'] == $GM_Num) && ($Data['sec_content'] == $GM_Num))
        return true;
		else
		return false;
	}
	
	public function PlayerCount($ShardID)
	{
		global $dbs;
		$query = $this->query("Select top 1 nUserCount FROM $dbs[ACC].._ShardCurrentUser WHERE nShardID = '$ShardID' ORDER BY nID desc");
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$PlayersCount = $result["nUserCount"];
		if ($PlayersCount == 0){
			$Last = "<span style='color:#9c2503'>No</span>";
		} else if ($PlayersCount <= 500){
			$Last = "<span style='color:olive'>$PlayersCount</span>";
		}
		else {
			$Last = "<span style='color:#9c2503'>$PlayersCount</span>";
		}
        return $Last;
	}
	
	/** Char gold **/
	public function CharGold($CharName)
	{
		global $dbs;
		$query = $this->query("SELECT RemainGold from $dbs[SHARD].._Char where CharName16 = '$CharName'");
		$Data = $this->QueryFetchArray($query);
		$Gold = $Data['RemainGold'];
        return $Gold;
	}
	
	/********************************************************
	             ACCOUNT AND CHARACTER FUNCTIONS
    ********************************************************/
	
	/* GET JID*/
    function JID($username)
	{
		global $dbs;
		$query = $this->query("SELECT JID FROM $dbs[ACC]..[TB_User] WHERE ([StrUserID] = '$username')");
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$JID = $result["JID"];
        return $JID;
	}
    
	/* GET JID*/
    function TB_USER($CharID,$Data)
	{
		global $dbs;
		$query = $this->query("SELECT * FROM $dbs[ACC]..TB_User AS U inner join  $dbs[SHARD].._User AS C ON U.JID = C.UserJID where CharID = '$CharID'");
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if ($Data == "JID"){return $result["JID"];} else {return $result["StrUserID"];}
        
	}
	
	
	/* GET JID*/
    function CharID($Charname)
	{
		global $dbs;
		$query = $this->query("SELECT CharID FROM $dbs[SHARD]..[_Char] WHERE ([CharName16] = '$Charname')");
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$CharID = $result["CharID"];
        return $CharID;
	}
	
	/**Get Account chars**/
    function CharsByAcc($username)
	{
		global $dbs;
		$chars = array();
		$num = 0;
		
		$Qry = $this->query("SELECT TOP 4 * FROM $dbs[SHARD].._Char tb1, $dbs[SHARD].._User tb2 WHERE tb1.CharID = tb2.CharID AND tb2.UserJID=(select JID from $dbs[ACC]..TB_User where StrUserID='$username')");
		while($row = $this->QueryFetchArray($Qry))	
		{		
			$num++;
			$chars[$num]['name'] = $row['CharName16'];
		}
		foreach($chars as $value)
		{
				echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
		}
		
	}
	
	/** Check charname owned to the username **/
	function CharInUser($username,$charname){
		global $dbs;
		$checkquery = $this->QueryHasRows("select * from $dbs[SHARD].._User where UserJID =(select JID from $dbs[ACC]..TB_User where StrUserID='$username') and CharID=(select CharID from $dbs[SHARD].._Char where CharName16='$charname')"); // Query
		if($checkquery)
			return true;
		else
			return false;
	}
	
	/** Get Name **/
	Function CharName($CharID){
		global $dbs;
		
		$qryPlayer = $this->query("SELECT CharName16 FROM $dbs[SHARD]..[_Char] WHERE [CharID] = '$CharID' ");
        $playerData = $this->QueryFetchArray($qryPlayer);
        return $CharName16 = $playerData["CharName16"];
	}
	
		/** Get Name **/
	Function GuildName($GuildID){
		global $dbs;
		
		$qryGuild = $this->query("SELECT Name FROM $dbs[SHARD]..[_Guild] WHERE [ID] = '$GuildID' ");
        $GuildData = $this->QueryFetchArray($qryGuild);
        return $GuildName = $GuildData["Name"];
	}
	
	/* GET Silk, 1 Silk own , 2 Silk gift ,3 Silk point*/
    Public function Silk($username,$type)
	{
		If ($type == 3){
			$type = "silk_point";
		} elseif ($type == 2){
			$type = "silk_gift";
		} elseif ($type == 1) {
			$type = "silk_own";
		} else {
			$type = "silk_own";
		}
		
		global $dbs;
		$query = $this->query("Select $type from $dbs[ACC]..SK_Silk where JID in (SELECT JID FROM $dbs[ACC]..[TB_User] WHERE ([StrUserID] = '$username'))");
		$result = $this->QueryFetchArray($query);
		$silk = $result["$type"];
        return $silk;
	}
	
	/** WEBPOINTS **/
	Public function UserPoints ($Username,$Type){
		
		if ($Type == "Vote"){
			$Point = "VotePoints";
		} elseif ($Type == "Web") {
			$Point = "WebPoints";
		} else {
			$Point = "WebPoints";
		}
		
		global $dbs;
		$Query = $this->query("SELECT $Point FROM $dbs[WEB]..SK_Points where JID in (SELECT JID FROM $dbs[ACC]..TB_User WHERE StrUserID = '$Username')");
		$Data = $this->QueryFetchArray($Query);
		return $Data["$Point"];
	}
	
	/** Check inventory full **/
	Public function InvCheck ($CharName) {
		global $dbs;
		//Inventory slot 
		$Check = $this->query("Select Top 1 Slot from $dbs[SHARD].._Inventory where CharID in (SELECT CHARID FROM $dbs[SHARD].._CHAR where charname16 = '$CharName') and ItemID = 0 and Slot between 13 and (SELECT InventorySize from $dbs[SHARD].._Char where charname16 = '$CharName')");
		$Check1 = $this->QueryFetchArray ($Check);
		$InventroySlot = $Check1['Slot'];
		
		/** inventory size **/
		$Invqry = $this->query("SELECT InventorySize from $dbs[SHARD].._Char where charname16 = '$CharName'");
	    $Inv = $this->QueryFetchArray($Invqry);
		$InventroySize = $Inv['InventorySize'];
		If ($InventroySlot < $InventroySize) {
			return true;
		} else {
			return false;
		}
	}
	
	/** Check inventory full **/
	Public function FreeSlot ($CharName) {
		global $dbs;
		//Inventory slot 
		$Check = $this->query("Select Top 1 Slot from $dbs[SHARD].._Inventory where CharID in (SELECT CHARID FROM $dbs[SHARD].._CHAR where charname16 = '$CharName') and ItemID = 0 and Slot between 13 and (SELECT InventorySize from $dbs[SHARD].._Char where charname16 = '$CharName')");
		$Check1 = $this->QueryFetchArray ($Check);
		return $Check1['Slot'];
	}
	
	/** Get the Guild for char **/
	Public function CharGuild($CharName,$Level = false){
        global $dbs;

    	$Query = $this->query("SELECT GuildID FROM $dbs[SHARD].._Char WHERE CharName16 = '$CharName'");
		$Data = $this->QueryFetchArray($Query);
		
		/*** Guild information ***/
		$GuildName = $this->query("SELECT * FROM $dbs[SHARD].._Guild WHERE ID = '$Data[GuildID]'");
		$guild = $this->QueryFetchArray($GuildName);

		/*** No guild name ***/
		if($guild['Name'] == 'dummy') {
			$guild['Name'] = 'No Guild';  
			$guild['Lvl'] = '0';
		}
		
		/*** Guild Level **/
		if ($Level == true){
			return $guild['Lvl'];
		} else {
			return $guild['Name'];
		}
	}
	
	/** Get Job type for char **/
	Public function JobType($CharName,$Level = false){
		global $dbs;
		$CharID = $this->CharID($CharName);
		
		if($Level == true){
			
			$Job = $this->query("SELECT Level FROM $dbs[SHARD].._CharTrijob where CharID = '$CharID'");
			$JobLevel = $this->QueryFetchArray($Job);
			return $JobLevel['Level'];
			
		}else {
		   
			$Job = $this->query("SELECT JobType FROM $dbs[SHARD].._CharTrijob where CharID = '$CharID'");
			$JobType = $this->QueryFetchArray($Job);
			
			if($JobType['JobType'] == 1) {
				$job = "Trader";
			} elseif($JobType['JobType'] == 2) {
				$job = "Thief";
			} elseif($JobType['JobType'] == 3) {
				$job = "Hunter";
			} else {
				$job = "None";
			}
			return $job;
		}
	}
	
	/** Get Char Race **/
	Public function CharRace ($CharName){
		global $dbs;
		
		$Query = $this->query("SELECT RefObjID FROM $dbs[SHARD].._Char where CharName16 = '$CharName' ");
		$Data = $this->QueryFetchArray($Query);
		$RefObjID = $Data['RefObjID'];
		
		/** Return Race **/
		If ($RefObjID < 3000){
			return "China";
		} else {
			return "Europe";
		}
	}
	
	/** Get Char Status (Online/Offline) **/
	Public function CharStatus($CharName,$Full = false){
		global $dbs;
		
		$Query = $this->query("SELECT Status FROM $dbs[LOG].._OnlineOffline where Charname = '$CharName' ");
		$Data = $this->QueryFetchArray($Query);
		$Status = $Data['Status'];
		
		if ($Status == "OnHold"){
			$Statue = "Offline";
		}else {
			$Statue = $Data['Status'];
		}
		
		
		/** Status colors **/
		if ($Full == true){
			
			If ($Status == "Offline"){
				$Status = "<span style='color:#9c1414'>".$Statue."</span>";
			} elseif ($Status == "Online"){
				$Status = "<span style='color:#0a730e'>".$Statue."</span>";
			}
			return $Status;
		} else {
			return $Statue;
		}
		
		
	}
	
	/** Character Title **/
	Public function CharTitle($CharName,$ID){
		global $dbs;
		
		$Race = $this->CharRace($CharName);
		$Query = $this->query("SELECT * FROM $dbs[WEB].._Titles where TitleID = '$ID'");
		
		/**Get Hwan title**/
		if ($Data = $this->QueryFetchArray($Query)){
			
	        if($Race == "China"){$Title = $Data['China'];}
		    else if($Race == "Europe"){$Title = $Data['Europe'];}
			else {$Title = "None";}
			
		}else {
			$Title = "None";
		}
		
		return $Title;
	}
	
	/**************************************************
	            ITEM FUNCTION START HERE
	**************************************************/
	
	/** Get Item Name**/
	Public function ItemIcon($ItemID,$ItemCode = false){
		
		global $dbs;
		
		if ($ItemCode == false){
			$QueryItemID = $this->query("SELECT * FROM $dbs[SHARD].._Items WHERE ID64 = '$ItemID'");
			$fetchGetItem = $this->QueryFetchArray($QueryItemID);
			
			// Get data from RefObjCommon
			$query = $this->query("SELECT * FROM $dbs[SHARD].._RefObjCommon WHERE ID = '$fetchGetItem[RefItemID]'");
			$FetchImage = $this->QueryFetchArray($query);
			
		} else {
			$query = $this->query("SELECT * FROM $dbs[SHARD].._RefObjCommon WHERE CodeName128 = '$ItemID'");
			$FetchImage = $this->QueryFetchArray($query);
		}
		
		if(($ItemID == 0) && ($ItemCode == false)){
		   $image = "";
		}elseif (file_exists("assets/images/".str_replace("\\","/",$FetchImage['AssocFileIcon128']).".png")){
		   $image = "/assets/images/".str_replace("\\","/",$FetchImage['AssocFileIcon128']).".png";	
		} else {
			$image = "assets/images/item/slots/soxframe.jpg";
		}
					
						
	return $image;
	}
	
	
	/**Check If sox or no**/
	Public Function Is_Sox ($Item,$ItemCode = false){
        global $dbs;
		
		if ($ItemCode == false){
			$SoxOrNo = count($this->query("
			SELECT TOP 1 obj.CodeName128 
			from $dbs[SHARD].._Items as it
			LEFT JOIN $dbs[SHARD].._Inventory as inv ON it.ID64 = inv.ItemID
			LEFT JOIN $dbs[SHARD].._RefObjCommon as obj ON it.RefItemID = obj.ID
			LEFT JOIN $dbs[SHARD].._RefObjItem as item ON obj.Link = item.ID
			where ID64 = '$Item' and (CodeName128 like '%RARE%')")->fetchAll());
		} else {
			$SoxOrNo = count($this->query("
			SELECT TOP 1 CodeName128 from $dbs[SHARD].._RefObjCommon
			where CodeName128 = '$Item' and (CodeName128 like '%RARE%')")->fetchAll());
		}

		if(($SoxOrNo) != 0)
		{	
			Return $Sox = "<img src=\"/assets/images/item/slots/soxglow.gif\" class=\"sox\">";
		} else {
			Return $Sox = "<img src=\"/assets/images/item/slots/no-sox.png\" class=\"sox\">";
		}
	}
	
	/**Get Item Amount**/
	Public Function Item_Amount ($ItemID){
        global $dbs;
		
	    $ItemQua = $this->query("SELECT TOP 1  it.Data , item.MaxStack
		from $dbs[SHARD].._Items as it
		LEFT JOIN $dbs[SHARD].._Inventory as inv ON it.ID64 = inv.ItemID
		LEFT JOIN $dbs[SHARD].._RefObjCommon as obj ON it.RefItemID = obj.ID
		LEFT JOIN $dbs[SHARD].._RefObjItem as item ON obj.Link = item.ID
		where ID64 = '$ItemID'");
        $Data = $this->QueryFetchArray($ItemQua);
		
		$Amount = $Data['Data'];
		$MaxStack = $Data['MaxStack'];
		
		if ($MaxStack < $Amount || $Amount == 0){$Amount = "";}
		echo $Amount;
		//if(($Data['MaxStack']) < ($Amount) || ($Amount == 0))
	}
	
	/** Get all sox parts **/
	Public Function SoxParts ($CharID){
        global $dbs;
		
	    $SoxParts = count($this->query("
		SELECT TOP 13 obj.CodeName128
		from $dbs[SHARD].._Items as it
		LEFT JOIN $dbs[SHARD].._Inventory as inv ON it.ID64 = inv.ItemID
		LEFT JOIN $dbs[SHARD].._RefObjCommon as obj ON it.RefItemID = obj.ID
		LEFT JOIN $dbs[SHARD].._RefObjItem as item ON obj.Link = item.ID
		where CharID = '$CharID' and CodeName128 like '%RARE%' and slot >= 0 and slot < 13")->fetchAll());

		Return $SoxParts;
	}

	Public function ItemPoints ($ItemID,$Stars = false){
		
		global $dbs;
		$Qry = $this->query("SELECT TOP 1
		ch.CharName16,
		it.OptLevel,
		obj.ReqLevel1 ,
		it.MagParamNum as blue,
		SealPoints = CASE
		WHEN PATINDEX('%_11%_' + '%A_RARE',obj.CodeName128) > 0 THEN '6'--Nova
		WHEN PATINDEX('%_11%_' + '%SET_B_RARE',obj.CodeName128) > 0 THEN '10'--EgyB
		WHEN PATINDEX('%_11%_' + '%SET_A_RARE',obj.CodeName128) > 0 THEN '8'--EgyA
		WHEN PATINDEX('%A_RARE',obj.CodeName128) > 0 THEN '3'--SOS
		WHEN PATINDEX('%B_RARE',obj.CodeName128) > 0 THEN '5'--SOM
		WHEN PATINDEX('%C_RARE',obj.CodeName128) > 0 THEN '6'--SUN
		ELSE '1'--Normal 
		END,
		ItemType = CASE
		WHEN ((obj.CodeName128 like'%DAGGER%') or (obj.CodeName128 like '%SPEAR%') or (obj.CodeName128 like '%STAFF%') 
		or (obj.CodeName128 like '%BOW%') or (obj.CodeName128 like '%BLADE%') or (obj.CodeName128 like '%SWORD%') 
		or (obj.CodeName128 like '%AXE%')) THEN '6' --Weapon
		WHEN (obj.CodeName128 like '%LIGHT%') or (obj.CodeName128 like '%HEAVY%' ) or (obj.CodeName128 like '%CLOTH%') THEN '4' --Set
		WHEN (obj.CodeName128 like'%SHIELD%' )  THEN '5' --Shield
		WHEN (obj.CodeName128 like'%NECKLACE%') or (obj.CodeName128 like'%RING%')THEN '3' -- Accessory
		ELSE '0' --Other
		END,
		Adv.nOptValue 

		from $dbs[SHARD].._Items as it
		LEFT JOIN $dbs[SHARD]..[_Inventory] as inv ON it.ID64 = inv.ItemID
		LEFT JOIN $dbs[SHARD]..[_Char] as ch ON inv.CharID = ch.CharID
		LEFT JOIN $dbs[SHARD]..[_RefObjCommon] as obj ON it.RefItemID = obj.ID
		LEFT JOIN $dbs[SHARD]..[_RefObjItem] as item ON obj.Link = item.ID
		LEFT JOIN $dbs[SHARD]..[_BindingOptionWithItem] as adv on it.ID64 = adv.nItemDBID AND adv.bOptType = 2
		where ID64 = '$ItemID'");
		
		$Data = $this->QueryFetchArray($Qry);
		
		//Calculate the points
		
		$SealPoint = $Data['SealPoints']; //Seal type
		
		$OptLvl = ($Data['OptLevel'] * 3); //OptLevel
		
		$Adv = (int)($Data['nOptValue'] * 2); //Advane 
		
		$ReqLvl = (int)( ($Data['ReqLevel1']+10) /10); //Degree
		
		$Blues = $Data['blue']; // blues
		
		$SortPoints = $Data['ItemType']; // item type
		
		//if item more than D9 add some points
		if ($ReqLvl >= 10){
			$Strong = ($ReqLvl/3);
		} else {
			$Strong = 0;
		}
		
		//Stars system
		if($Stars == true){
			
			$OptLvl = ($Data['OptLevel']); // Plus
			
			$AllPoints = $SealPoint + $Adv + $OptLvl + $ReqLvl + $Strong + $Blues + $SortPoints;
			
			$Stars = (int)$AllPoints / 5; //Calculate Stars
			if ($Stars >= 15) {$Stars = '15';} // Set max stars
			
			//Shapes and colors
			if ($Stars <= 3){
				$Color = 'white';
				$Shape = 'star';
			}
			elseif($Stars <= 6){
				$Color = 'orange';
				$Shape = 'star';
			}
			elseif($Stars <= 9){
				$Color = 'olive';
				$Shape = 'star';
			} 
			else {
				$Color = '#f2e43d';
				$Shape = 'tint';
			}
			
			if($Stars > 1){
				echo'<br><font style="color:'.$Color.';font-weight:bold;font-family:Marcellus SC, serif;">Rate: </font>';
			for($i=1;$i<$Stars;$i++)
			{
				echo '<b style="color:'.$Color.'" class="fa fa-'.$Shape.'"></b>';
			}
				echo'<br>';
			}
		
		//Only points
		}else{
			return (int)($SealPoint + $Adv + $OptLvl +$ReqLvl +$Blues +$Strong + $SortPoints);
		}
		
	}
	
	/** Char full data **/
	Public function PlayerPoints($CharID){
		global $dbs;
		
		$QryItems = $this->query("SELECT * FROM $dbs[SHARD].._Inventory where CharID = '$CharID' and slot between 0 and 12 and ItemID != 0 and Slot != 8");
		
		while($Data = $this->QueryFetchArray($QryItems)){
		$Slot = $Data['Slot'];
		
			if($Slot == "0"){$Name =  "<span style='color:olive'>Head</span>";}if($Slot == "1"){$Name =  "<span style='color:olive'>Chest</span>";}  
			if($Slot == "3"){$Name =  "<span style='color:olive'>Hands</span>";} if($Slot == "4"){$Name =  "<span style='color:olive'>Legs</span>";}
			if($Slot == "5"){$Name =  "<span style='color:olive'>Foot</span>";} if($Slot == "6"){$Name =  "Weapon";}
			if($Slot == "7"){$Name =  "Shield";} if($Slot == "9"){$Name =  "<span style='color:#e08821'>Earring</span>";}
			if($Slot == "10"){$Name =  "<span style='color:#e08821'>Necklace</span>";} if($Slot == "11"){$Name =  "<span style='color:#e08821'>Left-Ring</span>";}
			if($Slot == "12"){$Name =  "<span style='color:#e08821'>Right-Ring</span>";}if($Slot == "2"){$Name =  "<span style='color:olive'>Shoulder</span>";}
		
			echo"<b class='fa fa-star'></b><span class='h6'> ".$Name." : <span style='color:#FFF'>".$this->ItemPoints($Data['ItemID'])." Point(s) </span></span><br>";
		}
		
	}
	
	/******** STALL PRICE TYPE ********/
	public function PriceType ($ItemID){
		global $dbs;
		
		$Qury = $this->query("SELECT * FROM $dbs[WEB].._WebStall where ItemID = '$ItemID'");
		$Data = $this->QueryFetchArray($Qury);
		$GoldPrice = $Data['GoldPrice'];
		$SilkPrice = $Data['SilkPrice'];
		if ($SilkPrice == 0){
			return "<h6 style='font-size:15px'>".number_format($GoldPrice)." Gold</h6>";
		} else {
			return "<h6 style='font-size:15px;color:#e08821'>".number_format($SilkPrice)." Silk(s)</h6>";
		}
	}
	
	/** Char full data **/
	Public function PlayerAllPoints($CharID){
		
		global $dbs;
		
		$Items = array();
		$num = 0;
		
		$QryItems = $this->query("SELECT * FROM $dbs[SHARD].._Inventory where CharID = '$CharID' and slot between 0 and 12 and ItemID != 0 and Slot != 8");
		
		while($Data = $this->QueryFetchArray($QryItems)){
			$num++;
			$Items[$num] = $this->ItemPoints($Data['ItemID']);
		}
		
		return array_sum($Items);
	}
	
	/** Spin functions ***/
	public function Reward($amount,$username)
	{
		if(!is_numeric($amount))
		{
			throw new Exception("Silk Amount should be Numeric!");
			return;
		}
		
		global $silkType;
		global $dbs;
		
		$jid = $this->query("select JID from $dbs[ACC]..TB_User where StrUserID=:userid",array(':userid'=>$username))->fetchAll()[0]['JID'];
		$q1 = $this->query("UPDATE $dbs[ACC]..SK_Silk set ".$this->colName($silkType)."=".$this->colName($silkType)."+:amount where JID=:JID",array(':amount'=>$amount,':JID'=>$jid));
		$q2 = $this->query("INSERT INTO $dbs[WEB].._SpinLog Values(:Username,:Prize,:Date)", array(':Username'=>$username,':Prize'=>$amount,':Date'=>date('Y-m-d H:i:s')));
	}
	
	public function colName($type)
	{
		$find[] = 1; $replace[] = "silk_own";
		$find[] = 2; $replace[] = "silk_gift";
		$find[] = 3; $replace[] = "silk_point";
		return str_replace($find, $replace, $type);
	}

	
}