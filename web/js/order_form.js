// Hide sideNavbar
$(function() {
  $('#sideNavbar').hide();
});
// Hide & show buttons
$(function() {
  $('#buy').on('click', function (e) {
    e.preventDefault()
    $('#day').remove();
    $('#half-day').remove();
    //
    $('.add_ticket').hide();
    $('.delete_ticket').hide();
    $('.previous').hide();
    $('.cart').hide();
    $('#sideNavbar').show();
  });
});

// Command tunnel
var $collectionHolder;

// "Continuer" button
var $newOrderLi = $('.show_order').append();
// "Ajouter un billet" button
var $addTicketLi = $('.add_ticket').append();

$(function() {
    // Get the ul that holds the collection of tickets
    $collectionHolder = $('#appbundle_order_tickets');

    /* Count the current form inputs we have, use that as the new index
    when inserting a new item */
    $collectionHolder.data('index', $collectionHolder.find('div').length);

    $('.show_order').click(function(e) {
        // Prevent the link form creating a "#" on the URL
        e.preventDefault();
        $('.show_order').hide();
        $('.add_ticket').show();
        $('.delete_ticket').show();
        $('.previous').show();
        $('.cart').show();
        // Add a new order form
        addOrderForm($collectionHolder, $newOrderLi);
    });

    $('.add_ticket').click(function(e) {
        e.preventDefault();
        // Add a new Ticket form
        addOrderForm($collectionHolder, $newOrderLi);
    });
});

/* The addTagForm() function's job is to use the data-prototype
attribute to dynamically add a new form when this link is clicked. */
function addOrderForm($collectionHolder, $newOrderLi, $addTicketLi) {
    // Get the data-prototype
    var prototype = $collectionHolder.data('prototype');
    // Get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    /* Replace '__name__' in the prototype's HTML to
    instead be a number based on how many items we have */
    newForm = newForm.replace(/__name__/g, index);
    // Increase the item with one for the next item
    $collectionHolder.data('index', index + 1);

    $collectionHolder.append(newForm);
}
