

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

function valoresDeFila(table){ //Obtiene los valores de los registros de la tabla

var p = table.rows($('.selected')).data();
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

  var seleccionados = valoresDeFila(table);

  $.each(seleccionados, function(index, val) {
    ids += val[0]+',';
  });

  ids = ids.substring(0,ids.length-1);
  alert(ids);
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

function customDataTable(nombre, data, atributos, nombres) {

$(nombre+' thead .busqueda th').each( function () {
          // var title = $(nombre+' tfoot th').eq( $(this).index() ).text();
          $(this).html( '<input type="text" width=100% class="form-control" placeholder="Buscar" />' );
});
 //-----------------------Generando la tabla----------------------------//

        // columnas = '[{"data": "id", "class": "center" },{ "data": "invdate", "class": "center" },{ "data": "client_id", "class": "center" },{ "data": "amount", "class": "center edit" },{ "data": "tax", "class": "center edit" },{ "data": "total", "class": "center edit" },{ "data": "note", "class": "center edit" }]';
        var columnas = '['+columnList(atributos)+']';

        columnas = JSON.parse(columnas);
        var table = $(nombre).DataTable( {

          data: data,
          deferRender: true,
          dataType: "json",
          lengthMenu: [10, 20, 50, 75, 100 ],
          bLengthChange: true,
          columns: columnas

        });

//---------------------Metodos que trabajan con la tabla-----------------------//
$(nombre+' thead .busqueda th').each( function ( colIdx ) {
          $(this).find( 'input').on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
           } );
} );

$(nombre+' tbody').on( 'click', 'tr', function () {
 $(this).toggleClass('selected');
} );

$(nombre+' tbody').on( 'dblclick', 'tr', function () { //Evento doble click sobre una fila de la tabla
  if ( document.getElementById("modalInfo")){
    tr = $(this);
    $('tr').removeClass('selected'); // Se quitan las columnas seleccionadas
    $(this).addClass('selected'); // Sombrea la fila que se le hizo doble click por medio de la calse selected
    var p = table.row($(this)).data(); //obtiene los datos de la fila a partir del datasource del dataTable
    valores = new Array(); //variable global
    $.each(p, function(index, val) {
      valores.push(val); //se guardan únicamente los valores de la fila en un array
    });
    // console.log(valores);
    idDisp = valores[0]; //En la primera posisición del Array está el id
    $('#modalInfoLabel').html('Información del dispositivo: '+idDisp); //Título del modal de Info
    $('#filas').empty(); //Se borra la info actual del modal de Info
    $(nombres).each(function(index, val) { //Se coloca la información en el modal
      if(valores[index+1]!=null){ //Donde el valor sea nulo se pone un guión (-)
        $('#filas').append('<tr><td width="50%" class="text-right">'+nombres[index]+'</td><td>&nbsp'+valores[index+1]+'</td></tr>');
      }else{
        $('#filas').append('<tr><td width="50%" class="text-right">'+nombres[index]+'</td><td>-</td></tr>');
      }
    });
    if ( document.getElementById("btnAsignar")){ //Verifica si la vista es de dispositivos para el manejo del botón Asignar simcard
      if(valores[valores.length-3]=='no'){ //Hablita o no el botón de asignar sim dependiendo si el dispositivo usa
        $('#btnAsignar').addClass('disabled');
        $('#msjSim').html('Este artículo no utiliza simcards');
      }else{
        if(valores[valores.length-2]==valores[valores.length-1]){ //Pregunta si el dispositivo ya tiene su capacidad de sims ocupadas
          $('#btnAsignar').addClass('disabled');
          $('#msjSim').html('No hay ranura disponible para sim en este dispositivo');
        }else{ // Muestra el botón y dice cuántas ranuras tiene disponible el dispositivo
          $('#btnAsignar').removeClass('disabled');
          $('#msjSim').html(valores[valores.length-2]-valores[valores.length-1]+' Ranura(s) disponible(s)');
        }
      }
    }
    // table.ajax.reload();
    $('#modalInfo').modal({backdrop: 'static'}); //Muestra el modal con el fondo bloqueado
    if (document.getElementById("modalEdit")){ //Verifica si es posible editar en la vista
      $.post('view', {id: idDisp}) //Se obtienen los datos para el modal de Edit
      .done(function(data){
        var x = JSON.parse(data);
        var value = new Array();
        $.each(x[0], function(index, val) { //Coloca los datos para editar en un array para luego asignarlo a cada campo del formEdit
          value.push(val);
        });
        $.post('getTypes', {proveedor: value[3]}) //Busca los tipos de dispositivo del proveedor actual
        .done(function(data){
          reloadTypes(data);
          $('#modalEdit form').find('[name]').each(function(index, el) { //Asigna los valores al formulario de edición
            $(this).val(value[index]);
          });
          $(".selectpicker").selectpicker('refresh'); //Refresca los selectpicker
        });
      });
    }
  }
});
$('#btnEditar').on('click', function(event) {
  event.preventDefault();
          // $('#modalInfo').modal('toggle'); //Quita el modal de Info
          $('#modalEdit').modal({backdrop: 'static'}); //Muestra el modal de Edit
        });
        $('#btnGuardar').on('click', function(event) { //Oculta el modal de Edit, las acciones las maneja el Bootstrap Validator en el evento success
          $('#modalEdit').modal('toggle');
        });
        $('#modalEdit').on('hidden.bs.modal', function (e) { //Cuando se oculta el modal de Edit se reestablecen los valores del Form y las validaciones anteriores
          $('#editarDispositivo')[0].reset();
          $(".selectpicker",$('#editarDispositivo')).selectpicker('refresh');
          $('#editarDispositivo').data('bootstrapValidator').resetForm();
        });

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