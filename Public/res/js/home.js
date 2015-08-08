/**
 * Created by SDX on 2014/9/4.
 * vision:1.0
 * title:
 * e-mail:jrshenduxian@jd.com
 */
$(function () {
    //顶部轮播
    var $slideHolder = $("#slider");
    var $scrollHolder = $("#scrollHolder");
    var $pagination = $("#slideCircle");
    var myWebSlider = new WebSlider({
        slideHolder: $slideHolder,
        scrollHolder: $scrollHolder,
        pagination: $pagination,
        currentClass: "swiper-active-switch"
    });

    //回到顶部和定位导航栏目
    var $navHolder = $("#navHolder");
    var navShow = false;
    $(window).scroll(function () {
        $navHolder.css("height", 0);
        var scroTop = $(window).scrollTop(),
            tabulTop = $(".tabul-box").offset().top;
        if (tabulTop - scroTop <= 5) {
            $(".tabul-div").addClass("tabul-fixed");
        } else {
            $(".tabul-div").removeClass("tabul-fixed");
        }

    });
    goToTop($("#goTop"));

    //顶部引流条
    $("#guideIcon").on("click",function () {
        if (navShow) {
            $navHolder.css("height", "0");
        } else {
            $navHolder.css("height", "79px");
        }
        navShow = !navShow;
    });
    //关闭顶部黑色提示框
    $(".tip-fq-close").on("click",function(){
        $(".tip-faqi").hide();
    })
})
