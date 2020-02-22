  <!-- DataTables -->
        <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/buttons.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/datatables/select.bootstrap4.min.css')?>" rel="stylesheet" type="text/css" />


<div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">                           
                            <h4 class="page-title">List All Visit Showroom 
								<div class="pull-right">
								
								<button type="button" class="btn btn-success btn-sm" onClick="window.location.href='<?php echo base_url('Control/visitshowroom_add')?>'"><i class="fa fa-plus"></i> Add Visit Showroom </button>
								</div>
							</h4>
						</div>							
								
                    			<div class="col-sm-12">
									
										<h5 class="card-title">
											<div class="progress mb-0" style="display: none">
											<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
											</div>
										</h5>
										<div class="card-box table-responsive" id="showData">
										<table id="datatable" class="table table-hover">
											<thead>
											<tr>
												<th>#</th>
												<th>Showroom Name</th>
												                           
												<th>Show on web</th>
												<th width="50">Edit</th>
												<th width="50">Delete</th>
											</tr>
											</thead>
											<tbody>
											<?php $n=1; foreach($visit_list->result() AS $data){ 
												  $x ='';
												  //$count_product = $this->Category_model->get_productData($x,$data->id);	
											?>	
											<tr id="row<?php echo $data->id?>">
												<td scope="row"><?php echo $n?></td>
												<td><?php echo $data->name_th?></td>
												
												<td align="center">
													<label><input id="ch<?php echo $data->id?>" type="checkbox" class="js-switch js-check-change" onClick="setShow_onWeb('<?php echo $data->id?>', this.value, 'tbl_visit_data')" value="<?php echo $data->show_onWeb?>" <?php if($data->show_onWeb == '1'){ echo 'checked'; }?> data-plugin="switchery" data-color="#007bff" data-size="small" /></label>
												</td>
												<td><button type="button" class="btn btn-success btn-sm" onClick="window.location.href='<?php echo base_url('Control/visitshowroom_add/'.$data->id)?>'"><i class="icon-pencil"></i></button></td>                               
												<td><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete('<?php echo $data->id?>','<?php echo $data->name_th?>')" style="float: right; margin-right: 5%;"><i class="icon-trash"></i></button></td>									
											</tr>
											<?php $n++; } ?>   
											</tbody>
										</table>											
										</div>									
								</div>                      
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

            </div> <!-- end container -->
        </div>