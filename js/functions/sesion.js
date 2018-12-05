$(document).ready(function() {
  $('.parallax').parallax()

  getList('college', 'autocompleteCollege')
  getList('carrier', 'autocompleteCarrier')
  getList('subject', 'autocompleteSubject')

  $('.datepicker').pickadate({
    selectMonths: false, // Creates a dropdown to control month
    selectYears: 1, // Creates a dropdown of 15 years to control year
    minDate: 0,
    min: 0
  })
})

$('.signin').sideNav({
  edge: 'right'
})

$('.login').sideNav({
  edge: 'right' // Choose the horizontal origin
})

$('.button-collapse').sideNav({
  edge: 'right', // Choose the horizontal origin
  closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
  draggable: true // Choose whether you can drag to open on touch screens
})

$('.cancel').click(function() {
  $('.button-collapse').sideNav('hide')
})
//listener changes add subject
$('#newSubject input').keyup(function() {
  $('.submit-subject').unbind()

  var subject = $('#subject').val()
  var carrier = $('#carrier').val()
  var college = $('#college').val()

  if (subject != '' && carrier != '' && college != '') {
    $('.submit-subject').removeClass('disabled')
    $('.submit-subject').click(function() {
      innerEntrance(subject, carrier, college)
    })
  } else {
    $('.submit-subject').addClass('disabled')
  }
})

//task

$('#newTask input, .picker__clear, #subjecTo').on('keyup click change', function() {
  var hour = $('#hour').val()
  var subject = $('#subjecTo').val()
  var date = $('#date').val()
  var name = $('#nameTask').val()
  var description = $('#descriptionTask').val()

  if (subject != '' && date != '' && name != '') {
    if (date) {
      var selected = new Date($('#date').val())
    } else {
      var selected = new Date(0)
    }
    selected.setHours($('#hour').val())
    var date = selected.getTime()

    var current = new Date()
    if (selected >= current) {
      // success
      $('.taskSubmit').unbind()
      $('.taskSubmit').removeClass('disabled')

      //listener
      var upload = {
        hour: hour,
        subject: subject,
        date: date,
        name: name,
        description: description
      }
      $('.taskSubmit').click(function() {
        innerTask(upload)
        console.log(subject)
      })
    } else {
      $('.taskSubmit').unbind()
      $('.taskSubmit').addClass('disabled')
      $('.taskSubmit').click(function() {
        Materialize.toast('La fecha no es valida', 4000)
      })
    }
  } else {
    $('.taskSubmit').unbind()
    $('.taskSubmit').addClass('disabled')
  }
})

$(document).ready(function() {
  $('.tooltipped').tooltip({ delay: 50 })
  $('select').material_select()

  var urlPath = $('#avatar').attr('src')
  if (urlPath.search('dd46a756faad4727fb679320') > 0) {
    Materialize.toast(
      "Para añadir una imagen, visita: <a class='btn' href='https://es.gravatar.com/'>Gravatar</a>",
      7000
    )
  }
})
