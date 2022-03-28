var Restaurant = function () {
    var initRestaurantValidation = function () {
        alert("hiii");
        $("#RestaurantForm").validate({
            rules: {
                name: {
                    required: true,
                   
                },
                phone_number : {
                    required: true,
                    digits:true
                    
                },
                email :{
                    required: true,
                    email: true
                },
                restaurant_code :{
                    required: true,
                   
                },
                restaurant_desc :{
                    required: true,
                },
                
            },
            messages: {
                name: {
                    required: "Name is required.",
                },
                phone_number : {
                    required: "Phone number is required.",
                    digits: "Only digits allowed"
                    
                },
                email :{
                    required: "Email Address is Required.",
                    email: "Please enter a valid email address."
                },
                restaurant_code : {
                    required: "Restaurant code is required.",
                    
                },
                restaurant_desc : {
                    required: "Restaurant desc is required.",
                    
                },
                
            }
        });

        // $("#addRestaurantBtn").click(function () {
		// 	if ($("#RestaurantForm").valid()) {
		// 		$("#addRestaurantBtn").attr('disabled', 'disabled');
		// 		$.post($('#RestaurantForm').attr('action'), $('#RestaurantForm').serialize())
		// 			.success(function (data) {
		// 				LaravelCMSApp.displayResultAndReload(data);
		// 			})
		// 			.fail(function (data) {
		// 				LaravelCMSApp.displayFailedValidation(data);
		// 			})
		// 			.always(function () {
		// 				$("#addRestaurantBtn").removeAttr('disabled');
		// 			});
		// 	}
		// });

    };
    return {
        init: function () {
            initRestaurantValidation();
        }
    };
}();
jQuery(document).ready(function () {
    alert("hiii");
    Restaurant.init();
});