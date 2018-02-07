$(function() {
  $('#buy').on('click', function (e) {
    e.preventDefault()
    $('#day').remove();
    $('#half-day').remove();
    var div = $('#form-ticket')
    var textarea = $('<textarea class="ticket-type"></textarea>')
    div.append(textarea)
  });
});
