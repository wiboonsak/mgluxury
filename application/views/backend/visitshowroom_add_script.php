<script>	 
	
	function comfirmDelete(DataID,fileType,FileName,type){
		var currentID = $('#currentID').val();
       	swal({
                title: 'Delete ?',
                text: "Please confirm the delete of the data. !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ml-2 mt-2',
                buttonsStyling: false
            }).then(function (){
		   		$.post('<?php echo base_url('Control/deletevisitFile')?>', { DataID : DataID , fileType : fileType , FileName : FileName,type:type }, function(data){  
					console.log(data);
					   if(data=='1'){
						     swal({
								title: 'Deleted !',
								text: "Data has been deleted successfully.",
								type: 'success',
								confirmButtonClass: 'btn btn-confirm mt-2'   
							}) 
						   //------------------------ catalgoue RowImg19
						   if(fileType=='imgfile'){
							     $('#RowImg'+DataID).remove(); 
							     console.log('#RowImg'+DataID)
						   }
						   if(fileType=='catalgoue'){
							     $('#RowFile'+DataID).remove();  
							   console.log('#RowFile'+DataID)
						   }						  
						   
						   //------ images RowImg   file RowFile
					   }else{
						   swal({
							title: 'Error',
							text: "Cannot delete data",
							type: 'error',
							confirmButtonClass: 'btn btn-confirm mt-2'
                    		})
					   }
				});
               
            }, function (dismiss){
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if(dismiss === 'cancel'){
                    swal({
                        title: 'Cancelled',
                        text: "You have canceled the data deletion.",
                        type: 'error',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    })
                }
            })
	} 
	//---------------------------
	
	function loadImages(ProID){
		$.post('<?php echo base_url('Control/loadvisitImg')?>' , { ProID : ProID }, function(data){
			$('#showImage').empty();
			$('#showImage').html(data);			
		})		
	}
	//---------------------------
	
	function loadImages360(ProID){
		$.post('<?php echo base_url('Control/loadvisitImg360')?>' , { ProID : ProID }, function(data){
			$('#showImage360').empty();
			$('#showImage360').html(data);			
		})		
	}
   
	//---------------------- 
	
	function Addvisit(){
		
		var product_nameth = $('#name_th').val();
		
		
        /*var product_desc = tinyMCE.editors[$('#product_desc').attr('id')].getContent();
		$('#comment').val(product_desc);
        var comment = $('#comment').val();
		var product_price = $('#product_price').val();                
		var product_category = $('#product_category option:selected').val();*/
                
		if(product_nameth == ''){
			 swal({
				title: 'Please Enter Showroom Name. !',
				confirmButtonClass: 'btn btn-confirm mt-2',
				type: 'warning'
			 })
			
     

		}else{	
			var postData = new FormData($("#productForm")[0]);	
			$.ajax({
				 type:'POST',
				 url:'<?php echo base_url('Control/Addvisit')?>',
				 processData: false,
				 contentType: false,
				 data : postData,
				 xhr: function(){
					//upload Progress
					var xhr = $.ajaxSettings.xhr();
					if(xhr.upload){
						$(".progress").show();
						xhr.upload.addEventListener('progress', function(event){
							var percent = 0;
							var position = event.loaded || event.position;
							var total = event.total;
							if (event.lengthComputable) {
								percent = Math.ceil(position / total * 100);
							}
							//update progressbar
							$(".progress-bar").css("width", + percent +"%");
							$('#progress_bar_id' + " .status").text(percent +"%");
						}, true);
					}
					return xhr;
				},
				 success:function(data, status){
					console.log(data);
					$('#currentID').val(data);
				  // console.log("File Uploaded");
					
					if(status=='success'){
						 loadImages(data);
						 loadImages360(data);
						 

						swal({
							title: 'Data saved successfully',
							//text: "Your file has been deleted",
							type: 'success',
							confirmButtonClass: 'btn btn-confirm mt-2'
						});
						setTimeout(function(){ window.location.href = "<?php echo base_url('Control/visitshowroom_add/')?>"+data; }, 2000);
						
					}else{
						
						 swal({
							title: 'Can not be saved!',
							//text: "You won't be able to revert this!",
							type: 'warning',
							confirmButtonClass: 'btn btn-confirm mt-2'
						});
					}
				 }
			});			
		}
	}
   
   
  
    //------------------------- get_subCategory
	
	$(document).ready(function(){ 
        $('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
	/////////////////////////////////	
       var currentID = $('#currentID').val();		
	   var product_category = $('#product_category option:selected').val();	
	   loadImages(currentID);
	   loadImages360(currentID);
      // loadFile(currentID);
       //loadFAQ(currentID);
         tinymce.init({
		   selector: "textarea.ex",
		   theme: "modern",
		   height:300,
		   plugins: [
			 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			 "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
		   style_formats: [
			 {title: 'Bold text', inline: 'b'},
			 {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			 {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			 {title: 'Example 1', inline: 'span', classes: 'example1'},
			 {title: 'Example 2', inline: 'span', classes: 'example2'},
			 {title: 'Table styles'},
			 {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
		   ]
		});
    })          
		
//		if(accessories_category!=0){
//			getSubCateSlect(accessories_category);
//			
//		}
	

	
</script>
