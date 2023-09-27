<div class="nk-gap-3"></div>
<div class="container">
<h1>Online Players</h1>
<div class="nk-box-2 bg-dark-1">
<script type="text/javascript" src="/assets/js/jquery.flot.min.js"></script>
<script src="/assets/js/jquery.flot.tooltip.min.js"></script>
<script src="/assets/js/jquery.flot.resize.min.js"></script>
<?
$Query = "SELECT TOP 100 nUserCount, dLogDate from $dbs[ACC].._ShardCurrentUser where nShardID = '64' order by dLogDate DESC";
$QryExec = $sql->query($Query);
?>
<script type="text/javascript">	
	var d2 = [], aLabel = [];
		<? for($i=0;	$i <= $Data = $sql->QueryFetchArray($QryExec);	$i++){ ?>
			aLabel.push("<?= date('H:i', strtotime($Data['dLogDate']));?>");
			d2.push(["<?=$i?>", "<?= $Data['nUserCount'];?>"]);
		<? } ?>
		
	jQuery(document).ready(function() {
		
		jQuery.plot("#placeholder", [
			{ label: "Player", data: d2 }
		],{
			colors: ["#808000"],
			series: {
				lines: { show: true },
				points: { show: true }
			},
			grid: {
				hoverable: true,
				clickable: true,
				borderWidth: {
					top: 1,
					right: 1,
					bottom: 1,
					left: 1
				},
    			color: "#746441"
			},
			xaxis: {
				tickFormatter: xAxisLabelGenerator
			},
			yaxis: {
				axisMargin: 10,
				tickDecimals: 0
			},
			shadowSize: 1,
			tooltip: true,
			tooltipOpts: {
				content: "<span style='color:black;font-family:Marcellus SC, serif;font-weight: bold;'><b class='fa fa-user'></b> %y  online player at %x</span>",
			}
		});
	});

	function xAxisLabelGenerator(x){
		return aLabel[x];
	}

</script>
<div id="placeholder" style="height: 400px"></div>
</div>
</div>
<div class="nk-gap-6"></div>