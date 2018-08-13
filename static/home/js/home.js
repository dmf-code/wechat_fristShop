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