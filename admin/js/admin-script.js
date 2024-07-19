jQuery(document).ready(function($) {
    var $slider = $('input[name="custom_widgets_gradient_size"]');
    var $sizeValue = $('#gradient-size-value');

    $slider.on('input', function() {
        var value = $(this).val();
        $sizeValue.text(value + 'px');
        $('input[name="custom_widgets_gradient_size"]').val(value);
    }).trigger('input');
});
