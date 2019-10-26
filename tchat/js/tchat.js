
// 
$(function(){
	$("#tchatForm form").submit(function(){
		showLoader("#tchatForm")
		return false;
	})

});

// function de chargement...

function showLoader(div){
	$(div).append('<div class="loader"></div>');
	$(".loader").fadeTo(500,0.6);
}