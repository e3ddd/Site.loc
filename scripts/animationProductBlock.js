$(document).ready(function(){
    $(".img").hover(function(){
        $(this).css({"width":"300px","height":"300px", "transition": "1s"})
        },function(){
        $(this).css({"width":"220px","height":"200px","transition": "1s"})
        });
});

