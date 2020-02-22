<script>
	
	
	//-----------------------------------
	function Addshowroom(){  // news_title  news_detail
		var company = $('#company').val();
		var address = $('#address').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		var facebook = $('#facebook').val();
		var map = $('#map').val();
                
		if(company==''){
			swal({
					title: 'warning !',
					text: "Please Enter Company.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
			
		}else if(address==''){
				swal({
					title: 'warning !',
					text: "Please Enter Address.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
		}else if(phone==''){
				swal({
					title: 'warning !',
					text: "Please Enter Telephone.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
		}else if(email==''){
				swal({
					title: 'warning !',
					text: "Please Enter E-mail.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
		}else if(facebook==''){
				swal({
					title: 'warning !',
					text: "Please Enter Facebook.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
		}else if(map==''){
				swal({
					title: 'warning !',
					text: "Please Enter Map.",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
                       
		}else{
					var postData = new FormData($("#productForm")[0]);	
		$.ajax({
		 type:'POST',
		 url:'<?php echo base_url('Control/Addshowroom')?>',
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
			if(status=='success'){
				swal({
                        title: 'Data saved successfully',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
                     setTimeout(function(){ window.location.href = "<?php echo base_url('Control/showroom_add/')?>"+data; }, 2000);
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
        //---------------------------
	
	function loadmap(ProID){
		$.post('<?php echo base_url('Control/loadmap')?>' , { ProID : ProID }, function(data){
			$('#showloadmap').empty();
			$('#showloadmap').html(data);			
		})		
	}
     
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
			loadmap(currentID);
		//}	
	})
</script>


