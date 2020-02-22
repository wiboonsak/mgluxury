<script>
    function comfirmDelete(DataID,fileType,FileName){
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
		   		$.post('<?php echo base_url('Control/deletePromotionFile1')?>', { DataID : DataID , fileType : fileType , FileName : FileName }, function(data){  
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
	
	
	//-----------------------------------
	function AddNews(){  // news_title  news_detail
		var news_title = $('#reference_title').val();
		var news_detail = $('#reference_detail').val();
               // var ImagesFiles = $('#ImagesFiles').val();
		//var img_old = $('#img_old').val();
		if(news_title==''){
			swal({
					title: 'warning !',
					text: "Please enter Promotion topic.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
			
		}else if(news_detail==''){
				swal({
					title: 'warning !',
					text: "Please enter Promotion details.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			})
                   
		}else{
					var postData = new FormData($("#productForm")[0]);	
		$.ajax({
		 type:'POST',
		 url:'<?php echo base_url('Control/addreference')?>',
		 processData: false,
		 contentType: false,
		 data : postData,
		 xhr: function(){
			//upload Progress
			var xhr = $.ajaxSettings.xhr();
			if (xhr.upload) {
				$(".progress").show();
				xhr.upload.addEventListener('progress', function(event) {
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
			console.log('data->'+data+'  status->'+status);
			$('#oldImg').val(data);
			$(".progress-bar").css("width", + 0 +"%");
			$(".progress").hide();
			$('#ImagesFiles').val('');
			$('#cFiles').val('');
			 $('#txtTitle').val('');
			if(status=='success'){
				 loadImages(data);
				 //loadFile(data);
				swal({
                        title: 'Data saved successfully',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                     setTimeout(function(){ window.location.href = "<?php echo base_url('Control/promotion_add/')?>"+data; }, 2000);
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
			//----------------------------
		}
	}
	//---------------------------------
	//--------------------------- 
	function  loadImages(ProID){
		$.post('<?php echo base_url('Control/loadreferenceImages')?>' , { ProID : ProID }, function(data){
			$('#showImage').empty();
			$('#showImage').html(data);
			
		})
		
	}
            //----------------------------
	
    function loadFile(ProID){
		$.post('<?php echo base_url('Control/loadPromotionFile')?>' , { ProID : ProID }, function(data){
			$('#showCat').empty();
			$('#showCat').html(data);			
		})		
	}
                    //----------------------
	function deleteyoutube(dataID,table){  
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
            }).then(function () {
		   		$.post('<?php echo base_url('Control/deleteyoutube')?>', { dataID : dataID , table : table }, function(data){  
					console.log(data);
					   if(data=='1'){
						     swal({
								title: 'Deleted !',
								text: "Data has been deleted successfully.",
								type: 'success',
								confirmButtonClass: 'btn btn-confirm mt-2'   
							}) 
						  setTimeout(function () {
                        window.location.href = "<?php echo base_url('Control/promotion_add/') ?>"+currentID ;
                    }, 2000);
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
               
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Cancelled',
                        text: "You have canceled the data deletion.",
                        type: 'error',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    })
                }
            })

	} 
                                   //===============================
        function ADDyoutube(){
             
        var num = $('.youtube3').length;
        num = num + 1;
        $('#linkyoutube_a').append("<br><input name='youtube[]' type='text' id='inputyoutube"+num+"' class='form-control form-control-sm youtube3' value=''>");
        
       
    
        }
          //---------------------------------------------------
        function sendmail(currentID){
             
       $.post('<?php echo base_url('Control/sendmailreference')?>', { currentID : currentID }, function(data){
           if(data=='1'){
               alert('Send Mail Successfully');
           }else{
                alert('Can not Send Mail');
           }
              });
       
    
        }
        //----------------------
	
	function AddFile(){
		
		var cFiles = $('#file22').val();
		//var cFiles = $('#cFiles').val();
		var group2 = $('#group2').val();
		var txtTitle = $('#txtTitle_th').val();
		
		if(cFiles != ''){
			
			if(txtTitle == ''){
				
				swal({
					title: 'Please enter file name. !',
					confirmButtonClass: 'btn btn-confirm mt-2',
					type: 'warning'
				})
				
			} else {
				
				$('#file22').attr('onclick', 'upload_file(this.files[0])');
				$('#file22').click();
								 
				$('#divload').modal({backdrop: 'static', keyboard: false});
				$('#divload').modal('show');
			}		   
		} else {
                    
			return false;
		}		
	}
        	//----------------------
	
	var p=document.getElementById('progress_bar');
	var s=document.getElementById('status');
	var b=document.getElementById('file22');
		//var a=document.getElementById('abort');

function upload_file(file){
	
	 var allowedExtensions = /(\.pdf|\.PDF)$/i;
	 var filePath = document.getElementById('file22').value;
	 var imgVideo = document.getElementById("file22");     

	if(!allowedExtensions.exec(filePath)){
        alert('กรุณาอัพโหลดไฟล์ประเภท PDF');
        
       
        $('#divload').modal('hide');
        $('#file22').val('');
        return false;
	/*}else if(imgVideo.files[0].size > 52428800){
        alert('ขนาดไฟล์เกิน 50 เมกกะไบต์ \r \n กรุณาเลือกไฟล์ขนาดเล็กกว่า 50 เมกกะไบต์');
       
        return false;*/		
    }else{
	
	chunk_uploader.on_ready=function(response){
		//s.innerHTML='100%';

		//document.getElementById('client_file_size').innerHTML=response.total+' bytes';
		//document.getElementById('server_sent_bytes').innerHTML=response.sent+' bytes';
		//document.getElementById('elapsed_time').innerHTML=response.elapsed+' sec';
		//document.getElementById('remote_file_name').innerHTML=response.file.name;
		//document.getElementById('remote_file_path').innerHTML=response.file.tmp_name;
		//document.getElementById('remote_file_size').innerHTML=response.file.size+' bytes';
		//document.getElementById('remote_file_chunks').innerHTML=response.file.chunks+' chunks of max. '+chunk_uploader.options.max_chunk_size+' bytes';
		//document.getElementById('remote_file_crc').innerHTML=response.file.crc.toString(16)+' ('+response.file.crc+')';

		//document.getElementById('transfer_result').style.display='inherit'; a.
        console.log('>'+response.file.name)
		document.getElementById('video_file_name').value=response.file.name;		
		
	};

	chunk_uploader.on_done=function(){
		b.disabled=false;
		//a.disabled=!b.disabled;
		p.style.backgroundColor='#13B048';
		setTimeout(function (){  
			$('#divload').modal('hide');
			AddNews();
        }, 2000);		
	};
	
	chunk_uploader.on_error=function(object,err_type){
		s.innerHTML=err_type+' error : '+object.message+' ('+object.code+')';
		b.disabled=false;
		//a.disabled=!b.disabled;
		p.style.backgroundColor='#FF6347';
	};

	chunk_uploader.on_abort=function(object){
		s.innerHTML=object.message;
		b.disabled=false;
		//a.disabled=!b.disabled;
		p.style.backgroundColor='#F78C18';
		document.getElementById('video_file_name').value='';
		console.log('on_abort');
	};

	chunk_uploader.on_upload_progress=function(progress){
		p.style.width=progress.percentage+'%';
		s.innerHTML=p.style.width+' (ETA : '+progress.eta.toHMS()+')';
	};

	chunk_uploader.options.max_chunk_size=parseInt(document.getElementById('max_chunk_size').value);
	//chunk_uploader.options.raw_post=document.getElementById('raw_post').checked;
	chunk_uploader.options.raw_post=false;
	chunk_uploader.options.max_parallel_chunks=parseInt(document.getElementById('max_parallel_chunks').value);
	chunk_uploader.options.send_interval=parseInt(document.getElementById('send_interval').value);

	b.disabled=true;
	//a.disabled=!b.disabled;
	
	chunk_uploader.upload_chunked('<?php echo base_url()?>upload.php',file);  
  }
}
window.onload=function(){window.chunk_uploader=new MyChunkUploader();};
	//--------------------------
	$(document).ready(function(){
               $('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
		var currentID = $('#currentID').val();
		//if(currentID!=''){ 
			loadImages(currentID);
			loadFile(currentID);
		//}	
	})
</script>


