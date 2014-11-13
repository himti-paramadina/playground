(function ( $ ) {

    $.fn.listenOnKeyboardPause = function(callback) {
        var typingTimer;
        var typingInterval = 2000; /* Set time interval to 2 seconds. */

        this.keyup(function () {
            console.log("listenOnKeyboardPause", "'keyup' executed.");
            clearTimeout(typingTimer);
            typingTimer = setTimeout(callback, typingInterval);
        });

        this.keydown(function() {
            console.log("listenOnKeyboardPause", "'keydown' executed.");
            clearTimeout(typingTimer);
        });
    };


    $.fn.generateMarkdownPreview = function(sourceElement) {
        var THIS = this;

        this.html('<p align="center">Harap tunggu..</p>');
        var dataText = $(sourceElement).val();

        var postRequest = $.post(CONFIG.url + "api/quizzes/preview.json", {text: dataText});
        
        postRequest.fail(function () {
            $(THIS).html('<p align="center">Gagal mengirimkan permintaan ke <em>API Server</em></p>');
        });

        postRequest.done(function (obtainedData) {
            console.log(obtainedData)
            $(THIS).html(obtainedData.response.parsed_text);
        });
    };
 
}( jQuery ));