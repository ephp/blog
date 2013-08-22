$(document).ready(function(){
    $('input:radio').click(function() {
        switch_media($(this));
    });
});

function switch_media(elem) {
    console.log(elem);
    $('.js_s').hide();
    $('#js_s'+elem.val()).show();
}