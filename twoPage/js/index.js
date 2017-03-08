/**
 * Created by Noctis on 2016/11/28.
 */

$(function(){
    //第一段视频16秒
    //第二段左手4秒
    //第三段右手11秒
})
var canPlay = true;
window.onload=function(){
    // setProgressBarCss();
    // doProgressBarLoading();
    $('.page2Left').click(function(){
        var audio = $('.audi')[0];
        audio.pause();
        $('.sMan').css({'left':'-80%'});
        clearTimeout(clock);
        $(function(){
            $.fn.snow({
                minSize: 5,		//雪花的最小尺寸
                maxSize: 50, 	//雪花的最大尺寸
                newOn: 300		//雪花出现的频率 这个数值越小雪花越多
            },2);
        });
        pageLeft();
        clock = setTimeout('clearWord()',10000);
        $('#page1').stop().hide();
        $('#page2').stop().hide();
        $('#page3').stop().slideDown(1000,function(){
            $('.sMan').delay(1500).fadeIn().animate({'left':'15%'},1000,function(){
                $(this).addClass('animated swing');
            }).delay(1000).animate({'left':'100%'},1000,function(){
                $(this).removeClass('animated swing');
                $('.sMan').css({'display':'none'});
            });
        });
    });
    $('.page2Right').click(function(){
        var audio = $('.audi')[0];
        audio.pause();
        clearTimeout(clock);
        $('#page2').fadeOut();
        $('#page1').hide();
        $('#page3').hide();
        pageRight();
        $('#page4').css({'display':"block",'animation': 'wave steps(7) 1s both'});
    });
    $('.point').click(function(){
        window.location.href='http://shop13292402.wxrrd.com/';
    })
setTimeout('index()',2000);
    $('.soundCon').click(function(){
        if(canPlay){
            var audio = $('.audi')[0];
            audio.pause();
            canPlay = false;
        }else {
            var audio = $('.audi')[0];
            audio.play();
            canPlay = true;
        }
    });
}

function index (){
    $('.shake').show();
    $('.indexT').html("请摇一摇你的手机");
    //create a new instance of shake.js.
    var myShakeEvent = new Shake({
        threshold: 15
    });

    // start listening to device motion
    myShakeEvent.start();

    // register a shake event
    window.addEventListener('shake', shakeEventDidOccur, false);

    //shake event callback
    function shakeEventDidOccur () {
        $('.loading').fadeOut();
        $('#page1').fadeIn();
        $('.P1First').parent().show(1000);
        typeWord();
        pageStart();
        window.removeEventListener('shake', shakeEventDidOccur, false);
    }
}
var clock;
function clearWord(){
    var audio = $('.audi')[0];
    audio.play();
    $('#page1').hide();
    $('.snowbox').hide();
    $.fn.snow({},1)
    $('#page2').show();
    $('#page3').hide();
    $('.loading').hide();
}

var postAjax = function(url,param,succfun) {
    //ajax 调用
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: param,
        async: false,
        success: function (data, status) {
            succfun(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("Error " + textStatus);
        }
    });
};
function pageStart (){
    //开始Ajax
    var url = "../../U3D/phoneInteraction.php";
    var param = {
        "num" :"1",
    };
    postAjax(url,param,function(data){
        console.log(data);

    });
};
function pageLeft (){
    //左手Ajax
    var url = "../../U3D/phoneInteraction.php";
    var param = {
        "num" :"2",
    };
    postAjax(url,param,function(data){
        console.log(data.type);

    });
};
function pageRight (){
    //右手Ajax
    var url = "../../U3D/phoneInteraction.php";
    var param = {
        "num" :"3",
    };
    postAjax(url,param,function(data){
        console.log(data.type);

    })
};

//
// var progressId = "ProgressBarID";
// function setProgressBar(progress) {
//     if (progress) {
//         $("#" + progressId + " > div").css("width", String(progress) + "%");
//         $("#" + progressId + " > div").html(String(progress) + "%");
//     }
// }
// var i_ProgressBar = 0;
// function doProgressBarLoading() {
//     if (i_ProgressBar > 100) {
//         // $('#ProgressBarID').hide();
//         // $('#page1').fadeIn();
//         // $('.P1First').parent().show(1000);
//         // typeWord();
//         // pageStart();
//         return;
//     }
//     if (i_ProgressBar <= 100) {
//         setTimeout("doProgressBarLoading()", 10);
//         setProgressBar(i_ProgressBar);
//         i_ProgressBar++;
//     }
// }
// function setProgressBarCss() {
//     $("#" + progressId + "").css({ "width": "100%", "height": "25px" });
//     $("#" + progressId + " > div").css({ "height": "25px", "background-color": "#e0e0e0", "text-align": "center" });
// }

function typeWord() {
    clock = setTimeout('clearWord()',20000);;
    $('.P1First').typed({
        strings: ["大家好，我是Maggie"],
        // stringsElement: $('.typed-strings'),
        typeSpeed: 200,
        startDelay: 1000,
        backDelay: 2000,
        loop: false,
        contentType: 'text',
        loopCount: false,
        callback: function () {
            $('.P1Sec').parent().show(2000);
            $('.P1Sec').typed({
                strings: ["圣诞节就要到了，我有礼物要送给大家"],
                // stringsElement: $('.typed-strings'),
                typeSpeed: 200,
                startDelay: 2000,
                backDelay: 2000,
                loop: false,
                contentType: 'text',
                loopCount: false,
                callback: function () {
                    $('.P1Th').parent().delay(2000).show();

                    // $('.P1Th').typed({
                    //     strings: ["快拿出你的手机查看吧"],
                    //     // stringsElement: $('.typed-strings'),
                    //     typeSpeed: 200,
                    //     startDelay: 2000,
                    //     backDelay: 5000,
                    //     loop: false,
                    //     contentType: 'text',
                    //     loopCount: false,
                    //     callback: function () {
                    //     },
                    //     resetCallback: function () {
                    //     }
                    // });
                },
                resetCallback: function () {
                }
            });
        },
        resetCallback: function () {
        }
    });
}
$.fn.snow = function(options,num){

if(num==1){
    clearInterval(interval);
    $(this).remove();
    return;
}else {
    var $flake = $('<div class="snowbox" />').css({'position': 'absolute', 'top': '-50px'}).html('&#10052;'),
        documentHeight = $(document).height(),
        documentWidth = $(document).width(),
        defaults = {
            minSize: 10,		//雪花的最小尺寸
            maxSize: 20,		//雪花的最大尺寸
            newOn: 1000,		//雪花出现的频率
            flakeColor: "#FFFFFF"	//懒人建站 www.51xuediannao.com   整理
        },
        options = $.extend({}, defaults, options);

    var interval = setInterval(function () {
        var startPositionLeft = Math.random() * documentWidth - 100,
            startOpacity = 0.5 + Math.random(),
            sizeFlake = options.minSize + Math.random() * options.maxSize,
            endPositionTop = documentHeight - 40,
            endPositionLeft = startPositionLeft,
            durationFall = documentHeight * 10 + Math.random() * 5000;
        $flake.clone().appendTo('body').css({
            left: startPositionLeft,
            opacity: startOpacity,
            'font-size': sizeFlake,
            color: options.flakeColor
        }).animate({
                top: endPositionTop,
                left: endPositionLeft,
                opacity: 0.2
            }, durationFall, 'linear', function () {
                $(this).remove()
            }
        );
    }, options.newOn);
}
};