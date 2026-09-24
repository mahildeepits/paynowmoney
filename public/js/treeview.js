$(function(){
    getTree();
    $('body').on('mouseover',"img.user-img",function(){
        $('.span_username').html($(this).data('id'));
        $('.user_join_kit').html($(this).data('kit'));
        // $('.sponsor-details').html($(this).data('name')+' ('+$(this).data('sponsor')+')');
        $('.sponsor-details').html($(this).data('name'));
        $('.user_join_date').html($(this).data('joindate'));
        $('.left_count').html($(this).data('left'));
        $('.right_count').html($(this).data('right'));
    });
});


function getTree(userId = null){
    let tree_number = $('input[name=tree_number]').val();
    // if(userId == null){
    //     $.ajax({
    //         type: 'GET',
    //         url: route()+'/member/binary/tree/'+tree_number,
    //         data: {},
    //         success: function(result){
    //             $('#tree').html(result);
    //             $("img.user-img").easyTooltip({useElement: "user_1"});
    //         }
    //     })
    // }else{
        $.ajax({
            type: 'GET',
            url: route()+'/member/binary/tree/'+tree_number,
            data: {
                username: userId
            },
            success: function(result){
                $('#tree').html(result);
                $("img.user-img").easyTooltip({useElement: "user_1"});
            }
        })
    // }
}


function handleEmptyNode(position, parent, sponsor, path){
    console.log(parent);
    if(parent.trim() !== ''){
        window.location.href = path+'?position='+position+'&parent='+parent+'&sponsor='+sponsor;
    }
}
