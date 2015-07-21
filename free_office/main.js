function init() {
    var get = function (id) {
        return document.getElementById(id);
    },
        elA = document.getElementsByClassName("elA"), //all a tags in services
        elR = document.getElementsByClassName("rotate"), //all rotated div tags containing a tags
        elP = document.getElementsByClassName("stext"),
        elRW = document.getElementsByClassName("rotateW"), //buttons in personel section
        elWA = document.getElementsByClassName("elWA"), // a tads in buttons in personnel section
        triangle = document.getElementsByClassName("triangle"), //small red triangle in buttons in personnel section
        elDot = document.getElementsByClassName("dot"), //dot elements in slow life section
        elView = get("view"),
        view = ["pictures/view1.jpg", "pictures/view2.jpg", "pictures/view3.jpg", "pictures/view4.jpg", "pictures/view5.jpg", "pictures/view6.jpg"], //all view pictures in slow life section
        len = elR.length,
        i = 0, j = 0, c = 1, //loops counters
        selected = {
            iphone: false,
            mac: true,
            tab: false
        }, //the object with flags for icons in project title section
        utils = {
            addEvent: null,
            removeEvent: null
        };
    
    //check whether browser is IE and apply class to hover elements in who are we
    if (navigator.userAgent.indexOf("Chrome") == -1 &&  navigator.userAgent.indexOf("Firefox") == -1) {
        for (i = 0; i < len; i++) {
            elWA[i].classList.add("elWAForEX");
        }
    } 
    
    // adding on mouse over event to services buttons
    
    for (i = 0; i < len; i++) {        
        elR[i].onmouseover = function (){
            this.classList.add("hoverSet");
        } 
    }
        
    for (j = 0; j < len; j++) {
        elR[j].onmouseout = function (){
            this.classList.remove("hoverSet");
        }
    }
        
    //adding on mouseover, mouseout and click events to project title icos
    
    
    // iphone ico events
    get("iphone").addEventListener("mouseover", function (e){
        if(selected.iphone == false){
            this.src = "pictures/iphoneicoselect.png";
            e.stopPropagation();
        }
    })
    
    get("iphone").addEventListener("mouseout", function (e){
        if(selected.iphone == false){
            this.src = "pictures/iphoneico.png";
            e.stopPropagation();
        }
    })
    
    get("iphone").addEventListener("click", function (e){
        if (selected.iphone == false) {
            get("pict").src = "pictures/iphone.png";
            selected.tab = false;
            selected.iphone = true;
            selected.mac = false;
            get("mac").src = "pictures/macico.png";
            get("tab").src = "pictures/tabico.png";
            e.stopPropagation();
        }
    })
    
    // tab icon events
    get("tab").addEventListener("mouseover", function(e){
        if(selected.tab == false){
            this.src = "pictures/tabicoselect.png";
            e.stopPropagation();
        }
    })
    
    get("tab").addEventListener("click", function (e){
        if (selected.tab == false) {
            get("pict").src = "pictures/ipad.png";
            selected.tab = true;
            selected.iphone = false;
            selected.mac = false;
            get("iphone").src = "pictures/iphoneico.png";
            get("mac").src = "pictures/macico.png";
            e.stopPropagation();
        }
    })
    
    get("tab").addEventListener("mouseout", function (e){
        if(selected.tab == false){
            this.src = "pictures/tabico.png";
            e.stopPropagation();
        }
    })
    
    
    // mac  icon events
     get("mac").addEventListener("mouseover", function(e){
        if(selected.mac == false){
            this.src = "pictures/macicoselect.png";
            e.stopPropagation();
        }
    })
    
    get("mac").addEventListener("mouseout", function(e){
        if(selected.mac == false){
            this.src = "pictures/macico.png";
            e.stopPropagation();
        }
    })
    
     get("mac").addEventListener("click", function (e){
        if (selected.mac == false) {
            get("pict").src = "pictures/imac.png";
            selected.tab = false;
            selected.iphone = false;
            selected.mac = true;
            get("iphone").src = "pictures/iphoneico.png";
            get("tab").src = "pictures/tabico.png";
            e.stopPropagation();
        }
    })
    
     //adding maoseover and mouse out events on personel
    for (i = 0; i < len; i++) {
        elRW[i].addEventListener("mouseover", function (e) {
            var myIndex = findIndex(this);
            elWA[myIndex].classList.remove("hoverWhoSet");
            triangle[myIndex].classList.remove("hoverWhoSet");
        })
    }
    
    for (i = 0; i < len; i++) {
        elRW[i].addEventListener("mouseout", function (e) {
            var myIndex = findIndex(this);
            elWA[myIndex].classList.add("hoverWhoSet");
            triangle[myIndex].classList.add("hoverWhoSet");
            
        })
     }
    
    //function to define the index of the chosen element
    function findIndex (elem) {
        var i, length = elRW.length;
        for (i=0; i<len; i++) {
            if(elRW[i]==elem) {
                return i;
            }
        }
        return -1;
    }
    
    //slow life functions section
    window.setInterval(changeViewDot, 2000);
    
    function changeViewDot () {
        if(c == 0){
            elView.src = view[c];
            elDot[c].src = "pictures/whitedot.png";
            elDot[c+5].src = "pictures/blackdot.png";
        } else {
            elView.src = view[c];
            elDot[c].src = "pictures/whitedot.png";
            elDot[c-1].src = "pictures/blackdot.png";
        }
        c++;
        if(c == 6) {
            c = 0;
        }
    }
    
}

window.addEventListener("load", init);