$(window).load(function(){
    
    $("#adate").datepicker({
        minDate: 0
    });
    $("#ddate").datepicker({
        minDate: 1
    });
    $(window).on("beforeunload", function(){
        return "";
    });

})

