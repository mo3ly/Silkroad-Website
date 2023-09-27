<? if (isset($_SESSION['LogIn'])){ ?>
<div id="AlchemyItems" class="modal nk-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalAlchemy" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ion-android-close"></span>
                    </button>
                    <h4 class="modal-title nk-title" id="myModalAlchemy">Items</h4>
                </div>
                <div class="modal-body">
				<div id="LoadItems"></div>
				
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- END: Modal -->
</div>
<? } ?>