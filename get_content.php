<?php 
	$content = file_get_contents('http://www.me-fi.com/Important_day_config.php');
	$contentCheck = $content;
	//echo strlen(trim($contentCheck));
	if($contentCheck !='0'){
		 $contentHtml = file_get_contents('http://www.me-fi.com/'.$content);
		 echo $contentHtml;
		// echo "xx1xx";
	}else if($contentCheck =='0') {
		
		echo "goindex";
	}
   
?>