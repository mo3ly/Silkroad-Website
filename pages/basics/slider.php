  <!--START: Header-->
    <div class="nk-main">
        <div class="<?= $HeaderStatus; ?> nk-header-title nk-header-title-lg nk-header-title-parallax-opacity">
            <div class="bg-image">
                <div style="background-image: url('assets/images/image-1.jpg');"></div>
            </div>
            <div class="nk-header-table">
                <div class="nk-header-table-cell">
                    <div class="container">




                        <div class="nk-header-text">

                           <h1 class="nk-title display-3"><?= $ServerName ?></h1><br>
							
							<h2> 
							<span class="db hidden-sm-up"></span>
                            <span class="nk-typed" data-loop="true" data-shuffle="false" data-cursor="false" data-type-speed="90" data-start-delay="0" data-back-speed="60" data-back-delay="1000">
                            
                            <span>Server is <?= $func->ServerStatus($IP,$Port) ?>.</span>
                            <span><?= $sql->PlayerCount($ShardID); ?> online Player(s).</span>
                            <span>The real way to fun!</span>
                            </span>
					       </h2>

                            <div class="nk-gap-2"></div>
							<? if(!isset($_SESSION['LogIn'])) { ?>
                            <a href="/register" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Register Now!</span>
                            </a>
                            <? } else { ?>
							<a href="/ranking" class="nk-btn nk-btn-lg link-effect-4">
                                <span>Ranking!</span>
                            </a>
							<? } ?>
                            <div class="nk-gap-4"></div>

                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- END: Header Title -->