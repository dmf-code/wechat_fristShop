/**
 * Created by DMF on 2018/1/3.
 */

var mySwiper = new Swiper('.swiper-container', {
    autoplay: 3000,
    speed: 500,
    loop: true,
    //方向
    direction: 'horizontal',
    // 如果需要分页器
    pagination: '.swiper-pagination',
    //用户操作swiper之后，是否禁止autoplay。
    autoplayDisableOnInteraction : false,
    observer:true,//修改swiper自己或子元素时，自动初始化swiper
    observeParents:true,//修改swiper的父元素时，自动初始化swiper
});

$(function(){
    var loading = false;
        $('#tab3').infinite().on("infinite", function () {
            if (loading) return;
            loading = true;
            $("#my-loadmore").html('<i class="weui-loading"></i> <span class="weui-loadmore__tips">正在加载</span>');
            setTimeout(function () {
                $("#list").append("<p> 我是新加载的内容 </p>");
                $('#my-loadmore').empty();
                loading = false;
            }, 2500);   //模拟延迟
        });
});
