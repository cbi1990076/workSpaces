/**
 * Created by NoctisLee on 2016/12/28.
 */
//微信分享
var _wx_JsConfig = {};
_wx_JsConfig.title = "一段话 一份情";
_wx_JsConfig.content = "在即将到来的元宵佳节里，说出你的心里话！",
_wx_JsConfig.appid = "wxf508733f4f12c592";
if (_wx_JsConfig.imgUrl == null) {
    _wx_JsConfig.imgUrl = "http://www.brandxfrance.com/share/images/brand.png";
}
if (_wx_JsConfig.timeLineLink == null) {
    _wx_JsConfig.timeLineLink = location.href;
}
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
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareQZone',
            'startRecord',
            'stopRecord',
            'uploadVoice',
            'playVoice',
            'pauseVoice',
            'chooseImage',
            'uploadImage',
            'downloadVoice'
        ]
    });
    wx.error(function(res){
        console.log(res);
        alert('内部系统错误!无法正确分享,请注意!');
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。

    });
    myShare();
})

function myShare() {
    wx.ready(function () {
        //alert(_wx_JsConfig);
        console.log(_wx_JsConfig);
        //分享朋友圈
        wx.onMenuShareTimeline({
            title: _wx_JsConfig.title,
            desc: _wx_JsConfig.content, // 分享描述
            link: _wx_JsConfig.timeLineLink,
            imgUrl: _wx_JsConfig.imgUrl,
            success: function () {
                alert("已分享到朋友圈");
            },
            cancel: function () {

            }
        });
        //分享朋友
        wx.onMenuShareAppMessage({
            //title: _wx_JsConfig.title,
            //desc: _wx_JsConfig.content,
            title: _wx_JsConfig.title, // 分享标题
            desc:  _wx_JsConfig.content,// 分享描述
            link: _wx_JsConfig.timeLineLink, // 分享链接
            imgUrl: _wx_JsConfig.imgUrl, // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                alert("已分享给朋友");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }

        });
        //分享给QQ好友
        wx.onMenuShareQQ({
            title: _wx_JsConfig.title,
            desc: _wx_JsConfig.content,
            //link: _wx_JsConfig.timeLineLink,
            //imgUrl: _wx_JsConfig.imgUrl,
            success: function () {
                //用户确认分享后执行的回调函数
             //   $.alert("分享给QQ");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        //分享到QQ空间
        wx.onMenuShareQZone({
            title: _wx_JsConfig.title,
            desc: _wx_JsConfig.content,
            link: _wx_JsConfig.timeLineLink,
            imgUrl: _wx_JsConfig.imgUrl,
            success: function () {
                // 用户确认分享后执行的回调函数
            //    $.alert("分享到QQ空间");
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

    });

}
