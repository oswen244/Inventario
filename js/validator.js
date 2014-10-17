function validar(formName){
	$(formName)
		.find('.selectpicker')
        .selectpicker()
        .change(function(e) {
            $(formName).bootstrapValidator('revalidateField', 'texto');
        })
        .end()
        .bootstrapValidator({
		container: 'tooltip',
		// container: 'popover',
		excluded: ':disabled',
		live: 'enabled',
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
	        email: {
	            validators: {
	            	notEmpty: {
	                    message: 'El email es requerido'
	                },
	                emailAddress: {
	                    message: 'La dirección de correo electrónico ingresada no es válida'
	                }
	            }
	        },
	        password: {
	            validators: {
	            	notEmpty: {
	                    message: 'La contraseña es requerida'
	                },
	                // stringLength: {
	                // 	min: 4,
	                //     max: 12,
	                //     message: 'El campo debe tener entre 4 y 12 caracteres'
	                // },
	                // different: {
	                //     field: 'name',
	                //     message: 'La contraseña no puede ser igual al nombre de usuario'
	                // }
	            }
	        },
	        confirmPassword: {
	            validators: {
	                identical: {
	                    field: 'password',
	                    message: 'Los campos de contraseña no coinciden'
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
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
			// alert(atributos);
            $form.find('[name]').each(function(index, el) {
				$(this).attr('name',index); //Cambia el valor de los names a los pasados por parámetro
            });
			var atributos = $(":not(.ignorar)",$form).serialize();
            $.post($form.attr('action'), {data: atributos}, function(result) {
                success(result);
                $form[0].reset();
                $(".selectpicker",$form).selectpicker('refresh');
                $form.data('bootstrapValidator').resetForm();
            });
			
        });
}