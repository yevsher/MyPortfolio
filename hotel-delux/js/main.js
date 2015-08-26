$(window).load(function(){
    
    //setting minimum date for arrival and departure
    $("#adate").datepicker({
        minDate: 0
    });
    
    $("#ddate").datepicker({
        minDate: 1
    });
    
    //modal window befor page update or quit
    $(window).on("beforeunload", function(){
        return "";
    });
    
    //modal window on navbar press custom title text
    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); 
      var recipient = button.text(); 
      var modal = $(this);
      modal.find(".modal-title").html(recipient);
    });
    

})

