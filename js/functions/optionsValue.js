var upload = {table:'subject'}

$.ajax({

  url:"php/getField.php",
  type:'post',
  dataType:'json',
  data: upload,
  complete:function(request){
    request = request.responseJSON;


    for(var i = 0; i < request.length;++i){

      var option = request[i].name;
      $('#subjecTo').append('<option>'+option+'</option>');
      $('#subjecTo option').last().attr('value',option);
    }

  }
});
