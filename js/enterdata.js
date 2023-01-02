$(document).ready(function(){
	var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
	
	//Add single stock detail
	$("#addSingleStock").on("submit",function(){
		$.ajax({
			url : "../php/addSingleStock.php",
			method : "POST",
			data : $("#addSingleStock").serialize(),
			success : function(data){
				if(data['flag'] == true){
					Toast.fire({
						icon: 'success',
						title: data['response']
					})
					$('#addSingleStock').trigger("reset");
				} else {
					Toast.fire({
						icon: 'error',
						title: data['response']
					})
				}					
			},
			dataType:"json"
		})
	});
	
	//Update single stock detail
	$("#updateSingleStock").on("submit",function(){
		$.ajax({
			url : "../php/updateSingleStock.php",
			method : "POST",
			data : $("#updateSingleStock").serialize(),
			success : function(data){
				if(data['flag'] == true){
					Toast.fire({
						icon: 'success',
						title: 'The stock has been updated successfully.'
					})
				} else {
					Toast.fire({
						icon: 'error',
						title: 'There was issue while updating stock. Please contact administrator for the same.'
					})
				}					
			},
			dataType:"json"
		})
	});
})











