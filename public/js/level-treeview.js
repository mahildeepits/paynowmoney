$(function(){
    getTree();
});


function getTree(userId = null){
    if(userId == null){
        $.ajax({
            type: 'GET',
            url: route()+'/member/level/tree/structure',
            data: {},
            success: function(result){
                $('#tree').html(result);
                $("img.user-img").easyTooltip({useElement: "user_1"});
            }
        })
    }else{
        $.ajax({
            type: 'GET',
            url: route()+'/member/level/tree/structure',
            data: {
                username: userId
            },
            success: function(result){
                $('#tree').html(result);
                $("img.user-img").easyTooltip({useElement: "user_1"});
            }
        })
    }
}
