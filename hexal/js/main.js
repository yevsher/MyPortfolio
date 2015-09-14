"use strict";

$(document).ready(function() {
    //variables f for contents part
    var a = $("#head ul li a"),
        length = a.length,
        i = 0,
        arrow = document.createElement("div"),
        img1 = document.createElement("img"),
        img2 = document.createElement("img"),
        arrowpos = [300, 385, 460, 532, 620],
        hexa = document.createElement("div"),
        hex1 = document.createElement("div"),
        hex2 = document.createElement("div"),
        hexaHolder = document.createElement("a");
        
    
    //creating an arrow pointer for the header menu
    $(arrow).attr("id", "arrow");
    $(img1).attr({src:"pictures/arrowblock.png", id: "arrowblock"});
    $(img2).attr({src:"pictures/pointer.png", id: "pointer"});
    $(arrow).append(img1,img2);
        
    //creating hexagonal hover element for sample contents part
    $(hexaHolder).addClass("hexaHolder");
    $(hexa).addClass("hexa");
    $(hex1).addClass("hex1");
    $(hex2).addClass("hex2");
    
    $(hex1).append(hex2);
    $(hexa).append(hex1);
    $(hexaHolder).append(hexa);
    
    //setting events on header menu
    for(i = 0; i < length; i++) {
        a.eq(i).on("click", function(e) {
            e.preventDefault();
            
            var container = $("#container");
            if (container.nodeType == 1) {
                container.detach();
            }
           
            var hrefAtr = $(this).attr("href"),
                index = 0, i = 0, lef;
            
            //creating hover effect for elements in sample part when adding sample part
            if(hrefAtr == "navigation-pages/sample.html") {
                $("#content").load(hrefAtr+"#container", function() {
                    $("#content").on("mouseover", "a.hex", function() {
                        $(this).append(hexaHolder);
                    });
                    $("#content").on("mouseout", ".hexaHolder", function() {
                        $(this).detach();
                    });
                });
            }
            
            //adding other parts to the contents
            $("#content").load(hrefAtr+"#container");

            //adding arrow to the header menu part
            index = a.index(this);           
            $("#arrow").css({top: -15, left: arrowpos[index]});
        });
    }
    
    //cheking whether elements are inserted
    
    //load sample page
    $("#head").append(arrow);
    a.eq(2).trigger("click");
    
})


 

