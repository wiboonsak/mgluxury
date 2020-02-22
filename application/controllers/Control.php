<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
       parent::__construct();
		 if($this->session->userdata('user_id')==''){
			    redirect(base_url('login'), 'refresh');
			    exit();			 
		  }
			
          $this->load->model('Product_model');  
          $this->load->model('User_model');  
          $this->load->model('Category_model');		 
    }
	//---------------------
	public function index(){
		
		$x ='';
		$data['productList'] = $this->Category_model->get_productData($x,'','','','','','0');	
		$this->load->view('backend/header');
		$this->load->view('backend/product',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/product_list_script');
	}
    //---------------------
    public function gallery_category(){
		$this->load->view('backend/header');
		$this->load->view('backend/category');
		$this->load->view('backend/footer');
		$this->load->view('backend/category_script');
	}
    
	//---------------
	public function DoAddProductCategory(){
		
		$category_title = $this->input->post('name_th');
		$dataID = $this->input->post('dataID');
		$imgold = $this->input->post('imgold'); 
		$category_img = $this->input->post('category_img');
		$desc_th = $this->input->post('desc_th');
		$detail_th = $this->input->post('detail_th');
		$icon = $this->input->post('icon');
		
        /*if(($category_img != '') && ($imgold != '')){
            @unlink('./uploadfile/'.$imgold);
        }*/
		$upload_path = './uploadfile';
		$upload_pathName = 'uploadfile';
		$config['upload_path'] = $upload_path;
		//allowed file types. * means all types
		$config['allowed_types'] = 'jpg|png|gif';
		//allowed max file size. 0 means unlimited file size
		$config['max_size'] = '0';
		//max file name size
		$config['max_filename'] = '255';
		//whether file name should be encrypted or not
		$config['encrypt_name'] = FALSE;
		//store image info once uploaded
		$image_data = array();
		//check for errors
		$is_file_error = FALSE;
		 	
		$this->load->library('upload', $config);         
		//---------------------------
		$_FILES['userFile']['name'] = $_FILES['category_img']['name'];
        $_FILES['userFile']['type'] = $_FILES['category_img']['type'];
        $_FILES['userFile']['tmp_name'] = $_FILES['category_img']['tmp_name'];
        $_FILES['userFile']['error'] = $_FILES['category_img']['error'];
        $_FILES['userFile']['size'] = $_FILES['category_img']['size'];


        $this->upload->initialize($config);
        if($this->upload->do_upload('userFile')){
			
			if($imgold != ''){
            	@unlink('./uploadfile/'.$imgold);
        	}
			
            $fileData = $this->upload->data();
            $uploadData['file_name'] = $fileData['file_name'];
			$resultUpdateBooking = $this->Category_model->update_dataCategory($category_title, $dataID, $uploadData['file_name'], $desc_th, $detail_th, $icon);
			
        } else {
			
            $resultUpdateBooking = $this->Category_model->update_dataCategory($category_title, $dataID, $imgold, $desc_th, $detail_th, $icon);
        }
		echo $resultUpdateBooking;
	}
    //---------------------------
    public function updateOrderCate(){
		$dataID = $this->input->post('dataID');
		$changeValue = $this->input->post('changeValue');
		$result = $this->Category_model->updateOrderCate($dataID,$changeValue);
		echo $result;		
	}
    //------------------------
	public function deletePcate(){
				$this->Product_model->deletePcate($DataID);
				$result2 = '2';

		echo $result2;
	}
    //---------------------------
    public function Product_add($currentID=NULL){
		
		$data['categoryList'] = $this->Category_model->listcategory('0','0');
		$data['productData'] = $this->Category_model->productDetail($currentID);
		$data['currentID'] = $currentID;
		
		/*if($productData->num_rows() > 0){
			foreach($productData->result() AS $product){}
			$data['product_nameth']=$product->product_nameth;
			$data['product_nameen']=$product->product_nameen;
			$data['product_topic']=$product->product_topic;
			$data['product_category']=$product->product_category;
			$data['product_desc']=$product->product_desc;
            $data['product_price']=$product->product_price;                        
			$data['currentID']=$product->id;
		
		 }else{
			$data['product_category']=0;			
		}*/
		$this->load->view('backend/header');
		//$this->load->view('backend/product_add',$data);
		$this->load->view('backend/product_add2',$data);
		$this->load->view('backend/footer');
		//$this->load->view('backend/product_script');
		$this->load->view('backend/product_script2');
	}
    //-----------------------------------------------
    public function addProduct(){ 
		
		 $name_th = $this->input->post('name_th');
		 $title = $this->input->post('title');
		
		$overview_th = $this->input->post('overview_th');
		
		 $Price = $this->input->post('Price');		
		 $youtube = $this->input->post('youtube');
		 $txtTitle_th = $this->input->post('txtTitle_th');
		
		 $currentID = $this->input->post('currentID'); 
		 $file_name2 = $this->input->post('video_file_name'); 
		
		
	
		 
		 $currentID = $this->Category_model->addProduct($currentID,$name_th,$overview_th,$Price,$title);
		
		
         if($youtube!=''){
             foreach($youtube AS $value){
                 if($value !=''){
                     $this->Product_model->addyoutube($currentID,$value);                        
                 }  
             }
         }
		 
		 //--------upload file------------//
		 
		 $countFiles = count($_FILES['userFiles']['name']);
		   
		 $upload_path = './uploadfile/product';
		 $upload_pathName = 'uploadfile/product';
		 $config['upload_path'] = $upload_path;
		 //allowed file types. * means all types
		 $config['allowed_types'] = 'jpg|png|gif';
		 //allowed max file size. 0 means unlimited file size
		 $config['max_size'] = '0';
		 //max file name size
		 $config['max_filename'] = '255';
		 //whether file name should be encrypted or not
		 $config['encrypt_name'] = TRUE;
		 //store image info once uploaded
		 $image_data = array();
		 //check for errors
		 $is_file_error = FALSE;
		 	
		 $this->load->library('upload', $config);
         if($countFiles > 0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
               
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddImagesData($uploadData[$i]['file_name'],$currentID,'1');
                }				
			}
		}
                
                 //--------upload file------------//
		 
		 $countFiles360 = count($_FILES['userFiles360']['name']);
		   
		 $upload_path = './uploadfile/360view';
		 $upload_pathName = 'uploadfile/360view';
		 $config['upload_path'] = $upload_path;
		 //allowed file types. * means all types
		 $config['allowed_types'] = 'jpg|png|gif';
		 //allowed max file size. 0 means unlimited file size
		 $config['max_size'] = '0';
		 //max file name size
		 $config['max_filename'] = '255';
		 //whether file name should be encrypted or not
		 $config['encrypt_name'] = TRUE;
		 //store image info once uploaded
		 $image_data = array();
		 //check for errors
		 $is_file_error = FALSE;
		 	
		 $this->load->library('upload', $config);
         if($countFiles360 > 0){ 
			for($i=0; $i<$countFiles360; $i++){           
				//---------------------------
				$_FILES['userFile360']['name'] = $_FILES['userFiles360']['name'][$i];
                $_FILES['userFile360']['type'] = $_FILES['userFiles360']['type'][$i];
                $_FILES['userFile360']['tmp_name'] = $_FILES['userFiles360']['tmp_name'][$i];
                $_FILES['userFile360']['error'] = $_FILES['userFiles360']['error'][$i];
                $_FILES['userFile360']['size'] = $_FILES['userFiles360']['size'][$i];
               
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile360')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddImagesData($uploadData[$i]['file_name'],$currentID,'2');
                }				
			}
		}

		if($file_name2 != ''){
			$this->Product_model->AddCatalogueData($file_name2, $currentID, $txtTitle_th);
		}		
		echo $currentID;		
	 }
     //------------------------------------
     public function loadProductImg(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadProductImg($ProID,'1');
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td ><span class="text-danger"><img src="'.base_url('uploadfile/product/').$data->imge_name.'" style="width:150px;" class="thumbnail"></span></td>';
                          echo '<td ><input class="form-control form-control-sm" id="order'.$data->id.'" name="oeder'.$data->id.'" value="'.$data->img_order.'" style="text-align:center" onchange="updateOrder(\''.$data->id.'\',this.value,\''.$ProID.'\')"></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\' , \'imgfile\', \''.$data->imge_name.'\' , \'1\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 } 
     //------------------------------------
     public function loadProductImg360(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadProductImg($ProID,'2');
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td ><span class="text-danger"><a href="'.base_url('View360/index/').$data->imge_name.'" target="_blank"><img src="'.base_url('uploadfile/360view/').$data->imge_name.'" style="width:150px;" class="thumbnail"></a></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\' , \'imgfile\', \''.$data->imge_name.'\', \'2\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 } 
     //------------------------------------
     public function loadcateImg(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Category_model->loadcateImg($ProID);
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td><span class="text-danger"><img src="'.base_url('uploadfile/').$data->category_img.'" style="width:150px;" class="thumbnail"></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="imgDelete(\''.$data->id.'\',\''.$data->category_img.'\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 } 
     //-------------------------------
	 public function deletePorductFile1(){ 
	 	 $fileType = $this->input->post('fileType');
	 	 $DataID = $this->input->post('DataID');
	 	 $FileName = $this->input->post('FileName');
	 	 $type = $this->input->post('type');
		 $num = 0;
		 
		 if($fileType == 'catalgoue'){
			 
			 $chDownload = $this->Category_model->check_relatedData('file_id','tbl_downloadfile_data',$DataID);
			 $num = $chDownload->num_rows();
		 }
		 if($num > 0){
			 $this->Category_model->update_ShowOnWeb($DataID,'0','tb_file_data','data_status');
			 
		 } else if($num == 0){
			 $result = $this->Product_model->deleteProductFile1($DataID, $fileType, $FileName,$type);
		 }	 
		 echo $result;
	 }
     //-------------------------------
	 public function deletePromotionFile1(){ 
	 	 $fileType = $this->input->post('fileType');
	 	 $DataID = $this->input->post('DataID');
	 	 $FileName = $this->input->post('FileName');
		 $num = 0;
		 
		 if($fileType == 'catalgoue'){
			 
			 $chDownload = $this->Category_model->check_relatedData('file_id','tbl_downloadfile_data',$DataID);
			 $num = $chDownload->num_rows();
		 }
		 if($num > 0){
			 $this->Category_model->update_ShowOnWeb($DataID,'0','tb_file_promotion','data_status');
			 
		 } else if($num == 0){
			 $result = $this->Product_model->deletePromotionFile1($DataID, $fileType, $FileName);
		 }	 
		 echo $result;
	 }
     //-------------------------------
	 public function deletecateimg(){
         $img = '';
	 	 $DataID = $this->input->post('DataID');
	 	 $FileName = $this->input->post('FileName');
		 $result = $this->Category_model->deletecateimg($DataID,$FileName,$img);
		 echo $result;
	 }
     //----------------------------------------------- 
	 public function loadProductFile(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadProductFile($ProID);
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 
						 
			 
			 echo '<tr id = "RowFile'.$data->id.'">';
			 echo '<td><span class="text-suceess">';
			 echo'<a href="'.base_url('uploadfile/catalogue/').$data->imge_name.'" target="_blanl"><i class="icon-arrow-down-circle">&nbsp;'.$data->txtTitle_th.'</i></a></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\' , \'catalgoue\' , \''.$data->imge_name.'\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 }
    //-------------------
    public function deleteyoutube(){
        $dataID = $this->input->post('dataID');
        $table = $this->input->post('table');
        $result = $this->Product_model->delete_data($dataID, $table);
        echo $result;
    }  
    //-----------------------
    public function Product_list(){
		//$data['productList']=$this->Product_model->getproductList();
		$data['categoryList'] = $this->Category_model->listcategory('0','0');
		
		$this->load->view('backend/header');
		$this->load->view('backend/product_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/product_list_script');
	}
	//-----------------------
    public function Product(){ 
		//$data['productList']=$this->Product_model->getproductList();
		$x ='';
		$data['productList'] = $this->Category_model->get_productData($x,'','','','','','0');
		$this->load->view('backend/header');
		$this->load->view('backend/product',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/product_list_script');
	}
    //-------------------------------
	public function news_add($curentID=NULL){
		
		$NewDetail = $this->Product_model->getNewDetail($curentID);
		if($NewDetail->num_rows() > 0){
			foreach($NewDetail->result() AS $news){}
			$data['news_title']=$news->news_title;
			$data['news_detail']=$news->news_detail; 
			$data['currentID']=$news->id;
			$data['news_date_add']=$news->news_date_add;
			$data['news_date_end']=$news->news_date_end;
		 }else{
			$data['news_title']='';
			$data['news_detail']=''; 
			$data['currentID']='';
			$data['news_date_add']='';
			$data['news_date_end']='';
		}
		$this->load->view('backend/header',$data);
		$this->load->view('backend/news_add',$data);
		$this->load->view('backend/footer2');
		$this->load->view('backend/news_add_script');		
	}
    //-------------------------------
	public function promotion_add($curentID=NULL){
		
		$referenceDetail = $this->Product_model->getreferenceDetail($curentID);
		if($referenceDetail->num_rows() > 0){
			foreach($referenceDetail->result() AS $reference){}
			$data['reference_title']=$reference->reference_title;
			$data['reference_detail']=$reference->reference_detail; 
			$data['currentID']=$reference->id;
			$data['reference_date_add']=$reference->reference_date_add;
			$data['Timeperiod']=$reference->Timeperiod;
		 }else{
			$data['reference_title']='';
			$data['reference_detail']=''; 
			$data['currentID']='';
			$data['reference_date_add']='';
			$data['Timeperiod']='';
		}
		$this->load->view('backend/header',$data);
		$this->load->view('backend/reference_add2',$data);
		$this->load->view('backend/footer2');
		$this->load->view('backend/reference_add_script2');		
	}
    //-------------------------------   // imageID 
	public function deleteNewsImg(){
		$imageID = $this->input->post('imageID');
		$imageName = $this->input->post('imageName');
		$result = $this->Product_model->deleteNewsImg($imageID,$imageName);
		echo $result;
	} 
    //-------------------------------   // imageID 
	public function deletereferenceImg(){
		$imageID = $this->input->post('imageID');
		$imageName = $this->input->post('imageName');
		$result = $this->Product_model->deletereferenceImg($imageID,$imageName);
		echo $result;
	} 
    //-------------------------------    
	public function addNews(){
		$currentID =$this->input->post('currentID');
		$news_detail =$this->input->post('news_detail');
		$news_title =$this->input->post('news_title');
		
		$news_date_add =$this->input->post('news_date_add');
		//$news_date_end =$this->input->post('news_date_end');
		$youtube =$this->input->post('youtube');
		 
		$currentID = $this->Product_model->addNews($news_title , $news_detail ,$currentID , $news_date_add );
                 
        if($youtube!=''){
            foreach($youtube AS $value){
                if($value !=''){
                    $result_id2 = $this->Product_model->addyoutubeNew($currentID , $value);                        
                }  
            }
        }
        
         //--------uploadfile------------//
		$countFiles = count($_FILES['userFiles']['name']);
		   
		$upload_path = './uploadfile/news';
		$upload_pathName = 'uploadfile/news';
		$config['upload_path'] = $upload_path;
		//allowed file types. * means all types
		$config['allowed_types'] = 'jpg|png|gif';
		//allowed max file size. 0 means unlimited file size
		$config['max_size'] = '0';
		//max file name size
		$config['max_filename'] = '255';
		//whether file name should be encrypted or not
		$config['encrypt_name'] = TRUE;
		//store image info once uploaded
		$image_data = array();
		//check for errors
		$is_file_error = FALSE;
		 	
		$this->load->library('upload', $config);
        if($countFiles>0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
				
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddNewsImg($uploadData[$i]['file_name'],$currentID);
                }				
			}
		}		
		echo $currentID;		 
	}
    //-------------------------------    
	public function addreference(){
		
		 $currentID =$this->input->post('currentID');
		 $reference_detail =$this->input->post('reference_detail');
		 $reference_title =$this->input->post('reference_title');
		 $reference_date_add =$this->input->post('reference_date_add');
		 //$Time_Period =$this->input->post('Time_Period');
		 //$img = $this->input->post('img_old');
		 $youtube =$this->input->post('youtube');
                  $file_name2 = $this->input->post('video_file_name'); 
                  $txtTitle_th = $this->input->post('txtTitle_th');
		 
		 $currentID = $this->Product_model->addreference($reference_title, $reference_detail, $currentID, $reference_date_add);
                 
         if($youtube!=''){
            foreach($youtube AS $value){
               if($value !=''){
                   $result_id2 = $this->Product_model->addyoutubereference($currentID,$value);                        
               }  
            }
         }
         
          //--------upload file------------//
		 
		 $countFiles = count($_FILES['userFiles']['name']);
		   
		 $upload_path = './uploadfile/reference';
		 $upload_pathName = 'uploadfile/reference';
		 $config['upload_path'] = $upload_path;
		 //allowed file types. * means all types
		 $config['allowed_types'] = 'jpg|png|gif';
		 //allowed max file size. 0 means unlimited file size
		 $config['max_size'] = '0';
		 //max file name size
		 $config['max_filename'] = '255';
		 //whether file name should be encrypted or not
		 $config['encrypt_name'] = TRUE;
		 //store image info once uploaded
		 $image_data = array();
		 //check for errors
		 $is_file_error = FALSE;
		 	
		 $this->load->library('upload', $config);
         if($countFiles > 0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
               
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $this->Product_model->AddreferenceImg($uploadData[$i]['file_name'],$currentID);
                }				
			}
		}
         
               if($file_name2 != ''){
			$this->Product_model->AddCataloguePromotion($file_name2, $currentID, $txtTitle_th);
		}		
         
         
		 echo $currentID;
		 
	}
    //-------------------------------
	public function loadNewsImages(){
		$ProID=$this->input->post('ProID');
		$data['newsImg'] = $this->Product_model->loadNewsImg($ProID);
		$this->load->view('backend/news_images_list',$data);
		
	}
//    //-------------------------------
//	public function loadreferenceImages(){
//		$ProID=$this->input->post('ProID');
//		$data['referenceImg'] = $this->Product_model->loadreferenceImg($ProID);
//		$this->load->view('backend/reference_images_list',$data);
//		
//	}
    //-------------------------------
	public function loadreferenceImages(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadreferenceImg($ProID);
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td><span class="text-danger"><img src="'.base_url('uploadfile/reference/').$data->images_name.'" style="width:150px;" class="thumbnail"></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\', \'imgfile\'  ,\''.$data->images_name.'\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
		
	}
         //----------------------------------------------- 
	 public function loadPromotionFile(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadPromotionFile($ProID);
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 
						 
			 
			 echo '<tr id = "RowFile'.$data->id.'">';
			 echo '<td><span class="text-suceess">';
			 echo'<a href="'.base_url('uploadfile/catalogue/').$data->imge_name.'" target="_blanl"><i class="icon-arrow-down-circle">&nbsp;'.$data->txtTitle_th.'</i></a></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\' , \'catalgoue\' , \''.$data->imge_name.'\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 }
    //-------------------------------
	public function news_list(){
		$data['NewsList']=$this->Product_model->news_list();
		$this->load->view('backend/header');
		$this->load->view('backend/news_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/news_list_script');	
	}
    //-------------------------------
	public function promotion_list(){
		$data['referenceList']=$this->Product_model->reference_list();
		$this->load->view('backend/header');
		$this->load->view('backend/reference_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/reference_list_script');	
	}
    //------------------------------- deleteNews 
	public function deleteNews(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deleteNews($DataID);
		echo $result;
	}
    //------------------------------- deleteNews 
	public function deletereference(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deletereference($DataID);
		echo $result;
	}
    //-------------------------------
	public function slide_add($curentID=NULL){
		
		$slideDetail = $this->Product_model->getslideDetail($curentID);
		if($slideDetail->num_rows() > 0){
			foreach($slideDetail->result() AS $slide){}
			$data['slide_title']=$slide->slide_title;
			$data['slide_detail']=$slide->slide_detail;
			$data['slide_desc']=$slide->slide_desc;
			$data['learnMore']=$slide->learnMore;
			$data['currentID']=$slide->id;
			
		}else{
			
			$data['slide_title']='';
			$data['slide_detail']='';
			$data['slide_desc']='';
			$data['learnMore']='';
			$data['currentID']='';			
		}
		$this->load->view('backend/header');
		$this->load->view('backend/slide_add',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/slide_add_script');		
	}
    //-------------------------------deleteSlideImg 
	public function deleteSlideImg(){
		$DataID=$this->input->post('imageID');
		$imge_name=$this->input->post('imageName');
		$result = $this->Product_model->deleteSlideImg($DataID,$imge_name);
		echo $result;
	}
    //-------------------------------    
	public function addSlide(){
		 $currentID =$this->input->post('currentID');
		 $slide_title =$this->input->post('comment');
		 $slide_detail =$this->input->post('comment1');
		 $slide_desc =$this->input->post('comment2');
		 $learnMore =$this->input->post('learnMore');
                 $img = $this->input->post('img_old');
		 $currentID = $this->Product_model->addSlide($slide_title , $slide_detail ,$currentID , $slide_desc,$learnMore );
		 //--------uploadfile------------//
                 
              
        

		$countFiles = count($_FILES['userFiles']['name']);
		  
		 		$upload_path = './uploadfile/banner';
				$upload_pathName = 'uploadfile/banner';
				$config['upload_path'] = $upload_path;
				//allowed file types. * means all types
				$config['allowed_types'] = 'jpg|png|gif';
				//allowed max file size. 0 means unlimited file size
				$config['max_size'] = '0';
				//max file name size
				$config['max_filename'] = '255';
				//whether file name should be encrypted or not
				$config['encrypt_name'] = TRUE;
				//store image info once uploaded
				$image_data = array();
				//check for errors
				$is_file_error = FALSE;
		 	
		    $this->load->library('upload', $config);
       if($countFiles>0){ 
			for($i=0; $i<$countFiles; $i++)
			{           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];


               
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    if($img!=''){$this->Product_model->deleteSlideImg($currentID,$img);}
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $this->Product_model->AddSlideImg($uploadData[$i]['file_name'],$currentID);
                }
                 
				
			}
		}		
		echo $currentID;
		 
	}
            //---------------------------
    public function updateOrderslide(){
		$dataID = $this->input->post('dataID');
		$changeValue = $this->input->post('changeValue');
		$result = $this->Product_model->updateOrderslide($dataID,$changeValue);
		echo $result;		
	}
    //-------------------------------
	public function loadSlideImages(){
		$ProID=$this->input->post('ProID');
		$data['slideImg'] = $this->Product_model->loadSlideImg($ProID);
        $this->load->view('backend/slide_images_list',$data);		
	}
    //-------------------
    public function set_ShowOnWeb(){
        $dataID = $this->input->post('dataID');
        $check = $this->input->post('check');
        $table = $this->input->post('table');
        $result = $this->Product_model->update_ShowOnWeb($dataID, $check, $table);
        echo $result;
    }
    //-------------------------------
    public function deleteSlide(){
		$DataID=$this->input->post('DataID');
		$result = $this->Product_model->deleteSlide($DataID);
		echo $result;
	}
    //-------------------------------
	public function slide_list(){
            
		$data['SlideList']=$this->Product_model->slide_list();
		$this->load->view('backend/header');
		$this->load->view('backend/slide_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/slide_list_script');	
	}
    //-------------------------------	
    public function cangePassForm(){
	   $this->load->view('backend/changepassform');
    }
   	//-------------------------------  doChangePass') ', { newpass
    public function doChangePass(){
		$id = $this->input->post('id');
		$newpass = trim($this->input->post('newpass'));
		
		$result = $this->Product_model->doChangePass($newpass,$id);
		echo $result;
	}
    //-----------------
	public function admin_add($dataID=NULL){
		if($dataID!=''){
			$selectData=$this->Product_model->getuserdata($dataID);
			foreach($selectData->result() AS $abc){ }
			$data['name_sname']= $abc->name_sname;			
			$data['user_name']= $abc->user_name;			
			$data['password']= $abc->password;			
			$data['dataID']= $dataID;
		}else{
			$data['name_sname']= '';			
			$data['user_name']= '';			
			$data['password']= '';			
			$data['dataID']= '';
		}

		$this->load->view('backend/header');
		$this->load->view('backend/addmin_add',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/addmin_add_script');
	 }
     //-----------------------------
     public function chk_user(){
             $username = $this->input->post('username');
             $result = $this->Product_model->chk_user($username);
             $numresult = $result->num_rows();
		echo $numresult;
     }
     //-----------------------------
     public function add_admin(){
             $Name = $this->input->post('Name');
             $username = $this->input->post('username');
             $Password = $this->input->post('Password');
             $password_old = $this->input->post('password_old');
             $dataID = $this->input->post('dataID');
             $result = $this->Product_model->add_admin($Name,$username,$Password,$password_old,$dataID);

		echo $result;
     }
     //-------------------------------
	 public function admin_list(){
            
		$data['adminList']=$this->Product_model->admin_list();
		$this->load->view('backend/header');
		$this->load->view('backend/admin_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/admin_list_script');	
	}
	//-------------------------------
	public function load_category(){
		
		$category = $this->Category_model->listcategory(); ?>
            
		<table class="table table-bordered table-hover table-strip">
          <thead>
            <tr>
               <th width="5%" style="text-align: center !important">No.</th>
               <th>Category</th>
               <th width="20%"  style="text-align: center !important">Order</th>
               <th width="10%" style="text-align: center !important">Delete</th>
            </tr>
          </thead>
          <tbody>
		  <?php $n=1; foreach($category->result() as $category2){ ?>	  
               <tr>
                   <td align="center"><?php echo $n?>.</td>
                   <td><input type="text" value="<?php echo $category2->category_title?>" class="form-control form-control-sm" onChange="updateCategory('<?php echo $category2->id?>',this.value)" ></td>
                   <td align="center"><input style="text-align: center !important" id="order" type="text" class="form-control form-control-sm OrderCate" value="<?php echo $category2->category_order?>" onChange="updateOrder('<?php echo $category2->id?>', 'category_order', this.value)">
                       </td>

                   <td align="center"><button type="button" class="btn btn-sm btn-danger waves-light waves-effect" <?php //if($numdetailcate >0){disabled?><?php //} ?> onClick="comfirmDelete('<?php echo $category2->id?>', '<?php echo $category2->category_title?>')"><i class="icon-trash"></i></button></td>
              </tr>			  
					  
		  <?php  $n++; } ?>	  
        </tbody>
      </table>	
<?php
	}  
	//-----------------------------
    public function do_addCategory(){	
        $category_title = $this->input->post('category_title');   
        $result = $this->Category_model->DoAddProductCategory($category_title);
		echo $result;
    }
	//---------------------------
    public function update_category(){
		$dataID = $this->input->post('dataID');
		$changeValue = $this->input->post('changeValue');
		$result = $this->Category_model->do_updateCategory($dataID,$changeValue);
		echo $result;		
	}
    //-------------------------------
	public function do_get_subCategory(){
		$mainCate_id = $this->input->post('mainCate_id');
		$level = $this->input->post('level');		
		//$category2 = $this->Category_model->get_dataCategory($mainCate_id); 				
		$category2 = $this->Category_model->listcategory($mainCate_id,$level);
		$num = $category2->num_rows();
		
		if($num > 0){ ?>				
		
		<div class="form-group row category2" id="sub<?php echo $level+1?>">
			<label class="col-3 col-form-label">Sub Category</label>
			<div class="col-9">
				<select id="category<?php echo $level+1?>" name="category[]" class="form-control form-control-sm" onChange="get_subCategory(this.value,'<?php echo $level+1?>')" >
					<option value="0">---Select---</option>
					<?php foreach($category2->result() AS $category){ ?>
					<option value="<?php echo $category->id?>" <?php //if($category->id==$product_category){ echo "selected"; } ?> ><?php echo $category->name_th?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		
<?php  }  }  
		
	//------------------- 
	public function addFAQ(){ 				
		$topic_th = $this->input->post('topic_th');	
		$desc_th = $this->input->post('desc_th');
		$faqID = $this->input->post('faqID');
		$product_id = $this->input->post('currentID');
		$result = $this->Category_model->do_addFAQ($faqID,$topic_th,$desc_th,$product_id);
		echo $result;
	} 
	//-------------------------------  
	public function load_FAQ(){
		$ProID = $this->input->post('ProID');					
		$FAQ = $this->Category_model->list_FAQ($ProID);
		$num = $FAQ->num_rows(); ?>

		<div class="col-lg-11 offset-lg-1" id="showFAQ">
		
	<?php	if($num > 0){ 
			foreach($FAQ->result() AS $FAQ2){	
	?>	
          <div>
            <div class="question-q-box">Q.</div>
            <h4 class="question" data-wow-delay=".1s"><?php echo $FAQ2->topic_th?>
			  <button type="button" class="btn btn-danger btn-sm" onclick="deleteFAQ('<?php echo $FAQ2->id?>')" style="float: right; margin-right: 5%;"><i class="icon-trash"></i></button>
			  <button type="button" class="btn btn-success btn-sm" style="float: right; margin-right: 10px;" onclick="editFAQ('<?php echo $FAQ2->id?>','<?php echo $FAQ2->topic_th?>')"><i class="icon-pencil"></i></button>			  
			</h4>			
            <div class="answer col-9"><?php echo $FAQ2->desc_th?></div>         	
          </div>	
	<?php } ?>
		  </div>	
		
	<?php  } }  
	
	//-------------------------------
	 public function deleteFAQ(){ 
	 	 $DataID = $this->input->post('DataID');	 	 
		 $result = $this->Category_model->do_deleteFAQ($DataID);
		 echo $result;
	 }
	//-------------------
	public function editFAQ(){ 
		 $txt = '';
	 	 $dataID = $this->input->post('dataID');	 	 
	 	 $product_id = $this->input->post('currentID');	 	 
		 $FAQ = $this->Category_model->list_FAQ($product_id,$dataID);
		 foreach($FAQ->result() AS $FAQ2){}
		 $txt = $FAQ2->desc_th;
		
		 echo $txt;
	 }
	//-------------------
	public function set_ShowOnWeb2(){
        $dataID = $this->input->post('dataID');
        $check = $this->input->post('check');
        $table = $this->input->post('table');
        $result = $this->Category_model->update_ShowOnWeb($dataID,$check,$table,'show_onWeb');
        echo $result;
    }
	//-------------------------------  
	public function deleteData(){
		$result = '0';
		$DataID = $this->input->post('dataID');
		$chDownload = $this->Category_model->check_relatedData('product_id','tbl_downloadfile_data',$DataID);
		$chQuotation = $this->Category_model->check_relatedData('product_id','tbl_quote_quotation',$DataID);
		
		if(($chDownload->num_rows() < 1) && ($chQuotation->num_rows() < 1)){
			
			$this->Category_model->do_deleteData('product_id','tbl_youtube_link',$DataID);
			$this->Category_model->do_deleteData('product_id','tb_file_data',$DataID);
			$this->Category_model->do_deleteData('product_id','tb_img_data',$DataID);
			$this->Category_model->do_deleteData('product_id','tbl_faq_data',$DataID);
			$this->Category_model->do_deleteData('id','tbl_product_data',$DataID);
			$result = '1';
			
		} else {
			
			$this->Category_model->update_ShowOnWeb($DataID,'0','tbl_product_data','data_status');
			$result = '1';
		}			
		echo $result;
	}
	//---------------------- inputName inputEmail inputPhone textareaMessage
	public function sendmail(){
		$currentID = $this->input->post('currentID');
                $status = '1';
                $getuserfontend = $this->Product_model->getuserfontend($status);

                foreach ($getuserfontend->result() AS $userfontend){
                $NewDetail = $this->Product_model->getNewDetail($currentID);
		
			foreach($NewDetail->result() AS $news){}
			$news_title=$news->news_title;
			$news_detail=$news->news_detail; 
		
                        $imgnew = $this->Product_model->loadNewsImg($currentID);  
 foreach ($imgnew->result() AS $imgnew3){}
                $images_name = $imgnew3->images_name;
		$from_email = 'saleteam1@gotrading.co.th';
		$to_email = $userfontend->email;	
		$email_body = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<style>
		body{
		font-family: arial; 
		font-size: 11pt; 
	}
	</style>

</head>

<body>
	
	<table width="70%" align="center" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #D5D5D5;">
  <tbody>
    <tr>
      <td align="center" bgcolor="#efb40b" style="color:#FFFFFF;"><h2>'.$news_title.'</h2>www.gotautomations.com/News<br><br></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" style="font-size: 11pt; color: #666666; padding-left: 25px;">
	<img src="'.base_url().'uploadfile/news/'.$images_name.'" align="center" width="500"  style="margin-top: -55px; padding-left: 15px;">
    </tr>
    <tr>
      <td align="left" valign="top" style="font-size: 11pt; color: #666666; line-height: 25px; padding-left: 25px;">
		  <p>'.$this->Product_model->str_limit_html($news_detail,450).'</p><br></td>
    </tr>
    <tr>
      <td align="center"><a href="'.base_url().'News/news_detail/'.$currentID.'" style="padding:20px;background-color:#efb40b;color:white">คลิก อ่านต่อ...</a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center" >
      <div style="padding:10px;background-color:#eaeaea;">
      <p><img src="http://www.gotautomations.com/HTML_2/images/logo-dark.png" alt="logo" /><br>
        <strong>Great Oriental Trading Co.,Ltd.</strong><br>
        <br>
        1049 Ruamtam Rd., T.Khohong Hatyai Songkhla 90110 Thailand
        <br>
      </p>
</div>
</td>
    </tr>
     <tr>
        <td>
            <table width="100%" align="center" cellspacing="0" cellpadding="0" >
                <tr>
                  <td width="9%">&nbsp;</td>
                    <td width="4%">
                         <img src="http://www.gotautomations.com/HTML_2/images/phonegold.png"  width="40" /> 
                    </td>
                    <td width="17%"><strong>Tel:</strong> +66 74-300212-4 <br>
                    <strong>Fax:</strong> +66 74-300215</td>
                    <td width="4%"><img src="http://www.gotautomations.com/HTML_2/images/mail.png"  width="40" /></td>
                    <td width="18%"><br>
                      <strong>Email Address</strong><br>
						<a href="mailto:saleteam1@gotrading.co.th" target="_blank">saleteam1@gotrading.co.th</a></td>
                    <td width="4%" align="center"><img src="http://www.gotautomations.com/HTML_2/images/facebook-logo.png"  width="32" /></td>
                    <td width="18%"><strong>Facebook</strong><br>
                    <a href="https://www.facebook.com/GreatOrientalTrading/" target="_blank">GreatOrientalTrading</a></td>
                    <td width="4%">
                         <img src="http://www.gotautomations.com/HTML_2/images/chat1.png"  width="40" /> 
                    </td>
                    <td width="7%"><strong>ID Line</strong><br>
                    <a href="http://line.me/ti/p/@gotrading" target="_blank">@gotrading</a> </td>
                    <td width="15%"><img src="http://www.gotautomations.com/HTML_2/images/lineatgotrading.jpg"  width="101" /></td>
                </tr>
            </table>
    </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</body>
</html>
';		
		 
		
		$this->email->from($from_email, 'GOT AUTOMATION NEWS'); 
        $this->email->to($to_email);
        $this->email->subject('จดหมายติดต่อจาก GOT AUTOMATION( gotautomations.com )'); 
        $this->email->message($email_body); 
        $this->email->send();
        
                }
                $this->linenotify($currentID);
                $this->linenotify2($currentID);
                $this->linenotify3($currentID);
                $this->linenotify4($currentID);
                $this->linenotify5($currentID);
                $this->linenotify6($currentID);
                $this->linenotify7($currentID);
                $this->linenotify8($currentID);
                $this->linenotify9($currentID);
                $this->linenotify10($currentID);
                $this->linenotify11($currentID);
                $this->linenotify12($currentID);
                $this->linenotify13($currentID);
                $this->linenotify14($currentID);
                $this->linenotify15($currentID);
                echo 1;
	}
	//---------------------- inputName inputEmail inputPhone textareaMessage
	public function sendmailreference(){
		$currentID = $this->input->post('currentID');
                $status = '1';
                $getuserfontend = $this->Product_model->getuserfontend($status);

                foreach ($getuserfontend->result() AS $userfontend){
                $referenceDetail = $this->Product_model->getreferenceDetail($currentID);
		
			foreach($referenceDetail->result() AS $reference){}
			$reference_title=$reference->reference_title;
			$reference_detail=$reference->reference_detail; 
		
                        $referenceImg = $this->Product_model->loadreferenceImg($currentID);  
 foreach ($referenceImg->result() AS $imgreference3){}
                $images_name = $imgreference3->images_name;
		$from_email = 'saleteam1@gotrading.co.th';
		$to_email = $userfontend->email;	
		$email_body = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<style>
		body{
		font-family: arial; 
		font-size: 11pt; 
	}
	</style>

</head>

<body>
	
	<table width="70%" align="center" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #D5D5D5;">
  <tbody>
    <tr>
      <td align="center" bgcolor="#efb40b" style="color:#FFFFFF;"><h2>'.$reference_title.'</h2>www.gotautomations.com/News<br><br></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" style="font-size: 11pt; color: #666666; padding-left: 25px;">
	<img src="'.base_url().'uploadfile/reference/'.$images_name.'" align="center" width="500"  style="margin-top: -55px; padding-left: 15px;">
    </tr>
    <tr>
      <td align="left" valign="top" style="font-size: 11pt; color: #666666; line-height: 25px; padding-left: 25px;">
		  <p>'.$this->Product_model->str_limit_html($reference_detail,450).'</p><br></td>
    </tr>
    <tr>
      <td align="center"><a href="'.base_url().'Reference/Reference_detail/'.$currentID.'" style="padding:20px;background-color:#efb40b;color:white">คลิก อ่านต่อ...</a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center" >
      <div style="padding:10px;background-color:#eaeaea;">
      <p><img src="http://www.gotautomations.com/HTML_2/images/logo-dark.png" alt="logo" /><br>
        <strong>Great Oriental Trading Co.,Ltd.</strong><br>
        <br>
        1049 Ruamtam Rd., T.Khohong Hatyai Songkhla 90110 Thailand
        <br>
      </p>
</div>
</td>
    </tr>
     <tr>
        <td>
            <table width="100%" align="center" cellspacing="0" cellpadding="0" >
                <tr>
                  <td width="9%">&nbsp;</td>
                    <td width="4%">
                         <img src="http://www.gotautomations.com/HTML_2/images/phonegold.png"  width="40" /> 
                    </td>
                    <td width="17%"><strong>Tel:</strong> +66 74-300212-4 <br>
                    <strong>Fax:</strong> +66 74-300215</td>
                    <td width="4%"><img src="http://www.gotautomations.com/HTML_2/images/mail.png"  width="40" /></td>
                    <td width="18%"><br>
                      <strong>Email Address</strong><br>
						<a href="mailto:saleteam1@gotrading.co.th" target="_blank">saleteam1@gotrading.co.th</a></td>
                    <td width="4%" align="center"><img src="http://www.gotautomations.com/HTML_2/images/facebook-logo.png"  width="32" /></td>
                    <td width="18%"><strong>Facebook</strong><br>
                    <a href="https://www.facebook.com/GreatOrientalTrading/" target="_blank">GreatOrientalTrading</a></td>
                    <td width="4%">
                         <img src="http://www.gotautomations.com/HTML_2/images/chat1.png"  width="40" /> 
                    </td>
                    <td width="7%"><strong>ID Line</strong><br>
                    <a href="http://line.me/ti/p/@gotrading" target="_blank">@gotrading</a> </td>
                    <td width="15%"><img src="http://www.gotautomations.com/HTML_2/images/lineatgotrading.jpg"  width="101" /></td>
                </tr>
            </table>
    </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</body>
</html>
';		
		 
		
		$this->email->from($from_email, 'GOT AUTOMATION REFERENCE'); 
        $this->email->to($to_email);
        $this->email->subject('จดหมายติดต่อจาก GOT AUTOMATION( gotautomations.com )'); 
        $this->email->message($email_body); 
        $this->email->send();
       
                }
                 $this->linenotifyref($currentID);
                 $this->linenotifyref2($currentID);
                 $this->linenotifyref3($currentID);
                 $this->linenotifyref4($currentID);
                 $this->linenotifyref5($currentID);
                 $this->linenotifyref6($currentID);
                 $this->linenotifyref7($currentID);
                 $this->linenotifyref8($currentID);
                 $this->linenotifyref9($currentID);
                 $this->linenotifyref10($currentID);
                 $this->linenotifyref11($currentID);
                 $this->linenotifyref12($currentID);
                 $this->linenotifyref13($currentID);
                 $this->linenotifyref14($currentID);
                 $this->linenotifyref15($currentID);
                echo 1;
	}
          //----------------------------------
  public function checkmail(){
       $email = $this->input->post('email');
       $result = $this->Product_model->checkmail($email);
       echo $result;           
  }
  //-------------------
  public function linenotify($currentID){
	  	   //---------line notify----------------//
		$NewDetail = $this->Product_model->getNewDetail($currentID);
		
			foreach($NewDetail->result() AS $news){}
			 
        
		date_default_timezone_set("Asia/Bangkok");

		$sToken = "x90LByhjZwRceboe0brPHw8FukJvJUCxYEetbAIxd6S";

                    $datebookingArray = explode("-",$news->news_date_add);
                    $datebooking = $datebookingArray[2];
                    $monbooking = $datebookingArray[1];
                    $yearbooking = $datebookingArray[0] ;
                    $date_add = $datebooking.'-'.$monbooking.'-'.$yearbooking;
	 
	 			$sMessage ="\nNews Date : ".$date_add."\nNews Title : ".$news->news_title."\nNews Detail : ".$news->news_detail."";

	            $chOne = curl_init(); 
				curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
				curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
				curl_setopt( $chOne, CURLOPT_POST, 1); 
				curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
				$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
				curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
				$result = curl_exec( $chOne ); 

				//Result error 
				if(curl_error($chOne)) 
				{ 
					//echo 'error:' . curl_error($chOne); 
				} 
				else { 
					$result_ = json_decode($result, true); 
					//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				} 
				curl_close( $chOne );   

 }
   //-------------------------------
	public function article_add($curentID=NULL){
		
		$ArticleDetail = $this->Product_model->getArticleDetail($curentID);
		if($ArticleDetail->num_rows() > 0){
			foreach($ArticleDetail->result() AS $Article){}
			$data['article_title']=$Article->article_title;
			$data['article_detail']=$Article->article_detail; 
			$data['currentID']=$Article->id;
			$data['article_date_add']=$Article->article_date_add;
			$data['article_date_end']=$Article->article_date_end;
		 }else{
			$data['article_title']='';
			$data['article_detail']=''; 
			$data['currentID']='';
			$data['article_date_add']='';
			$data['article_date_end']='';
		}
		$this->load->view('backend/header',$data);
		$this->load->view('backend/article_add',$data);
		$this->load->view('backend/footer2');
		$this->load->view('backend/article_add_script');		
	}
           //-------------------------------   // imageID 
	public function deleteArticleImg(){
		$imageID = $this->input->post('imageID');
		$imageName = $this->input->post('imageName');
		$result = $this->Product_model->deleteArticleImg($imageID,$imageName);
		echo $result;
	} 
        //-------------------------------    
	public function AddArticle(){
		$currentID =$this->input->post('currentID');
		$news_detail =$this->input->post('news_detail');
		$news_title =$this->input->post('news_title');
		
		$news_date_add =$this->input->post('news_date_add');
		//$news_date_end =$this->input->post('news_date_end');
		$youtube =$this->input->post('youtube');
		 
		$currentID = $this->Product_model->AddArticle($news_title , $news_detail ,$currentID , $news_date_add );
                 
        if($youtube!=''){
            foreach($youtube AS $value){
                if($value !=''){
                    $result_id2 = $this->Product_model->addyoutubeArticle($currentID , $value);                        
                }  
            }
        }
        
         //--------uploadfile------------//
		$countFiles = count($_FILES['userFiles']['name']);
		   
		$upload_path = './uploadfile/article';
		$upload_pathName = 'uploadfile/article';
		$config['upload_path'] = $upload_path;
		//allowed file types. * means all types
		$config['allowed_types'] = 'jpg|png|gif';
		//allowed max file size. 0 means unlimited file size
		$config['max_size'] = '0';
		//max file name size
		$config['max_filename'] = '255';
		//whether file name should be encrypted or not
		$config['encrypt_name'] = TRUE;
		//store image info once uploaded
		$image_data = array();
		//check for errors
		$is_file_error = FALSE;
		 	
		$this->load->library('upload', $config);
        if($countFiles>0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
				
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddArticleImg($uploadData[$i]['file_name'],$currentID);
                }				
			}
		}		
		echo $currentID;		 
	}
          //-------------------------------
	public function loadArticleImages(){
		$ProID=$this->input->post('ProID');
		$data['ArticleImg'] = $this->Product_model->loadArticleImg($ProID);
		$this->load->view('backend/article_images_list',$data);
		
	}
           //-------------------------------
	public function article_list(){
		$data['article_list']=$this->Product_model->article_list();
		$this->load->view('backend/header');
		$this->load->view('backend/article_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/article_list_script');	
	}
          //------------------------------- deletearticle 
	public function deletearticle(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deletearticle($DataID);
		echo $result;
	}
         //-------------------------------
	public function gallery_add($curentID=NULL){
		
		$galleryDetail = $this->Product_model->getgalleryDetail($curentID);
		$data['categoryList'] = $this->Category_model->listcategory();
                
		if($galleryDetail->num_rows() > 0){
			foreach($galleryDetail->result() AS $gallery){}
			$data['gallery_title']=$gallery->gallery_title;
			$data['gallery_detail']=$gallery->gallery_detail; 
			$data['currentID']=$gallery->id;
			$data['gallery_date_add']=$gallery->gallery_date_add;
			$data['gallery_cate']=$gallery->gallery_cate;
		 }else{
			$data['gallery_title']='';
			$data['gallery_detail']=''; 
			$data['currentID']='';
			$data['gallery_date_add']='';
			$data['gallery_cate']='';
		}
		$this->load->view('backend/header',$data);
		$this->load->view('backend/gallery_add',$data);
		$this->load->view('backend/footer2');
		$this->load->view('backend/gallery_add_script');		
	}
         //-------------------------------   // imageID 
	public function deleteGalleryImg(){
		$imageID = $this->input->post('imageID');
		$imageName = $this->input->post('imageName');
		$result = $this->Product_model->deleteGalleryImg($imageID,$imageName);
		echo $result;
	} 
          //-------------------------------    
	public function AddGallery(){
		$currentID =$this->input->post('currentID');
		$category=$this->input->post('category');
		$news_detail =$this->input->post('news_detail');
		$news_title =$this->input->post('news_title');
		
		$news_date_add =$this->input->post('news_date_add');
		//$news_date_end =$this->input->post('news_date_end');
		$youtube =$this->input->post('youtube');
		 
		$currentID = $this->Product_model->AddGallery($news_title , $news_detail ,$currentID , $news_date_add,$category );
                 
        if($youtube!=''){
            foreach($youtube AS $value){
                if($value !=''){
                    $result_id2 = $this->Product_model->addyoutubeGallery($currentID , $value);                        
                }  
            }
        }
        
         //--------uploadfile------------//
		$countFiles = count($_FILES['userFiles']['name']);
		   
		$upload_path = './uploadfile/gallery';
		$upload_pathName = 'uploadfile/gallery';
		$config['upload_path'] = $upload_path;
		//allowed file types. * means all types
		$config['allowed_types'] = 'jpg|png|gif';
		//allowed max file size. 0 means unlimited file size
		$config['max_size'] = '0';
		//max file name size
		$config['max_filename'] = '255';
		//whether file name should be encrypted or not
		$config['encrypt_name'] = TRUE;
		//store image info once uploaded
		$image_data = array();
		//check for errors
		$is_file_error = FALSE;
		 	
		$this->load->library('upload', $config);
        if($countFiles>0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
				
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddGalleryImg($uploadData[$i]['file_name'],$currentID);
                }				
			}
		}		
		echo $currentID;		 
	}
           //-------------------------------
	public function loadGalleryImages(){
		$ProID=$this->input->post('ProID');
		$data['GalleryImg'] = $this->Product_model->loadGalleryImg($ProID);
		$this->load->view('backend/gallery_images_list',$data);
		
	} //-------------------------------
	public function gallery_list(){
		$data['gallery_list']=$this->Product_model->gallery_list();
		$this->load->view('backend/header');
		$this->load->view('backend/gallery_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/gallery_list_script');	
	}
          //------------------------------- deletearticle 
	public function deletegallery(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deletegallery($DataID);
		echo $result;
	}
      //-------------------------------
         //-------------------------------
	public function activity_add($curentID=NULL){
		
		$activityDetail = $this->Product_model->getactivityDetail($curentID);
		if($activityDetail->num_rows() > 0){
			foreach($activityDetail->result() AS $activity){}
			$data['activity_title']=$activity->activity_title;
			$data['activity_detail']=$activity->activity_detail; 
			$data['currentID']=$activity->id;
			$data['activity_date_add']=$activity->activity_date_add;
			$data['activity_date_end']=$activity->activity_date_end;
		 }else{
			$data['activity_title']='';
			$data['activity_detail']=''; 
			$data['currentID']='';
			$data['activity_date_add']='';
			$data['activity_date_end']='';
		}
		$this->load->view('backend/header',$data);
		$this->load->view('backend/activity_add',$data);
		$this->load->view('backend/footer2');
		$this->load->view('backend/activity_add_script');		
	}
           //-------------------------------   // imageID 
	public function deleteactivityImg(){
		$imageID = $this->input->post('imageID');
		$imageName = $this->input->post('imageName');
		$result = $this->Product_model->deleteactivityImg($imageID,$imageName);
		echo $result;
	} 
        //-------------------------------    
	public function Addactivity(){
		$currentID =$this->input->post('currentID');
		$news_detail =$this->input->post('news_detail');
		$news_title =$this->input->post('news_title');
		
		$news_date_add =$this->input->post('news_date_add');
		//$news_date_end =$this->input->post('news_date_end');
		$youtube =$this->input->post('youtube');
		 
		$currentID = $this->Product_model->Addactivity($news_title , $news_detail ,$currentID , $news_date_add );
                 
        if($youtube!=''){
            foreach($youtube AS $value){
                if($value !=''){
                    $result_id2 = $this->Product_model->addyoutubeactivity($currentID , $value);                        
                }  
            }
        }
        
         //--------uploadfile------------//
		$countFiles = count($_FILES['userFiles']['name']);
		   
		$upload_path = './uploadfile/activity';
		$upload_pathName = 'uploadfile/activity';
		$config['upload_path'] = $upload_path;
		//allowed file types. * means all types
		$config['allowed_types'] = 'jpg|png|gif';
		//allowed max file size. 0 means unlimited file size
		$config['max_size'] = '0';
		//max file name size
		$config['max_filename'] = '255';
		//whether file name should be encrypted or not
		$config['encrypt_name'] = TRUE;
		//store image info once uploaded
		$image_data = array();
		//check for errors
		$is_file_error = FALSE;
		 	
		$this->load->library('upload', $config);
        if($countFiles>0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
				
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddactivityImg($uploadData[$i]['file_name'],$currentID);
                }				
			}
		}		
		echo $currentID;		 
	}
          //-------------------------------
	public function loadactivityImages(){
		$ProID=$this->input->post('ProID');
		$data['activityImg'] = $this->Product_model->loadactivityImg($ProID);
		$this->load->view('backend/activity_images_list',$data);
		
	}
           //-------------------------------
	public function activity_list(){
		$data['activity_list']=$this->Product_model->activity_list();
		$this->load->view('backend/header');
		$this->load->view('backend/activity_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/activity_list_script');	
	}
          //------------------------------- deletearticle 
	public function deleteactivity(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deleteactivity($DataID);
		echo $result;
	}
        
	public function showroom_add($curentID=NULL){
		
		$showroomDetail = $this->Product_model->getshowroomDetail($curentID);
                
		if($showroomDetail->num_rows() > 0){
			foreach($showroomDetail->result() AS $showroom){}
			$data['company']=$showroom->company;
			$data['address']=$showroom->address; 
			$data['currentID']=$showroom->id;
			$data['phone']=$showroom->phone;
			$data['fax']=$showroom->fax;
			$data['email']=$showroom->email;
			$data['facebook']=$showroom->facebook;
			$data['map']=$showroom->map;
			$data['date_add']=$showroom->date_add;
		 }else{
			$data['company']='';
			$data['address']=''; 
			$data['currentID']='';
			$data['phone']='';
			$data['fax']='';
			$data['email']='';
			$data['facebook']='';
			$data['map']='';
			$data['date_add']='';
		}
		$this->load->view('backend/header',$data);
		$this->load->view('backend/showroom_add',$data);
		$this->load->view('backend/footer2');
		$this->load->view('backend/showroom_add_script');		
	}
        //---------------------------------------
        public function showroom_list(){
		$data['showroom_list']=$this->Product_model->showroom_list();
		$this->load->view('backend/header');
		$this->load->view('backend/showroom_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/showroom_list_script');	
	}
        //-------------------------------  
	public function loadData(){
		$ProID = $this->input->post('ProID');					
		$list_sub = $this->Product_model->list_sub($ProID);
		$num = $list_sub->num_rows(); ?>
            
		<table class="table table-bordered table-hover table-strip">
          <thead>
            <tr>
               <th width="5%" style="text-align: center !important">No.</th>
               <th>Sub Product Name</th>
               <th >Sub Product Price</th>
               <th width="10%" style="text-align: center !important">Delete</th>
            </tr>
          </thead>
          <tbody>
		  <?php $n=1; foreach($list_sub->result() as $list_sub2){ ?>	  
               <tr>
                   <td align="center"><?php echo $n?>.</td>
                   <td><input type="text" value="<?php echo $list_sub2->sub_name?>" id="namesub" name="namesub"  class="form-control form-control-sm" onChange="updatesub('<?php echo $list_sub2->id?>',this.value,'sub_name')" ></td>
                   <td ><input  id="pricesub" name="pricesub" type="text" class="form-control form-control-sm" value="<?php echo $list_sub2->sub_price?>" onChange="updatesub('<?php echo $list_sub2->id?>',this.value,'sub_price')">
                       </td>

                   <td align="center"><button type="button" class="btn btn-sm btn-danger waves-light waves-effect" <?php //if($numdetailcate >0){disabled?><?php //} ?> onClick="comfirmDelete('<?php echo $list_sub2->id?>', '<?php echo $list_sub2->sub_name?>')"><i class="icon-trash"></i></button></td>
              </tr>			  
					  
		  <?php  $n++; } ?>	  
        </tbody>
      </table>	
<?php  }
//------------------- 
	public function Addsub(){ 				
		$subname_th = $this->input->post('subname_th');	
		$subPrice = $this->input->post('subPrice');
		$product_id = $this->input->post('product_id');
		$result = $this->Product_model->Addsub($subname_th,$subPrice,$product_id);
		echo $result;
	} 
         //---------------------------
    public function updatesub(){
		$dataID = $this->input->post('dataID');
		$changeValue = $this->input->post('changeValue');
		$type = $this->input->post('type');
		$result = $this->Product_model->updatesub($dataID,$changeValue,$type);
		echo $result;		
	}
         //---------------------------
    public function visitshowroom_add($currentID=NULL){
		
		$data['visitDetail'] = $this->Product_model->visitDetail($currentID);
		$data['currentID'] = $currentID;
		
		/*if($productData->num_rows() > 0){
			foreach($productData->result() AS $product){}
			$data['product_nameth']=$product->product_nameth;
			$data['product_nameen']=$product->product_nameen;
			$data['product_topic']=$product->product_topic;
			$data['product_category']=$product->product_category;
			$data['product_desc']=$product->product_desc;
            $data['product_price']=$product->product_price;                        
			$data['currentID']=$product->id;
		
		 }else{
			$data['product_category']=0;			
		}*/
		$this->load->view('backend/header');
		//$this->load->view('backend/product_add',$data);
		$this->load->view('backend/visitshowroom_add',$data);
		$this->load->view('backend/footer');
		//$this->load->view('backend/product_script');
		$this->load->view('backend/visitshowroom_add_script');
	}
        	 public function deletevisitFile(){ 
	 	 $fileType = $this->input->post('fileType');
	 	 $DataID = $this->input->post('DataID');
	 	 $FileName = $this->input->post('FileName');
	 	 $type = $this->input->post('type');
		 $num = 0;
		 $result = $this->Product_model->deletevisitFile($DataID, $fileType, $FileName,$type);	 
		 echo $result;
	 }
            //------------------------------------
     public function loadvisitImg(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadvisitImg($ProID,'1');
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td ><span class="text-danger"><img src="'.base_url('uploadfile/visit/').$data->imge_name.'" style="width:150px;" class="thumbnail"></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\' , \'imgfile\', \''.$data->imge_name.'\' , \'1\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 } 
     //------------------------------------
     public function loadvisitImg360(){
		 $ProID = $this->input->post('ProID');
		 $imglist = $this->Product_model->loadvisitImg($ProID,'2');
		 echo '<table class="table table-bordered table-hover">';
		 foreach($imglist->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td ><span class="text-danger"><a href="'.base_url('View360/index/').$data->imge_name.'" target="_blank"><img src="'.base_url('uploadfile/360view/').$data->imge_name.'" style="width:150px;" class="thumbnail"></a></span></td>';
			 echo '<td width="30"><button type="button" class="btn btn-danger btn-sm" onclick="comfirmDelete(\''.$data->id.'\' , \'imgfile\', \''.$data->imge_name.'\', \'2\')"><i class="icon-trash"></i></button></td>';
			 echo '</tr>';
		 }
		 echo '</table>';
	 } 
     //------------------------------------
       //-----------------------------------------------
    public function Addvisit(){ 
		
		 $name_th = $this->input->post('name_th');
		$overview_th = $this->input->post('overview_th');
		 $currentID = $this->input->post('currentID'); 

		 $currentID = $this->Product_model->addvisit($currentID,$name_th,$overview_th);
 
		 //--------upload file------------//
		 
		 $countFiles = count($_FILES['userFiles']['name']);
		   
		 $upload_path = './uploadfile/visit';
		 $upload_pathName = 'uploadfile/visit';
		 $config['upload_path'] = $upload_path;
		 //allowed file types. * means all types
		 $config['allowed_types'] = 'jpg|png|gif';
		 //allowed max file size. 0 means unlimited file size
		 $config['max_size'] = '0';
		 //max file name size
		 $config['max_filename'] = '255';
		 //whether file name should be encrypted or not
		 $config['encrypt_name'] = TRUE;
		 //store image info once uploaded
		 $image_data = array();
		 //check for errors
		 $is_file_error = FALSE;
		 	
		 $this->load->library('upload', $config);
         if($countFiles > 0){ 
			for($i=0; $i<$countFiles; $i++){           
				//---------------------------
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
               
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddImagescvisit($uploadData[$i]['file_name'],$currentID,'1');
                }				
			}
		}
                
                 //--------upload file------------//
		 
		 $countFiles360 = count($_FILES['userFiles360']['name']);
		   
		 $upload_path = './uploadfile/360view';
		 $upload_pathName = 'uploadfile/360view';
		 $config['upload_path'] = $upload_path;
		 //allowed file types. * means all types
		 $config['allowed_types'] = 'jpg|png|gif';
		 //allowed max file size. 0 means unlimited file size
		 $config['max_size'] = '0';
		 //max file name size
		 $config['max_filename'] = '255';
		 //whether file name should be encrypted or not
		 $config['encrypt_name'] = TRUE;
		 //store image info once uploaded
		 $image_data = array();
		 //check for errors
		 $is_file_error = FALSE;
		 	
		 $this->load->library('upload', $config);
         if($countFiles360 > 0){ 
			for($i=0; $i<$countFiles360; $i++){           
				//---------------------------
				$_FILES['userFile360']['name'] = $_FILES['userFiles360']['name'][$i];
                $_FILES['userFile360']['type'] = $_FILES['userFiles360']['type'][$i];
                $_FILES['userFile360']['tmp_name'] = $_FILES['userFiles360']['tmp_name'][$i];
                $_FILES['userFile360']['error'] = $_FILES['userFiles360']['error'][$i];
                $_FILES['userFile360']['size'] = $_FILES['userFiles360']['size'][$i];
               
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile360')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$this->Product_model->AddImagescvisit($uploadData[$i]['file_name'],$currentID,'2');
                }				
			}
		}		
		echo $currentID;		
	 }
             //-------------------------------
	public function visitshowroom_list(){
		$data['visit_list']=$this->Product_model->visit_list();
		$this->load->view('backend/header');
		$this->load->view('backend/visitshowroom_list',$data);
		$this->load->view('backend/footer');
		$this->load->view('backend/visitshowroom_list_script');	
	}
            //------------------------------- deleteNews 
	public function deletevisit(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deletevisit($DataID);
		echo $result;
	}
         //-------------------------------    
	public function Addshowroom(){
		$currentID =$this->input->post('currentID');
		$company=$this->input->post('company');
		$address =$this->input->post('address');
		$phone =$this->input->post('phone');
		
		$fax =$this->input->post('fax');
		$email =$this->input->post('email');
		$facebook =$this->input->post('facebook');
		$map =$this->input->post('map');
		 
		$currentID = $this->Product_model->Addshowroom($currentID , $company ,$address , $phone,$fax,$email,$facebook,$map );
                 
		echo $currentID;		 
	}
             //------------------------------- deletearticle 
	public function deleteshowroom(){
		$DataID = $this->input->post('dataID');
		$result = $this->Product_model->deleteshowroom($DataID);
		echo $result;
	}
         //------------------------------------
     public function loadmap(){
		 $ProID = $this->input->post('ProID');
		 $getshowroomDetail = $this->Product_model->getshowroomDetail($ProID);
		 echo '<table class="table table-bordered table-hover">';
		 foreach($getshowroomDetail->result() AS $data){ 
			 echo '<tr id = "RowImg'.$data->id.'">';
			 echo '<td >'.$data->map.'</td>';
			 
			 echo '</tr>';
		 }
		 echo '</table>';
	 } 
         //---------------------------
    public function updateOrderimg(){
		$dataID = $this->input->post('dataID');
		$changeValue = $this->input->post('changeValue');
		$result = $this->Product_model->updateOrderimg($dataID,$changeValue);
		echo $result;		
	}
	
}