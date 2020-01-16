
$(function() {
    

    /*menu functionality:start*/
    $('.menu li').not(".menu .noSubMenu").hover(function() {
        //if (!$(".subMenu").is(':animated')){
        $(this).addClass('sel').siblings().removeClass('sel');
        $(this).find('.subMenu').stop(false, true).show();
        //}
    },
	    function() {
	        $(this).find(".subMenu").hide();
	        $(this).removeClass('sel');
	    }
	);


    $('.navDashboard li').not(".navDashboard .noSubMenu").hover(function() {
        //if (!$(".subMenu").is(':animated')){
        $(this).addClass('sel').siblings().removeClass('sel');
        $(this).find('.submenus').stop(false, true).show();
        //}
    },
	    function() {
	        $(this).find(".submenus").hide();
	        $(this).removeClass('sel');
	    }
	);
    /*menu functionality:end*/
       

    /*Our Partners functionality:start*/
    var liWidth = 0
    var liLength = $(".ourPartners .sliderContent ul li").length;
    var liLimit = liLength - 6;

    $(".ourPartners .sliderSection .next").click(function() {
        clearTimeout(partnerTimer);
        partnerLopping();
        liWidth = $(".ourPartners .sliderContent ul li").outerWidth(true);
        $(".ourPartners .sliderContent ul").animate({ "margin-left": "-" + liWidth + "px" }, 600, function() {
            var nextAppend = $(".ourPartners .sliderContent ul li:first").clone();
            $(".ourPartners .sliderContent ul li:first").remove();
            $(".ourPartners .sliderContent ul").css({ 'margin-left': 0 }).append(nextAppend);
        });
    });

    $(".ourPartners .sliderSection .prev").click(function() {
        clearTimeout(partnerTimer);
        partnerLopping();
        liWidth = $(".ourPartners .sliderContent ul li").width();
        var prevAppend = $(".ourPartners .sliderContent ul li:last").clone();
        $(".ourPartners .sliderContent ul li:last").remove();
        $(".ourPartners .sliderContent ul").css({ 'margin-left': -liWidth }).prepend(prevAppend);
        $(".ourPartners .sliderContent ul").animate({ "margin-left": 0 }, 600);
    });
    /*Our Partners functionality:end*/

    /*getStartedSlide:start*/
    if (navigator.userAgent.match(/MSIE\s(?!9.0)/)) {
        $('.registerSection').css({ 'right': -500 });
        $('.registerSection .register').height($("#wrapper").height() - 120);
    }
    $(".getStarted, .registerLink").click(function() {
        $(".overlay").fadeIn();
        $('html,body').animate({
            scrollTop: 0
        });
        if (navigator.userAgent.match(/MSIE\s(?!9.0)/)) {
            $('.registerSection').show();
            $('.registerSection').animate({ 'right': 0 }, 500);
            $('#wrapper').animate({ 'left': 0 }, 500);
        } else {
            $('#transition').addClass('cssTransition perspective');
            setTimeout(function() {
                $('#transition').addClass('cube');
                $('.registerSection .register').height($("#wrapper").height() - 100);
            }, 100);
        }
    });
    $(".registerSection .arrow, .overlay").click(function() {
        $(".overlay").fadeOut();
        if (navigator.userAgent.match(/MSIE\s(?!9.0)/)) {
            $('.registerSection').animate({ 'right': -500 }, 500, function() {
                $('.registerSection').hide();
            });
            $('#wrapper').animate({ 'left': 0 }, 500);
        } else {
            $('#transition').removeClass('cube');
            setTimeout(function() {
                $('#transition').removeClass('cssTransition perspective');
            }, 350);
        }
    });
    /*getStartedSlide:end*/

   


    /* Lightbox Close END */
    postBack();
});

/*postBack Function:start*/
function postBack() {
    /*Select code:start*/
    $(".selectBg select").each(function() {
        $(this).children("option").each(function() {
            if ($(this).attr("selected")) {
                $(this).parent().prev().html($(this).html());
            }
        });
    });
    $(".selectBg select").change(function() {
        $(this).prev().html($(this).find("option:selected").html());
    });
    /*Select code*/

    /*Radio buttons code*/
    $('.radioBtn .group label').click(function() {
        $(this).addClass('active').parent('.group').siblings().find('label').removeClass('active');
        $(this).children('input')
    });

    $('.radioBtn li').click(function() {
        if ($(this).find('input').is(':disabled')) {
            return false;
        }
        $(this).addClass('active').siblings().removeClass('active');
        $(this).find('input').attr("checked", "checked");
    });

    $('.radioBtn li').each(function() {
        if ($(this).find('input').is(':checked')) {
            $(this).addClass('active');
        }
    });
    /*Radio buttons code*/    

}
/*postBack Function:end*/

/*getStartTrigger:start*/
function getStartTrigger() {
    setTimeout(function() {
        $(".getStarted, .registerLink").trigger('click');
    }, 100);
}

/*openLightbox:end*/

function partnerLopping() {
    partnerTimer = setTimeout(function() {
        $('.ourPartners .sliderSection .next').click();
    }, 2000, function() {
        partnerLopping();
    });
}
$(window).load(function() {
    //bannerLopping();
    //autoScroller('vmarquee');
    partnerLopping();
});

function thankyouMsgScroll() {
    $('html,body').animate({
        scrollTop: 0
    });
}
function autoResize(id) {
    var lastHeight = 0, curHeight = 0, $frame = $('iframe:eq(0)');
    setInterval(function() {
        curHeight = $frame.contents().find('body').height();
        if (curHeight != lastHeight) {
            $frame.css('height', (lastHeight = curHeight) + 'px');
        }
    }, 500);
    //    var newheight;
    //    var newwidth;
    //    if (document.getElementById) {
    //        newheight = document.getElementById(id).contentWindow.document.body.scrollHeight;
    //        newwidth = document.getElementById(id).contentWindow.document.body.scrollWidth;
    //    }
    //    document.getElementById(id).height = (newheight) + 200 + "px";
    //    document.getElementById(id).width = (newwidth) + "px";
    //$('html, body').animate({ scrollTop: 0 }, 'slow');
}


/* for the validation display message using dialogbox */
function DisplayMessage(message) {

    var newDiv = $(document.createElement('div'));
    newDiv.id = "popupMessageDiv";
    newDiv.html("<p id='messageInnerDiv'>" + message + "</p>");
    newDiv.dialog({
        dialogClass: "dialog_message",
        modal: true,
        resizable: false,
        height: 'auto',
        width: 500,
        // close: HandleMsgDialogClose(),
        closeOnEscape: false,
        title: 'SME -',
        open: function(event, ui) { $("#dlgClose").hide(); }
//        buttons: {
//            'Ok': {
//                click: function() {
//                    $(this).dialog('close');
//                    $(this).dialog('destroy');
//                },
//                text: 'Ok',
//                "class": 'x-btn-default-medium'
//            }
//        }
    });
}