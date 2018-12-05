//get task
var upload = { table: 'task' }
$.ajax({
  url: 'php/geTask.php',
  type: 'post',
  dataType: 'json',
  data: upload,
  complete: function(request) {
    request = request.responseJSON

    if (request.length == 0) {
      $(this)
        .delay(1000)
        .animate({ width: '40px' }, 'slow', function() {
          Materialize.toast('Parece que nesesitas agregar algunas tareas   ', 4000)
        })
    }

    for (var i = 0; i < request.length; i++) {
      if (request[i].status == '1') {
        var status = true
      } else {
        var status = false
      }

      var input = $('<input>')
        .attr('type', 'checkbox')
        .addClass('switched')
        .attr('id', request[i].id)
        .attr('checked', status)
      var span = $('<span>').addClass('lever')

      var label = $('<label>')
        .append('sin terminar')
        .append(input)
        .append(span)
        .append('terminado')
      var p = $('<p>').append(request[i].descripcion)
      var description = $('<div>')
        .addClass('collapsible-body')
        .append(p)
      var div = $('<div>')
        .addClass('switch right')
        .append(label)
      var icon = $('<i>')
        .addClass(' material-icons center ')
        .append('delete')
        .attr('style', 'font-size:1rem')
      var button = $('<a>')
        .addClass('btn-floating btn-small right red trash')
        .append(icon)
        .attr('id', request[i].id)

      div = $('<div>')
        .addClass('collapsible-header')
        .append(div)
        .append(request[i].name)

      var injection = $('<li>')
        .append(button)
        .append(div)
        .append(description)

      $('#tasks').append(injection)
    }
  }
})

//listener entrances
$(document).ready(function() {
  $('.switched').each(function() {
    $(this).click(function() {
      var update = { status: $(this).prop('checked'), id: $(this).prop('id') }
      $.ajax({
        url: 'php/updateTask.php',
        type: 'post',
        dataType: 'json',
        data: update,
        complete: function(request) {
          if (request.status == 200) {
            Materialize.toast('Actualización exitosa', 4000)
          } else {
            Materialize.toast('A ocurrido un error al insertar', 4000)
          }
        }
      })
    })
  })

  $('.trash').each(function() {
    $(this).click(function() {
      if (confirm('seguro?')) {
        $(this)
          .parent()
          .hide('slow')
        var update = { id: $(this).attr('id') }
        $.ajax({
          url: 'php/deleteTask.php',
          type: 'post',
          dataType: 'json',
          data: update,
          complete: function(request) {
            if (request.status == 200) {
              Materialize.toast('Actualización exitosa', 4000)
            } else {
              Materialize.toast('A ocurrido un error al insertar', 4000)
            }
            console.log(request)
          }
        })
      }
    })
  })

  $(document).ready(function() {
    $('.modal').modal()
  })
})
