var _wx_JsConfig = {};
_wx_JsConfig.appid = "wxf508733f4f12c592";
_wx_JsConfig.timestamp = "";
_wx_JsConfig.nonceStr = "";
_wx_JsConfig.signature = "";

$(function () {
    $.ajax({
        url: "../../wxJs/wx_js.php",
        data: {url:location.href.split('#')[0]},
        type: "POST",
        async: false,
        success: function (data) {
            var wxJsCfg = $.parseJSON(data);
            _wx_JsConfig.timestamp = wxJsCfg.timestamp;
            _wx_JsConfig.nonceStr = wxJsCfg.nonceStr;
            _wx_JsConfig.signature = wxJsCfg.signature;
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("系统内部错误！");
        }
    });

    wx.config({
    	debug: false,
        appId: _wx_JsConfig.appid,
        timestamp: _wx_JsConfig.timestamp,
        nonceStr: _wx_JsConfig.nonceStr,
        signature: _wx_JsConfig.signature,
        jsApiList: [
            'startRecord',
            'stopRecord',
            'translateVoice'
        ]
    });
})
