var utils = {
    addListener: null,
    removeListener: null,
    elCDiv: null
};

//create facade for addEventListener/attachEvent/onevent
if(typeof document.attachEvent === "function") {
    utils.addListener = function (e, type, fn) {
        var e = e || document;
        e.attachEvent("on" + type, fn);
    }
    utils.removeListener = function (e, type, fn) {
        var e = e || document;
        e.detachEvent("on" + type, fn);
    }
} else if (typeof document.addEventListener === "function") {
    utils.addListener = function (e, type, fn) {
        var e = e || document;
        e.addEventListener(type, fn, false);
    }
    utils.removeListener = function (e, type, fn) {
        var e = e || document;
        e.removeEventListener(type, fn, false);
    }
} else {
    utils.addListener = function (e, type, fn) {
        var elEvent = "on" + type;
        e.elEvent = fn;
    }
    utils.removeListener = function (e, type, fn) {
        var elEvent = "on" + type;
        e.elEvent = null;
    }
}

utils.addListener(window,"load", init);

//function after initialization
function init() {
    var person = {},
        fragment,
        len,
        i,
        personrow = document.getElementById("personrow"),
        personname = document.getElementById("personname");
    
    person.photo = ["pictures/photo1.png", "pictures/photo2.png", "pictures/photo3.png", "pictures/photo4.png", "pictures/photo5.png", "pictures/photo6.png", "pictures/photo7.png", "pictures/photo8.png", "pictures/photo9.png", "pictures/photo10.png", "pictures/photo11.png", "pictures/photo12.png", "pictures/photo13.png", "pictures/photo14.png", "pictures/photo15.png", "pictures/photo16.png", "pictures/photo17.png", "pictures/photo18.png", "pictures/photo19.png", "pictures/photo20.png", "pictures/photo21.png"];
    person.name = ["Liza Raine", "David Kraige", "Omanda Kerr", "Chet Kwazi", "Jack Hudson", "Jane Hunt", "Kozo Lambert", "Iren Brickly", "Jon Kobb", "Kriss Tacker", "Mia Rollins", "Frank Tsuka", "Josef Farrow", "Maxin Doll", "Franky Brown", "Donky Kong", "Banny Aaron", "Laisie Tukker", "Brian Kiss", "Mat White", "Kandy Cocks"];

    fragment = document.createDocumentFragment();
    len = person.photo.length;

    
    //creating elements in Dom
    (function () {
        for (i = 0; i < len; i++) {
            var elLi = document.createElement("LI"),
                elA = document.createElement("A"),
                elDivInner = document.createElement("DIV"),
                elDivOut = document.createElement("DIV"),
                urlP = "url(" + person.photo[i] + ")";

            elLi.classList.add("testli");
            elA.classList.add("elA");
            elA.href = "#";
            elDivInner.style.backgroundImage = urlP;
            elDivInner.classList.add("photoinner");
            elDivOut.classList.add("photoblur");
            elA.classList.add("alert");


            elDivInner.appendChild(elDivOut);
            elA.appendChild(elDivInner);
            elLi.appendChild(elA);
            fragment.appendChild(elLi);
        }

        personrow.appendChild(fragment);
    })();
    
    
    // creating hover events
    var elA = document.getElementsByClassName("elA"),
        elDivOut = document.getElementsByClassName("photoblur");
    
    for (i = 0; i < len; i++) {
        utils.addListener(elA[i], "mouseover", function() {
            var i, index;
            index = findIndex(this);
           
            elDivOut[index].classList.add("photoVisibility");
            personname.innerHTML = person["name"][index];
        })
    
        utils.addListener(elA[i], "mouseout", function() {
            var i, index;
            index = findIndex(this);
            
            elDivOut[index].classList.remove("photoVisibility");
            personname.innerHTML = "&nbsp;";
        })
    }
    
    function findIndex(el) {
        var i;
        for(i = 0; i < len; i++) {
            if(elA[i] == el){
                return i;
                break;
            }
        }
        return -1;
    }
    
    //creating alerts on click ivents for all buttons and links
    var alertEl = document.querySelectorAll(".alert"),
        alertLen = alertEl.length;
    for(i = 0; i < alertLen; i++){
        utils.addListener(alertEl[i], "click", function(e){
            e.preventDefault();
            alert("This is a single presentation page!");
            
        })
    }
}