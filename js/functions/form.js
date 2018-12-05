var signin = $("#signin");

$(document).ready(function() {
  $('input').characterCounter();
});

$("form#signin input, #mail,body").on('keyup click change' ,function(){

  var name = $("#name").val();
  var last_name_p = $("#lastnamep").val();
  var last_name_m = $("#lastnamem").val();
  var mail = $("#mail").val();
  var pass = $("#password").val();
  var xpass = $("#xpassword").val();

  function hasField(string,caracter){
    if(string.search(caracter) > 0){
      return true;
    }else{
      return false;
    }
  }

  if(name != ""  && last_name_p != ""  && mail != "" && hasField($("#mail").val(),'@')    && pass != "" && xpass != "" ){

    if(!$("form#signin input").hasClass('invalid')){

      $(".submit").unbind();
      $(".submit").removeClass("disabled");
      $(".submit").click(function(){
        $.ajax({
          url:conect,
          type:'post',
          dataType:'json',
          data: getFormData(signin),

          complete:function(request){

            if(request.status >= 400 || request.status < 200){
              Materialize.toast("Ups! acurrido un error :( "+alertStatus(request.status), 4000) // 4000 is the duration of the toast
              Materialize.toast("Seguramente el usuario ya se encuentra registrado", 4000) // 4000 is the duration of the toast
              Materialize.toast("tus contraseñas  deben ser mayores a 7 caracteres, y coincidir", 4000) // 4000 is the duration of the toast


              //  console.debug(request);
            }else{
              Materialize.toast("Al parecer todo a salido bien,Ahora:"/*+alertStatus(request.status)*/,4000);
              Materialize.toast("¡INICIA SESION!"/*+alertStatus(request.status)*/,4000);

              //console.debug(request);

            }


          }
        });

      });
    }else{
      $(".submit").unbind();
      $(".submit").addClass("disabled");
    }
  }else{
    $(".submit").unbind();
    $(".submit").addClass("disabled");
  }


});
