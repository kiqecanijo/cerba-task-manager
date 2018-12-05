var form = $("#signup");

$(".signup").click(function(){
  $.ajax({
    url:loginConection,
    type:'post',
    dataType:'json',
    data: getFormData(form),
    complete: function(request){
      if(request.status == 200){
        $(location).attr('href', 'sesion.php ')

      }else{
        Materialize.toast("¡Ha ocurrido un error, intentalo nuevamente!", 4000) // 4000 is the duration of the toast

      }

      //console.debug(request);
    }
  })

});
