<?php
if(!empty($_SESSION['username'])) {
	
if(isset($_POST['reward']))
{	
	
	$q = $sql->query("select TOP 1 * from _SpinLog where Username=:Username order by Date desc",array('Username'=>$_SESSION['username']));
	$qr = $q->fetchAll();
	$spinned = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) > $spinEvery ? 0 : 1 : 0;
	$lastSpin = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) : $spinEvery+1;
	
	

	$RandAmount = array_rand(($rewards), 2);
	$amount = $rewards[$RandAmount[0]];
	
	if($lastSpin < $spinEvery)
	{
		die("Cant Process Reward Request. <b>Already rewarded</b>");
	}
	
	if(in_array($amount,$rewards))
	{
		$sql->Reward($amount,$_SESSION['username']);
		$lastSpin = $sp->SpinTime(date('Y-m-d H:i:s'));
		$func->Notification("You have won $amount silks.",5);
	}
	}

	if ($_GET['sup'] == "Treasure"){
	if(isset($_POST['treasure'])){	
	
	$BoxNumber = $_POST['number'];
	
	$q = $sql->query("select TOP 1 * from _SpinLog where Username=:Username order by Date desc",array('Username'=>$_SESSION['username']));
	$qr = $q->fetchAll();
	$spinned = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) > $spinEvery ? 0 : 1 : 0;
	$lastSpin = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) : $spinEvery+1;
	
	//Get random from the array
	$RandAmount = array_rand(($rewards), 2);
	$amount = $rewards[$RandAmount[0]];
	
	//If the user is already rewarded
	if($lastSpin < $spinEvery)
	{
		$func->Notification("Sorry you already rewarded.",5);
	} else {
	
	//Check the number in array or no
	if(in_array($amount,$rewards))
	{
		$sql->Reward($amount,$_SESSION['username']);
		$lastSpin = $sp->SpinTime(date('Y-m-d H:i:s'));
		echo '<h4 style="color:orange">You won '.$amount.' silk.</h4>';
	}
	}
	
	}
	}
	
	}else{	
		die("Login First! $username");
	}

?>