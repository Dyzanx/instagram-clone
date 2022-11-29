$(document).ready(function() {
    // change url HERE
    var url = "http://192.168.1.7:8000";
    console.log("jquery running");

    $('.like-button').css('cursor', 'pointer');
    $('.dislike-button').css('cursor', 'pointer');

    function like(){
        $('.like-button').unbind('click').click(function(e){
            $(this).addClass("dislike-button").removeClass('like-button');
            $(this).attr('src', url+'/img/red-hearth.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('liked!');
                    }
                }
            });
            dislike();
        });
    }
    like();

    function dislike(){
        $('.dislike-button').unbind('click').click(function(e){
            $(this).addClass("like-button").removeClass('dislike-button');
            $(this).attr('src', url+'/img/black-hearth.png');

            console.log(url+'/dislike/'+$(this).data('id'),);
            
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('disliked!');
                    }else{
                        console.log("error");
                    }
                }
            });
            like();
        });
    }
    dislike();

});