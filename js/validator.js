function validar(formName){
	$(formName)
		.find('[name="estado"]')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'estado');
        })
        .end()
        .find('[name="proveedor"]')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'proveedor');
        })
        .end()
        .find('[name="tipoDispositivo"]')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'tipoDispositivo');
        })
        .end()
        .bootstrapValidator({
		container: 'tooltip',
		excluded: ':disabled',
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
                        format: 'DD/MM/YYYY',
                        message: 'The value is not a valid date'
                    }
				}
			},
			imei: {
                validators: {
                    notEmpty: {
	                    message: 'The imei is required'
	                }
                }
            },
            estado: {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un estado'
                    }
                }
            },
            proveedor: {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un proveedor'
                    }
                }
            },
            tipoDispositivo: {
                validators: {
                    notEmpty: {
                        message: 'Debes seleccionar un tipo de dispositivo'
                    }
                }
            },
	        // estado: {
	        // 	validators: {
	        // 		regexp: {
			      //       regexp:/^([1-9]{1})$/,
			      //       message: 'Selecciona una opción'
			      //       }
	        // 	}
	        // },
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
	}).on('error.field.bv', function(e, data) {
            // Get the tooltip
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
                title   = $icon.data('bs.tooltip').getTitle();

            // Destroy the old tooltip and create a new one positioned to the right
            $icon.tooltip('destroy').tooltip({
                html: true,
                placement: 'right',
                title: title,
                container: 'body'
            });
        });
}