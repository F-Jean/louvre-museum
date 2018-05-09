$(function() {
    // Hide & show the buttons before starting the command tunnel
    $('#buy').click(function(e) {
        e.preventDefault()
        $('#day').remove();
        $('#half-day').remove();
        //
        $('.add_ticket').hide();
        $('.delete_ticket').hide();
        $('.cart').hide();
        $('#buy').hide();
        $('#sideNavbar').show();
        $(".input_validation").each(function() {
            var rules = $(this).data("rules");
            var messages = $(this).data("messages");
            $(this).rules("add", Object.assign(rules, { messages : messages }))
        })
    });

    // Call the datepicker of Order form
    $('#appbundle_order_visitDay').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "fr",
        orientation: "bottom left",
        // daysOfWeekDisabled: "0,2",
        todayHighlight: true
    });

    // Validate the fields of the first step after clicking the Continue btn
    var validator = $("form[name=appbundle_order]").validate({
        validClass: 'is-valid',
        errorClass: 'is-invalid',
        errorElement: 'div',
        errorPlacement: function(error, e) {
            error.addClass("invalid-feedback");
            e.parents('.form-group').append(error);
        },
        highlight: function(e) {
            $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        },
        success: function(e) {
            e.closest('.form-group').removeClass('has-success has-error');
            e.closest('.invalid-feedback').remove();
        },
        rules: {},
        messages: {}
    });


    $("body").on("click", ".show_order", function(e) {
        if(!validator.valid()) {
            e.preventDefault();
        } else {
            $(this).hide();
            $('.add_ticket').show();
            $('.delete_ticket').show();
            $('.cart').show();
            // Add a new order form
            addOrderForm($collectionHolder, $newOrderLi);
        }
    });

    // Command tunnel starts
    var $collectionHolder;

    // "Continuer" button
    var $newOrderLi = $('.show_order').append();
    // "Ajouter un billet" button
    var $addTicketLi = $('.add_ticket').append();

    // Get the part that holds the collection of tickets
    $collectionHolder = $('div#ticket-tunnel');

    /* Count the current form inputs we have, use that as the new index
    when inserting a new item */
    $collectionHolder.data('index', $collectionHolder.find('div').length);


    $('.add_ticket').click(function(e) {
        e.preventDefault();
        // Add a new Ticket form
        addOrderForm($collectionHolder, $newOrderLi);
    });

    /* The addTagForm() function's job is to use the data-prototype
    attribute to dynamically add a new form when this link is clicked. */
    function addOrderForm($collectionHolder, $newOrderLi, $addTicketLi) {
        // Get the data-prototype
        var prototype = $collectionHolder.data('prototype');
        // Get the new index
        var index = $collectionHolder.data('index');

        var newForm = prototype;

        /* Replace '_name_' in the prototype's HTML to
        instead be a number based on how many items we have */
        newForm = newForm.replace(/__name__/g, index);

        var $newForm = $(newForm)
        // Increase the item with one for the next item
        $collectionHolder.data('index', index + 1);

        $collectionHolder.append($newForm);

        $newForm.find(".input_validation").each(function() {
            var rules = $(this).data("rules");
            var messages = $(this).data("messages");
            $(this).rules("add", Object.assign(rules, { messages : messages }))
        })
    }

    $("body").on("click", ".delete_ticket", function() {
        $(this).closest(".ticket-form").find(".input_validation").each(function() {
            $(this).rules("remove");
        })
        $(this).closest(".ticket-form").remove();
    });

    // Display an alert if reducedPrice is checked
    function verifychk(cb) {
        if(cb.checked == true) {
            alert('Un justificatif sera demandé lors de l\'entrée');
        }else{
            alert('Vous venez de décocher tarif réduit');
        }
    }


});
/*
// Hide sideNavbar
$(function() {
  $('#sideNavbar').hide();
});*/
