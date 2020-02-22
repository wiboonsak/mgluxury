 <?php  if(!isset($currentID)){ $currentID='';}
		if(!isset($company)){ $company ='';}
		if(!isset($address)){ $address ='';}
		if(!isset($phone)){ $phone = '';}
		if(!isset($fax)){ $fax ='';}
		if(!isset($email)){ $email ='';}
		if(!isset($facebook)){ $facebook ='';}
		if(!isset($map)){ $map ='';}
		if(!isset($date_add)){ $date_add ='';}
$datetoday = date("Y-m-d");
?>  

<div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Showroom Data</h4>
                            <br>
							<div class="row">
                    			<div class="col-sm-12">
									<div class="card m-b-30 card-body">
										<h5 class="card-title">
											<div class="progress mb-0" style="display: none">
										<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
										</div>
                                                                                    <div class="pull-right">
                                                             <?php if($currentID!=''){?>
								<button type="button" class="btn btn-success btn-sm" onClick="window.location.href='<?php echo base_url('Control/showroom_add')?>'"><i class="fa fa-plus"></i> Add Showroom</button> 
						    &nbsp;&nbsp;
                                                             <?php }?>
								<button type="button" class="btn btn-info btn-sm" onClick="window.location.href='<?php echo base_url('Control/showroom_list')?>'">Back</button></div>
										</h5>
						<form enctype="multipart/form-data" id="productForm" name="productForm">
						 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Company</label>
								<div class="col-sm-6">
									<input type="text" id="company" name="company" class="form-control form-control-sm" value="<?php echo $company?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>
						 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Address</label>
								<div class="col-sm-6">
									<textarea id="address" name="address" class="form-control form-control-sm" ><?php echo $address?></textarea>
								</div>
							   <div class="col-sm-4">	</div>
						</div>
                                                    <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Telephone</label>
								<div class="col-sm-6">
									<input type="text" id="phone" name="phone" class="form-control form-control-sm" value="<?php echo $phone?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>
                                                    <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Fax</label>
								<div class="col-sm-6">
									<input type="text" id="fax" name="fax" class="form-control form-control-sm" value="<?php echo $fax?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>
                                                    <div class="form-group row">
							  <label class="col-sm-2 col-form-label">E-mail</label>
								<div class="col-sm-6">
									<input type="text" id="email" name="email" class="form-control form-control-sm" value="<?php echo $email?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>
                                                    <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Facebook</label>
								<div class="col-sm-6">
									<input type="text" id="facebook" name="facebook" class="form-control form-control-sm" value="<?php echo $facebook?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>
                                                    <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Map</label>
								<div class="col-sm-6">
									<input type="text" id="map" name="map" class="form-control form-control-sm" value="<?php //echo $map?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>

						 					
						<div class="form-group row" >
							<div class="col-sm-6" style="text-align: center">
							<button type="button" class="btn btn-success btn-sm" onClick="Addshowroom()">Add / Edit Data</button>
							<input type="hidden" name="currentID" id="currentID" value="<?php echo $currentID?>">
                                                       
							</div>
					</div>					
											
						</form>					
								<div id="showloadmap"></div>		
									</div>
								</div>
								
							</div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

            </div> <!-- end container -->
        </div>