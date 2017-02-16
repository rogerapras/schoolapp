$(document).ready(function(){
		$('#install_form').validate({
	    rules: {
	    	hostname: {
	        required: true
	      },
	      db_user: {
	    	  required: true 
	      },
	      db_name: {
	    	  required: true
	      }
	    },
			highlight: function(element) {
				$(element).removeClass('success').addClass('error');
			},
			success: function(element) {
				element.removeClass('error').addClass('success');
			}
	  });

}); // end document.ready