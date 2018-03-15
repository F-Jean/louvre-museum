// Remove "Billet journée" & "Billet demi-journée" when clicking on "Acheter un billet"
$(function() {
  $('#buy').on('click', function (e) {
    e.preventDefault()
    $('#day').remove();
    $('#half-day').remove();
    $('.add_ticket').hide();
  });
});

// Command tunnel part 1

var $collectionHolder;

// Setup an "Continuer" button
var $showTicket = $('<button type="button" href="#" class="show_ticket btn btn-warning">Continuer</button>');
var $newTicketLi = $('<li></li>').append($showTicket);

// Setup an "add a ticket" link
var $addTicket = $('<button type="button" href="#" class="add_ticket btn btn-warning">Ajouter un billet</button>');
var $newLinkLi = $('<li></li>').append($addTicket);

// Display first ticket
$(function() {
    // Get the ul that holds the collection of tickets
    $collectionHolder = $('#appbundle_order_tickets');

    // Add the "Continuer" anchor and li to the tickets ul
    $collectionHolder.append($showTicket);

    $collectionHolder.data('index', $collectionHolder.find('div').length);

    $showTicket.on('click', function(e) {
        // Prevent the link form creating a "#" on the URL
        e.preventDefault();

        // Add a new ticket form
        addTicketForm($collectionHolder, $newTicketLi);
        $('.add_ticket').show();
    });
});

/* The addTagForm() function's job is to use the data-prototype
attribute to dynamically add a new form when this link is clicked. */
function addTicketForm($collectionHolder, $newTicketLi) {
    // Get the data-prototype
    var prototype = $collectionHolder.data('prototype');
    // Get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    /* Replace '__name__' in the prototype's HTML to
    instead be a number based on how many items we have */
    newForm = newForm.replace(/__name__/g, index);
    // Increase the item with one for the next item
    $collectionHolder.data('index',index + 1);

    $collectionHolder.append(newForm);
}

// Command tunnel part 2

$(function() {
    // Get the ul that holds the collection of tickets
    $collectionHolder = $('#appbundle_order_tickets');

    // Add the "Ajouter un billet" anchor and li to the tickets ul
    $collectionHolder.append($addTicket);

    $collectionHolder.data('index', $collectionHolder.find('div').length);

    $addTicket.on('click', function(e) {
        // Prevent the link form creating a "#" on the URL
        e.preventDefault();

        // Add a new ticket form
        addTicketForm($collectionHolder, $newLinkLi);
        $('.add_ticket').show();
    });
});

function addTicketForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype;

    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index',index + 1);

    $collectionHolder.append(newForm);
}
