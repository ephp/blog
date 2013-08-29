$(document).ready(function(){
    $('input:radio').click(function() {
        switch_media($(this));
    });
    $('#post_video')
            .change(function(){video($(this));})
            .keyup(function(){video($(this));})
            .blur(function(){video($(this));})
    ;
});

function switch_media(elem) {
    console.log(elem);
    $('.js_s').hide();
    $('#js_s'+elem.val()).show();
    $('#post_picture').val('');
    $('#post_media').val('');
    $('#post_video').val('');
    $('ul.thumbnails').html('');
}

function callbackDragDrop(item, numero_foto) {
    console.log(item);
    alert('Ciao');
    $('#post_picture').val(item.id);
    $('#post_media').val(item.url);
}

function video(elem) {
    var val = elem.val();
    if(checkSito(val)) {
        if(checkYoutube(val)) {
            $('#post_media').val('<iframe width="100%" height="300" src="http://www.youtube.com/embed/'+codeYoutube(val)+'?rel=0" frameborder="0" allowfullscreen></iframe>');
        }
    } else {
        $('#post_media').val(val);
    }
}

var re_yt = /^http(s)?:\/\/www.youtube.com\/watch\?([a-zA-Z0-9]+=[^&]*&)*v=[a-zA-Z0-9\-\_]{11}/;
var re_ytc = /v=[a-zA-Z0-9\-\_]{11}/;
function checkYoutube(url) {
    if (url.match(re_yt)) {
        return true;
    }
    return false;
}

function codeYoutube(url) {
    var m = re_ytc.exec(url);
    return m[0].from(2);
}

