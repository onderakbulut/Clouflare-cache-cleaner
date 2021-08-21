$(document).ready(function(){
	
	/* Adding new inputs */
	var i=1;  
	$('#add').click(function(){  
	   i++;  
	   $('#dynamic_field').append('<div id="row'+i+'" class="input-group mb-3 dynamic-added">'+
			'<input type="text" class="form-control" name="dizi[]">'+
			'<div class="input-group-append">'+
				'<button class="btn btn-outline-primary" name="remove" id="'+i+'"><i class="fas fa-minus"></i></button>'+
			'</div>'+
		'</div>');  
	}); 
	$("html").delegate("[name=remove]", "click", function(){
		var button_id = $(this).attr("id");   
		$('#row'+button_id+'').remove();  
	});
	
	
	/* Clear Caches */
	$("#clear").click(function(){
		
		$.ajax({  
			method  : "post",
			url		: "ajax.php",
			data	: $('#myForm').serialize()+"&url_purge=true",  
			success : function(response){ 
				var data = JSON.parse(response);
				console.log(data);
				if(data.success == true){
					$.toast({
						heading: 'Success!',
						text: 'Cache Cleaned.',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					})
				}else {
					$.toast({
						heading: 'Error!',
						text: JSON.stringify(data.errors),
						showHideTransition: 'slide',
						icon: 'error ',
						position: 'top-right',
						hideAfter: false
					})
				} 
			}  
		});  
		
	});
	
});