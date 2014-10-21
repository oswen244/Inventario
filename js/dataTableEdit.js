

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

 function success(mensaje,num){

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
        switch(num){
          case 1: toastr.success(mensaje);break;
          case 2: toastr.warning(mensaje);break;
          case 3: toastr.error(mensaje);break;
        }
        
}



function columnList(atributos){ //Genera la lista con los nombres de las columnas de la tabla

    var structure = '';
    for (var i = 0 ; i<atributos.length; i++) {
        
        structure = structure+'{"data":'+'"'+atributos[i]+'"'+'},';
    };
    return structure.substring(0,structure.length-1);
}

function valoresDeFila(p){ //Obtiene los valores de los registros de la tabla

     var seleccionados = [];
    $.each(p, function(index, val) {
                var values = new Array();
                $.each(val, function(index, valor) {
                    values.push(valor);
                });
                seleccionados.push(values);    
    });

    return seleccionados;
}

function listaIds(table){ //Obtiene la lista de los ids de los registros que estan en la tabla
    var ids='';

    var p = table.rows($('.selected')).data();
    var seleccionados = valoresDeFila(p);

    $.each(seleccionados, function(index, val) {
        ids += val[0]+',';
    });

    ids = ids.substring(0,ids.length-1);
             

    return ids;
}

function borrar(table,modal,modalCascade,btnDelete,deleteCascade){ 
  var ids = listaIds(table);
  if (ids!=''){
    $(modal).modal();
    $(btnDelete).one('click', function(event) {
      event.preventDefault();
      $.post('delete', {data: ids})
        .done(function(data){
          data = data.split(';');
          if(data[0]=="1"){
            table.row('.selected').remove().draw( false );
            success(data[1],1);
          }else{
            $('.cascada > p').html(data[1]);
            $(modalCascade).modal();
            $(deleteCascade).one('click', function(event) {
                $.post('deleteCascade', {data: ids})
                  .done(function(data){
                     data = data.split(';');
                     if(data[0]=="1"){
                        table.row('.selected').remove().draw( false );
                        success(data[1],1);
                      }else{
                        success(data[1],3); 
                      }
                  });
            });
          }
      });

    });
  }else{success("No se ha seleccionado ninguna fila", 2)}

}

function precioIva(pcsiva,pvsiva,iva){
  var precios = [];
  
  precios[0] = pcsiva+(pcsiva*iva);
  precios[1] = pvsiva+(pvsiva*iva);
  return precios;
}

function customDataTable(nombre, data, atributos) {

 //-----------------------Generando la tabla----------------------------//

        // columnas = '[{"data": "id", "class": "center" },{ "data": "invdate", "class": "center" },{ "data": "client_id", "class": "center" },{ "data": "amount", "class": "center edit" },{ "data": "tax", "class": "center edit" },{ "data": "total", "class": "center edit" },{ "data": "note", "class": "center edit" }]';
        var columnas = '['+columnList(atributos)+']';

        columnas = JSON.parse(columnas);
        var table = $(nombre).DataTable( {

            data: data,
            dataType: "json",
            lengthMenu: [10, 20, 50, 75, 100 ],
            bLengthChange: true,
            columns: columnas
              
        });

//---------------------Metodos que trabajan con la tabla-----------------------//

         $(nombre+' tbody').on( 'click', 'tr', function () {
             $(this).toggleClass('selected');
         } );

          $(nombre+' tbody').on( 'dblclick', 'tr', function () {
            var p = table.row($(this)).data();
             $.each(p, function(index, val) {
                alert(val);
             });
         } );
        
        return table;
    //Quita la caja de texto guardando el valor que tenia en la celda
   //  $(nombre+' tbody').on( 'blur', 'td', function () {

   //      $(this).html($(this).find('input').val());
   //      valAfter = $(this).html();
   //      $(this).css('padding','8px');
   //      var miArray = [];

   //      var datos = $(this).parent().find('td').each(function() {
   //          miArray.push($(this).html());
   //      });

   //      $.post('update', {data: miArray}, function(data) {
   //          success(data);
   //      });
   //  });

   //  table.on( 'draw', function () {
              
   //      actualizarEdit(nombre);
   //  });

   // actualizarEdit(nombre);


}