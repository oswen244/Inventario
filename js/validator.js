function validar(formName){
	$(formName).bootstrapValidator({
		language: 'es',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
	    },
	    fields: {
	    	dateAdq: {
	            validators: {
	            	notEmpty: {
	                    message: 'The date is required'
	                },
	                date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
	            }
	        },
	        imei: {
                validators: {
                    notEmpty: {
	                    message: 'The imei is required'
	                },
                    imei: {
                        message: 'The value is not valid IMEI'
                    }
                }
            },
	        // lastname: {
	        //     validators: {
	        //         notEmpty: {
	        //             message: 'The LastName is required'
	        //         },
	        //         stringLength: {
	        //             min: 6,
	        //             max: 15,
	        //             message: 'The Name must be more than 6 and less than 15 characters'
	        //         }
	        //     }
	        // },
	        email: {
	            validators: {
	            	notEmpty: {
	                    message: 'The email is required'
	                },
	                emailAddress: {
	                    message: 'The value is not a valid email address'
	                }
	            }
	        },
	        password: {
	            validators: {
	            	notEmpty: {
	                    message: 'The password is required'
	                },
	                stringLength: {
	                	min: 4,
	                    max: 12,
	                    message: 'The password must be more than 4 and less than 12 characters'
	                },
	                different: {
	                    field: 'name',
	                    message: 'The password cannot be the same as username'
	                }
	            }
	        },
	        confirmpassword: {
	            validators: {
	                identical: {
	                    field: 'password',
	                    message: 'The password and its confirm are not the same'
	                }
	            }
	        }
	    }
	});
}