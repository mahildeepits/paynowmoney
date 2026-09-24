$(function(){
    $('input[name=sponsor]').blur(function(){
        if($(this).val().trim() != ''){
            $.ajax({
                type: 'GET',
                url: route()+'/member/sponsor/validate',
                data: {
                    sponsor: $(this).val(),
                    register:true,
                },
                success: function(result){
                    if(result.error_code == 0){
                        $('input[name=sponsor_name]').val(result.sponsor);
                        $('.ajax-error').hide();
                    }else{
                        $('.ajax-error').html(result.error).show();
                        $('input[name=sponsor_name]').val('');
                    }
                }
            });
        }else{
            $('.ajax-error').hide();
        }
    });
    setTimeout(()=>{
        $('input[name=sponsor]').trigger('blur');
    },1000);
});
