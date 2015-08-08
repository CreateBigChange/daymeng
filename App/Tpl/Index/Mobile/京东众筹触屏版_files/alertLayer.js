/**
 * Created by SDX on 2014/11/10.
 * vision:1.0
 * title:
 * e-mail:jrshenduxian@jd.com
 */

    var $supportBtn_tmp = $(".btn-red");
    var $alertLayer_tmp = $(".alert-layer");
    var $closeEle_tmp = $(".close-ele");
    var $mask_tmp = $alertLayer_tmp.find(".mask");

    $closeEle_tmp.on("touchend", function (e) {
        e.preventDefault();
        $alertLayer_tmp.hide();
    })
    $mask_tmp.on("touchmove", function (e) {
        e.preventDefault();

    })

    function alertLayer(type) {
        if (type == 1) {
            $alertLayer_tmp.eq(0).show();
        } else {
            $alertLayer_tmp.eq(1).show();
        }
    }



