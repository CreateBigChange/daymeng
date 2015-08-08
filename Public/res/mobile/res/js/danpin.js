/**
 * Created by SDX on 2014/8/19.
 * vision:1.0
 * title:
 * e-mail:jrshenduxian@jd.com
 */
var inWx = false;


$(function () {
    //更多按钮
    var $moreBtn = $(".more-btn");
    $moreBtn.each(function () {
        new MoreBtn({
            "btn": $(this),
            "infoMin": $(this).parents("li").children(".info-min"),
            "infoAll": $(this).parents("li").children(".info-all")
        });
    })

    //弹出遮罩层
    var $wxShareLayer1 = $("#wxShareLayer-1"); //不在微信客户端内
    var $wxShareLayer2 = $("#wxShareLayer-2"); //在微信客户端内
    var $wxShareCloseBtn = $(".wxShareCloseBtn");
    var shareLayerShow = false;

    var $wxShareBtn = $("#wxShareBtn");
    var noScroll = function (e) {
        e.preventDefault();
        return false;
    }
    $wxShareBtn.on("touchend", function (e) {
        e.preventDefault();
        if (!shareLayerShow) {
            shareLayerShow = true;
            $(document).on("touchmove", noScroll);
            if (inWx) {
                $wxShareLayer2.show();
            } else {
                $wxShareLayer1.show();
            }
        }

    });

    $wxShareLayer1.on("touchend", function (e) {
        e.preventDefault();
        shareLayerShow = false;
        $(this).hide();
        $(document).off("touchmove", noScroll);
    })
    $wxShareLayer2.on("touchend", function () {
        e.preventDefault();
        $(this).hide();
        $(document).off("touchmove", noScroll);
    })

})

var pageInWx = function () {
    inWx = true;
}

if (document.addEventListener) {
    document.addEventListener('WeixinJSBridgeReady', pageInWx, false);
} else if (document.attachEvent) {
    document.attachEvent('WeixinJSBridgeReady', pageInWx);
    document.attachEvent('onWeixinJSBridgeReady', pageInWx);
}