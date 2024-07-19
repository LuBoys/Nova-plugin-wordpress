jQuery(document).ready(function($) {
    // Initialize WordPress color picker
    $('.custom-widgets-color-field').wpColorPicker();

    // Handle gradient size slider
    $('.slider').on('input', function() {
        var value = $(this).val();
        $('#gradient-size-value').text(value + 'px');
    });
});
