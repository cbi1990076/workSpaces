//声明参数
var openId;

var timestamp;

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

$(function() {
	
	var voice = {
		localId: '',
		serverId: ''
	};
	
	//点击录制声音
    $('.start').click(function () {
    	
        $('.start').hide();
        
        $('.stop').show();
        
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
        
		wx.stopRecord({
			
			success: function (res) {
				
				voice.localId = res.localId;
				
			},
			
			fail: function (res) {
				
				alert(JSON.stringify(res));
				
			}
			
		});

    });

    wx.translateVoice({
        localId: voice.localId, // 需要识别的音频的本地Id，由录音相关接口获得
        isShowProgressTips: 1, // 默认为1，显示进度提示
        success: function (res) {
            alert(res.translateResult); // 语音识别的结果
            var url ="wx_saveMedia.php";

            var param = {
                "openid":openId ,
                "type" : "voice",
                "localId":voice.localId,
                "serverId":voice.serverId,
                "timestamp":timestamp
            };

            postAjax(url,param,function(data){

                if(data.info==true){

                    window.location.href = "share.php?openId="+openId+"&timestamp="+timestamp;

                }

            });
        }

    });

});



