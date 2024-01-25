var responseMessage = null;
var responseType = "success";
var timeoutId = null;


//Shows response message and fades out the #response div after 5 seconds
function showResponseMessage(){
    console.log(responseType);
    if(responseMessage){
        var res = $("#response");
        
        //Clear previous timeout if it exists
        if(timeoutId){
            clearTimeout(timeoutId);
            timeoutId = null;
        }

        res.slideUp(200, function(){ //Slide up if the alert is already visible

            //Remove previous alert subtype classes if they exist
            res.removeClass("alert-success");
            res.removeClass("alert-error");

            res.html(responseMessage);
            res.addClass("alert-" + responseType)
            responseMessage = null;
            res.slideDown(200)
            timeoutId = setTimeout(function(){
                res.slideUp(400, function(){
                    window.location.hash = ''; //Clears the hash so it won't show the message after refresh
                });
                timeoutId = null;
            }, 5000)
        });
        
    }
}

function setResponseMessage(msg, type){
    responseMessage = msg;
    responseType = type;
}

//Check for login button press and run ajax method
function login(){
    $(".container").on("submit", "#login-form", function() {
        var loginData   = $("#login-form").serializeArray();
        var action = $("#login-form").attr('action');

        ajaxRequestPost(action, loginData, "main.php#logged-in")
        return false;
    });
}

//Check for register button press and run ajax method
function register(){
    $(".container").on("submit", "#register-form", function() {
        var registerData   = $("#register-form").serializeArray();
        var action = $("#register-form").attr('action');

        ajaxRequestPost(action, registerData, "index.php#registered")
        return false;
    });
}

//Check for end session button press and run ajax method
function destroySession(){
    $(".container").on("submit", "#end-session-form", function() {
        var action = $("#end-session-form").attr('action');

        ajaxRequestPost(action, null, "index.php#logged-out")
        return false;
    });
}

//Calls ajax function with set parameters
function ajaxRequestPost(action, data, redirectToOnSuccess){
    $.ajax({
        type: "POST",
        url: action,
        data: data,
        beforeSend: function () {
            $(".ajax-btn").attr('disabled', true); //Disable login button while processing to avoid multiple submits
        },
        success: function (response) {
            var res = JSON.parse(response);
            $(".ajax-btn").attr('disabled', false); //Enable login button

            setResponseMessage("<p>" + res.msg + "</p>", res.type); //Set the response message

            if(res.type == "success"){
                location.href = redirectToOnSuccess
            }else{
                showResponseMessage();
            }
        }
    });
}

//Sets message after page redirect
function setMessageFromHash(){
    var hash = window.location.hash
    if(hash && hash != "#"){
        var msg;
        switch(hash){
            case "#logged-out": 
                msg = "Sessioon edukalt lõpetatud!"
                break;
            case "#logged-in": 
                msg = "Oled edukalt sisse logitud!"
                break;
            case "#registered":
                msg = "Kasutaja edukalt registreeritud! Võid nüüd sisse logida!"
                break;
            default:
                break;
        }

        if(msg){
            setResponseMessage("<p>" + msg + "</p>", "success");
            showResponseMessage();
        }

    }
}

$(document).ready(function() {
    login();
    register();
    destroySession();
    setMessageFromHash();
});