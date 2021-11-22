jQuery(document).ready(function() {
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
