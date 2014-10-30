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
			origNames = [];
            $form.find('[name]').each(function(index, el) {
				origNames.push($(this).attr('name')); //Cambia el valor de los names a los pasados por parámetro
				$(this).attr('name',index); //Cambia el valor de los names para evitar conflicto con el parsestr
            });
			var atributos = $(":not(.ignorar)",$form).serialize();
			// alert(atributos);
            $.post($form.attr('action'), {data: atributos}, function(result) {
            	// alert(result);
            	result = JSON.parse(result);
            	// if(result['accion']=='1'){
            	// 	window.location.href = '';
            	// }
                successi(result['mensaje'],parseInt(result['cod']),result['reload']);
            	// 	window.location.href = '';
            	$form.find('[name]').each(function(index, el) {
					$(this).attr('name',origNames[index]); //Regresa los names a como estaban
                	$(this).val('');
				});
                $form[0].reset();
                $(".selectpicker",$form).selectpicker('refresh');
                $form.data('bootstrapValidator').resetForm();
            });
			
        });
}

function successi(mensaje,num,reload){
	if(reload==='1'){
		toastr.options = {
			"closeButton": false,
			"debug": false,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "2000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "slideDown",
			"hideMethod": "slideUp",
			"onHidden": function() { window.location.href = ''}
		}
	}else{
		toastr.options = {
		"closeButton": false,
		"debug": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "slideDown",
		"hideMethod": "slideUp"
		}
	}
	switch(num){
		case 1: toastr.success(mensaje);break;
		case 2: toastr.warning(mensaje);break;
		case 3: toastr.error(mensaje);break;
	}
}