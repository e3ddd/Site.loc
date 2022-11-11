$(document).ready(function(){
    $("#button").on("click", () => {
        event.preventDefault();
        const data = {
            email: $("#regInputEmail").val(),
            password: $("#regInputPassword").val(),
        }
            $.ajax({
                method: "GET",
                url: "../Controllers/Auth/registration.php",
                data: JSON.stringify(data),
                dataType: "json",
                success: function (res){

                },
                error: function (err,ex){
                    console.log("Error status >>>", err.status);
                    if (err.status === 200){
                        $("small").detach()
                    }
                    if(err.status === 400){
                        if($("#reg_form").find("small").length !== 0) return
                        $("#reg_form").append("<small class='exception_message'>Password is very weak !</small>")
                        setTimeout(() => $("small").detach(), 5000)
                    }
                    if(err.status === 404){
                        if($("#reg_form").find("small").length !== 0) return
                        $("#reg_form").append("<small class='exception_message'>Fill all input fields !</small>")
                        setTimeout(() => $("small").detach(), 5000)
                    }
                    if(err.status === 403){
                        if($("#reg_form").find("small").length !== 0) return
                        $("#reg_form").append("<small class='exception_message'>Your email exist !</small>")
                        setTimeout(() => $("small").detach(), 5000)
                    }
                    if(err.status === 406){
                        if($("#reg_form").find("small").length !== 0) return
                        $("#reg_form").append("<small class='exception_message'>Email incorrect !</small>")
                        setTimeout(() => $("small").detach(), 5000)
                    }
                }
            })

    })
})