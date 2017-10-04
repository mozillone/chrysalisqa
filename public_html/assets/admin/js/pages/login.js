$("#login").validate();
$("#email").rules("add", {required:true,email: true});
$("#password").rules("add", {required:true});
$('.close').click(function(){
	$('.alert').remove();
})






