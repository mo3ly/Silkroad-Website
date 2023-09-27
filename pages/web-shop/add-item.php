<? if ($sql->Admin($_SESSION['username'],$Gm_Number)){ ?>
<div id="AddItemModal" class="modal nk-modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalShop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ion-android-close"></span>
                    </button>
                    <h4 class="modal-title nk-title" id="myModalShop">Add Item</h4>
                </div>
                <div class="modal-body">
				
				<form class="nk-form nk-form-ajax nk-form-style-1" action="/adminshop/add" method="POST">
					
					<!-- RESULTS -->
					<div class="row">
						<div class="col-xs-12">
							<div  class="nk-form-response-success" ></div>
							<div  class="nk-form-response-error" ></div>
						</div>
					</div> 
					
					<!-- ITEM DATA -->   
					<div class="row">
						<div class="col-sm-6">
							<span>Item Code <span style="color:red">*</span></span>
								<input type="text" class="form-control required" placeholder="Item Code" name="ItemCode" autocomplete="off" />
							<div class="nk-gap"></div>
						</div>
					
						<div class="col-sm-6">
							<span>Item Name <span style="color:red">*</span></span>
								<input type="text" class="form-control required" placeholder="ItemName" name="ItemName" />
							<div class="nk-gap"></div>
						</div>
					</div>
					
					<!-- ITEM INFO -->   
					<div class="row">
						<div class="col-sm-6">
							<span>Max Plus <span style="color:red">*</span></span>
								<input type="number" class="form-control required" placeholder="Max Plus" name="MaxPlus" autocomplete="off" />
							<div class="nk-gap"></div>
						</div>
					
						<div class="col-sm-6">
							<span>Gender <span style="color:red">*</span></span>
								<select class="form-control required" name="Gender" >
									<option value="male">Male</option>
									<option value="female">Female</option>
									<option value="none">None</option>
								</select>
							<div class="nk-gap"></div>
						</div>
					</div>
					
					<!-- ITEM DETAILS --> 
					<div class="row">
						<div class="col-sm-6">
							<span>Item Price <span style="color:red">*</span></span>
								<input type="number" class="form-control required" placeholder="Item Price" name="Price" />
							<div class="nk-gap"></div>
						</div>
					
						<div class="col-sm-6">
						  <span>Section <span style="color:red">*</span></span>
							  <select type="text" class="form-control required"  name="Sort"  autocomplete="off" >
								<option value="hot">Hot</option>
								<option value="devil">Avatar - Devil</option>
								<option value="dress">Avatar - Dress</option>
								<option value="hat">Avatar - Hat</option>
								<option value="attach">Avatar - Attach</option>
								<option value="pets">Pets</option>
								<option value="weaponeu">Gears - EUR Weapon</option>
								<option value="equipeu">Gears - EUR Equipment</option>
								<option value="accessoryeu">Gears - EUR Accessory</option>
								<option value="weaponch">Gears - CHN Weapon</option>
								<option value="equipch">Gears - CHN Equipment</option>
								<option value="accessorych">Gears - CHN Accessory</option>
								<option value="others">Others</option>
							  </select>
						  <div class="nk-gap"></div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
						 <span>Item Decription <span style="color:red">*</span></span>
							  <input type="text" class="form-control required" placeholder="Item Decription" name="Description"  autocomplete="off" />
						  <div class="nk-gap"></div>
						</div>
					</div>
					
					<!-- SUBMIT -->
					<div class="row">
						<div class="col-sm-12">
							<button type="submit" class="nk-btn nk-btn-lg link-effect-4">
										<span>Add item</span>
							</button>
						</div>
					</div>
					
				</form>
				
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- END: Modal -->
</div>
<? } ?>