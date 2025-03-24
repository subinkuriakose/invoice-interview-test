$(document).ready(function(){
    $('#editInvoiceForm').on('submit', function (e) {
        // Prevent normal form submission
        e.preventDefault();

        // Collect form data
        var formData = $(this).serialize();
        var url = $('#editInvoiceForm').data('url');
        var urlRedirect = $('#editInvoiceForm').data('url_redirect');

        // Send the form data using AJAX
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                if(res.status == true) {
                    // alert(res.message);
                    window.location.href = urlRedirect;
                }
                else {
                    // Handle errors
                    var errors = res.errors;
                    var errorMessages = '';
                    $.each(errors, function (key, value) {
                        errorMessages += '<p>' + value[0] + '</p>';
                    });
                    $('#responseErrMessage').html(errorMessages).show();
                }
            },
            error: function (xhr, status, error) {
                alert('Something went wrong! Please try again later.');
                // Handle errors
                var errors = xhr.responseJSON.errors;
                var errorMessages = '';
                $.each(errors, function (key, value) {
                    errorMessages += '<p>' + value[0] + '</p>';
                });
                $('#responseErrMessage').html(errorMessages);
            }
        });
    });
});