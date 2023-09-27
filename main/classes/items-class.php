<?php

class CItemInfo
{
private $m_ItemType = 0;
private $m_nCurParam = 0;
private $m_CurStatParams = array();

public static $s_WeaponStatNames =
array('Durability', 'PhyReinforce', 'MagReinforce', 'HitRatio', 'PhyAttack', 'MagAttack', 'CriticalRatio');

public static $s_EquipmentStatNames =
array('Durability', 'PhyReinforce', 'MagReinforce', 'PhyDefense', 'MagDefense', 'ParryRatio');

public static $s_ShieldStatNames =
array('Durability', 'PhyReinforce', 'MagReinforce', 'BlockRatio', 'PhyDefense', 'MagDefense');

public static $s_AccessoryStatNames =
array('PhyAbsorb', 'MagAbsorb');



public function __construct($item_type)
{
if($item_type > 3 || $item_type < 0) die("Item with type > 4 or < 0 !!1 (CItemInfo)!!");
$this -> m_ItemType = $item_type;
}

public function AddParam($param_value)
{
$this -> m_CurStatParams[$this -> m_nCurParam++] = $param_value;
}

public function GetParamCountForItem()
{
switch($this -> m_ItemType)
{
case 0:
{
return count(self::$s_WeaponStatNames);
}
break;
case 1:
{
return count(self::$s_EquipmentStatNames);
}
break;
case 2:
{
return count(self::$s_ShieldStatNames);
}
break;
case 3:
{
return count(self::$s_AccessoryStatNames);
}
break;
}
}

public function GetParams()
{
$result = array(array());



switch($this -> m_ItemType)
{
case 0:
{
for($i = 0; $i < count (self::$s_WeaponStatNames); $i++)
{
$result[$i] =
array(self::$s_WeaponStatNames[$i] => $this -> m_CurStatParams[$i]);
}
}
break;
case 1:
{
for($i = 0; $i < count (self::$s_EquipmentStatNames); $i++)
{
$result[$i] =
array(self::$s_EquipmentStatNames[$i] => $this -> m_CurStatParams[$i]);
}
}
break;
case 2:
{
for($i = 0; $i < count (self::$s_ShieldStatNames); $i++)
{
$result[$i] =
array(self::$s_ShieldStatNames[$i] => $this -> m_CurStatParams[$i]);
}
}
break;
case 3:
{
for($i = 0; $i < count (self::$s_AccessoryStatNames); $i++)
{
$result[$i] =
array(self::$s_AccessoryStatNames[$i] => $this -> m_CurStatParams[$i]);
}
}
break;
}
return $result;
}
}

class CItemClass
{

static $s_Instance;

private function __construct()
{

}

protected function __clone()
{

}

static public function Instance()
{
if(is_null(self::$s_Instance))
{
self::$s_Instance = new self();
}
return self::$s_Instance;
}

public function PercentageFromBitvalue($bitvalue)
{
return round(($bitvalue * 100 / 31) - 0.5 , 0);
}


public function GetVarianceDump($variance, $item_type_id)
{
$result = null;
$g_Item = new CItemInfo($item_type_id);

$n = 0;
$nParams = $g_Item -> GetParamCountForItem();
while($n < $nParams)
{
$cur_stat = $variance & 0x1F;
$g_Item -> AddParam($this -> PercentageFromBitvalue($cur_stat));
$variance >>= 5;
$n++;

}

//print_r($g_Item -> GetParams());
return $g_Item -> GetParams();
}

/**Other Functions**/
function Part_Type ($string) {
$find[] = "CA"; $replace[] = "Head";
$find[] = "HA"; $replace[] = "Head";
$find[] = "BA"; $replace[] = "Chest";
$find[] = "LA"; $replace[] = "Legs";
$find[] = "SA"; $replace[] = "Shoulder";
$find[] = "AA"; $replace[] = "Hands";
$find[] = "FA"; $replace[] = "Foot";
return str_replace($find, $replace, $string);
}

#--- Function to fix Gear differences ---#
function Set_Type ($string,$race) {
if ($race == "CH"){
$find[] = "CLOTHES"; $replace[] = "Garment";
$find[] = "HEAVY"; $replace[] = "Armor";
$find[] = "LIGHT"; $replace[] = "Protector";
} elseif ($race == "EU"){
$find[] = "CLOTHES"; $replace[] = "Robe";
$find[] = "HEAVY"; $replace[] = "Heavy Armor";
$find[] = "LIGHT"; $replace[] = "Light Armor";
}
return str_replace($find, $replace, $string);
}

#--- Small function to replace the special items, not even hard LEL ---#
function Sox_Type ($string) {
$find[] = "SET_A_RARE"; $replace[] = "Power";
$find[] = "SET_B_RARE"; $replace[] = "Fight";
$find[] = "A_RARE"; $replace[] = "Seal of Nova";
$find[] = "B_RARE"; $replace[] = "Seal of Moon";
$find[] = "C_RARE"; $replace[] = "Seal of Sun";
return str_replace($find, $replace, $string);
}

#--- Function created because iSRO sucks naming "Glaive to tblade and shit, u fekker" ---#
function Weapon_Name ($string) {
$find[] = "Tblade"; $replace[] = "Glaive";
$find[] = "Tstaff"; $replace[] = "Two handed staff";
$find[] = "Tsword"; $replace[] = "Two handed sword";
$find[] = "Staff"; $replace[] = "Light staff";
$find[] = "Darkstaff"; $replace[] = "Dark staff";
return str_replace($find, $replace, $string);
}
#--- Function created to work with chernos fucking stat combiner ---#
function Part_Number ($string) {

//Weapons
$find[] = "Glaive"; $replace[] = 0;
$find[] = "Two handed staff"; $replace[] = 0;
$find[] = "Two handed sword"; $replace[] = 0;
$find[] = "Light staff"; $replace[] = 0;
$find[] = "Dark staff"; $replace[] = 0;
$find[] = "Bow"; $replace[] = 0;
$find[] = "Sword"; $replace[] = 0;
$find[] = "Spear"; $replace[] = 0;
$find[] = "Harp"; $replace[] = 0;
$find[] = "Crossbow"; $replace[] = 0;
$find[] = "Dagger"; $replace[] = 0;

//Set
$find[] = "Head"; $replace[] = 1;
$find[] = "Chest"; $replace[] = 1;
$find[] = "Legs"; $replace[] = 1;
$find[] = "Shoulder"; $replace[] = 1;
$find[] = "Hands"; $replace[] = 1;
$find[] = "Foot"; $replace[] = 1;

//Shield
$find[] = "Shield"; $replace[] = 2;

//Accessory
$find[] = "Necklace"; $replace[] = 3;
$find[] = "Ring"; $replace[] = 3;
$find[] = "Earring"; $replace[] = 3;

return str_replace($find, $replace, $string);
}


/**Blues Function**/
function Blues ($Str,$Num,$Rate) {
$BlueRate = ($Num / $Rate) * 100;

//Fix MP and HP
If(($Str == "MATTR_HP" || $Str == "MATTR_MP")){
	if($Num == "20"){$Num = "1300";}
	elseif($Num == "82"){$Num = "850";}
	elseif($Num == "194"){$Num = "600";}
	elseif($Num == "144"){$Num = "600";}
}
//Job suits
$find[] = "MATTR_STR_3JOB";    $replace[] = "Suit $Num% Increase";

//Avatar
$find[] = "MATTR_AVATAR_MDIA";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_DRUA";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_DARA";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_ER";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_STR";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_HR";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_HPRG";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_AVATAR_HP";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_STR_AVATAR";    $replace[] = "Avatar $Num% Increase";
$find[] = "MATTR_INT_AVATAR";    $replace[] = "Avatar $Num% Increase";

//Basics
$find[] = "MATTR_STR";              $replace[] = "Str $Num Increase";
$find[] = "MATTR_INT";              $replace[] = "Int $Num Increase";
$find[] = "MATTR_HP";               $replace[] = "HP $Num Increase";
$find[] = "MATTR_MP";               $replace[] = "MP $Num Increase";
$find[] = "MATTR_DUR";              $replace[] = "Durability $Num% Increase";
$find[] = "MATTR_ER";               $replace[] = "Parry rate $Num% Increase";
$find[] = "MATTR_HR";               $replace[] = "Attack rate $Num% Increase";
$find[] = "MATTR_EVADE_BLOCK";      $replace[] = "Blocking rate $Num% Increase";
$find[] = "MATTR_EVADE_CRITICAL";   $replace[] = "Critical $Num";
$find[] = "MATTR_LUCK";             $replace[] = "Lucky (".$Num."Time/times)";
$find[] = "MATTR_SOLID";            $replace[] = "Steady (".$Num."Time/times)";
$find[] = "MATTR_ATHANASIA";        $replace[] = "Immortalt (".$Num."Time/times)";
$find[] = "MATTR_ASTRAL";           $replace[] = "Astral (".$Num."Time/times)";

//Accessory
$find[] = "MATTR_RESIST_BURN";      $replace[] = "BurnHour $Num% Reduce";
$find[] = "MATTR_RESIST_FROSTBITE"; $replace[] = "Freezing,FrostbiteHour $Num% Reduce";
$find[] = "MATTR_RESIST_POISON";    $replace[] = "PoisoningHour $Num% Reduce";
$find[] = "MATTR_RESIST_ESHOCK";    $replace[] = "Electric  shockHour $Num% Reduce";
$find[] = "MATTR_RESIST_ZOMBIE";    $replace[] = "ZombieHour $Num% Reduce";

//Durability 
$find[] = "MATTR_DEC_MAXDUR";    $replace[] = "<span style='color:#ff2f51;font-weight: bold;'>Maximum Durability $Num% Reduce</span>";

return str_replace($find, $replace, $Str);
}

/*** Item Data Function ***/
function ItemData ($CodeName,$Type){
	
//Explode the codename
$main_explode = explode("_",$CodeName);

if($Type == "Race")
{
		//Item gender
		$gender = $main_explode[1];
		if ($gender == "CH"){
			return "Chinese";
		}elseif ($gender == "EU"){
			return  "European";
		}
}

if($Type == "SortBy")
{
			//Item gender
			$gender = $main_explode[1];
			$name = $main_explode[3];
			return $this->Set_Type($name,$gender);
}

if($Type == "Devil")
{
		//Item gender
		$name = $main_explode[4];
		$mall = $main_explode[1];
		if($name == "NASRUN" && ($mall == "MALL" || $mall == "EVENT")){
		return true;
		}
}

}

/*Devil Time function*/
function DevilTime($DevilTime,$Equal)
{
$now = new DateTime(date('Y-m-d H:i:s'));
$TimeConvert = date('Y-m-d H:i:s', $DevilTime);
$date_b = new DateTime($TimeConvert);

$diff = $now->diff($date_b);

$Days = $Equal-($diff->format('%d'));
//$Hours = ($Equal*24)-($diff->format('%h'));
//$Minutes = ($Equal*24*60)-($diff->format('%i'));

return "".$Days." Days";
}

/** Sort filter **/
Function Sort_Filter ($Str,$MaxMagic){
	
if($MaxMagic == "1"){
	$find[] = "Avatar";    $replace[] = "Avatar Attach";
} else if ($MaxMagic == "2") {
	$find[] = "Avatar";    $replace[] = "Avatar Hat";
} else if ($MaxMagic == "4") {
	$find[] = "Avatar";    $replace[] = "Avatar Dress";
} else if ($MaxMagic == "9") {
	$find[] = "Avatar";    $replace[] = "Devil spirit's";	
} else {
	$find[] = "P";    $replace[] = "Pet";	
	$find[] = "Ammo";    $replace[] = "Arrow";	
}

return str_replace($find, $replace, $Str);
}
	
/** Empty Slot function **/
Public function EmptySlot($ItemID,$Slot){
	if($ItemID == "0"){
	if($Slot == "0"){Return "/assets/images/item/slots/head.png";}if($Slot == "1"){Return "/assets/images/item/slots/chest.png";}  
	if($Slot == "3"){Return "/assets/images/item/slots/hands.png";} if($Slot == "4"){Return "/assets/images/item/slots/legs.png";}
	if($Slot == "5"){Return "/assets/images/item/slots/foot.png";} if($Slot == "6"){Return "/assets/images/item/slots/weapon.png";}
	if($Slot == "7"){Return "/assets/images/item/slots/shield.png";} if($Slot == "9"){Return "/assets/images/item/slots/earring.png";}
	if($Slot == "10"){Return "/assets/images/item/slots/necklace.png";} if($Slot == "11"){Return "/assets/images/item/slots/ring.png";}
	if($Slot == "12"){Return "/assets/images/item/slots/ring.png";}if($Slot == "2"){Return "/assets/images/item/slots/shoulder.png";}
	} else {
		Return "/assets/images/item/slots/empty.png";
	}
}

}
?>