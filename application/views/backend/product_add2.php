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
		foreach($productData->result() AS $product){}
	}
?>
<script type="text/javascript" src="<?php echo base_url('assets/js/chunk-uploader.js')?>"></script>
<div class="wrapper">
<div class="container-fluid">

<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">

			<h4 class="page-title">Product Data</h4>
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
								<button type="button" class="btn btn-success btn-sm" onClick="window.location.href='<?php echo base_url('Control/Product_add')?>'"><i class="fa fa-plus"></i> Add Product</button>&nbsp;&nbsp;
                            <?php } ?>
								<button type="button" class="btn btn-info btn-sm" onClick="window.location.href='<?php echo base_url('Control/Product')?>'">Back</button></div>
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
									  <label class="col-3 col-form-label">Product Name</label>
										<div class="col-9">
											<input type="text" id="name_th" name="name_th" class="form-control form-control-sm" value="<?php if($currentID != ''){ echo $product->name_th; }?>">
										</div>									   
								</div>
								<div class="form-group row">
									  <label class="col-3 col-form-label">Product Title</label>
										<div class="col-9">
											<input type="text" id="title" name="title" class="form-control form-control-sm" value="<?php if($currentID != ''){ echo $product->title; }?>">
										</div>									   
								</div>
								 
								<div class="form-group row">
								  <label class="col-3 col-form-label">Overview</label>
									<div class="col-9">
										<textarea id="overview_th" name="overview_th" class="summernote"><?php if($currentID != ''){ echo $product->detail_th; }?></textarea>
										
									</div>								   
								</div>
                                                                <div class="form-group row">
									  <label class="col-3 col-form-label">Price</label>
										<div class="col-9">
                                                                                    <input type="number" id="Price" name="Price" class="form-control form-control-sm" value="<?php if($currentID != ''){ echo $product->Price; }?>">
										</div>									   
								</div>
								<div class="form-group row">
                                  	<label class="col-3 col-form-label">Link Youtube</label>
                                    <div id="linkyoutube_a" class="col-5">
                                        <input id="youtube" name="youtube[]" type="text" class="form-control form-control-sm youtube3" autocomplete="off">                                                      
									</div>
                                    <div class="col-2">	
                                        <a id="bt1" class="btn btn-primary btn-sm" onclick="ADDyoutube()">Add Clip Video</a>
                                    </div>
                                    <div class="col-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('HTML_2/images/youtube.jpg')?>" target="_blank">ขั้นตอนการเพิ่มคลิปวีดีโอ</a>
                                    </div>                                      
                                </div> 
                                <?php $youtube = $this->Product_model->getlinkyoutube($currentID);
                                      $numyoutube = $youtube->num_rows();
                                      if($numyoutube>0){
                                          foreach ($youtube->result() AS $youtube2){?>
                                <div class="form-group row">
                                	<label class="col-3 col-form-label"></label>                                    
                                    <div id="linkyoutube_a" class="col-6">
                                        <input id="youtube<?php echo $youtube2->id?>" name="youtube1[]" type="text" class="form-control form-control-sm youtube3" readonly value='<?php echo $youtube2 ->linkyoutube;?>'>
                                    </div>
                                    <div class="col-sm-3">
                                        <a id="bt2"class="btn btn-danger btn-sm entypo-cancel" onclick="deleteyoutube('<?php echo $youtube2->id ?>', 'tbl_youtube_link')"><i class="fa fa-times" aria-hidden="true"></i></a>                                                        
                                    </div>
                                </div> 
                                <?php } } ?> 
								 
								<div class="form-group row" >
									<div class="col-12" style="text-align: center">
										<button type="button" class="btn btn-success btn-sm" onClick="Addproduct()">Add / Edit Data</button>
										<input type="hidden" name="currentID" id="currentID" value="<?php echo $currentID?>">
									</div>
							 	</div>                            
                                                             <div class="row">
                                                                 <div class="col-12">
									<div class="card m-b-30">
										<h6 class="card-header">Add Images 360</h6>
										<div class="card-body">
											<div class="form-group row">
												<div class="col-7">
										 			<input type="file" id="ImagesFiles360" name="userFiles360[]" />
												</div>
												<div class="col-5">
													<a href="#" class="btn btn-custom waves-effect waves-light" onClick="Addproduct()">Add Images</a>
												</div>
												<br><a>(Supports image file extension jpg, gif, png. File size should not exceed 2MB. Picture size 1000 x 530 pixels.)</a>										
												<div id="showImage360" style="margin-top: 5px;width: 100%"></div>
											</div>
										</div>
									</div>
								</div>
                                                             </div>
							    <div class="row">
								<div class="col-6">
									<div class="card m-b-30">
										<h6 class="card-header">Add Images</h6>
										<div class="card-body">
											<div class="form-group row">
												<div class="col-7">
										 			<input type="file" id="ImagesFiles" name="userFiles[]" multiple/>
												</div>
												<div class="col-5">
													<a href="#" class="btn btn-custom waves-effect waves-light" onClick="Addproduct()">Add Images</a>
												</div>
												<br><a>(Supports image file extension jpg, gif, png. File size should not exceed 2MB. Picture size 1000 x 530 pixels.)</a>										
												<div id="showImage" style="margin-top: 5px;width: 100%"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card m-b-30">
										<h6 class="card-header">Add File</h6>
										<div class="card-body">
                                                                                    
											 <div class="form-group row">
												  <label class="col-3 col-form-label">File Name</label>
													<div class="col-9">
														<input type="text" id="txtTitle_th" name="txtTitle_th" class="form-control form-control-sm" >
                                                                                                                
													</div>									   
											 </div>
											 <div class="form-group row">
												 <div class="col-7"> 
													 
													<input type="hidden" id="raw_post" value="true" >
													<input type="hidden" id="max_chunk_size" value="10048576">
													<input type="hidden" id="max_parallel_chunks" value="10">
													<input type="hidden" id="send_interval" value="20">
													<input type="hidden" id="video_file_name" name="video_file_name">
													<input type="hidden" id="Chk_video_file_name" name="Chk_video_file_name">
													 
													<input type="file" id="file22" ><!--onchange="upload_file(this.files[0]);"-->
													<div id="status" style="position: absolute; width: 100%; text-align: center; margin-top: 5px;"></div>
													<div id="progress_bar" style="width: 0; height: 50%; background-color: #00adee; text-align: center;"></div>											 
													 
													 <!--<input type="file" id="cFiles" name="catFiles[]"/>-->
													 <!--<br>(Support PDF file only. File size should not exceed 2MB.)-->
												 </div>
												 <div class="col-5" style="text-align: center"> 
													 <a href="javascript:void(0)" class="btn btn-custom waves-effect waves-light" onClick="AddFile()">Add File</a>
												 </div>
											 </div>
											 <div class="form-group row col-12">(Support PDF file only. File size should not exceed 2MB.)</div>
											 <div class="form-group row col-12"><p style="color:red">*Please select an English file.</p></div>
											
											 <div id="showCat"></div>
										</div>
									</div>
								</div>
						    </div>
                                                             <?php if($currentID!=''){?>
                                                             <div class="row">
                                                                 <div class="col-12">
									<div class="card m-b-30">
										<h6 class="card-header">Sub Product</h6>
										<div class="card-body">
											<div class="form-group row">
									  <label class="col-3 col-form-label">Sub Product Name</label>
										<div class="col-9">
											<input type="text" id="subname_th" name="subname_th" class="form-control form-control-sm" value="">
										</div>									   
								</div>
								<div class="form-group row">
									  <label class="col-3 col-form-label">Sub Product Price</label>
										<div class="col-9">
											<input type="text" id="subPrice" name="subPrice" class="form-control form-control-sm" value="">
										</div>									   
								</div>
                                     <div class="form-group row" >
									<div class="col-12" style="text-align: center">
										<button type="button" class="btn btn-success btn-sm" onClick="Addsub('<?php echo $currentID?>')">Add / Edit Data</button>
									
									</div>
							 	</div>
                                      <div  id="showdata"></div>
										</div>
									</div>
								</div>
                                                             </div>
                                                             <?php }?>
								 
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