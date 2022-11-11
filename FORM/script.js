$(document).ready(function(){
    $(".1").click(function(){
        $(".reg").fadeOut(300);
        $(".reg").fadeIn(300);
        $(".2").attr("style", false)
        $(this).css({
            "border":"2px",
            "border-color": "#0242e8",
            "background": "white",
            "color": "#0242e8",
            "padding": "7px",
            "border-radius": "10px"
        })
        setTimeout(() => {
            $("#header").text("Apply as a Seller")
            $("input:radio").show()
            $("label").show();
        }, 300)
    })
    $(".2").click(function(event){
        $(".1").attr("style", false)
        $(".reg").fadeOut(300);
        $(".reg").fadeIn(300);
        $(this).css({
            "border":"2px",
            "border-color": "#0242e8",
            "background": "white",
            "color": "#0242e8",
            "padding": "7px",
            "border-radius": "10px"
        })
        setTimeout(() => {
            $("#header").text("Apply as a Buyer");
            $("input:radio").hide()
            $("label").hide();
            $("#reg_btn").css("margin-bottom", "20px");
        }, 300)

    })


    $( ".reg" ).on( "submit", function( event ) {
        event.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: "request.php",
            data: data,
            dataType: "json",
            done: (suc) => {
                console.log("Error >>>", suc.status);
            }
        })
    });
})
