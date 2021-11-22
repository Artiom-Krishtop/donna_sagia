jQuery(document).ready(function() {
  //menu
  jQuery(".drop").on("click", function(){
    if(jQuery(this).hasClass("active")){
      jQuery(this).removeClass("active");
      jQuery(this).text("Развернуть опции");
      jQuery(this).next().slideUp()
    }else {
      jQuery(this).addClass("active");
      jQuery(this).text("Свернуть опции");
      jQuery(this).next().slideDown()
    }
  });

  //menu
  jQuery(".mobile-menu").on("click", function(){
    if(jQuery(this).hasClass("active")){
      jQuery(this).removeClass("active");
      jQuery("#navi").removeClass("active");
    }else {
      jQuery(this).addClass("active");
      jQuery("#navi").addClass("active");
    }
  });
});
