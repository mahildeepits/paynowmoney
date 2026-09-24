$(document).ready(function(){
    $('#class_type').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue == 'online') {
            $('#class_center_container').hide();
        } else {
            $('#class_center_container').show();
        }
    });
});
