<?php
	/*if(!isset($product_nameen)){ $product_nameen ='';}
	if(!isset($product_nameth)){ $product_nameth ='';}
	if(!isset($product_topic)){ $product_topic ='';}
	if(!isset($product_desc)){ $product_desc ='';}
	if(!isset($product_category)){ $product_category ='';}
        if(!isset($product_price)){ $product_price ='';}
	if(!isset($linkyoutube)){ $linkyoutube ='';}
	if(!isset($currentID)){ $currentID ='';}*/
	if($currentID != ''){
		foreach($visitDetail->result() AS $visit){}
	}
?>
<script type="text/javascript" src="<?php echo base_url('assets/js/chunk-uploader.js')?>"></script>
<div class="wrapper">
<div class="container-fluid">

<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">

			<h4 class="page-title">Visit Showroom</h4>
                        <br>
			<div class="row">
				<div class="col-sm-12">
					<div class="card m-b-30 card-body">
						<h5 class="card-title">
						<div class="progress mb-0" style="display: none">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
						</div>

							<div class="pull-right">
                            <?php if($currentID != ''){ ?>
								<button type="button" class="btn btn-success btn-sm" onClick="window.location.href='<?php echo base_url('Control/visitshowroom_add')?>'"><i class="fa fa-plus"></i> Add Visit Showroom</button>&nbsp;&nbsp;
                            <?php } ?>
								<button type="button" class="btn btn-info btn-sm" onClick="window.location.href='<?php echo base_url('Control/visitshowroom_list')?>'">Back</button></div>
						</h5>
						<!-------------->					
							
						 <ul class="nav nav-tabs">
                                
                             <li class="nav-item">
                                 <a href="#detail" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    <i class="icon-note"></i> Detail
                                 </a>
                             </li>
			
                         </ul>
							
                         <div class="tab-content">							 
                            
                             <div class="tab-pane show active" id="detail">
							 <form enctype="multipart/form-data" id="productForm" name="productForm">
								 
								<div class="form-group row">
									  <label class="col-3 col-form-label">Showroom Name</label>
										<div class="col-9">
											<input type="text" id="name_th" name="name_th" class="form-control form-control-sm" value="<?php if($currentID != ''){ echo $visit->name_th; }?>">
										</div>									   
								</div>
								 
								<div class="form-group row">
								  <label class="col-3 col-form-label">Showroom Detail</label>
									<div class="col-9">
										<textarea id="overview_th" name="overview_th" class="summernote"><?php if($currentID != ''){ echo $visit->detail_th; }?></textarea>
										
									</div>								   
								</div>
								<div class="form-group row" >
									<div class="col-12" style="text-align: center">
										<button type="button" class="btn btn-success btn-sm" onClick="Addvisit()">Add / Edit Data</button>
										<input type="hidden" name="currentID" id="currentID" value="<?php echo $currentID?>">
									</div>
							 	</div>                            
                                                           
							    <div class="row">
								<div class="col-6">
									<div class="card m-b-30">
										<h6 class="card-header">Add Images</h6>
										<div class="card-body">
											<div class="form-group row">
												<div class="col-7">
										 			<input type="file" id="ImagesFiles" name="userFiles[]" />
												</div>
												<div class="col-5">
													<a href="#" class="btn btn-custom waves-effect waves-light" onClick="Addvisit()">Add Images</a>
												</div>
												<br><a>(Supports image file extension jpg, gif, png. File size should not exceed 2MB. Picture size 1000 x 530 pixels.)</a>										
												<div id="showImage" style="margin-top: 5px;width: 100%"></div>
											</div>
										</div>
									</div>
								</div>
                                                                <div class="col-6">
									<div class="card m-b-30">
										<h6 class="card-header">Add Images 360</h6>
										<div class="card-body">
											<div class="form-group row">
												<div class="col-7">
										 			<input type="file" id="ImagesFiles360" name="userFiles360[]" multiple />
												</div>
												<div class="col-5">
													<a href="#" class="btn btn-custom waves-effect waves-light" onClick="Addvisit()">Add Images</a>
												</div>
												<br><a>(Supports image file extension jpg, gif, png. File size should not exceed 2MB. Picture size 1000 x 530 pixels.)</a>										
												<div id="showImage360" style="margin-top: 5px;width: 100%"></div>
											</div>
										</div>
									</div>
								</div>
								
						    </div>
						</form>		 
						</div>	
                             	    
                     </div>			
					
					</div>
				</div>				
				
				<div class="modal fade bs-example-modal-sm modal-dialog-centered" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="background-color: #bdbdbd61; display: none;" id="divload">
                    <div class="modal-dialog modal-sm" style="top: 44%;">                         
                         <div class="modal-body"><img src="<?php echo base_url('HTML_2/images/LOADING-APITU-SERVER.gif')?>" ></div>                         
                    </div>
                </div>			

			</div>
		</div>
	</div>
<!--</div>-->
<!-- end page title end breadcrumb -->

</div> <!-- end container -->
</div>