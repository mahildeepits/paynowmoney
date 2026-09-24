$(document).ready(function(){
    $('input[name=select_all]').click(function(){
        if($(this).is(':checked')){
            $('.user-select').each(function(){
                $(this).prop('checked',true);
            });
            $('.approve_bulk').show();
        }else{
            $('.user-select').each(function(){
                $(this).prop('checked',false);
            });
            $('.approve_bulk').hide();
        }
    });
    $('.user-select').click(function(){
        if($('.user-select:checked').length > 0){
            $('.approve_bulk').show();
        }else{
            $('.approve_bulk').hide();
        }
    });
    $('.approve_single_pancard').click(function(){
        if(confirm('Are you sure to approve this pancard?')){
            $(this).parents('tr').find('.user-select').prop('checked',true);
            $(this).parents('form').submit();
        }
    });

    $('.approve_selected').click(function(){
        if(confirm('Are you sure to approve the selected records?')){
            $(this).parents('form').submit();
        }
    });

    $('.select2-ajax').select2({
        tokenSeparators: [',', ' '],
        minimumInputLength: 2,
        minimumResultsForSearch: 10,
        ajax: {
            url: route()+'/admin/memberids',
            dataType: "json",
            type: "GET",
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.member_id,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
});
