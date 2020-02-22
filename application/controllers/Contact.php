<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
        $this->load->model('Product_model');  
        $this->load->model('User_model');  
        $this->load->model('Category_model');
    }
	
	
	//---------------------------------
	public function index()
	{
           $this->load->view('fontend/contact');
	}
	//---------------------------------
	public function captcha($r=NULL)
	{
           if($this->session->userdata('gfm_captcha') != ''){
		$capt_string = 'ERROR!';
        }else{
		$capt_string = $this->session->userdata('gfm_captcha');
        }	
        $i=1;
        for($x=0;$x<$i;$x++){
	$rand_char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));
	$capt_string = rand(1, 7) . rand(1, 7) . $rand_char;
       $checkcap = $this->Product_model->checkcap($capt_string);
       $numcap = $checkcap->num_rows();
       if($numcap<1){
           $this->Product_model->addcap($capt_string);
       }else{
           $rand_char2 = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));
            $capt_string2 = rand(1, 7) . rand(1, 7) . $rand_char2;
             $checkcap2 = $this->Product_model->checkcap($capt_string2);
       $numcap2 = $checkcap2->num_rows();
        if($numcap2<1){
           $this->Product_model->addcap($capt_string2);
       }else{
          $i=$i+1;   
       }
        }
        
       }
	//$_SESSION['gfm_captcha'] = $capt_string;
	header('Cache-control: no-cache');
        
	//Set the font 
	$font  = 'php/captcha/fonts/zxxnoise.otf';
	// Set the image settings
	$image = imagecreatetruecolor(118, 15); 
	$black = imagecolorallocate($image, 0, 0, 0);
	$color = imagecolorallocate($image, 140,148,155);
	$white = imagecolorallocate($image, 245,245,245);
	imagefilledrectangle($image,0,0,399,99,$white);
	// Draw the image
	imagettftext($image, 15, 0, 15, 15, $color, $font, $capt_string);
	// Output image
	header('Content-type: image/png');
	imagepng($image);
	imagedestroy($image);
	}
//-------------------	
	public function action_captcha(){
		
		$txt = $this->input->post('txtcap');
		$checkcap = $this->Product_model->checkcap($txt);
       $numcaptxt = $checkcap->num_rows();
       if($numcaptxt>0){
           echo '1';
       }else{
           echo '0';
       }
	}	
        //-------------------------------    
	public function submitdata(){
		$sendername =$this->input->post('sendername');
		$emailaddress =$this->input->post('emailaddress');
		$telephone =$this->input->post('telephone');
		$sendersubject =$this->input->post('sendersubject');
		$sendermessage =$this->input->post('sendermessage');
		
		 
		$currentID = $this->Product_model->Addcontact($sendername , $emailaddress ,$telephone , $sendersubject,$sendermessage);

		echo $currentID;
	}
     //---------------------- inputName inputEmail inputPhone textareaMessage
	public function sendContactMail(){
            $DataID = $this->input->post('DataID');
            
            $where = '';
		$getcontact_data = $this->Product_model->getcontact_data($DataID);
        foreach($getcontact_data->result() AS $data){}
		$from_email = $data->email;
		$to_email = 'wiboonsak.suw@gmail.com';	
		$email_body = '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<style type="text/css">
.share {
	-moz-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	-webkit-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #9dce2c), color-stop(1, #8cb82b) );
	background:-moz-linear-gradient( center top, #9dce2c 5%, #8cb82b 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#9dce2c", endColorstr="#8cb82b");
	background-color:#9dce2c;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #83c41a;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:normal;
	font-style:normal;
	height:40px;
	line-height:40px;
	width:177px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #689324;
}
.share:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8cb82b), color-stop(1, #9dce2c) );
	background:-moz-linear-gradient( center top, #8cb82b 5%, #9dce2c 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#8cb82b", endColorstr="#9dce2c");
	background-color:#8cb82b;
}.share:active {
	position:relative;
	top:1px;
}
.book {
	-moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	-webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
	background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#79bbff", endColorstr="#378de5");
	background-color:#79bbff;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #84bbf3;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:normal;
	font-style:normal;
	height:40px;
	line-height:40px;
	width:118px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #528ecc;
}
.book:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
	background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#378de5", endColorstr="#79bbff");
	background-color:#378de5;
}.book:active {
	position:relative;
	top:1px;
}</style>
</head>

<body>
<table width="60%" height="393" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family: arial; font-size: 11pt; border:1px solid #D5D5D5;">
  <tbody>
    <tr>
      <td height="70" align="center"  bgcolor="#5F5F5F" style="color:#FFFFFF; font-size: 16pt;"><span style="font-size: 16pt; color: #ffffff; font-weight: 400; text-align: center">huanghong from website.</span></td>
    </tr>
    <tr>
      <td height="223" align="center" valign="top" style="font-size: 11pt; color: #666666; line-height: 25px;"><p><br>
        </p>
        <table width="90%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tbody>
            <tr>
              <td height="40" colspan="5" align="center" bgcolor="#E7E5E5"><strong>Contact Form</strong></td>
            </tr>
            <tr>
              <td width="27%" height="40" align="right" bgcolor="#F7F7F7"><strong>Name : </strong></td>
              <td width="1%" height="40" bgcolor="#F7F7F7">&nbsp;</td>
              <td height="40" colspan="3" bgcolor="#F7F7F7" style="font-size: 16pt; color:#F07700">'.$data->name.'</td>
            </tr>
            <tr>
              <td height="40" align="right" bgcolor="#F7F7F7"><strong>Tel :</strong></td>
              <td height="40" bgcolor="#F7F7F7">&nbsp;</td>
              <td height="40" bgcolor="#F7F7F7">'.$data->tel.'</td>
            </tr>
            <tr>
              <td height="40" align="right"><strong>E-mail :</strong></td>
              <td height="40">&nbsp;</td>
              <td height="40">'.$data->email.'</td>
            </tr>
            <tr>
              <td height="40" align="right" bgcolor="#F7F7F7"><strong>Subject :</strong></td>
              <td height="40" bgcolor="#F7F7F7">&nbsp;</td>
              <td height="40" colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
            </tr>
            <tr>
              <td height="40" align="right">&nbsp;</td>
              <td height="40">&nbsp;</td>
              <td height="40" colspan="3">'.$data->subject.'</td>
            </tr>
            <tr>
              <td height="40" align="right" bgcolor="#F7F7F7"><strong>Message :</strong></td>
              <td height="40" bgcolor="#F7F7F7">&nbsp;</td>
              <td height="40" colspan="3" bgcolor="#F7F7F7">&nbsp;</td>
            </tr>
            <tr>
              <td height="40" align="right">&nbsp;</td>
              <td height="40">&nbsp;</td>
              <td height="40" colspan="3">'.$data->message.'</td>
            </tr>

          </tbody>
        </table>
        <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td align="center" >
      <div style="padding:20px;background-color:#eaeaea;">
      <p><strong>หจก. หวงหวงษ์ สหกิจ</strong><br>
    49 ซอย 1 ประชายินดี ตำบลหาดใหญ่ อำเภอหาดใหญ่ จังหวัดสงขลา 90110<br>
    Telephone: +66 95-036-765   Fax: +66 74-800716<br>
    Email: <a href="mailto:H2S@windowslive.com" target="_blank">H2S@windowslive.com</a>    &nbsp;&nbsp;&nbsp;Website: <a href="https://www.huanghong.co.th/" target="_blank">huanghong.co.th</a></p>
</div>
</td>
    </tr>
  </tbody>
</table>
</body>
</html>
';		
		 
		
		$this->email->from($from_email, 'CONTACT HUANG HONG'); 
        $this->email->to($to_email);
        $this->email->subject('จดหมายติดต่อจากคุณ '.$data->name .'( huanghong.co.th )'); 
        $this->email->message($email_body); 
        //Send mail 
        $this->email->send();
       $this->Product_model->deletecap();
echo 1;
	}
      
}
