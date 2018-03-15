$(function() {
  $('#buy').on('click', function (e) {
    e.preventDefault()
    $('#day').remove();
    $('#half-day').remove();
  });
});


// Script that add a new ticket
var $collectionHolder;

// setup an "add a ticket" link
var $addTicketLink = $('<button type="button" href="#" class="add_ticket_link btn btn-warning">Continuer</button>');
var $newLinkLi = $('<li></li>').append($addTicketLink);

$(function() {
    //Get the ul that holds the collection of tickets
    $collectionHolder = $('#appbundle_order_tickets');

    //add the "Continuer" anchor and li to the tickets ul
    $collectionHolder.append($addTicketLink);

    $collectionHolder.data('index', $collectionHolder.find('div').length);

    $addTicketLink.on('click', function(e) {
        // prevent the link form creating a "#" on the URL
        e.preventDefault();

        // add a new ticket form
        addTicketForm($collectionHolder, $newLinkLi);
    });
});

function addTicketForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    console.log(newForm)

    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index',index + 1);

    $collectionHolder.append(newForm);
}
