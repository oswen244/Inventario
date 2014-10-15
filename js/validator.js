function validar(formName){
	$(formName)
		.find('#estado')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'texto');
        })
        .end()
        .find('#proveedor')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'texto');
        })
        .end()
        .find('#tipoDispositivo')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'texto');
        })
        .end()
        .bootstrapValidator({
		container: 'tooltip',
		// container: 'popover',
		excluded: ':disabled',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			fecha: {
				validators: {
					notEmpty: {
						message: 'La fecha es requerida'
					},
					date: {
                        format: 'DD/MM/YYYY',
                        message: 'El valor introducido no es una fecha válida'
                    }
				}
			},
			texto: {
                validators: {
                    notEmpty: {
	                    message: 'El campo es requerido'
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
	})
	.on('error.field.bv', function(e, data) {
            // Get the tooltip
        var $parent = data.element.parents('.form-group'),
            $icon = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
            title = $icon.data('bs.tooltip').getTitle();

        // Destroy the old tooltip and create a new one positioned to the right
        $icon.tooltip('destroy').tooltip({
            html: true,
            placement: 'right',
            title: title,
            container: 'body'
        });
    })
	// .on('error.field.bv', function(e, data) {
	//             // Get the popover
	//             var $parent = data.element.parents('.form-group'),
	//                 $icon = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
	//                 content = $icon.data('bs.popover').getContent();

	//             // Destroy the old tooltip and create a new one positioned to the right
	//             $icon.popover('destroy').popover({
	//                 html: true,
	//                 placement: 'right',
	//                 content: content,
	//                 trigger: 'hover click',
	//                 container: 'body'
	//             });
	//         })
	.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
            // var inputs = $form.find('[name]');
            // var ignorados = ":not([name='q1w2e3']";
            // $.each(ignorar, function(index, val) {
            // 	ignorados+=",[name='"+val+"']";
            // });
            // ignorados+=")";
			var atributos = $(":not(.ignorar)",$form).serialize();
			alert(atributos);
			// $.each(inputs, function(index, val) {
			// 	$form.find('[name="'+val.name+'"]').attr('name',dbNames[index]); //Cambia el valor de los names a los pasados por parámetro
			// });
            $.post($form.attr('action'), {data: atributos}, function(result) {
                alert(result);
                $form.data('bootstrapValidator').resetForm();
            });
			
        });
}