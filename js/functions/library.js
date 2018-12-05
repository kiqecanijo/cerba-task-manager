
//function parse the form contend in a jason
function getFormData(form){
  var unindexed_array = form.serializeArray();
  var indexed_array = {};
  $.map(unindexed_array, function(n, i){
      indexed_array[n['name']] = n['value'];
  });
  return indexed_array;
}



function getList(table,input){
  var upload = {table:table};
  $.ajax({
    url:"php/getField.php",
    type:'post',
    dataType:'json',
    data: upload,
    complete:function(request){

      //console.log(request);


      request = request.responseJSON;
      for(var i = 0; i < request.length; i++ ){
        request[i] = request[i].name;
      }
      (function($){
        $(function(){
          function toObject(arr) {
            var rv = {};
            for (var i = 0; i < arr.length; ++i)
            rv[arr[i]] = "img/"+arr[i]+".jpg";
            return rv;
          }
          var where = "input."+input;
          $(where).autocomplete({
            data: toObject(request)
          });
        });
      })(jQuery);
    }
  });
}


function innerTask(upload){
  $.ajax({
    url:"php/innerTask.php",
    type:'post',
    dataType:'json',
    data: upload,
    complete:function(request){

        switch(request.status){
          case 200:
          //Materialize.toast("¡registro exitoso! visitas tus <a class='btn' href='http://localhost/cerba/sesion.php'>Tareas</a>", 2500,'nothing',function(){$(location).attr('href', 'http://localhost/cerba/sesion.php')});;
          Materialize.toast("¡registro exitoso! redirigiendo...", 2500,'nothing',function(){$(location).attr('href', 'http://localhost/cerba/sesion.php')});;

          break;

          case 400:
          Materialize.toast('Algo a salido mal, intentalo más tarde', 4000);
          break;
          case 406:
          Materialize.toast('Verfica tus datos, parece que algo anda mal :/', 4000);

        }



    }
  });
}

function innerEntrance(subject,carrier,college){
  var data =  {subject:subject,carrier:carrier,college:college};
  $.ajax({
    url:"php/innerEntrance.php",
    type:'post',
    dataType:'json',
    data: data,
    complete:function(request){

    /*  if(request.responseJSON.college){
        Materialize.toast('Colegio correctamente agregada', 4000);
      }else{
        Materialize.toast('El colegio no pudo ser agregado', 4000);

      }

      if(request.responseJSON.carrier){
        Materialize.toast('Carrera correctamente agregada', 4000);
      }else{
        Materialize.toast("La carrera no pudo ser agregado <a href='http://google.com'>clickme</a>", 4000);

      }
*/
      if(request.responseJSON.subject){
        Materialize.toast("Materia correctamente agregada ahora: <a class='waves-effect waves-light btn' href='http://localhost/cerba/sesion.php'>Añade una tarea</a>", 2500,'Algo aqui',function(){$(location).attr('href', 'http://localhost/cerba/sesion.php')
});
      }else{
        Materialize.toast('La materia no pudo ser agregada, seguramente ya se encuentra registrada', 4000);

      }

    }
  });
}


//status switcher
function alertStatus(status){
  var text;
  switch (status) {
    case 200: text = 'OK'; break;
    case 201: text = 'creado'; break;
    case 202: text = 'aceptado'; break;
    case 203: text = 'Non-Authoritative Information'; break;
    case 204: text = 'No Content'; break;
    case 205: text = 'Reset Content'; break;
    case 206: text = 'Partial Content'; break;
    case 301: text = 'Moved Permanently'; break;
    case 302: text = 'Moved Temporarily'; break;
    case 305: text = 'Use Proxy'; break;
    case 400: text = 'Bad Request'; break;
    case 401: text = 'Unauthorized'; break;
    case 402: text = 'Payment Required'; break;
    case 403: text = 'Forbidden'; break;
    case 404: text = 'Not Found'; break;
    case 405: text = 'metodo no soportado'; break;
    case 406: text = 'No Aceptable'; break;
    case 407: text = 'Proxy Authentication Required'; break;
    case 408: text = 'tiempo de respuesta exedido'; break;
    case 410: text = 'Gone'; break;
    case 411: text = 'Length Required'; break;
    case 412: text = 'la longitud de las contraseñas no es correcta'; break;
    case 413: text = 'Request Entity Too Large'; break;
    case 415: text = 'Unsupported Media Type'; break;
    case 500: text = 'error interno :('; break;
    case 501: text = 'Not Implemented'; break;
    case 502: text = 'Bad Gateway'; break;
    case 503: text = 'servicio no disponible'; break;
    case 504: text = 'tiempo de respuesta exedido'; break;


    default: text = 'Codigo de error desconocido'; break;
  };
  return text;
}

$(".logout").click(function(){
  $.ajax({
    url:"php/closeSesion.php",
  });
  $( location ).attr("href","http://localhost/cerba/");

});




//php routes
var conect = "php/conect.php";
var loginConection = "php/login.php";
var college = "php/getCollege.php";
var check = "php/cheker.php";
