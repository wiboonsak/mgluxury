 <?php  if(!isset($currentID)){ $currentID='';}
		if(!isset($gallery_title)){ $gallery_title ='';}
		if(!isset($gallery_detail)){ $gallery_detail ='';}
		if(!isset($gallery_date_add)){ $gallery_date_add =date("d-m-Y");}
		if(!isset($gallery_cate)){ $gallery_cate ='';}
$datetoday = date("Y-m-d");
?>  

<div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Gallery Data</h4>
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
								<button type="button" class="btn btn-success btn-sm" onClick="window.location.href='<?php echo base_url('Control/gallery_add')?>'"><i class="fa fa-plus"></i> Add Gallery</button> 
						    &nbsp;&nbsp;
                                                             <?php }?>
								<button type="button" class="btn btn-info btn-sm" onClick="window.location.href='<?php echo base_url('Control/gallery_list')?>'">Back</button></div>
										</h5>
						<form enctype="multipart/form-data" id="productForm" name="productForm">
						 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Gallery topic</label>
								<div class="col-sm-6">
									<select id="category" name="category" class="form-control form-control-sm" >
												<option value="0">---Select---</option>
												<?php foreach($categoryList->result() AS $category){ ?>
												<option value="<?php echo $category->id?>" <?php if(($category->id == $gallery_cate) && ($currentID != '')){ echo "selected"; } ?> ><?php echo $category->category_title?></option>
												<?php } ?>
											</select>
								</div>
							   <div class="col-sm-4">	</div>
						</div>
						 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Gallery topic</label>
								<div class="col-sm-6">
									<input type="text" id="news_title" name="news_title" class="form-control form-control-sm" value="<?php echo $gallery_title?>" >
								</div>
							   <div class="col-sm-4">	</div>
						</div>
						 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Gallery Details</label>
								<div class="col-sm-6">
									<textarea id="news_detail" name="news_detail" class="summernote" ><?php echo $gallery_detail?></textarea>
								</div>
							   <div class="col-sm-4">	</div>
						</div>
                                                   
							 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Date</label>
								<div class="col-sm-6">
									<input   type="date" id="news_date_add" name="news_date_add" value="<?php if($currentID!=''){echo $gallery_date_add;}else{echo $datetoday;}?>" class="form-control form-control-sm"/> 
								</div>
							   <div class="col-sm-4">	</div>
						</div>	
<!--							 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Date End</label>
								<div class="col-sm-6">
									<input   type="date" id="news_date_end" name="news_date_end" value="<?php //if($currentID!=''){echo $news_date_end;}else{echo $datetoday;}?>" class="form-control form-control-sm"/> 
								</div>
							   <div class="col-sm-4">	</div>
						</div>	-->
                                                      <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">link Youtube</label>
                                       
<!--                                            <input id="linkyoutube" name="linkyoutube" class="form-control form-contol-sm" >-->
                                          
                                             <div id="linkyoutube_a" class="col-sm-6">
                                                                                                      <input id="youtube" name="youtube[]" type="text" class="form-control form-control-sm youtube3"  autocomplete="off"   >
                                                                                                     
                                             </div>
                                            <div class="col-sm-2">	
                                        <a  id="bt1" class="btn btn-primary btn-sm" onclick="ADDyoutube()">Add Clip Video</a>
                                        </div>
                                        <div class="col-sm-2">	
                                                <a href="<?php echo base_url('HTML_2/images/youtube.jpg')?>" target="_blank">ขั้นตอนการเพิ่ม youtube</a>
                                        </div>
                                                     
                                        
                                       
                                    </div> 
                                                         <?php 
                                                      $youtube = $this->Product_model->getlinkyoutubegallery($currentID);
                                                      $numyoutube = $youtube->num_rows();
                                                      if($numyoutube>0){
                                                      foreach ($youtube->result() AS $youtube2){?>
                                                    <div class="form-group row">
                                   <label class="col-sm-2 col-form-label"></label>
                                    
                                         <div id="linkyoutube_a" class="col-sm-6">
                                            <input id="youtube<?php echo $youtube2->id?>" name="youtube1[]" type="text" class="form-control form-control-sm youtube3" readonly value='<?php echo $youtube2 ->linkyoutube;?>'>
                                         </div>
                                               <div class="col-sm-3">
                                                        <a  id="bt2"class="btn btn-danger btn-sm entypo-cancel" onclick="deleteyoutube('<?php echo $youtube2->id ?>', 'tbl_youtube_gallery')"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                         
                                                    </div>
                                    </div> 
                                                      <?php }}?>
						 <div class="form-group row">
							  <label class="col-sm-2 col-form-label">Images</label>
								<div class="col-sm-6">
									<input   type="file" id="ImagesFiles" name="userFiles[]" multiple/> 
                                                                        <br><a>(Supports image file extension jpg, gif, png. File size should not exceed 2MB. Picture size 570 x 325 pixels.)</a>
								</div>
							   <div class="col-sm-4">	</div>
						</div>					
						<div class="form-group row" >
							<div class="col-sm-6" style="text-align: center">
							<button type="button" class="btn btn-success btn-sm" onClick="AddGallery()">Add / Edit Data</button>
							<input type="hidden" name="currentID" id="currentID" value="<?php echo $currentID?>">
                                                       
							</div>
					</div>					
											
						</form>					
										<div id="showImage"></div>
									</div>
								</div>
								
							</div>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

            </div> <!-- end container -->
        </div>