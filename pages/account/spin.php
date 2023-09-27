<style>

/* Sets the background image for the wheel */
td.the_wheel
{
    background-image: url(assets/images/spin/wheel_back.png);
    background-position: center;
    background-repeat: none;
	background-color: #0e0e0e;
	box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.5);
}

/* Do some css reset on selected elements */
h1, p
{
    margin: 0;
    font-family: Marcellus SC, serif;
}

div.power_controls
{
    margin-right:70px;
}

div.html5_logo
{
    margin-left:70px;
}

/* Styles for the power selection controls */
table.power
{
    background-color: #cccccc;
    cursor: pointer;
    border:1px solid #333333;
}

table.power th
{
    background-color: white;
    cursor: default;
}

td.pw1
{
    background-color: #6fe8f0;
}

td.pw2
{
    background-color: #86ef6f;
}

td.pw3
{
    background-color: #ef6f6f;
}

/* Style applied to the spin button once a power has been selected */
.clickable
{
    cursor: pointer;
}

/* Other misc styles */
.margin_bottom
{
    margin-bottom: 5px;
}
.diabled-spin {
	cursor:not-allowed;
	border-radius:4px
}
</style>
<script src="assets/js/Winwheel.js"></script>
<?
if (!isset($_SESSION['LogIn'])){$func->userRedirect("/");}
?>


<div class="nk-gap-3"></div>

<div align="center"><br>
<div id="notification"></div>
<br>

<table cellpadding="0" cellspacing="0" border="0">

<tr>

<td>
<img id="spin_button" src="/assets/images/spin/spin_on.png" alt="Spin" style="cursor:pointer;border-radius:4px" onClick="startSpin();" />
</td>

<td width="438" height="582" class="the_wheel" align="center" valign="center">
    <canvas id="canvas" width="434" height="434">
        <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
    </canvas>
</td>

</tr>

</table>

</div>
<?
	$q = $sql->query("select TOP 1 * from _SpinLog where Username=:Username order by Date desc",array('Username'=>$_SESSION['username']));
	$qr = $q->fetchAll();
	$spinned = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) > $spinEvery ? 0 : 1 : 0;
	$lastSpin = count($qr) > 0 ? $sp->SpinTime($qr[0]['Date']) : $spinEvery+1;
	$colors = array('rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)','rgba(255, 255, 255, 0)');
?>
 
<? echo $sp->StartSpin($rewards,$colors,$winMessage,$spinned,$lastSpin,$spinEvery); ?>

<div class="nk-gap-6"></div>