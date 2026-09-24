$(document).ready(function(){
    $('.transfer-button').prop('disabled',true).addClass('disabled');
    $('input[name=transfer_to]').blur(function(){
        if($(this).val().trim() != ''){
            $.ajax({
                type: 'GET',
                url: route()+'/member/sponsor/validate',
                data: {
                    sponsor: $(this).val()
                },
                success: function(result){
                    if(result.error_code === 0){
                        $('.btn').prop('disabled',false).removeClass('disabled');
                        $('.member-name').show().find('.user-name').removeClass('text-danger').addClass('text-success').text(result.sponsor);
                    }else{
                        $('.btn').prop('disabled',true).addClass('disabled');
                        $('.member-name').show().find('.user-name').removeClass('text-success').addClass('text-danger').html('<i>Not Found</i>');
                    }
                }
            });
        }
    });

    $('select[name=kit]').change(function(){
        if($(this).val().trim() !== '' && $(this).val().trim() !== undefined){
            let kitId = $(this).val();
            $.ajax({
                type: 'GET',
                url: route()+'/member/pins/available',
                data: {
                    kit_id: kitId
                },
                success: function(result){
                    $('.avail-pins').text(result);
                }
            });
        }else{

        }
    });

    $('select[name=joining_kit]').change(function(){
        let value = $(this).val().trim();
        if(value !== ''){
            $.ajax({
                type: 'GET',
                url: route()+'/member/joining-pins/available',
                data: {
                    kit_id:value
                },
                success: function(result){
                    console.log(result.status);
                    if(result.status !== false){
                        $('.pin-details-div').show();
                        let html = `
                        <tr>
                            <th>Pin No</th>
                            <td>`+result.record.pin_no+`</td>
                        </tr>
                    `;
                        $('.pin-details').html(html);
                        $('.avail-pins').text(result.count);
                        $('input').prop('disabled',false).removeClass('disabled');
                        $('.join-link').attr('href',route()+'/member/register?pin='+result.record.pin_no).show();
                        $('.topup-now').show();
                        $('.transfer-now').show();
                    }else{
                        $.toast({
                            heading: 'Error',
                            text: 'No pins available!',
                            icon: 'error',
                            showHideTransition: 'slide',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#c6001e'  // To change the background
                        });
                        $('.avail-pins').text(0);
                        $('.join-link').hide();
                        $('.topup-now').hide();
                        $('.transfer-now').hide();
                    }
                }
            });
        }else{
            $('.pin-details-div').hide();
        }
    });
});
