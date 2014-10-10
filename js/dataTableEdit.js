

function actualizarEdit(table){

//agrega etiqueta input para la edición de la celda

	$(table +' .edit').on( 'dblclick', function () {
		if(!$(this).find('input').length){

			var w = $(this).width()+parseInt($(this).css('padding'))*2;
			var h = $(this).height()+parseInt($(this).css('padding'))*2;

			$(this).css('padding','0px');
			$(this).html("<input style='width:"+w+"px ; height:"+h+"px' type='text' value='"+$(this).html()+"' >");


			$(this).find('input').focus();
		}
	});

}

 function success(mensaje){

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "positionClass": "toast-top-left",
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
        toastr.success(mensaje)
}

function columnList(atributos){

    var structure = '';
    for (var i = 0 ; i<atributos.length; i++) {
        
        structure = structure+'{"data":'+'"'+atributos[i]+'"'+'},';
    };
    return structure.substring(0,structure.length-1);
}

function customDataTable(nombre, data, atributos) {
        
        var columnas = columnList(atributos);
        // columnas = '[{"data": "id", "class": "center" },{ "data": "invdate", "class": "center" },{ "data": "client_id", "class": "center" },{ "data": "amount", "class": "center edit" },{ "data": "tax", "class": "center edit" },{ "data": "total", "class": "center edit" },{ "data": "note", "class": "center edit" }]';
        columnas = '['+columnList(atributos)+']';

        columnas = JSON.parse(columnas);
        var table = $(nombre).DataTable( {

            data: data,
            dataType: "json",
            lengthMenu: [10, 20, 50, 75, 100 ],
            bLengthChange: true,
            columns: columnas
              
        });

         $(nombre+' tbody').on( 'click', 'tr', function () {
             $(this).toggleClass('selected');
         } );

          $(nombre+' tbody').on( 'dblclick', 'tr', function () {
            var p = table.row($(this)).data();
             $.each(p, function(index, val) {
                alert(val);
             });
         } );

        $('#delete').click( function () {
            success("ok");
            table.row('.selected').remove().draw( false );
        } );


    //Quita la caja de texto guardando el valor que tenia en la celda
    $(nombre+' tbody').on( 'blur', 'td', function () {

        $(this).html($(this).find('input').val());
        valAfter = $(this).html();
        $(this).css('padding','8px');
        var miArray = [];

        var datos = $(this).parent().find('td').each(function() {
            miArray.push($(this).html());
        });

        $.post('update', {data: miArray}, function(data) {
            success(data);
        });
    });

    table.on( 'draw', function () {
              
        actualizarEdit(nombre);
    });

   actualizarEdit(nombre);


    /*Descomentar para colocar funcionalidad a un boton */
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    });

}