$.ajax({
  url:check,
  type:'post',
  dataType:'json',
  data: 'nothing',
  statusCode: {
      200: function () {
      if($( location ).attr("href") != "http://localhost/cerba/sesion.php"){
      }
    },
      406: function () {
        if($( location ).attr("href") != "http://localhost/cerba/"){
          $( location ).attr("href","http://localhost/cerba/")
        }

      }
    }

});
