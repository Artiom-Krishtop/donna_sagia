<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CUtil::InitJSCore(array('jquery','jquery.flexslider.js'));

?>
<div class="carousel">
  <ul class="slides">
    <li style="background-image: url(include/slide.jpg);"></li>
    <li style="background-image: url(include/slide.jpg);"></li>
  </ul>
</div>
<script>
jQuery(document).ready(function() {
  $('.carousel').flexslider({
    controlNav: false,
  });
});
</script>
