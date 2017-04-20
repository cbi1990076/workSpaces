//声明参数
var openId;

var number = 0;

var times = "";

var t;

//开始计时
function timedCount(){
	
	if(number.toString().length==1){
		
		times = "<span>"+0+"</span>&nbsp;<span>"+0+"</span>&nbsp;:&nbsp;<span>"+0+"</span>&nbsp;<span>"+number+"</span>";
		
	}else if(number.toString().length==2){
		
		times = "<span>"+0+"</span>&nbsp;<span>"+0+"</span>&nbsp;:&nbsp;<span>"+number.toString().substring(0,1)+"</span>&nbsp;<span>"+number.toString().substring(1,2)+"</span>";
			
	}else if(number.toString().length==3){
		
		times = "<span>"+0+"</span>&nbsp;<span>"+number.toString().substring(0,1)+"</span>&nbsp;:&nbsp;<span>"+number.toString().substring(1,2)+"</span>&nbsp;<span>"+number.toString().substring(2,3)+"</span>";
		
	}else if(number.toString().length==4){
		
		times = "<span>"+number.toString().substring(0,1)+"</span>&nbsp;<span>"+number.toString().substring(1,2)+"</span>&nbsp;:&nbsp;<span>"+number.toString().substring(2,3)+"</span>&nbsp;<span>"+number.toString().substring(3,4)+"</span>";
		
	}
	
	document.getElementById('timeNumber').innerHTML= times;
	
	number = number+1;
	
	t=setTimeout("timedCount()",1000);
	
}

//停止计时
function stopCount()
{

	clearTimeout(t);
	
	number = 0;
	
	times = "";

}

//AJAX
var postAjax = function(url,param,succfun){
	$.ajax({
		type: "POST",
		url: url,
		dataType: "json",
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

window.onload = function(){
	
	document.getElementById('sounds').play();
	
	$('.word2016').delay(3000).fadeIn(1000,function(){
		
		$('.word2016').hide();
		
		$('.wordmid').delay(3000).fadeIn(1000,function(){
			
			$('.wordmid').hide();
			
			$('.word2017').fadeIn(function(){
				
				$('.loading').delay(2000).fadeOut();
				
				$('.main').fadeIn(1500);
				
			}).css({'display':"block"});
			
		}).css({'display':"block"});
	});
}

$(function() {
	
	var voice = {
		localId: '',
		serverId: ''
	};
	
	var images = {
		localId: [],
		serverId: []
	};
	
	//点击录制声音
    $('.start').click(function () {
        
    	document.getElementById('sounds').pause();
    	
        $('.start').hide();
        
        $('.stop').show();
        
        timedCount();
        
		wx.startRecord({
			
			cancel: function () {
				
				alert('用户拒绝授权录音');
				
			}
		
		});
        
    });
    
	//点击停止录制
    $('.stop').click(function(){
        
        $('.stop').hide();
        
        $('.reload').show();
        
        stopCount();
        
		wx.stopRecord({
			
			success: function (res) {
				
				voice.localId = res.localId;
				
			},
			
			fail: function (res) {
				
				alert(JSON.stringify(res));
				
			}
			
		});

    });
    
	//点击重新录制
    $('.reload').click(function(){
        
        $('.stop').show();
        
        $('.reload').hide();
        
        timedCount();
        
		wx.startRecord({
			
			cancel: function () {
				
				alert('用户拒绝授权录音');
				
			}
		
		});
		
    });
    
    //点击播放
    $('.play').click(function(){
        
    	document.getElementById('sounds').pause();
    	
        $('.play').hide();
        
        $('.pause').show();
        
		if (voice.localId == '') {
			
			alert('请先使用 startRecord 接口录制一段声音');
			
			return;
			
		}
		
		wx.playVoice({
			
			localId: voice.localId
			
		});
		
    });
    
    //点击暂停
    $('.pause').click(function(){
        
        $('.play').show();
        
        $('.pause').hide();
        
		wx.pauseVoice({
			
			localId: voice.localId
			
		});
        
    });
    
    //点击跳转
    $('.done').click(function(){
        
		if (voice.localId == '') {
			
			alert('请先使用 startRecord 接口录制一段声音');
			
			return;
			
		}
		wx.uploadVoice({
			
			localId: voice.localId,
			
			success: function (res) {
				
				voice.serverId = res.serverId;
				
				var url ="wx_downloadMedia.php";
				
				var param = {
					"openid":openId ,
					"type" : "voice",
					"media_id":voice.serverId,
				};
				
				postAjax(url,param,function(data){
					
					if(data.info==true){
							
						window.location.href = "share.php?openid="+openId;
								
					}
						
				});
			}
		
		});
        
    });
    
    //从手机中选择图片
    $('.top').click(function(){
    	
		wx.chooseImage({
			
			count: 1,
			
		    sizeType: ['original', 'compressed'],
		    
		    sourceType: ['album', 'camera'],
		    
			success: function (res) {
				
				images.localId = res.localIds;
				
				$('#text_pic').hide();
				
				$('#picture').attr('src',images.localId[0]);
				
				uploadImage();
				
			}
		
		});
		
    });
    
    function uploadImage(){
    	
		wx.uploadImage({
			
			localId: images.localId[0],
			
			isShowProgressTips: 1,
			
			success: function (res) {
				
				images.serverId = res.serverId;
				
				var urls ="wx_downloadMedia.php";
				
				var params = {
					"openid":openId,
					"type" : "image",
					"media_id":images.serverId,
				};
				
				postAjax(urls,params,function(datas){
					
					if(datas.info==true){
						
						console.log("图片上传成功!");
						
					}else{
						
						alert("图片上传失败!");
						
					}
					
				});
			},
			
			fail: function (res) {
				
				alert("上传图片失败!"+JSON.stringify(res));
				
			}
			
		});
    	    
    }
    
    var canPlay = true;
    
    //点击音乐
    $('.playMusic').click(function(){
        
        if(canPlay){
        	
            document.getElementById('sounds').pause();
            
            $('.playMusic').css({'animation':"none"});
            
            canPlay =false;
            
        }else{
        	
            document.getElementById('sounds').play();
            
            $('.playMusic').css({'animation':"rotae 5s infinite linear;"});
            
            canPlay =true;
            
        };
        
    });
    
    $('.shareBtn').click(function(){
    	
        $('#shareCover').show();
        
        $('.shareBottom').hide();
        
        $('.chichen').hide();
        
        $('.shareTop').hide();
        
    });
    
    $('#shareCover').click(function(){
    	
        $('.shareBottom').show();
        
        $('.chichen').show();
        
        $('.shareTop').show();
        
        $('#shareCover').hide();
        
    });
    
    //分享成功播放
    $('.startSound').click(function(){
        
        $('.startSound').hide();
        
        $('.stopSound').show();
        
        document.getElementById('sounds').pause();
        
        document.getElementById('newSound').play();
        
    });
    
    //分享成功暂停
    $('.stopSound').click(function(){
        
        $('.startSound').show();
        
        $('.stopSound').hide();
        
        document.getElementById('newSound').pause();
        
    });
    
    //跳转回授权认证
    $('.make').click(function(){
        
    	window.location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf508733f4f12c592&redirect_uri=http%3a%2f%2fwww.brandxspace.com%2fwx_media_voice%2findex.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        
    });
    
});



