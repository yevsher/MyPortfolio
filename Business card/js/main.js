$(window).load(function(){
    //VARIABLES
    var starQ = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        starBox = $(".starBox"),
        starBoxLen = starBox.length,
        Exp = {
            1: ["Менеджер проэктов", "SSI", "2 года и 2 месяца", ["Переговоры с заказчиками", "Подготовка ТЗ для разработчиков", "Выполнение роли Scrum Master"]],
            2: ["Старший Администратор", "Укртелеком", "4 месяца", ["Конфигурирование коммутаторов", "Поддержка сервис деска"]],
            3: ["Начальник Сектора", "ОТП Банк", "4 года", ["Администрирование сети банкоматов и POS", "Поддержка сервис деск"]],
            counter: 1
        },
        requisittes = {
            email: "",
            skype: "",
            emailTo: ""
        },
        lastScrollTop = 0;
    
    
    //BUTTON SCROLLING ANIMATION
    
    $("#thisIsMyButton").on("click", function(){
        $("body").animate({
            scrollTop: $("#thisIsMine").offset().top
        }, { duration: 2000, queue: false });
    });
    
    // PARRALAX EFFECT AND SCROLLING
    
    var parEl = $(".Parralax"),
        iframe = $("#ifVideo");
    
    //parallax
    
    function parralax() {
        var scrolled = $(window).scrollTop();
        parEl.eq(0).animate({
            top: scrolled + "px"
        }, { duration: 500, queue: false });
        parEl.eq(1).animate({
            top: scrolled + "px"
        }, { duration: 400, queue: false });
        if((scrolled<lastScrollTop)||(scrolled > 150)) {
            parEl.eq(2).animate({
                top: scrolled + "px"
            }, { duration: 700, queue: false });
        }
        lastScrollTop = scrolled;
        
    }
    
    //scrolling
    $(window).scroll(function(e){
        var posBody = $("body").scrollTop().toFixed()%1000 - $("body").scrollTop().toFixed()%100,
            autoPl = iframe.attr("src").split("").pop(),
            windowWidth = $(window).width();
        
        if(windowWidth>= 1000) {
            if(posBody == 500) {   
                iframe.attr("src", "//www.youtube.com/embed/HfnJ1ccnKPc?autoplay=1");
            } else if ((posBody <= 300)||(posBody >= 600)) {
              if(autoPl == 1) {
                iframe.attr("src", "//www.youtube.com/embed/HfnJ1ccnKPc?autoplay=0");
              }  
            }
        } else if(windowWidth>=750&&windowWidth<=999){
            if(posBody == 200) {   
                iframe.attr("src", "//www.youtube.com/embed/HfnJ1ccnKPc?autoplay=1");
            } else if ((posBody <= 350)||(posBody >= 500)) {
              if(autoPl == 1) {
                iframe.attr("src", "//www.youtube.com/embed/HfnJ1ccnKPc?autoplay=0");
              }  
            }
        } else {
            if(posBody == 100) {   
                iframe.attr("src", "/www.youtube.com/embed/HfnJ1ccnKPc?autoplay=1");
            } else if ((posBody <= 200)||(posBody >= 400)) {
              if(autoPl == 1) {
                iframe.attr("src", "//www.youtube.com/embed/HfnJ1ccnKPc?autoplay=0");
              }  
            }
        }
        
        parralax();
    })
    
    //LANGUAGES, FRAMEWORKS, CSS
    var inputCheck = $(".check");
    
    inputCheck.on("change", function(e) {
        var skillsChecked = $(".check:checked").length,
            progressBar = $(".progress-bar");
        
        progressBar.css("width", (skillsChecked/15)*100 + "%");
    });
    
    //STAR HOVER
    $(".Star").hover(
        function() {
            $(this).prevAll().andSelf().attr("src", "../pictures/goldstar.png");
            $(this).nextAll().attr("src", "../pictures/grey star.png");    
        }, function() {
            var stBox = $(this).parent(),
                i = starBoxFun(stBox) || 0;
                if(starQ[i] == 0) {
                    $(this).prevAll().andSelf().attr("src", "../pictures/grey star.png");
                } else {
                     stBox.children("img").eq(starQ[i]-1).trigger("click");
                }
    });
    
    //STAR CLICK
    $(".Star").on("click", function() {
        var checked = $(this).parents().filter("li").children()
            .filter(".myCheckbox").children()
                .filter(".check"),
            stBox = $(this).parent(),
            i = starBoxFun(stBox),
            stLen = $(this).prevAll().andSelf().length;
        
        starQ[i] = stLen;
        
        $(this).prevAll().andSelf().attr("src", "../pictures/goldstar.png");
        $(this).nextAll().attr("src", "../pictures/grey star.png");
             
        if(checked.is(":checked") == false){
            checked.trigger("click");
        }
    })
    
    //CHECKBOX CLICK
    
    inputCheck.on("click", function(e) {
        var star = $(this).parents().filter("li").children()
            .filter(".starBox").children().filter(".Star");
        
        if($(this).is(":checked") == true) {
            if(star.eq(1).attr("src") != "../pictures/goldstar.png") {
                star.attr("src", "../pictures/goldstar.png");
            }
        } else {
            var stBox = star.eq(1).parent(),
                i = starBoxFun(stBox);
            starQ[i] = 0;
            star.attr("src", "../pictures/grey star.png");
        }
    })
    
    //FUNCTION FOR CHEKING STARBOX
    function starBoxFun (stBox) {
        for(var i = 0; i < starBoxLen; i++) {
                if(stBox.get(0) == starBox.eq(i).get(0)) {
                    return i; 
                }
            }
    }
    
    //MY EXPERIENCE SECTION
    $("#otherWork").on("click", function() {
        var count = Exp.counter.toString(),
            position = $(".Position"),
            firm = $(".firm"),
            term = $(".term"),
            tasks = $(".tasks");
        
        position.css("display", "none");
        firm.css("display", "none");
        term.css("display", "none");
        tasks.css("display", "none");
        
        position.html("<span class="+"img-responsive"+">Должность:&nbsp;</span>" + "<span class="+"img-responsive"+">"+Exp[count][0]+"</span>").fadeIn("slow");

        firm.html("<span class="+"img-responsive"+">Компания:&nbsp;</span>" + "<span class="+"img-responsive"+">"+Exp[count][1]+"</span>").fadeIn("slow");
        
        term.html("<span class="+"img-responsive"+">Срок работы:&nbsp;</span>" + "<span class="+"img-responsive"+">"+Exp[count][2]+"</span>").fadeIn("slow");
        
        tasks.html("<span class="+"img-responsive"+">Задачи:&nbsp;</span>" + "<ul><li><span"+"img-responsive"+">"+Exp[count][3][0]+"</span></li>"+"<li><span"+"img-responsive"+">"+Exp[count][3][1]+"</span></li></ul>" ).fadeIn("slow");
        
        Exp.counter+=1;
        if(Exp.counter > 3) {
            Exp.counter = 1;
        }
    })
    
    //HEAR SECTION
    $("#meet").on("click", function(e) {
        $("#modalForm, #send").toggle("drop", {direction: "up"});
    })
    
    $("#send").on("click", function(event) {
        if(requisittes.email == "" || requisittes.skype == "" || requisittes.emailTo == "") {
            alert("You did not save email/skype/emailTo addresses the message wont be sent");
            event.preventDefault();
        } else {
            $.ajax({
                url: "../php/main.php",
                method: "POST",
                type: "POST",
                data: requisittes,
                success: function() {
                    alert("The message with Your requisittes was sent to " + requisittes.emailTo);
                }
            });
        }
    })
    
    //modal
    $("#save").on("click", function() {
        var email = $("#email"), skype = $("#skype"), emailTo = $("#emailTo");
        if(email.val() == ""){
            $("#formGrOne").addClass("has-error");
        } else if (skype.val() == "") {
            $("#formGrTwo").addClass("has-error");
        } else if (emailTo.val() == "") {
            $("#formGrThree").addClass("has-error");
        } else {
            requisittes.email = email.val();
            requisittes.skype = skype.val();
            requisittes.emailTo = emailTo.val();
            $("#modalData").modal("hide");
        }
    })
    
    $("#closeFooter").on("click", function() {
        $("#formGrOne").removeClass("has-error");
        $("#formGrTwo").removeClass("has-error");
        $("#formGrThree").removeClass("has-error");
    })
    
    $("#closeHeader").on("click", function() {
        $("#formGrOne").removeClass("has-error");
        $("#formGrTwo").removeClass("has-error");
        $("#formGrThree").removeClass("has-error");
    })
    
    $("#email").on("keypress", function() {
        $("#formGrOne").removeClass("has-error");
    })
    
    $("#skype").on("keypress", function() {
        $("#formGrTwo").removeClass("has-error");
    })
    
    $("#emailTo").on("keypress", function() {
        $("#formGrThree").removeClass("has-error");
    })
    
    
    //STARTING POSITION
    
    function startingPosition() {
        $("#otherWork").trigger("click");
        
        $(".starBox").eq(0).children("img:nth-child(3)").trigger("click");
        $(".starBox").eq(1).children("img:nth-child(3)").trigger("click");
        $(".starBox").eq(2).children("img:nth-child(3)").trigger("click");
        $(".starBox").eq(3).children("img:nth-child(3)").trigger("click");
        $(".starBox").eq(6).children("img:nth-child(2)").trigger("click");
        $(".starBox").eq(9).children("img:nth-child(2)").trigger("click");
        
        $("#meet").trigger("click");
    }
    
    startingPosition();
    
    //VIDEO SECTION
    //facebook like
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; 
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    //twitter
    (function(d,s,id) {
        var js,fjs=d.getElementsByTagName(s)[0],
            p=/^http:/.test(d.location)?'http':'https';
        
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js,fjs);
        }
    }(document, 'script', 'twitter-wjs'));
    
    
    
  
})