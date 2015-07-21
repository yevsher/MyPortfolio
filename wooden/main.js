window.addEventListener ("load", loadDom);

function loadDom () {
    var vid = document.getElementsByClassName("vid"),
        elI = document.querySelectorAll("#viddiv a img"),
        len = vid.length,
        imgBig = ["pictures/synergyBig.jpg", "pictures/radioBig.jpg", "pictures/nightBig.jpg"],
        imgSmall = ["pictures/synergy.jpg", "pictures/radio.jpg", "pictures/night.jpg"],
        utils = {
            addEvent: null
        }
        i = 0;
    
        if (typeof document.addEventListener === "function" ) {
            utils.addEvent = function (el, event, func) {
                el.addEventListener(event, func);
            }
        } else if (typeof document.attachEvent === "function") {
            utils.addEvent = function (el, event, func) {
                el.attachEvent ("on" + event, func);
            }
        } else {
             utils.addEvent = function (el, event, func) {
                var elEv = "on" + event;
                el.elEv = func;
            }
        }
    
    for (i=0; i < len; i++) {
        utils.addEvent(vid[i], "mouseover", changeScaleB);
    }
    
    for (i=0; i < len; i++) {
        utils.addEvent(vid[i], "mouseout", changeScaleS);
    }
    
    function changeScaleB () {
        var index;
        for(var i=0; i < len; i++) {
            if(this == vid[i]) {
                index = i;
                break;
            }
        }
        elI[index].src = imgBig[index];
    }
    
    function changeScaleS () {
        var index;
        for(var i=0; i < len; i++) {
            if(this == vid[i]) {
                index = i;
                break;
            }
        }
        elI[index].src = imgSmall[index];
    }

}

