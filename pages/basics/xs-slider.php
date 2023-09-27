  <!--START: Small Header-->
    <div class="nk-main">
        <div class="<?= $HeaderStatus; ?> nk-header-title nk-header-title-xs nk-header-title-parallax-opacity">
            <div class="bg-image" data-mouse-parallax-z="1">
			    <? $ImageURL = array_rand(($SliderImages), 2);?>
                <div style="background-image: url('<?= $SliderImages[$ImageURL[0]];?>');"></div>
            </div>
            <div class="nk-header-table">
                <div class="nk-header-table-cell">
                    <div class="container">


                        <div class="nk-header-text">
                           <h1 class="nk-title display-3"><?= $OtherTitle ?> <?= $PageMainTitle ?></h1>
                        </div>

                    </div>
                </div>
            </div>

			<div class="nk-header-text-bottom">
                <div class="nk-breadcrumbs text-xs-center">
                    <ul>
                        <li><a href="/">Home</a></li>
						
                        <li>
                            <span><?= $PageMainTitle ?></span>
                        </li>
						
						<? if (!is_null($OtherTitle)) { ?>
							
						<li>
                            <span><?= $OtherTitle?></span>
                        </li>
						
						<? } ?>
						
                    </ul>
                </div>
            </div>
			
        </div>
        <!-- END: Small Header -->