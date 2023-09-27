<?php
 Class Spin {
	 
	function StartSpin($rewards = array(), $colors = array(), $winMessage, $spinned, $lastSpin, $spinEvery)
	{
		$Win = str_replace("xxx","'+winningSegment.text+'",$winMessage);
	
			echo "<script>
				// Create new wheel object specifying the parameters at creation time.
				var theWheel = new Winwheel({
                'numSegments'  : ".count($rewards).",     // Specify number of segments.
                'outerRadius'  : 212,   // Set outer radius so wheel fits inside the background.
                'textFontSize' : 32,    // Set font size as desired.
                'segments'     :        // Define segments including colour and text.
                [\n";
				$segs = "";
				for($i = 0; $i < count($rewards); $i++)
				{
                   $segs .= "{'fillStyle' : '".$colors[$i]."', 'text' : '??'},\n";
				}
				echo substr($segs, 0, -2);
			echo "
                ],
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 5,     // Duration in seconds.
                    'spins'    : 12,     // Number of complete spins.
                    'callbackFinished' : 'alertPrize()'
                }
            });
            
            // Vars used by the code in this page to do power controls.
            var wheelPower    = 0;
            var wheelSpinning = false;
            var spinned = ".$spinned.";
            // -------------------------------------------------------
            // Click handler for spin button.
            // -------------------------------------------------------
            function startSpin()
            {
				if(spinned == 1)
				{
					var timeRemaining = ".$spinEvery."-".$lastSpin.";
					$('div#notification').html('<center><h3 style=\"color:darkred\">Sorry you spinned the wheel today, you have to wait '+timeRemaining+' hours.</h3></center>');
					return;
				}
				
                if (wheelSpinning == false)
                {
                    // Disable the spin button so can't click again while wheel is spinning.
                    document.getElementById('spin_button').src       = 'assets/images/spin/spin_off.png';
                    document.getElementById('spin_button').AddClass = 'diabled-spin';
                    
                    // Begin the spin animation by calling startAnimation on the wheel object.
                    theWheel.startAnimation();
                    
                    // Set to true so that power can't be changed and spin button re-enabled during
                    // the current animation. The user will have to reset before spinning again.
                    wheelSpinning = true;
                }
            }
            
            // -------------------------------------------------------
            // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
            // -------------------------------------------------------
            function alertPrize()
            {
                // Get the segment indicated by the pointer on the wheel background which is at 0 degrees.
                var winningSegment = theWheel.getIndicatedSegment();
                
                // Do basic alert of the segment text. You would probably want to do something more interesting with this information.       
				var prize = winningSegment.text;
				$.ajax({
					url: '/spinreward',
					type: 'post',
					data: 'reward=true&amount='+prize+'',
					success: function (data) {
						$('div#notification').html(data);
						window.setTimeout(function() {
						window.location.reload();
						}, 5000);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert(jqXHR);
					}		
				});
            }
			
			</script>";
	}

	function SpinTime($lastSpin)
	{
		$date_a = new DateTime(date('Y-m-d H:i:s'));
		$date_b = new DateTime($lastSpin);
		
		$interval = date_diff($date_a,$date_b);
		
		return $interval->format('%h');
	}

}
	