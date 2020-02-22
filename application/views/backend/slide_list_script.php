<script>
    
    function updateOrder(dataID,changeValue){
		
		if((changeValue=='')){
			swal({
				title: 'Warning !',
				text: "Please enter the numbers in order.",
				type: 'warning',
				confirmButtonClass: 'btn btn-confirm mt-2'
			}) 
			return false;
			
		}else{
			
			$.post('<?php echo base_url('Control/updateOrderslide')?>', { dataID : dataID , changeValue : changeValue } ,function(data){
				
				if(data == 1){
					swal({
                        title: 'Data saved successfully',
                        //text: "Your file has been deleted",
                        type: 'success',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });	
                    setTimeout(function(){ window.location.href = "<?php echo base_url('Control/slide_list')?>"; }, 2000);
				
				}else{
					swal({
                        title: 'Can not be saved!',
                        //text: "You won't be able to revert this!",
                        type: 'warning',
                        confirmButtonClass: 'btn btn-confirm mt-2'
                    });
				}
			})
		}
	}
    
    
    
	function comfirmDelete(DataID , NewsTitle) {
       swal({
                title: 'Delete'+NewsTitle+'?',
                text: "Please confirm the delete of the data. !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-success mt-2',
                cancelButtonClass: 'btn btn-danger ml-2 mt-2',
                buttonsStyling: false
            }).then(function () {
		   		$.post('<?php echo base_url('control/deleteSlide')?>', { DataID : DataID }, function(data){ 
					console.log(data); 
					   if(data=='1'){
						     swal({
								title: 'Deleted !',
								text: "Data has been deleted successfully.",
								type: 'success',
								confirmButtonClass: 'btn btn-confirm mt-2'
							}) 
						    $('#row'+DataID).remove();
					   }else{
						   swal({
							title: 'Error',
							text: "Cannot delete data.",
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
  //------------------------------
  //----------------------
	function setShow_onWeb(dataID , val2 , table){  
		var changeCheckbox = document.querySelector('.js-check-change');		
  		var x = changeCheckbox.checked; 		
		if(val2 == '0'){
		   var check = '1';
		}
		if(val2 == '1'){
		   var check = '0';
		}
		$.post('<?php echo base_url('control/set_ShowOnWeb')?>' , { dataID : dataID , check : check , table : table }  , function(data){
			if(data==1){
				$('#ch'+dataID).val(check);
				swal({
					title: 'Successfully edited data.',
					//text: 'You clicked the button!',
					type: 'success',
					confirmButtonClass: 'btn btn-confirm mt-2'
				}) ; 
			}else{
				swal({
					title: 'Cannot edit data!',
					//text: "You won't be able to revert this!",
					type: 'warning',
					confirmButtonClass: 'btn btn-confirm mt-2'
				}) ;
			}
		});
	}
//------------------------------
$('#datatable').DataTable();

</script>