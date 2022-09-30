$(function() {

    // Get the form.
    var form = $('#contact-form');

    // Get the messages div.
    var formMessages = $('.form-message');

    var removeValidation = function(){
        if ($('#contact-form input[name="name"]').hasClass("is-invalid")) {
            $('#contact-form input[name="name"]').removeClass("is-invalid");
            $('#contact-form input[name="name"]').parent().find(".invalid-feedback").remove();
        }
        if ($('#contact-form input[name="email"]').hasClass("is-invalid")) {
            $('#contact-form input[name="email"]').removeClass("is-invalid");
            $('#contact-form input[name="email"]').parent().find(".invalid-feedback").remove();
        }
        if ($('#contact-form input[name="subject"]').hasClass("is-invalid")) {
            $('#contact-form input[name="subject"]').removeClass("is-invalid");
            $('#contact-form input[name="subject"]').parent().find(".invalid-feedback").remove();
        }
        if ($('#contact-form textarea[name="message"]').hasClass("is-invalid")) {
            $('#contact-form textarea[name="message"]').removeClass("is-invalid");
            $('#contact-form textarea[name="message"]').parent().find(".invalid-feedback").remove();
        }

    }

    // Set up an event listener for the contact form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // removeValidation();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
        .done(function(response) {
            // Make sure that the formMessages div has the 'success' class.
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');

            // Set the message text.
            $(formMessages).html('<div class="alert alert-success" role="alert">'+response.message+'</div>');

            // Clear the form.
            $('#contact-form input,#contact-form textarea').val('');
        })
        .fail(function(data) {
            // Make sure that the formMessages div has the 'error' class.
            $(formMessages).html();

            var errors = data.responseJSON.errors;

            var errorMessage = function(message){
                return '<div class="invalid-feedback">'+message+'</div>';
            }

            if (typeof errors.name !== 'undefined' ) {
                $('#contact-form input[name="name"]').addClass("is-invalid");
                $('#contact-form input[name="name"]').parent().append(errorMessage(
                    errors.name[0]
                ))
            }
            if (typeof errors.email !== 'undefined' ) {
                $('#contact-form input[name="email"]').addClass("is-invalid");
                $('#contact-form input[name="email"]').parent().append(errorMessage(
                    errors.email[0]
                ))
            }
            if (typeof errors.subject !== 'undefined' ) {
                $('#contact-form input[name="subject"]').addClass("is-invalid");
                $('#contact-form input[name="subject"]').parent().append(errorMessage(
                    errors.subject[0]
                ))
            }
            if (typeof errors.message !== 'undefined' ) {
                $('#contact-form textarea[name="message"]').addClass("is-invalid");
                $('#contact-form textarea[name="message"]').parent().append(errorMessage(
                    errors.message[0]
                ))
            }

            var message = data.responseJSON.message;

            // Set the message text.
            if (data.responseText !== '') {
                $(formMessages).html('<div class="mb-5 alert mb-0 alert-danger" role="alert">'+message+'</div>');
            } else {
                $(formMessages).html('<div class="mb-5 alert mb-0 alert-danger" role="alert">Oops! An error occured and your message could not be sent.</div>');
            }
        });
    });

});



// $(function() {

// 	// Get the form.
// 	var form = $('#contact-form');

// 	// Get the messages div.
// 	var formMessages = $('.form-message');

// 	// Set up an event listener for the contact form.
// 	$(form).submit(function(e) {
// 		// Stop the browser from submitting the form.
// 		e.preventDefault();

// 		// Serialize the form data.
// 		var formData = $(form).serialize();

// 		// Submit the form using AJAX.
// 		$.ajax({
// 			type: 'POST',
// 			url: $(form).attr('action'),
// 			data: formData
// 		})
// 		.done(function(response) {
// 			// Make sure that the formMessages div has the 'success' class.
// 			$(formMessages).removeClass('error');
// 			$(formMessages).addClass('success');

// 			// Set the message text.
// 			$(formMessages).text(response);

// 			// Clear the form.
// 			$('#contact-form input,#contact-form textarea').val('');
// 		})
// 		.fail(function(data) {
// 			// Make sure that the formMessages div has the 'error' class.
// 			$(formMessages).removeClass('success');
// 			$(formMessages).addClass('error');

// 			// Set the message text.
// 			if (data.responseText !== '') {
// 				$(formMessages).text(data.responseText);
// 			} else {
// 				$(formMessages).text('Oops! An error occured and your message could not be sent.');
// 			}
// 		});
// 	});

// });


