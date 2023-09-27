<?
//no item
if ( ($ItemSID != 0) && ($ItemSID != NULL) ){

		//Fetch Data From Items table
		$getItem = $sql->query("SELECT * FROM $dbs[SHARD].._Items WHERE ID64 = '$ItemSID'");
		$fetchGetItem = $sql->QueryFetchArray($getItem);
		
		//Get Advance value :D Really Fuck my English
		$AdvanceQry = $sql->query("SELECT nOptValue From $dbs[SHARD]..[_BindingOptionWithItem] where nItemDBID = '$ItemSID' AND bOptType = 2");
		$AdvData  = $sql->QueryFetchArray($AdvanceQry);
		$Advance = $AdvData['nOptValue'];
		
		//Get info from RefObjCommon
		$getItemRef = $sql->query("SELECT * FROM $dbs[SHARD].._RefObjCommon WHERE ID = '$fetchGetItem[RefItemID]'");
		$fetchGetItemRef = $sql->QueryFetchArray($getItemRef);
		
		//Row from Refobjitem
		$getInfo = $sql->query("SELECT * FROM $dbs[SHARD].._RefObjItem WHERE ID = '$fetchGetItemRef[Link]'");
		$fetchGetInfo = $sql->QueryFetchArray($getInfo);
		
		//Default
		$names = "Unkkown";
		
		//ReqLevel
		$ReqLevel = $fetchGetItemRef['ReqLevel1'];
		
		//MaxMagicOption
		$MaxMagic = $fetchGetInfo['MaxMagicOptCount'];
		
		//MaxStack
		$MaxStack = $fetchGetInfo['MaxStack'];
		
		//Amount of the item
		$Amount = $fetchGetItem['Data'];
		
		//Codename 
		$Code = $fetchGetItemRef['CodeName128'];
		//fetch real names
		$name = $sql->query("SELECT TOP 1 * FROM $dbs[WEB]..[_RefNames] WHERE Item_Code ='$fetchGetItemRef[NameStrID128]'");					
		
		if($Data = $sql->QueryFetchArray($name)) {
			//Name
			$names = $Data['Item_Name']; 
		} else {
			//Codename
			$names = $fetchGetItemRef['NameStrID128'];
		}
		
		//Exploding the codename
		$main_explode = explode("_",$fetchGetItemRef['CodeName128']);
		$sort = $instance -> Weapon_Name(ucwords(strtolower($main_explode[2])));
		$kind = $instance -> Part_Number($sort);
		
		//Filter the sort
		$sort = $instance->Sort_Filter($sort,$MaxMagic);
		
		if($sort == "F" || $sort == "W" || $sort == "M") {
		
		//Woman or Man Gears
		$sort = $instance -> Part_Type(ucwords($main_explode[5]));
		$kind = $instance -> Part_Number($sort);
		
		//Item Degree
		$degree = (int)$main_explode[4];
		
		//Item gender
		$gender = $main_explode[1];
		
		//Item Type (Geremant,Protector,Armor)
		if(isset($main_explode[7])) {
			$gear = $instance -> Set_Type(ucwords($main_explode[3]),$gender);
		}
		
		//Special items (NOVA,EGY B or A ,SUN,MON,STAR)
		if(isset($main_explode[8])) {
			$grade = $instance -> Sox_Type($main_explode[6]."_".$main_explode[7]."_".$main_explode[8]);
		} elseif(isset($main_explode[7])) {
			$grade = $instance -> Sox_Type($main_explode[6]."_".$main_explode[7]);
		} else {
			$grade = "Normal";
		}
		
		 
		} else {
		
		//Item Degree
		$degree = (int)$main_explode[3];
			
		//Item gender
		$gender = $main_explode[1];
			
		//Check Special item
		if(isset($main_explode[6])) {
			$grade = $instance -> Sox_Type($main_explode[4]."_".$main_explode[5]."_".$main_explode[6]);
		} elseif(isset($main_explode[5])) {
			$grade = $instance -> Sox_Type($main_explode[4]."_".$main_explode[5]);
		} else {
			$grade = "Normal";
		}
		
		}
		
	 
	 
		//Variance
		if($fetchGetItem['Variance'] == NULL) {
			$fetchGetItem['Variance'] == 0;
		}
		
		
		//SwitchColors
		if($grade == "Seal of Nova" || $grade == "Seal of Moon" || $grade == "Seal of Sun" || $grade == "Fight" || $grade == "Power") {
			$color = "color:#f2e43d;font-weight: bold;";
			$color_2 = "color:#66ff66;font-weight: bold;";
		} else {
			if($fetchGetItem['MagParamNum'] > 0) {
				$color = "color:#50cecd;font-weight: bold;";
			} else {
				$color = "font-weight: bold;";
			}
		}
						
								
		//OptLevel And Advance 
		if(($fetchGetItem['OptLevel'] > 0) || ($Advance > 0)) {
			$PlusValue = $Advance+$fetchGetItem['OptLevel'];
			echo '<img style=" margin-bottom: 7px;margin-left: -7px;" src="assets/images/item/slots/corner.png"><span style="'.$color.'margin-left:-5px;"> '.$names.' (+'.$PlusValue.')</span>';
			
			//Item stars
			$sql->ItemPoints($ItemSID,true);
			echo'<br>';
			
		} else {
			echo '<img style=" margin-bottom: 7px;margin-left: -7px;" src="assets/images/item/slots/corner.png"><span style="'.$color.'margin-left:-5px;"> '.$names.'</span>';
			
			//Item stars
			$sql->ItemPoints($ItemSID,true);
			echo'<br>';
		}
		
		if($grade == "Seal of Nova" || $grade == "Seal of Moon" || $grade == "Seal of Sun") {
			
			
		if($degree == 11 && $grade == "Seal of Nova") {
			echo '<span style="'.$color.'">'.$grade.'</span><br>';
		} else {
			echo '<span style="'.$color.'">'.$grade.'</span><br>';
		}
			
		//Egy Items
		} elseif($grade == "Fight" || $grade == "Power") {
			echo '<span style="'.$color.'">Seal of Nova</span><br>';
			if($kind == 0 && $grade == "Fight"){$grade = "Fight";}elseif($kind == 0 && $grade == "Power"){$grade = "Power";}//Weapon
			if($kind == 1 && $grade == "Fight"){$grade = "Immortaltly";}elseif($kind == 1 && $grade == "Power"){$grade = "Dustruction";}//Set
			if($kind == 2 && $grade == "Fight"){$grade = "Guard";}elseif($kind == 2 && $grade == "Power"){$grade = "Power";}//Shield
			if($kind == 3 && $grade == "Fight"){$grade = "Legend";}elseif($kind == 3 && $grade == "Power"){$grade = "Myth";}//Accessory
			echo '<span style="'.$color_2.'">'.$grade.'</span><br>';
		}
		
		//Print Sort of item
		if(($kind == 0) || ($kind == 2) || ($kind == 3)){
		//if item is weapon
		echo '<span style="color:#efdaa4;">Sort of item: '.$sort.'</span><br>';
		
		}elseif($kind == 1){
		//if item is set
		echo '
		<span style="color:#efdaa4;">Sort of item: '.$instance->ItemData($Code,"SortBy").'<br>
		Mounting Part: '.$sort.'</span><br>';
		}
		
		//Print Degree
		if (($degree != 0) && ($degree <= 14)){
		echo '<span style="color:#efdaa4;">Degree: '.$degree.' degrees</span><br><br>';
		}


		/**************************************************
					  WHITE STATS STATR HERE
		**************************************************/
		
		//Variance dump
		if ((($kind == 0) || ($kind == 1) || ($kind == 2) || ($kind == 3))){
			$test = $instance -> GetVarianceDump((float)($fetchGetItem['Variance']), $kind);
		}
		
		//If item is weapon
		If ($ReqLevel != 0 && ($degree != 0) && ($degree <= 14)){
		if($kind == 0) {
		
			$Durability = $test[0]['Durability'];
			$Durability = str_replace("-1", "0", $Durability);
			$new_value = $Durability / 100 + 1; $NewDura_MIN = $fetchGetInfo['Dur_L'] * $new_value;
													
			$PhyReinforce = $test[1]['PhyReinforce'];
			$PhyReinforce = str_replace("-1", "0", $PhyReinforce);
			$new_value = $PhyReinforce / 100 + 1; $fetchGetInfo['PAStrMin_U'] = $fetchGetInfo['PAStrMin_U'] * $new_value; $fetchGetInfo['PAStrMax_U'] = $fetchGetInfo['PAStrMax_U'] * $new_value;
			
			$MagReinforce = $test[2]['MagReinforce'];
			$MagReinforce = str_replace("-1", "0", $MagReinforce);
			$new_value = $MagReinforce / 100 + 1; $fetchGetInfo['MAInt_Min_U'] = $fetchGetInfo['MAInt_Min_U'] * $new_value; $fetchGetInfo['MAInt_Max_U'] = $fetchGetInfo['MAInt_Max_U'] * $new_value;
			
			$HitRatio = $test[3]['HitRatio'];
			$HitRatio = str_replace("-1", "0", $HitRatio);
			$new_value = $HitRatio / 100 + 1; $NewHit_MIN = $fetchGetInfo['HR_L'] * $new_value;
			
			$PhyAttack = $test[4]['PhyAttack'];
			$PhyAttack = str_replace("-1", "0", $PhyAttack);
			$new_value = $PhyAttack / 100 + 1; $PhyPwr_MIN = $fetchGetInfo['PAttackMin_L'] * $new_value; $PhyPwr_MAX = $fetchGetInfo['PAttackMax_L'] * $new_value;
			
			$MagAttack = $test[5]['MagAttack'];
			$MagAttack = str_replace("-1", "0", $MagAttack);
			$new_value = $MagAttack / 100 + 1; $MagPwr_MIN = $fetchGetInfo['MAttackMin_L'] * $new_value; $MagPwr_MAX = $fetchGetInfo['MAttackMax_L'] * $new_value;
			
			$CriticalRatio = $test[6]['CriticalRatio'];
			$CriticalRatio = str_replace("-1", "0", $CriticalRatio);
			$new_value = $CriticalRatio / 100 + 1; $NewCrit_MIN = $fetchGetInfo['CHR_L'] * $new_value;
			
			#--- Phy reinforce shit ---#
			if($fetchGetInfo['PAStrMin_U'] >= 100) {
				$new_phy = number_format($fetchGetInfo['PAStrMin_U'] / 10, 1);
			} else {
				$new_phy = number_format($fetchGetInfo['PAStrMin_U'], 1);
			}
			
			#-- Phy reinforce shit 2 ---#
			if($fetchGetInfo['PAStrMax_U'] >= 100) {
				$new_phy_max = number_format($fetchGetInfo['PAStrMax_U'] / 10, 1);
			} else {
				$new_phy_max = number_format($fetchGetInfo['PAStrMax_U'], 1);
			}
			
			#--- Mag reinforce shit ---#
			if($fetchGetInfo['MAInt_Min_U'] >= 100) {
				$new_mag = number_format($fetchGetInfo['MAInt_Min_U'] / 10, 1);
			} else {
				$new_mag = number_format($fetchGetInfo['MAInt_Min_U'], 1);
			}
			
			#--- Mag reinforce shit 2 ---#
			if($fetchGetInfo['MAInt_Max_U'] >= 100) {
				$new_mag_max = number_format($fetchGetInfo['MAInt_Max_U'] / 10, 1);
			} else {
				$new_mag_max = number_format($fetchGetInfo['MAInt_Max_U'], 1);
			}
			
			/** Print All White Stats**/
			if($fetchGetInfo['PAttackMax_L'] > 0 && $fetchGetInfo['MAttackMax_L'] > 0) {
				//China Weapons
				echo '
				Phy. atk. pwr. '.(int)$PhyPwr_MIN.' ~ '.(int)$PhyPwr_MAX.' (+'.$PhyAttack.'%)<br>
				Mag. atk. pwr. '.(int)$MagPwr_MIN.' ~ '.(int)$MagPwr_MAX.' (+'.$MagAttack.'%)<br>
				Durability '.$fetchGetItem['Data'].'/'.(int)$NewDura_MIN.' (+'.$Durability.'%)<br>
				Attack rating '.(int)$NewHit_MIN.' (+'.$HitRatio.'%)<br>
				Critical '.(int)$NewCrit_MIN.' (+'.$CriticalRatio.'%)<br>
				Phy. reinforce '.$new_phy.' % ~ '.$new_phy_max.' % (+'.$PhyReinforce.'%)<br>
				Mag. reinforce '.$new_mag.' % ~ '.$new_mag_max.' % (+'.$MagReinforce.'%)<br>';
			} 
			elseif($fetchGetInfo['MAttackMax_L'] > 0 || $fetchGetInfo['PAttackMax_L'] == 0) {
				//Magical EU weapons
				echo '
				Mag. atk. pwr. '.(int)$MagPwr_MIN.' ~ '.(int)$MagPwr_MAX.' (+'.$MagAttack.'%)<br>
				Durability '.$fetchGetItem['Data'].'/'.(int)$NewDura_MIN.' (+'.$Durability.'%)<br>
				Attack rating '.(int)$NewHit_MIN.' (+'.$HitRatio.'%)<br>
				Mag. reinforce '.$new_mag.' % ~ '.$new_mag_max.' % (+'.$MagReinforce.'%)<br>';
				
			} elseif($fetchGetInfo['PAttackMax_L'] > 0 || $fetchGetInfo['MAttackMax_L'] == 0) {
				//Physical EU weapons
				echo '
				Phy. atk. pwr. '.(int)$PhyPwr_MIN.' ~ '.(int)$PhyPwr_MAX.' (+'.$PhyAttack.'%)<br>
				Durability '.$fetchGetItem['Data'].'/'.(int)$NewDura_MIN.' (+'.$Durability.'%)<br>
				Attack rating '.(int)$NewHit_MIN.' (+'.$HitRatio.'%)<br>
				Critical '.(int)$NewCrit_MIN.' (+'.$CriticalRatio.'%)<br>
				Phy. reinforce '.$new_phy.' % ~ '.$new_phy_max.' % (+'.$PhyReinforce.'%)<br>';
			} 
							
		/** If Item is Set **/
		} elseif($kind == 1) {
		
			//White Stats For Set
			$Durability = $test[0]['Durability'];
			$Durability = str_replace("-1", "0", $Durability);
			$new_value = $Durability / 100 + 1; $NewDura_MIN = $fetchGetInfo['Dur_L'] * $new_value;
													
			$PhyReinforce = $test[1]['PhyReinforce'];
			$PhyReinforce = str_replace("-1", "0", $PhyReinforce);
			$new_value = $PhyReinforce / 100 + 1; $new_phyrein = $fetchGetInfo['PDStr_L'] * $new_value;
			
			if($fetchGetInfo['PDStr_L'] <= 10) {
				$new_phyrein = number_format($new_phyrein / 10, 1);
			} else {
				$new_phyrein = number_format($new_phyrein, 1);
			}
			
			$MagReinforce = $test[2]['MagReinforce'];
			$MagReinforce = str_replace("-1", "0", $MagReinforce);
			$new_value = $MagReinforce / 100 + 1; $new_magrein = $fetchGetInfo['MDInt_L'] * $new_value;
			
			if($fetchGetInfo['MDInt_L'] <= 10) {
				$new_magrein = number_format($new_magrein / 10, 1);
			} else {
				$new_magrein = number_format($new_magrein, 1);
			}
			
			$PhyDefense = $test[3]['PhyDefense'];
			$PhyDefense = str_replace("-1", "0", $PhyDefense);
			$new_value = $PhyDefense / 100 + 1; $PhyDef_MIN = $fetchGetInfo['PD_U'] * $new_value;
			
			if($fetchGetInfo['PD_U'] <= 10) {
				$PhyDef_MIN = number_format($PhyDef_MIN / 10, 1);
			} else {
				$PhyDef_MIN = number_format($PhyDef_MIN, 1);
			}
			
			$MagDefense = $test[4]['MagDefense'];
			$MagDefense = str_replace("-1", "0", $MagDefense);
			$new_value = $MagDefense / 100 + 1; $MagDef_MIN = $fetchGetInfo['MD_U'] * $new_value;
			
			if($fetchGetInfo['MD_U'] <= 10) {
				$MagDef_MIN = number_format($MagDef_MIN / 10, 1);
			} else {
				$MagDef_MIN = number_format($MagDef_MIN, 1);
			}
			
			$ParryRatio = $test[5]['ParryRatio'];
			$ParryRatio = str_replace("-1", "0", $ParryRatio);
			$new_value = $ParryRatio / 100 + 1; $Parry_MIN = $fetchGetInfo['ER_U'] * $new_value;
			
			//Print All white stats
			echo '
			Phy. def. pwr. '.(int)$PhyDef_MIN.' (+'.$PhyDefense.'%)<br>
			Mag. def. pwr. '.(int)$MagDef_MIN.' (+'.$MagDefense.'%)<br>
			Durability '.$fetchGetItem['Data'].'/'.(int)$NewDura_MIN.' (+'.$Durability.'%)<br>
			Parry rate '.(int)$fetchGetInfo['ER_U'].' (+'.$ParryRatio.'%)<br>
			Phy. reinforce '.$new_phyrein.' (+'.$PhyReinforce.'%)<br>
			Mag. reinforce '.$new_magrein.' (+'.$MagReinforce.'%)<br>';
			#END STATS
			
						
		/** Shield section **/
		} elseif($kind == 2) {

				#--- K DEN ---#
				$Durability = $test[0]['Durability'];
				$Durability = str_replace("-1", "0", $Durability);
				$new_value = $Durability / 100 + 1; $NewDura_MIN = $fetchGetInfo['Dur_L'] * $new_value;
														
				$PhyReinforce = $test[1]['PhyReinforce'];
				$PhyReinforce = str_replace("-1", "0", $PhyReinforce);
				$new_value = $PhyReinforce / 100 + 1; $new_phyrein = $fetchGetInfo['PDStr_L'] * $new_value;
				
				if($fetchGetInfo['PDStr_L'] >= 1000) {
					$new_phyrein = number_format($new_phyrein / 10, 1);
				} else {
					$new_phyrein = number_format($new_phyrein, 1);
				}
				
				$MagReinforce = $test[2]['MagReinforce'];
				$MagReinforce = str_replace("-1", "0", $MagReinforce);
				$new_value = $MagReinforce / 100 + 1; $new_magrein = $fetchGetInfo['MDInt_L'] * $new_value;
				
				if($fetchGetInfo['MDInt_L'] >= 1000) {
					$new_magrein = number_format($new_magrein / 10, 1);
				} else {
					$new_magrein = number_format($new_magrein, 1);
				}
				
				$BlockRatio = $test[3]['BlockRatio'];
				$BlockRatio = str_replace("-1", "0", $BlockRatio);
				$new_value = $BlockRatio / 100 + 1; $BlockRatio_MIN = $fetchGetInfo['BR_L'] * $new_value;
				
				$PhyDefense = $test[4]['PhyDefense'];
				$PhyDefense = str_replace("-1", "0", $PhyDefense);
				$new_value = $PhyDefense / 100 + 1; $PhyDef_MIN = $fetchGetInfo['PD_U'] * $new_value;
				$PhyDef_MIN = number_format($PhyDef_MIN, 1);
				
				$MagDefense = $test[5]['MagDefense'];
				$MagDefense = str_replace("-1", "0", $MagDefense);
				$new_value = $MagDefense / 100 + 1; $MagDef_MIN = $fetchGetInfo['MD_U'] * $new_value;
				$MagDef_MIN = number_format($MagDef_MIN, 1);
				
				//Print item white stats
				echo '
				Phy. def. pwr. '.(int)$PhyDef_MIN.' (+'.$PhyDefense.'%)<br>
				Mag. def. pwr. '.(int)$MagDef_MIN.' (+'.$MagDefense.'%)<br>
				Durability '.$fetchGetItem['Data'].'/'.(int)$NewDura_MIN.' (+'.$Durability.'%)<br>
				Blocking rate '.(int)$BlockRatio_MIN.' (+'.$BlockRatio.'%)<br>
				Phy. reinforce '.$new_phyrein.' (+'.$PhyReinforce.'%)<br>
				Mag. reinforce '.$new_magrein.' (+'.$MagReinforce.'%)<br>';
							
						
			/** Accessory Section **/
			} elseif($kind == 3) {
			
				//Calculate stats
				$PhyAbsorb = $test[0]['PhyAbsorb'];
				$PhyAbsorb = str_replace("-1", "0", $PhyAbsorb);
				$new_value = $PhyAbsorb / 100 + 1; $new_phyrein = $fetchGetInfo['PAR_L'] * $new_value;
				
				if($fetchGetInfo['PAR_L'] >= 100) {
					$new_phyrein = number_format($new_phyrein / 10, 1);
				} else {
					$new_phyrein = number_format($new_phyrein, 1);
				}
				
				$MagAbsorb = $test[1]['MagAbsorb'];
				$MagAbsorb = str_replace("-1", "0", $MagAbsorb);
				$new_value = $MagAbsorb / 100 + 1; $new_magrein = $fetchGetInfo['MAR_L'] * $new_value;
				
				if($fetchGetInfo['MAR_L'] >= 100) {
					$new_magrein = number_format($new_magrein / 10, 1);
				} else {
					$new_magrein = number_format($new_magrein, 1);
				}
				
				//Print white stats
				echo '
				Phy. absorption '.$new_phyrein.' (+'.$PhyAbsorb.'%)<br>
				Mag. absorption '.$new_magrein.' (+'.$MagAbsorb.'%)<br>';
					
				} else {
					//If unknown
					echo "";
				}
				
			//If the item is not an equipment
			} else {
				$Desc = $sql->query("SELECT TOP 1 * FROM $dbs[WEB]..[_REFNAMES] WHERE Item_Code ='$fetchGetItemRef[DescStrID128]'");
				if($Val = $sql->QueryFetchArray($Desc)){echo"<br>".$Val['Item_Name']."<br><br>";}else
				{echo"<br>There is no words for this image<br>";}
			}
							

			/** Req level section **/
			if($ReqLevel != 0){
			echo '<br>Required level '.$ReqLevel.'<br>'.$instance->ItemData($Code,"Race").'<br>';
			}

			//Print Gender
			If($fetchGetInfo['ReqGender'] == 0){
				echo"Female<br>";
			}elseif($fetchGetInfo['ReqGender'] == 1){
				echo"Male<br>";
			}
			
			//Print MaxMagicOptOption
			if($MaxMagic != 0){
			echo'<br><span style="color:#efdaa4;">Max. no. of magic options: '.$fetchGetInfo['MaxMagicOptCount'].' Unit</span>';
			}
				
		/**************************************************
					  BLUE STATS STATR HERE
		**************************************************/
	
	
		if($fetchGetItem['MagParamNum'] > 0) {
			//space
			echo '<br><br>';

			//Blue Stats start here
			for($x = 1; $x <= $fetchGetItem['MagParamNum']; $x++) 
			{
				$param = 'MagParam'.$x;
				$ParamValues = $sql->query("select convert(int, cast(SUBSTRING(CONVERT(VARBINARY(5), cast((SELECT ".$param." FROM $dbs[SHARD].._Items where ID64 = '$fetchGetItem[ID64]') as bigint)),5,1) as varbinary)) as Mag1ID, convert(int, cast(SUBSTRING(CONVERT(VARBINARY(5), cast((SELECT ".$param." FROM $dbs[SHARD].._Items where ID64 = '$fetchGetItem[ID64]') as bigint)),1,1) as varbinary)) as Mag1Num");
				$MagParams = $sql->QueryFetchArray($ParamValues);
				$BluesQry = $sql->query("SELECT * FROM $dbs[SHARD].._RefMagicOpt where ID = '$MagParams[Mag1ID]'");
				$BlueParam = $sql->QueryFetchArray($BluesQry);
				$ParamNum = $MagParams['Mag1Num'];
				echo "<span style='color:#50cecd;font-weight: bold;'>".$instance->Blues($BlueParam['MOptName128'],$ParamNum,$BlueParam['MLevel'])."</span><br>";
			}
		}
			
			// Advance Section here
			if ((($kind == 0) || ($kind == 1) || ($kind == 2) || ($kind == 3)) && ($degree > 0) && ($degree <= 14)){
			if ($Advance != 0){
				echo '<br><span style="font-weight:bold">Advanced elixir is in effect [+'.$Advance.']</span></br>';
			} else {
				echo '<br><span style="font-weight:bold">Able to use Advanced elixir.</span></br>';
			} 
			}
			
			elseif ($MaxMagic < 1) {
				if ($MaxStack < $Amount){$Amount = "1";}
				echo '<br><br>Quantity (<b>'.$Amount.'</b>)';
			} 
			
			if($instance->ItemData($Code,"Devil") && $MaxMagic == 9){
				//echo'<br>'.date("h:M;Y",$Amount).'';
			echo'<br><br><span style="color:#efdaa4;font-weight:bold;">Awaken period</span><br>';
			echo $instance->DevilTime($Amount,28);
			}
			

//If there is no item
} else {
echo"This slot is empty.";
}

?>