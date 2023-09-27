<?  
if(!isset($_SESSION['LogIn'])){$func->userRedirect("/");}

if (!$sql->Admin($_SESSION['username'],$Gm_Number)){$func->userRedirect("/");}

If ($_GET['third']){
  $Page = $_GET['third'];
} else {
  $Page=1;
}

$AllRows =  count($sql->query("SELECT * FROM $dbs[WEB].._Tickets order by Date DESC")->fetchAll());
$Total = ceil($AllRows / $row_per_page); // Count all rows

if ($AllRows > 1){
if($Page > $Total){$func->userRedirect("/admin/tickets/",false);}
}
?>  			
								
	<div class="nk-gap-3"></div>    
		<div class="container">
					<div class="col-md-12">
						<div class="nk-box-2 bg-dark-1">
						<!-- Main title -->
                       
						<h1 style="color:orange" class="nk-title h1" >Tickets</h1>
						<h4>Total tickets [ <?= $AllRows?> ]</h4>
						<div class="nk-gap"></div>
						
                        <div class="table-responsive">
                            <table class="table table-bordered">
								<?php 
								$Start = ($Page - 1) * $row_per_page;
								$qry = "SELECT * FROM $dbs[WEB].._Tickets order by Date DESC OFFSET $Start ROWS FETCH NEXT $row_per_page ROWS ONLY";
								if($sql->QueryHasRows($qry)){
								?>
									<thead>
										<tr>
											<th>Character</th>
											<th>Title</th>
											<th>Status</th>
											<th>Date</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
									$QuryTickets = $sql->query($qry);
									while($Data = $sql->QueryFetchArray($QuryTickets)){
									$ID = $Data['ID'];
									$Owner = $Data['CharName'];//Charname
									$Title = $Data['Title'];//Ticekt title
									//Ticket status
									if ($Data['Status'] == 0){
										$Status = "<em style='color:#a00000;font-weight:bold'>Not Solved</em>";
									} else {
										$Status = "<em style='color:#00a009;font-weight:bold'>Solved</em>";
									}
									$Date = $func->time_ago($Data['Date']);
									?>
                                    <tr class="order">
									    <!--Item Slot-->
										<td><?= $Owner;?></td>
										<td><?= $Title;?></td>
										<td><?= $Status;?></td>
										<td><?= $Date;?></td>
                                        <td><a style="cursor: pointer;" href="/account/viewticket/<?= $ID;?>" class="nk-btn link-effect-4">Show</a></td>
                                    </tr>
									<?php }
									}else {
										//If there is no tickets
										echo'<h4>Sorry there is no tickets.</h4>';
									} ?>
                                </tbody>
							</table>
							</div>
							<!-- START: Pagination -->
							<div class="nk-pagination nk-pagination-left">
								<?php $pgn->Pagination($Page,"/admin/tickets/",$Total);?>
							</div>
							<!-- END: Pagination -->
			 </div>
		 </div>
	</div>
	<div class="nk-gap-4"></div>
	<div class="nk-gap-3"></div>