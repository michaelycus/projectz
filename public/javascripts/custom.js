 $('form.delete').submit(function(event){
 	if(!confirm("Deseja mesmo excluir esse item?")){
    	event.preventDefault();
	}
});


//  $('.delete').submit(function(event){
//  	event.preventDefault();
// 	 bootbox.confirm({
// 		message: "Are you sure?",
// 		callback: function(result) {
// 			if (result)
// 			{
// 				$('form#delete').submit();
// 			}
// 			else
// 			{
// 				event.preventDefault();
// 			}

// 		//	event.preventDefault();
// //			event.submit();
// 		},
// 		className: "bootbox-sm"
// 	});
// });