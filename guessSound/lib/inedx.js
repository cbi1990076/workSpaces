/**
 * Created by NoctisLee on 2017/1/17.
 */
var openId;
var canPlay;
var indexNum =0;
var score = 0;
var rate=0;
var clock;
window.onload = function () {
    $('#typingSound')[0].play();
    console.log(1);
    $('.ball').hide();
    clock = setInterval('changPic()',70);
};

$(function(){
    document.getElementById('typingSound').play();
    $('.playBtn').click(function(){
        $('#Main .question').eq(indexNum).show().siblings().hide();
        console.log(1);
        $('#startGame').hide();
        $('#Main').show();
        var music = $('.sounds')[indexNum]
        music.play();

    });
    $('.mQmid li').click(function(){
        var obj =this;
        choose(obj);
    });
    $('.nextBegin').click(function(){
        if(indexNum == 10){
            $('#Main').hide();
            $('#result').show();
            $('.score span').html(score);
            getRate();
            $('.rate span').html(rate);
        }else{
            var music = $('.sounds')[indexNum]
            music.play();
            $('#Main .question').eq(indexNum).show().siblings().hide();
            $('.mQues').show();
            $('.mResult').hide();
            $('.rateLeft').animate({'margin-left':"1.9rem"});
            $('.rateRight').animate({'margin-left':'0rem'});
            $('.rateMid').hide();
        }

    });
    $('.reShare').click(function(){
        $('#share').show();
        $('#result').hide();
    });
    $('#share').click(function(){
        $('#share').hide();
        $('#result').show();
    });
    $('.reStart').click(function(){
        indexNum = 0;
        $('#result').hide();
        $('#Main .question').eq(indexNum).show().siblings().hide();
        $('#Main').show();
        var music = $('.sounds')[indexNum]
        music.play();
        $('.mQues').show();
        $('.mResult').hide();
        $('.rateLeft').animate({'margin-left':"1.9rem"});
        $('.rateRight').animate({'margin-left':'0rem'});
        $('.rateMid').hide();
    });

});

function choose(obj){
   var num =$(obj).attr("choose");
   if(num==1){
      score+=10;
      console.log(score);
   };
   $('.sounds')[indexNum].pause();
   $('.mQues').hide();
   $('.mResult').show();
   $('.rateLeft').animate({'margin-left':".6rem"},1000);
   $('.rateRight').animate({'margin-left':'3.1rem'},1000);
   $('.rateMid').fadeIn(1000);
    indexNum+=1;
};
var postAjax = function(url,param,succfun) {
    //ajax 调用
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: param,
        async: false,
        success: function (data, status) {
            succfun(data);
            console.log(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("Error " + textStatus);
        }
    });
};
function getRate (){
    //获取比率
    var url = "game_UserScore.php";
    var param = {
        "openid":openId ,
        "score" : score,
    };
    postAjax(url,param,function(data){
        console.log(data.type);
        rate = data.victory;
    });
    if(rate == 0 || rate == undefined){
        rate = "80";
    };
    _wx_JsConfig.title = "听声音，猜城市";
    _wx_JsConfig.content = "我击败了全国"+rate+"%的人，十足的科技范，你快来试试吧！";
};
var i =0;
function changPic(){
    var num = $('.crack img').length;
    if(i<num){
        $('.crack img').eq(i).show().siblings().hide();
        i++;
    }
    if(i == num){
        clearInterval(clock);
       $('#loading').fadeOut(1000);
       $('#startGame').fadeIn(1500);
        document.getElementById('typingSound').pause();
    }
};

