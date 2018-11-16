jQuery(document).ready(function($){
  $('[data-slick]').each(function(){
    const dataName = eval('slickAttr' + $(this).data('slick'));
    $(dataName.slideAttach).slick({
      autoplay: dataName.atts.autoplay,
      autoplaySpeed: dataName.atts.autoplaySpeed,
      arrows: dataName.atts.arrows,
      dots: dataName.atts.dots,
      fade: dataName.atts.fade,
      infinite: dataName.atts.infinite,
      pauseOnHover: dataName.atts.pauseOnHover,
      slidesToScroll: dataName.atts.slidesToScroll,
      slidesToShow:  dataName.atts.slidesToShow
    });
  });
});


