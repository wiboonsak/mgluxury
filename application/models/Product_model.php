<?php defined('BASEPATH') OR exit('No direct script access allowed');
 class Product_model extends CI_Model
 {
      public function get_user_id_from_username($username) {
        		$this->db->select('id');
        		$this->db->from('users');
        		$this->db->where('username', $username);
        		return $this->db->get()->row('id');
	   }
     
     //---------------------------  
	function GetthaiDateTime($day=NULL){
		$DateTimeArray= explode(" ",$day);
		$dateArray = explode("-",$DateTimeArray[0]);
		$date= $dateArray[2];
		$mon= $dateArray[1];
		$year= $dateArray[0]+543 ;
		//$monthArray = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน", "05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
       $monthArray=Array("01"=>"มกราคม ","02"=>"กุมภาพันธ์ ","03"=>"มีนาคม ","04"=>"เมษายน ","05"=>"พฤษภาคม ","06"=>"มิถุนายน ","07"=>"กรกฎาคม ","08"=>"สิงหาคม ","09"=>"กันยายน ","10"=>"ตุลาคม ","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
		if($date < 10){ $date = str_replace("0", "", $date); } 
		return $date."&nbsp;".$monthArray[$mon]."&nbsp;".$year."<br>".$DateTimeArray[1];
	}
    //-------------------------
    function getCategory($datatype=null){
        $sql = $this->db->query("SELECT * FROM tb_category WHERE category_status='" . $datatype . "' ORDER BY category_order ASC ");
        return $sql;
    }
    //---------------------
    function pCategoryDetail($cateID=NULL){
        $sql = $this->db->query("SELECT * FROM tb_category WHERE id='" . $cateID . "' ");
        return $sql;
    }
    //---------------------
    function DoAddProductCategory($category_title=NULL,$dataID=NULL,$img=NULL){
        if($dataID == ''){
            $sql = $this->db->query("SELECT MAX(category_order) AS nNax FROM tb_category WHERE category_status='1' ");
            foreach ($sql->result() AS $data){}
            $nMaxIns = $data->nNax + 1;

            $data = array('category_title' => $category_title, 'category_order' => $nMaxIns,'images' => $img);
            if($this->db->insert('tb_category', $data)){
                $pass = $this->db->insert_id();
                ;
            } else {
                $pass = 'Error';
            }
        } else {
            $data = array('category_title' => $category_title,'images' => $img);
            $this->db->where('id', $dataID);
            if($this->db->update('tb_category', $data)){
                $pass = $dataID;
            } else {
                $pass = 'Error';
            }
        }

        return $pass;
    }
    //-----------------------------
    function updateOrderCate($dataID=NULL,$changeValue=NULL){
        $data = array('category_order' => $changeValue);
        $this->db->where('id', $dataID);
        if($this->db->update('tb_category', $data)){
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
    //---------------------
    function deletePcate($DataID=NULL){
        $this->db->where('id', $DataID);
        if($this->db->delete('tb_category')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
    //-------------------------
    function getdetailcateid($dataid=null){
        $sql = $this->db->query("SELECT * FROM tb_data_detail WHERE product_category = '".$dataid ."' ");
        return $sql;
    }
    //-------------------------------------
    function getDetail($productID=NULL){
        $sql = $this->db->query("SELECT * FROM tb_data_detail WHERE id = '".$productID."' ");
        return $sql;
    }    
    //---------------------------------
     function AddImagesData($file_name=NULL,$Accessories_ID=NULL,$type=NULL){
           $sql = $this->db->query("SELECT MAX(img_order) AS nNax FROM tb_img_data WHERE product_id = '".$Accessories_ID."' AND type = '1'");
            foreach ($sql->result() AS $data){}
            $nMaxIns = $data->nNax + 1;
        $data = array('imge_name' => $file_name,
            'product_id' => $Accessories_ID,
            'img_order' => $nMaxIns,
            'type' => $type
        );
        $result = $this->db->insert('tb_img_data', $data);
    }
    //--------------------------------
    function AddCatalogueData($file_name=NULL,$AccessoriesID=NULL,$txt=NULL){
        $data = array(
			'imge_name' => $file_name,
			'txtTitle_th' => $txt,
            'product_id' => $AccessoriesID);
        $result = $this->db->insert('tb_file_data', $data);
    }
    //--------------------------------
    function AddCataloguePromotion($file_name=NULL,$AccessoriesID=NULL,$txt=NULL){
        $data = array(
			'imge_name' => $file_name,
			'txtTitle_th' => $txt,
            'promotion_id' => $AccessoriesID);
        $result = $this->db->insert('tb_file_promotion', $data);
    }
    //---------------------------------
    function loadProductImg($ProID=NULL,$type=NULL,$limit=NULL){
        $sql = $this->db->query("SELECT * FROM `tb_img_data` WHERE product_id = '".$ProID."' AND type = '".$type."' ORDER BY img_order ASC LIMIT $limit ");
        return $sql;
    }
    //---------------------------------
    function loadcateImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tb_category` WHERE id = '".$ProID."' ");
        return $sql;
    }
    //----------------------------------
    function loadProductFile($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tb_file_data` WHERE product_id = '".$ProID."' AND data_status = '1' ORDER BY id ASC ");
        return $sql;
    } 
    //----------------------------------
    function loadPromotionFile($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tb_file_promotion` WHERE promotion_id = '".$ProID."' AND data_status = '1' ORDER BY id ASC ");
        return $sql;
    } 
    //------------------------------------------
     function deleteProductFile1($DataID=NULL,$fileType=NULL,$fileName=NULL,$type=NULL){
        if($fileType == 'imgfile'){
            $this->db->where('imge_name', $fileName);
            if($this->db->delete('tb_img_data')){
                $pass = 1;
                if($type=='1'){
                    @unlink('./uploadfile/product/' . $fileName);
                }else{
                    @unlink('./uploadfile/360view/' . $fileName);
                }
                
            } else {
                $pass = 0;
            }
        } else if ($fileType == 'catalgoue'){
            $this->db->where('imge_name', $fileName);
            if($this->db->delete('tb_file_data')){
                $pass = 1;
                @unlink('./uploadfile/catalogue/' . $fileName);
            } else {
                $pass = 0;
            }
        }
        return $pass;
    }
    //------------------------------------------
     function deletePromotionFile1($DataID=NULL,$fileType=NULL,$fileName=NULL){
        if($fileType == 'imgfile'){
            $this->db->where('images_name', $fileName);
            if($this->db->delete('tbl_reference_images')){
                $pass = 1;
                @unlink('./uploadfile/reference/' . $fileName);
            } else {
                $pass = 0;
            }
        } else if ($fileType == 'catalgoue'){
            $this->db->where('imge_name', $fileName);
            if($this->db->delete('tb_file_promotion')){
                $pass = 1;
                @unlink('./uploadfile/catalogue/' . $fileName);
            } else {
                $pass = 0;
            }
        }
        return $pass;
    }
    //------------------------------------------
    function deletecateimg($DataID=NULL,$fileName=NULL,$img=NULL){ 
         $data = array('images' => $img
        );
            $this->db->where('id', $DataID);
            if($this->db->update('tb_category', $data)){
                $pass = 1;
                @unlink('./uploadfile/' . $fileName);
            } else {
                $pass = 0;
            }
        return $pass;
    }
    //----------------------------------
    function getlinkyoutube($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_link` WHERE product_id = '".$dataid."' ");
        return $sql;
    }
    //----------------------------------
    function getlinkyoutubenew($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_News` WHERE news_id = '".$dataid."' ");
        return $sql;
    }
    //----------------------------------
    function getlinkyoutubereference($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_reference` WHERE reference_id = '".$dataid."'  ");
        return $sql;
    }
    //-------------------------------
    function addyoutube($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'product_id' =>$dataID,
            	'date_add' => $today
        	);
            if($this->db->insert('tbl_youtube_link', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
   //-------------------------------
   function addyoutubeNew ($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'news_id' =>$dataID,
            	'date_add' => $today
        	);
            if($this->db->insert('tbl_youtube_News', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
   //-------------------------------
   function addyoutubereference ($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'reference_id' =>$dataID,
            	'date_add' => $today
        	);
            if ($this->db->insert('tbl_youtube_reference', $data)) {
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
  }
  //------------------------------------------
  function delete_data($dataID=NULL,$table=NULL){
			$data = array('id' => $dataID,);
			if($this->db->delete($table, $data)){
				$pass = 1;
			} else {
				$pass = 0;
				//$this->db->_error_message(); 
			}
			return $pass;
  }
  //----------------------------------------
  function getproductList(){
        $sql = $this->db->query("SELECT a.* ,  b.category_title FROM tb_data_detail a LEFT JOIN tb_category b ON a.product_category=b.id WHERE a.data_status='1' AND b.category_status='1' ORDER BY b.category_order ASC");
        return $sql;
  }
  //------------------------------------
  function getNewDetail($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_news_data');
        return $sql;
  }
  //------------------------------------
  function getreferenceDetail($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_reference_data');
        return $sql;
  }
  //------------------------------------
  function deleteNewsImg($imageID=NULL,$imageName=NULL){
        $this->db->where('id', $imageID);
        if($this->db->delete('tbl_news_images')){
            @unlink('./uploadfile/news/' . $imageName);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
  }
     //------------------------------------
    function deleteNewsImgdata($DataID=NULL,$imge_name=NULL){
        $this->db->where('news_id', $DataID);
        $this->db->where('images_name', $imge_name);
        if($this->db->delete('tbl_news_images')){
            @unlink('./uploadfile/news/' . $imge_name);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
  //------------------------------------
  function deletereferenceImg($imageID=NULL,$imageName=NULL){
        $this->db->where('id', $imageID);
        if($this->db->delete('tbl_reference_images')){
            @unlink('./uploadfile/reference/' . $imageName);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
  }
     //------------------------------------
    function deletereferenceImgdata($DataID=NULL,$imge_name=NULL){
        $this->db->where('reference_id', $DataID);
        $this->db->where('images_name', $imge_name);
        if($this->db->delete('tbl_reference_images')){
            @unlink('./uploadfile/reference/' . $imge_name);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
  //------------------------------------
  function addNews($news_title=NULL,$news_detail=NULL,$currentID=NULL,$news_date_add=NULL){
        $data = array(
			'news_title' => $news_title,
			'news_detail' => $news_detail,
			'news_date_add' => $news_date_add
		);
        if($currentID == ''){
            if($this->db->insert('tbl_news_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_news_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
  //------------------------------------
  function addreference($reference_title=NULL,$reference_detail=NULL,$currentID=NULL,$reference_date_add=NULL){
        $data = array(
			'reference_title' => $reference_title,
			'reference_detail' => $reference_detail,
			'reference_date_add' => $reference_date_add
		);
        if($currentID == ''){
            if($this->db->insert('tbl_reference_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_reference_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
    }
    //------------------------------------
    function AddNewsImg($file_name=NULL,$ProductID=NULL){
        $data = array('images_name' => $file_name,
            'news_id' => $ProductID
        );
        if($this->db->insert('tbl_news_images', $data)){
            $pass = '';
        } else {
            $pass = 'Error';
        }
    }
    //------------------------------------
    function AddreferenceImg($file_name=NULL,$ProductID=NULL){
        $data = array('images_name' => $file_name,
            'reference_id' => $ProductID
        );
        if( $this->db->insert('tbl_reference_images', $data)){
            $pass = '';
        } else {
            $pass = 'Error';
        }
    }
    //----------------------------
    function loadNewsImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_news_images` WHERE news_id = '".$ProID."' ORDER BY id DESC ");
        return $sql;
    }
    //----------------------------
    function loadreferenceImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_reference_images` WHERE reference_id = '".$ProID."' ");
        return $sql;
    }
    //------------------------------------
    function news_list() {
        $sql = $this->db->query("SELECT * FROM tbl_news_data WHERE news_status = '1' ORDER BY id DESC");
        return $sql;
    }
    //------------------------------------
    function reference_list(){
        $sql = $this->db->query("SELECT * FROM tbl_reference_data WHERE reference_status = '1' ORDER BY id DESC");
        return $sql;
    }
    //------------------------------------
    function getDay($strDate=NULL){
        $dateArray = explode("-", $strDate);
        $date2 = $dateArray[2];
        $mon = $dateArray[1];
        $year = $dateArray[0];

        $monthArray = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
        if($dateArray[0] == 2018){
            $year = $dateArray[0] + 543;
        }
        if($date2 < 10){
            $date2 = str_replace("0", "", $date2);
        }
        $day = $date2."&nbsp;&nbsp;".$monthArray[$mon]."&nbsp;&nbsp;".$year;
        return $date2;
    }
	//------------------------------------
    function getMonth($strDate=NULL){
        $dateArray = explode("-", $strDate);
        $date2 = $dateArray[2];
        $mon = $dateArray[1];
        $year = $dateArray[0];

        $monthArray = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
        if($dateArray[0] == 2018){
            $year = $dateArray[0] + 543;
        }
        if($date2 < 10){
            $date2 = str_replace("0", "", $date2);
        }
        $day = $date2."&nbsp;&nbsp;".$monthArray[$mon]."&nbsp;&nbsp;".$year;
        return $monthArray[$mon];
    }
	//------------------------------------
    function getYear($strDate=NULL){
        $dateArray = explode("-", $strDate);
        $date2 = $dateArray[2];
        $mon = $dateArray[1];
        $year = $dateArray[0];

        $monthArray = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
        if($dateArray[0] == 2018){
            $year = $dateArray[0];
        }
        if ($date2 < 10) {
            $date2 = str_replace("0", "", $date2);
        }
        $day = $date2."&nbsp;&nbsp;".$monthArray[$mon]."&nbsp;&nbsp;".$year;
        return $year;
    }

    //$strMonthCut =array("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"Jul","08"=>"Aug","09"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");
    //------------------------------------
    function getDayMonthYear($strDate=NULL){
        $dateArray = explode("-", $strDate);
        $date2 = $dateArray[2];
        $mon = $dateArray[1];
        $year = $dateArray[0];

        $monthArray = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
        if($dateArray[0] == 2018){
            $year = $dateArray[0];
        }
        if($date2 < 10){
            $date2 = str_replace("0", "", $date2);
        }
        $day = $date2."&nbsp;&nbsp;".$monthArray[$mon]."&nbsp;&nbsp;".$year;
        return $day;
    }
    //------------------------------------
    function deleteNews($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_news_images WHERE news_id = '".$DataID."' ");
        foreach ($sql->result() AS $data){
            @unlink('./uploadfile/news/' . $data->images_name);
        }
        $this->db->where('news_id', $DataID);
        $this->db->delete('tbl_news_images');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_news_data')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
    //------------------------------------
    function deletereference($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_reference_images WHERE reference_id = '".$DataID."' ");
        foreach ($sql->result() AS $data) {
            @unlink('./uploadfile/reference/' . $data->images_name);
        }
        $this->db->where('reference_id', $DataID);
        $this->db->delete('tbl_reference_images');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_reference_data')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
    //------------------------------------
    function getslideDetail($curentID=null){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_slide_data');
        return $sql;
    }
    //----------------------------
    function loadSlideImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_slide_img` WHERE slide_id = '".$ProID."' ");
        return $sql;
    }
    //------------------------------------
    function deleteSlideImg($DataID=NULL,$imge_name=NULL){
        $this->db->where('slide_id', $DataID);
        $this->db->where('image_name', $imge_name);
        if($this->db->delete('tbl_slide_img')){
            @unlink('./uploadfile/banner/' . $imge_name);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
    //------------------------------------
    function addSlide($slide_title=NULL,$slide_detail=NULL,$currentID=NULL,$slide_desc=NULL,$learnMore=NULL){
        
        if($currentID == ''){
             $sql = $this->db->query("SELECT MAX(slide_order) AS nNax FROM tbl_slide_data ");
            foreach ($sql->result() AS $data){}
            $nMaxIns = $data->nNax + 1;
            $data = array(
			'slide_title' => $slide_title,
			'slide_detail' => $slide_detail,
			'slide_desc' => $slide_desc,
			'learnMore' =>$learnMore,
			'slide_order' =>$nMaxIns
		);
            if($this->db->insert('tbl_slide_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
              $data = array(
			'slide_title' => $slide_title,
			'slide_detail' => $slide_detail,
			'slide_desc' => $slide_desc,
			'learnMore' =>$learnMore
		);
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_slide_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
    }
    //------------------------------------
    function AddSlideImg($file_name=NULL,$ProductID=NULL){
        $data = array('image_name' => $file_name,
            'slide_id' => $ProductID
        );
        if($result = $this->db->insert('tbl_slide_img', $data)){
            $pass = '';
        } else {
            $pass = 'Errpr';
        }
    }
    //---------------------------	 
    function update_ShowOnWeb($dataID=NULL,$check=NULL,$table=NULL){
        $data = array(
            'show_onweb' => $check
        );
        $this->db->where('id', $dataID);
        if($this->db->update($table, $data)){
            $pass = 1;
        } else {
            $pass = 0;
            //$this->db->_error_message(); 
        }
        return $pass;
    }
    //------------------------------------
    function deleteSlide($DataID=null){
        $sql = $this->db->query("SELECT * FROM tbl_slide_img WHERE slide_id = '".$DataID."' ");
        foreach ($sql->result() AS $data) {
            @unlink('./uploadfile/banner/' . $data->image_name);
        }
        $this->db->where('slide_id', $DataID);
        $this->db->delete('tbl_slide_img');
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_slide_data')){
            $pass = '1';
        }else{
            $pass = 'Error';
        }
        return $pass;
    }
    //---------------------------
    function slide_list($show_onweb = NULL){
        if($show_onweb!=''){
        $sql = $this->db->query("SELECT * FROM tbl_slide_data WHERE show_onweb = '1' ORDER BY slide_order ");
        }else{
          $sql = $this->db->query("SELECT * FROM tbl_slide_data  ORDER BY slide_order ");  
        }
        return $sql;
    }
    //-------------------------------------
    function doChangePass($newpass=NULL,$id=NULL){
        $newpass = md5($newpass);
        $sql = "UPDATE tbl_user_data SET `password` = '".$newpass."' WHERE id = '".$id."' ";
        if($this->db->query($sql)){
            return 1;
        } else {
            return 0;
        }
    }
    //---------------------
    function getuserdata($dataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_user_data WHERE id = '".$dataID."' ");
        return $sql;
    }
    //---------------------
    function chk_user($username=null){
        $sql = $this->db->query("SELECT * FROM tbl_user_data WHERE user_name ='" .$username. "' ");
        return $sql;
    }
    //---------------------
    function add_admin($Name=null,$username=null,$Password=null,$password_old=null,$dataID=null){
       if($dataID == ''){
                $Password1 = md5($Password);
                $data = array(
				'name_sname' => $Name,
				'user_name' => $username,
				'password' => $Password1,
				'user_type' => '2');
				if ($this->db->insert('tbl_user_data', $data)) {
					$dataID = $this->db->insert_id();
				} else {
					$dataID = 'Error';
				}
			} else {
                        if($Password ==''){
                            $Password1 = $password_old;
                        }else{
                            $Password1 = md5($Password);
                        }
				$data = array(
				'name_sname' => $Name,
				'user_name' => $username,
				'password' => $Password1,
				'user_type' => '2');
				$this->db->where('id', $dataID);
				if($this->db->update('tbl_user_data', $data)){
					$dataID = $dataID;
				} else {
					$dataID = 'Error';
				}
			}
			return $dataID;
    }
      //---------------------------
    function admin_list() {
        $sql = $this->db->query("SELECT * FROM tbl_user_data WHERE user_type != '1' ORDER BY id ");
        return $sql;
    }
    //--------------------
    function productListByCate($cateID = null, $limit = null, $notUse = null, $start = null, $perpage = null) {
        if ($limit != '') {
            $txtWhere = 'LIMIT ' . $limit;
        } else {
            $txtWhere = '';
        }
        if ($notUse != '') {
            $txtNot = "AND id !='" . $notUse . "' ";
        } else {
            $txtNot = '';
        }
        if (($start >= 0) && ($perpage >= 0)) {
            $txtStart = 'LIMIT ' . $start . ',' . $perpage;
        } else {
            $txtStart = '';
        }

        $sql = "SELECT * FROM tb_data_detail WHERE product_category = '" . $cateID . "' AND data_status='1' $txtNot ORDER BY id DESC $txtWhere  $txtStart ";
        $query = $this->db->query($sql);
        return $query;
    }
     //---------------------
    function getSlideImg($dataId) {
        $sql = $this->db->query("SELECT * FROM tbl_slide_img WHERE slide_id = '" . $dataId . "' ORDER BY id ASC LiMIT 0,1 ");
        $numsql = $sql->num_rows();
        if($numsql!=0){
        foreach ($sql->result() AS $data) {}
        return $data->image_name;
        
       // if($numsql!=''){
        
        }else{
            return 0;
        }
    }
      //----------------------------------------
    function getNewsDetail1($limit = null, $notUse = null, $start = null, $perpage = null) {
        if ($limit != '') {
            $txtWhere = 'LIMIT ' . $limit;
        } else {
            $txtWhere = '';
        }if ($notUse != '') {
            $txtNot = "AND id !='" . $notUse . "' ";
        } else {
            $txtNot = '';
        }
        if (($start >= 0) && ($perpage >= 0)) {
            $txtStart = 'LIMIT ' . $start . ',' . $perpage;
        } else {
            $txtStart = '';
        }
        $sql = $this->db->query("SELECT * FROM  tbl_news_data WHERE news_status = '1' $txtNot ORDER BY news_date_add DESC  $txtWhere  $txtStart  " );
        return $sql;
    }
      //----------------------------------------
    function getreferenceDetail1($limit = null, $notUse = null, $start = null, $perpage = null) {
        if ($limit != '') {
            $txtWhere = 'LIMIT ' . $limit;
        } else {
            $txtWhere = '';
        }if ($notUse != '') {
            $txtNot = "AND id !='" . $notUse . "' ";
        } else {
            $txtNot = '';
        }
        if (($start >= 0) && ($perpage >= 0)) {
            $txtStart = 'LIMIT ' . $start . ',' . $perpage;
        } else {
            $txtStart = '';
        }
        $sql = $this->db->query("SELECT * FROM  tbl_reference_data WHERE reference_status = '1' $txtNot ORDER BY reference_date_add DESC  $txtWhere  $txtStart  " );
        return $sql;
    }
     //--------------------------------
    function getSlideDetail1(){
        $sql = $this->db->query("SELECT * FROM  tbl_slide_data WHERE show_onweb = '1'") ;
        return $sql;
    }
     //--------------------------------
    function getcateDetail(){
        $sql = $this->db->query("SELECT * FROM tb_category WHERE category_status = '1' ORDER BY category_order ASC") ;
        return $sql;
    }
        //---------------------
    function getreferenceImg($dataId) {
        $sql = $this->db->query("SELECT * FROM tbl_reference_images WHERE reference_id = '" . $dataId . "' ORDER BY id ASC LiMIT 0,1 ");
        foreach ($sql->result() AS $data) {
            
        }
        return $data->images_name;
    }
        //---------------------
    function getNewsImg($dataId) {
        $sql = $this->db->query("SELECT * FROM tbl_news_images WHERE news_id = '" . $dataId . "' ORDER BY id ASC LiMIT 0,1 ");
        foreach ($sql->result() AS $data) {
            
        }
        return $data->images_name;
    }
     //------------------------------
    function str_limit_html($value, $limit) {

        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        // Strip text with HTML tags, sum html len tags too.
        // Is there another way to do it?
        do {
            $len = mb_strwidth($value, 'UTF-8');
            $len_stripped = mb_strwidth(strip_tags($value), 'UTF-8');
            $len_tags = $len - $len_stripped;

            $value = mb_strimwidth($value, 0, $limit + $len_tags, '', 'UTF-8');
        } while ($len_stripped > $limit);

        // Load as HTML ignoring errors
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $value, LIBXML_HTML_NODEFDTD);

        // Fix the html errors
        $value = $dom->saveHtml($dom->getElementsByTagName('body')->item(0));

        // Remove body tag
        $value = mb_strimwidth($value, 6, mb_strwidth($value, 'UTF-8') - 13, '', 'UTF-8'); // <body> and </body>
        // Remove empty tags
        return preg_replace('/<(\w+)\b(?:\s+[\w\-.:]+(?:\s*=\s*(?:"[^"]*"|"[^"]*"|[\w\-.:]+))?)*\s*\/?>\s*<\/\1\s*>/', '', $value);
    }
    //---------------------
    function getFirstImg($dataId=NULL){
        $sql = $this->db->query("SELECT * FROM tb_img_data WHERE product_id = '" . $dataId . "' ORDER BY id ASC LiMIT 0,1 ");
        foreach($sql->result() AS $data){}
        return $data->imge_name;
    }
	//--------------------- 
    function search($txtSearch=null){
		 	 
		 $sql="SELECT a.*,b.imge_name,c.category_title FROM  tb_data_detail a LEFT JOIN tb_img_data b ON a.id=b.product_id LEFT JOIN tb_category c ON a.product_category = c.id  WHERE a.product_nameen LIKE '%".$txtSearch."%' OR a.product_nameth LIKE '%".$txtSearch."%' AND a.data_status = '1' GROUP BY a.id ";
		 $query=$this->db->query($sql);
		 return $query;
	}
    //---------------------
    function getPdetailcatalogue($productID=NULL,$dataID=NULL){
		
		if($productID != ''){
			$this->db->where('product_id', $productID);		
		}
		if($dataID != ''){
			$this->db->where('id', $dataID);		
		}							
		$this->db->select('*');	
		$query = $this->db->get('tb_file_data');		
		return $query;		
    }
    //---------------------
    function getPdetailCategory($productID=NULL){
        $sql = "SELECT a.* , b.id AS CategoryID, a.id AS productID , b.product_topic,b.product_desc,b.product_nameth,b.product_nameen FROM tb_data_detail b LEFT JOIN tb_category a ON b.product_category=a.id WHERE  b.id='" . $productID . "' ";
        $query = $this->db->query($sql);
        return $query;
    }
    //---------------------- 
    function getCategory1($datatype=null){

        $sql = $this->db->query("SELECT COUNT(*) AS TotalCount, b.id,b.category_title FROM tb_data_detail a INNER JOIN tb_category b ON a.product_category = b.id where b.category_status = '" . $datatype . "' GROUP BY b.id,b.category_title");
        return $sql;
    }
    //----------------------------------------
    function getNewsDetailByID($productID){
        $sql = $this->db->query("SELECT * FROM  tbl_news_data WHERE id = '" . $productID . "' AND news_status = '1' ");
        return $sql;
    }
    //----------------------------------------
    function getreferenceDetailByID($productID){
        $sql = $this->db->query("SELECT * FROM  tbl_reference_data WHERE id = '" . $productID . "' AND reference_status = '1' ");
        return $sql;
    }
    //----------------------------------------
    function AddNewUser($name=NULL,$Phone=NULL,$Line=NULL,$email=NULL,$password=NULL){
        $dateUpdate = date("Y-m-d H:i:s");
        $data = array('name' => $name,
            'phone' => $Phone,
            'line' => $Line,
            'email' => $email,
            'password' => md5($password),
            'data_status' => '1',
            'date_add' => $dateUpdate);

            if($this->db->insert('tbl_user_fontend', $data)){
                $currentID = $this->db->insert_id();
                
           $this->db->where('id', $currentID);
           $query = $this->db->get('tbl_user_fontend');

           //SELECT * FROM users WHERE username = '$username' AND password = '$password'
           if($query->num_rows() > 0){
            foreach ($query->result() as $row);
            $userdata = array(
                 'member_id'         => $row->id,
                 'member_name'              => $row->name,
                 'member_phone'              => $row->phone,
                 'member_line'              => $row->line,
                 'member_email'     => $row->email
                 );

           $this->session->set_userdata($userdata);
             //-----------last update----------//
           date_default_timezone_set('Asia/Bangkok');
           $now = date("Y-m-d H:i:s");
           $data = array(
               'last_login' => $now
            );
          $this->db->where('id', $row->id);
          $this->db->update('tbl_user_fontend', $data);
            return true;
           }else{
                return false;
           }
            } else {
                $currentID = 'Error';
            }

        return $currentID;
    }
    //-----------------------------------------------
     function can_login($email, $password){
           $password = md5($password);
           $this->db->where('email', $email);
           $this->db->where('password', $password);
           $query = $this->db->get('tbl_user_fontend');

           //SELECT * FROM users WHERE username = '$username' AND password = '$password'
           if($query->num_rows() > 0)
           {
            foreach ($query->result() as $row);
            $userdata = array(
                  'member_id'         => $row->id,
                 'member_name'              => $row->name,
                 'member_phone'              => $row->phone,
                 'member_line'              => $row->line,
                 'member_email'     => $row->email
                 );

           $this->session->set_userdata($userdata);
           //-----------last update----------//
           date_default_timezone_set('Asia/Bangkok');
           $now = date("Y-m-d H:i:s");
           $data = array(
               'last_login' => $now
            );
          $this->db->where('id', $row->id);
          $this->db->update('tbl_user_fontend', $data);
			   return true;
           }else{
                return false;
           }
      }
      //-------------------------------------------
      function download($product_id=NULL,$file_id=NULL) {
        $dateUpdate = date("Y-m-d H:i:s");
        $data = array('file_id' => $file_id,
            'product_id' => $product_id,
            'date_time' => $dateUpdate);

            if ($this->db->insert('tbl_downloadfile_data', $data)) {
                $currentID = $this->db->insert_id();
            } else {
                $currentID = 'Error';
            }

        return $currentID;
    }
                    //-------------------------
    function getuserfontend($status=NULL) {
        if($status!=''){
            $txt = 'WHERE data_status = "'.$status.'"';
        }else{
            $txt = '';
        }
        $sql = $this->db->query("SELECT * FROM tbl_user_fontend $txt ORDER BY date_add ASC");
        return $sql;
    }
                    //-------------------------
    function checkmail($email=NULL) {
        $sql = $this->db->query("SELECT * FROM tbl_user_fontend WHERE email = '".$email."'");
        $numsql = $sql->num_rows();
        if($numsql>0){
            $num =  1;
        }else{
            $num =  0;
        }
        return $num;
    }
       //------------------------------------
    function Quotation($name=NULL, $member_id=NULL, $phone=NULL, $line=NULL, $email=NULL, $address=NULL, $message=NULL, $product_id=NULL) {
        $dateUpdate = date("Y-m-d H:i:s");
        $data = array('member_id' => $member_id,
            'name' => $name, 
            'phone' => $phone,
            'line' => $line,
            'email' => $email,
            'address' => $address,
            'date_add' => $dateUpdate,
            'product_id' => $product_id,
            'message' =>$message);
            if ($this->db->insert('tbl_quote_quotation', $data)) {
                $pass = $this->db->insert_id();
                $orderID = date('dmy').$product_id.$pass;
                $data1 = array('quotation_id' => $orderID);
                $this->db->where('id', $pass);
                $this->db->update('tbl_quote_quotation', $data1);
            } else {
                $pass = 'Error';
            }

        return $pass;
    }
                        //-------------------------
    function getquotations($dataid=NULL) {
        if($dataid==''){
        $sql = $this->db->query("SELECT * FROM tbl_quote_quotation ORDER BY date_add DESC");
        }else{
         $sql = $this->db->query("SELECT * FROM tbl_quote_quotation WHERE id = '$dataid' ORDER BY date_add ASC");    
        }
        return $sql;
    }
        //------------------------------------
    function getcertificateDetail($curentID=null) {
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_certificates_data');
        return $sql;
    }
        //------------------------------------
    function getcertificate($type=NULL) {
        if($type==''){
             $sql = $this->db->query("SELECT * FROM tbl_certificates_data ORDER BY date_add ASC");
        }else{
            $sql = $this->db->query("SELECT * FROM tbl_certificates_data WHERE show_onweb = '$type' ORDER BY date_add ASC");
        }
        
        return $sql;
    }
      //------------------------------------
    function deletecertificatesImg($DataID, $imge_name) {
         $data = array('file_name' => '');
        $this->db->where('id', $DataID);
        if ($this->db->update('tbl_certificates_data', $data)) {
            @unlink('./uploadfile/certificate/' . $imge_name);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
      //------------------------------------
    function addcert($currentID, $certificates) {
        if ($currentID == '') {
                $dateUpdate = date("Y-m-d H:i:s");
        $data = array('certificates' => $certificates,
            'date_add' => $dateUpdate);
            if ($this->db->insert('tbl_certificates_data', $data)) {
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $data = array('certificates' => $certificates);
            $this->db->where('id', $currentID);
            if ($this->db->update('tbl_certificates_data', $data)) {
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }

        return $pass;
    }
      //------------------------------------
    function addcertificates($img, $currentID) {
   
            $data1 = array(
            'file_name' => $img);
            $this->db->where('id', $currentID);
            if ($this->db->update('tbl_certificates_data', $data1)) {
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }

        return $pass;
    }
    //------------------------------------
    function deletecertificates($DataID=null) {
        $sql = $this->db->query("SELECT * FROM tbl_certificates_data WHERE id ='" . $DataID . "' ");
        foreach ($sql->result() AS $data) {
            @unlink('./uploadfile/certificate/' . $data->file_name);
        }
      $this->db->where('id', $DataID);
        if($this->db->delete('tbl_certificates_data')){
            $pass = '1';
        }else{
            $pass = 'Error';
        }
        return $pass;
    }
        //------------------------------------
    function getservice($curentID=null) {
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_service');
        return $sql;
    }
     //------------------------------------
  function AddService($topic =null , $topic_detail =null ,$currentID =null , $icon_class =null ){
       $dateUpdate = date("Y-m-d H:i:s");
       $data = array(
			'topic' => $topic,
			'topic_detail' => $topic_detail,
			'icon_class' => $icon_class,
			'show_onweb' => '1',
			'date_add' => $dateUpdate
		);
        if($currentID == ''){
            if($this->db->insert('tbl_service', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_service', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
      //------------------------------------
    function getservice_list($type=NULL) {
        if($type==''){
             $sql = $this->db->query("SELECT * FROM tbl_service ORDER BY date_add DESC");
        }else{
            $sql = $this->db->query("SELECT * FROM tbl_service WHERE show_onweb = '$type' ORDER BY date_add DESC");
        }
        
        return $sql;
    }
      //------------------------------------
  function getserviceDetailbyid($curentID=NULL){

        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_service_datail');
    
        return $sql;
  }

      //------------------------------------
  function getserviceDetail(){
        $sql = $this->db->get('tbl_service_datail');
        return $sql;
  }
   //----------------------------------
    function getlinkyoutubeservice($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_Service` WHERE service_detail_id = '".$dataid."' ");
        return $sql;
    }
        //----------------------------
    function loadserviceImages($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_service_datail_img` WHERE service_datail_id = '".$ProID."' ");
        return $sql;
    }
     //------------------------------------
  function deleteserviceImg($imageID=NULL,$imageName=NULL){
        $this->db->where('id', $imageID);
        if($this->db->delete('tbl_service_datail_img')){
            @unlink('./uploadfile/service/' . $imageName);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
  }
  //------------------------------------
  function Addservice_detail($service_topic=NULL , $service_detail=NULL ,$currentID=NULL , $date=NULL){
        $data = array(
			'service_topic' => $service_topic,
			'service_detail' => $service_detail,
			'service_status' => '1',
			'date' => $date
		);
        if($currentID == ''){
            if($this->db->insert('tbl_service_datail', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_service_datail', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
    //-------------------------------
   function addyoutubeservice($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'service_detail_id' =>$dataID,
            	'date_add' => $today
        	);
            if($this->db->insert('tbl_youtube_Service', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
    //------------------------------------
    function AddserviceImg($file_name=NULL,$ProductID=NULL){
        $data = array('images_name' => $file_name,
            'service_datail_id' => $ProductID
        );
        if($this->db->insert('tbl_service_datail_img', $data)){
            $pass = '';
        } else {
            $pass = 'Error';
        }
    }
      //------------------------------------
    function deleteservice($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_service_datail_img WHERE service_datail_id = '".$DataID."' ");
        foreach ($sql->result() AS $data){
            @unlink('./uploadfile/service/' . $data->images_name);
        }
        $this->db->where('service_datail_id', $DataID);
        $this->db->delete('tbl_service_datail_img');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_service_datail_img')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
       //----------------------------------------
    function getservicebycate($limit = null, $id = null, $start = null, $perpage = null) {
        if ($limit != '') {
            $txtWhere = 'LIMIT ' . $limit;
        } else {
            $txtWhere = '';
        }if ($id != '') {
            $txtNot = "AND service_cate = '".$id."' ";
        } else {
            $txtNot = '';
        }
        if (($start >= 0) && ($perpage >= 0)) {
            $txtStart = 'LIMIT ' . $start . ',' . $perpage;
        } else {
            $txtStart = '';
        }
        $sql = $this->db->query("SELECT * FROM tbl_service_datail WHERE service_status = '1' $txtNot ORDER BY date DESC  $txtWhere  $txtStart  " );
        return $sql;
    }
    //---------------------
    function getserviceimg($dataId){
        $sql = $this->db->query("SELECT * FROM tbl_service_datail_img WHERE service_datail_id = '".$dataId."' ORDER BY id ASC LiMIT 0,1 ");
        foreach($sql->result() AS $data){}
        return $data->images_name;
    }
    //----------------------------
    function loadserviceImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_service_datail_img` WHERE service_datail_id = '".$ProID."' ");
        return $sql;
    }
    //------------------------------------
  	function getproduct_data($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_product_data');
        return $sql;
  	}
           //------------------------------------
    function Addcontact($sendername =NULL, $emailaddress =NULL,$telephone =NULL, $sendersubject =NULL,$sendermessage =NULL) {
        $dateUpdate = date("Y-m-d H:i:s");
        $data = array('name' => $sendername,
            'subject' => $sendersubject, 
            'tel' => $telephone,
            'email' => $emailaddress,
            'message' => $sendermessage,
            'date_add' =>$dateUpdate);
            if ($this->db->insert('tbl_contact_data', $data)) {
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }

        return $pass;
    }
     //-------------------------------
    function addinterest($dataID=null,$value=null){
        	$data = array('contact_id' => $dataID,
            	'cate_id' =>$value,
        	);
            if($this->db->insert('tbl_sectors_of_interest', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
                         //-------------------------
    function getcontact_data($dataid=NULL) {
       
         $sql = $this->db->query("SELECT * FROM  tbl_contact_data WHERE id = '$dataid' ORDER BY date_add ASC");    
        
        return $sql;
    }
    function getsectors_of_interest($dataid=NULL) {
         $sql = $this->db->query("SELECT a.*,b.name_th FROM  tbl_sectors_of_interest AS a LEFT JOIN tbl_category_data AS b ON a.cate_id = b.id WHERE a.contact_id = '$dataid' ");    
        
        return $sql;
    }
    //---------------------------  
	function GetthaiDatenews($day=NULL,$dayend=NULL){
		$dateArray = explode("-",$day);
		$date= $dateArray[2];
		$mon= $dateArray[1];
		$year= $dateArray[0]+543 ;
                
                             $dateendArray = explode("-",$dayend);
		$dateend = $dateendArray[2];
		$monend = $dateendArray[1];
		$yearend = $dateendArray[0]+543 ;
		//$monthArray = array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน", "05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
       $monthArray=Array("01"=>"ม.ค.","02"=>"ก.พ.","03"=>"มี.ค.","04"=>"เม.ย.","05"=>"พ.ค.","06"=>"มิ.ย.","07"=>"ก.ค.","08"=>"ส.ค.","09"=>"ก.ย.","10"=>"ต.ค.","11"=>"พ.ย.","12"=>"ธ.ค.");
		if($date < 10){ $date = str_replace("0", "", $date); } 
               
		return $date."&nbsp;".$monthArray[$mon]."&nbsp;".$year."&nbsp; - &nbsp;".$dateend."&nbsp;".$monthArray[$monend]."&nbsp;".$yearend;
                
	}
        //------------------------------------  
    function getcat_product($mainCate_id=NULL,$level=NULL, $start = null, $perpage = null) {
      if($mainCate_id != ''){
          $txtWhere = 'AND mainCate_id = '.$mainCate_id.' ';
       }else{
           $txtWhere = '';
       }
        if($level != ''){
            $txtNot = 'AND level = '.$level.' ';
        }else{
            $txtNot = '';
        }
        if (($start >= 0) && ($perpage >= 0)) {
            $txtStart = 'LIMIT ' . $start . ',' . $perpage;
        } else {
            $txtStart = '';
        }
        $sql = $this->db->query("SELECT * FROM  tbl_category_data WHERE data_status = '1' $txtWhere $txtNot ORDER BY category_order ASC   $txtStart  " );
        return $sql;
    }
        //------------------------------------  
    function get_product($start = null, $perpage = null) {
    
        if (($start >= 0) && ($perpage >= 0)) {
            $txtStart = 'LIMIT ' . $start . ',' . $perpage;
        } else {
            $txtStart = '';
        }
        $sql = $this->db->query("SELECT * FROM  tbl_product_data WHERE show_onWeb = '1' ORDER BY date_add DESC   $txtStart  " );
        return $sql;
    }
      //---------------------
    function checkcap($captcha=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_captcha WHERE captcha ='".$captcha."' ");
        return $sql;
    }
     //---------------------------------
     function addcap($capt_string=NULL){
        $data = array('captcha' => $capt_string);
        $result = $this->db->insert('tbl_captcha', $data);
    }
       //---------------------
    function deletecap(){
        $sql = $this->db->query("DELETE FROM `tbl_captcha` WHERE `captcha` !='' ");
        
    }
    //-----------------------------
    function updateOrderslide($dataID=NULL,$changeValue=NULL){
        $data = array('slide_order' => $changeValue);
        $this->db->where('id', $dataID);
        if($this->db->update('tbl_slide_data', $data)){
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
     //------------------------------------
  function getArticleDetail($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_article_data');
        return $sql;
  }
    //----------------------------------
    function getlinkyoutubeArticle($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_Article` WHERE article_id = '".$dataid."' ");
        return $sql;
    }
      //------------------------------------
  function deleteArticleImg($imageID=NULL,$imageName=NULL){
        $this->db->where('id', $imageID);
        if($this->db->delete('tbl_article_images')){
            @unlink('./uploadfile/article/' . $imageName);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
  }
  //------------------------------------
  function AddArticle($news_title=NULL,$news_detail=NULL,$currentID=NULL,$news_date_add=NULL){
        $data = array(
			'article_title' => $news_title,
			'article_detail' => $news_detail,
			'article_date_add' => $news_date_add
		);
        if($currentID == ''){
            if($this->db->insert('tbl_article_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_article_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
  //-------------------------------
   function addyoutubeArticle ($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'article_id' =>$dataID,
            	'date_add' => $today
        	);
            if($this->db->insert('tbl_youtube_Article', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
     //------------------------------------
    function AddArticleImg($file_name=NULL,$ProductID=NULL){
        $data = array('images_name' => $file_name,
            'article_id' => $ProductID
        );
        if($this->db->insert('tbl_article_images', $data)){
            $pass = '';
        } else {
            $pass = 'Error';
        }
    }
    //----------------------------
    function loadArticleImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_article_images` WHERE article_id = '".$ProID."' ORDER BY id DESC ");
        return $sql;
    }
      //------------------------------------
    function article_list($status=NULL) {
        if($status!=''){
            $sql = $this->db->query("SELECT * FROM tbl_article_data WHERE article_status = '1' ORDER BY id DESC");
        }else{
            $sql = $this->db->query("SELECT * FROM tbl_article_data  ORDER BY id DESC");
        }
        
        return $sql;
    }
    //------------------------------------
    function deletearticle($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_article_images WHERE article_id = '".$DataID."' ");
        foreach ($sql->result() AS $data){
            @unlink('./uploadfile/article/' . $data->images_name);
        }
        $this->db->where('article_id', $DataID);
        $this->db->delete('tbl_article_images');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_article_data')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
         //------------------------------------
  function getgalleryDetail($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_gallery_data');
        return $sql;
  }
  //----------------------------------
    function getlinkyoutubegallery($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_gallery` WHERE gallery_id = '".$dataid."' ");
        return $sql;
    }
       //------------------------------------
  function deleteGalleryImg($imageID=NULL,$imageName=NULL){
        $this->db->where('id', $imageID);
        if($this->db->delete('tbl_gallery_images')){
            @unlink('./uploadfile/gallery/' . $imageName);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
  }
   //------------------------------------
  function AddGallery($news_title=NULL,$news_detail=NULL,$currentID=NULL,$news_date_add=NULL,$category=NULL){
        $data = array(
			'gallery_title' => $news_title,
			'gallery_detail' => $news_detail,
			'gallery_cate' => $category,
			'gallery_date_add' => $news_date_add
		);
        if($currentID == ''){
            if($this->db->insert('tbl_gallery_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_gallery_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
  //-------------------------------
   function addyoutubeGallery ($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'gallery_id' =>$dataID,
            	'date_add' => $today
        	);
            if($this->db->insert('tbl_youtube_gallery', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
       //------------------------------------
    function AddGalleryImg($file_name=NULL,$ProductID=NULL){
        $data = array('images_name' => $file_name,
            'gallery_id' => $ProductID
        );
        if($this->db->insert('tbl_gallery_images', $data)){
            $pass = '';
        } else {
            $pass = 'Error';
        }
    }
    //----------------------------
    function loadGalleryImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_gallery_images` WHERE gallery_id = '".$ProID."' ORDER BY id DESC ");
        return $sql;
    }
       //------------------------------------
    function gallery_list($status=NULL) {
        if($status!=''){
             $sql = $this->db->query("SELECT * FROM tbl_gallery_data WHERE gallery_status = '1' ORDER BY id DESC");
        }else{
             $sql = $this->db->query("SELECT * FROM tbl_gallery_data  ORDER BY id DESC");
        }
       
        return $sql;
    }
    //------------------------------------
    function deletegallery($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_gallery_images WHERE gallery_id = '".$DataID."' ");
        foreach ($sql->result() AS $data){
            @unlink('./uploadfile/gallery/' . $data->images_name);
        }
        $this->db->where('gallery_id', $DataID);
        $this->db->delete('tbl_gallery_images');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_gallery_data')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
        //------------------------------------
  function getactivityDetail($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_activity_data');
        return $sql;
  }
    //----------------------------------
    function getlinkyoutubeactivity($dataid=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_youtube_activity` WHERE activity_id = '".$dataid."' ");
        return $sql;
    }
      //------------------------------------
  function deleteactivityImg($imageID=NULL,$imageName=NULL){
        $this->db->where('id', $imageID);
        if($this->db->delete('tbl_activity_images')){
            @unlink('./uploadfile/activity/' . $imageName);
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
  }
  //------------------------------------
  function Addactivity($news_title=NULL,$news_detail=NULL,$currentID=NULL,$news_date_add=NULL){
        $data = array(
			'activity_title' => $news_title,
			'activity_detail' => $news_detail,
			'activity_date_add' => $news_date_add
		);
        if($currentID == ''){
            if($this->db->insert('tbl_activity_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_activity_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
  //-------------------------------
   function addyoutubeactivity ($dataID=null,$value=null){
       		$today = date("Y-m-d H:i:s");
        	$data = array('linkyoutube' => $value,
            	'activity_id' =>$dataID,
            	'date_add' => $today
        	);
            if($this->db->insert('tbl_youtube_activity', $data)){
                $dataID = $this->db->insert_id();
            } else {
                $dataID = 'Error';
            }   
   }
     //------------------------------------
    function AddactivityImg($file_name=NULL,$ProductID=NULL){
        $data = array('images_name' => $file_name,
            'activity_id' => $ProductID
        );
        if($this->db->insert('tbl_activity_images', $data)){
            $pass = '';
        } else {
            $pass = 'Error';
        }
    }
    //----------------------------
    function loadactivityImg($ProID=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_activity_images` WHERE activity_id = '".$ProID."' ORDER BY id DESC ");
        return $sql;
    }
      //------------------------------------
    function activity_list($status=NULL,$limit=NULL) {
        if($status!=''){
            if($limit!=''){
                 $sql = $this->db->query("SELECT * FROM tbl_activity_data WHERE activity_status = '1' ORDER BY id DESC LIMIT $limit");
            }else{
                 $sql = $this->db->query("SELECT * FROM tbl_activity_data WHERE activity_status = '1' ORDER BY id DESC");
            }
           
        }else{
        $sql = $this->db->query("SELECT * FROM tbl_activity_data  ORDER BY id DESC");
        }
        return $sql;
    }
    //------------------------------------
    function deleteactivity($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_activity_images WHERE activity_id = '".$DataID."' ");
        foreach ($sql->result() AS $data){
            @unlink('./uploadfile/activity/' . $data->images_name);
        }
        $this->db->where('activity_id', $DataID);
        $this->db->delete('tbl_activity_images');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_activity_data')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
    //------------------------------------
  function Addsub($subname_th=NULL , $subPrice=NULL ,$product_id=NULL,$currentID=NULL){
      $today = date("Y-m-d H:i:s");
        $data = array(
			'sub_name' => $subname_th,
			'sub_price' => $subPrice,
			'product_id' => $product_id,
			'date_add' => $today
		);
        if($currentID == ''){
            if($this->db->insert('tbl_subproduct_data', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_subproduct_data', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
    //------------------------------------
    function list_sub() {  
        $sql = $this->db->query("SELECT * FROM tbl_subproduct_data  ORDER BY date_add DESC");
        return $sql;
    }
      //-----------------------------
    function updatesub($dataID=NULL,$changeValue=NULL,$type=NULL){
        $data = array($type => $changeValue);
        $this->db->where('id', $dataID);
        if($this->db->update('tbl_subproduct_data', $data)){
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
    	//-------------------------------------
    function visitDetail($productID=NULL){
        
		if($productID != ''){
			$this->db->where('id', $productID);		
		}							
		$this->db->select('*');	
		$query = $this->db->get('tbl_visit_data');		
		return $query;
    } 
    //------------------------------------------
     function deletevisitFile($DataID=NULL,$fileType=NULL,$fileName=NULL,$type=NULL){
        if($fileType == 'imgfile'){
            $this->db->where('imge_name', $fileName);
            if($this->db->delete('tbl_visit_img')){
                $pass = 1;
                if($type=='1'){
                    @unlink('./uploadfile/visit/' . $fileName);
                }else{
                    @unlink('./uploadfile/360view/' . $fileName);
                }
                
            } else {
                $pass = 0;
            }
        } 
        return $pass;
    }
    //---------------------------------
    function loadvisitImg($ProID=NULL,$type=NULL){
        $sql = $this->db->query("SELECT * FROM `tbl_visit_img` WHERE visit_id = '".$ProID."' AND type = '".$type."' ");
        return $sql;
    }
 	//----------------------------------------
    function addvisit($currentID=NULL,$name_th=NULL,$overview_th=NULL){	
		
        $data = array(
			'name_th' => $name_th,
            'detail_th' => $overview_th,
            'date_add' => date("Y-m-d H:i:s")
        );

        if($currentID == ''){

            if($this->db->insert('tbl_visit_data', $data)){
                $currentID = $this->db->insert_id();
            } else {
                $currentID = 'Error';
            }
			
        } else if($currentID != ''){
			
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_visit_data', $data)){
                $currentID = $currentID;
            } else {
                $currentID = 'Error';
            }
        }

        return $currentID;
    }
       //---------------------------------
     function AddImagescvisit($file_name=NULL,$Accessories_ID=NULL,$type=NULL){
        $data = array('imge_name' => $file_name,
            'visit_id' => $Accessories_ID,
            'type' => $type
        );
        $result = $this->db->insert('tbl_visit_img', $data);
    }
        //------------------------------------
    function visit_list($status=NULL) {
        if($status!=''){
            $sql = $this->db->query("SELECT * FROM tbl_visit_data WHERE data_status = '1' ORDER BY id DESC");
        }else{
        $sql = $this->db->query("SELECT * FROM tbl_visit_data  ORDER BY id DESC");
        }
        return $sql;
    }
     //------------------------------------
    function deletevisit($DataID=NULL){
        $sql = $this->db->query("SELECT * FROM tbl_visit_img WHERE visit_id = '".$DataID."' ");
        foreach ($sql->result() AS $data) {
            @unlink('./uploadfile/visit/' . $data->images_name);
        }
        $this->db->where('visit_id', $DataID);
        $this->db->delete('tbl_visit_img');
        
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_visit_data')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
             //------------------------------------
  function getshowroomDetail($curentID=NULL){
        $this->db->where('id', $curentID);
        $sql = $this->db->get('tbl_showroom');
        return $sql;
  }
   //------------------------------------
  function Addshowroom($currentID=NULL , $company=NULL ,$address=NULL , $phone=NULL,$fax=NULL,$email=NULL,$facebook=NULL,$map=NULL){
        $data = array(
			'company' => $company,
			'address' => $address,
			'phone' => $phone,
			'fax' => $fax,
			'email' => $email,
			'facebook' => $facebook,
			'map' => $map,
			'date_add' => date("Y-m-d")
		);
        if($currentID == ''){
            if($this->db->insert('tbl_showroom', $data)){
                $pass = $this->db->insert_id();
            } else {
                $pass = 'Error';
            }
        } else {
            $this->db->where('id', $currentID);
            if($this->db->update('tbl_showroom', $data)){
                $pass = $currentID;
            } else {
                $pass = 'Error';
            }
        }
        return $pass;
  }
         //------------------------------------
    function showroom_list() {

             $sql = $this->db->query("SELECT * FROM tbl_showroom  ORDER BY id DESC");
   
       
        return $sql;
    }
     //------------------------------------
    function deleteshowroom($DataID=NULL){
       
        $this->db->where('id', $DataID);
        if($this->db->delete('tbl_showroom')){
            $pass = '1';
        } else {
            $pass = 'Error';
        }
        return $pass;
    }
  //-----------------------------
    function updateOrderimg($dataID=NULL,$changeValue=NULL){
        $data = array('img_order' => $changeValue);
        $this->db->where('id', $dataID);
        if($this->db->update('tb_img_data', $data)){
            $pass = 1;
        } else {
            $pass = 0;
        }
        return $pass;
    }
   





  
 }
