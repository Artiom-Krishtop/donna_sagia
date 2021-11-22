<!-- start footer -->
<footer id="footer">
  <div class="inner">
    <div class="footer-phones">
      <div class="footer-phone">
        <span class="number"><?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          [
          "AREA_FILE_SHOW" => "file",
          "PATH" => SITE_DIR."include/telephone_donna_1.php"
          ],
          false
        );?></span><span class="label-phone">розничный отдел<br>(по будням с 10:00 до 19:00)</span>
      </div>

      <div class="footer-phone">
        <span class="number"><?$APPLICATION->IncludeComponent(
          "bitrix:main.include",
          "",
          [
          "AREA_FILE_SHOW" => "file",
          "PATH" => SITE_DIR."include/telephone_donna_2.php"
          ],
          false
        );?></span><span class="label-phone">оптовый отдел<br>(по будням с 9:00 до 18:00)</span>
      </div>
    </div>



      <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"donna_footer", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_THEME" => "site",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "podmenu",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "donna"
	),
	false
); ?>



    <div class="company-menu">
      <h3>Компания</h3>

      <ul>
        <li><a href="#">О нас</a></li>
        <li><a href="#">Контакты</a></li>
        <li><a href="#">Сертификаты</a></li>
      </ul>

      <ul>
        <li><a href="#">Новости</a></li>
        <li><a href="#">Статьи</a></li>
        <li><a href="#">Галерея</a></li>
      </ul>
    </div>

      <!-- social -->

    <div class="social">

      <h3>Социальные сети</h3>

      <?$APPLICATION->IncludeComponent(
	"bitrix:eshop.socnet.links",
	"donna",
	array(
		"COMPONENT_TEMPLATE" => "donna",
		"FACEBOOK" => "#",
		"VKONTAKTE" => "#",
		"TWITTER" => "",
		"GOOGLE" => "",
		"INSTAGRAM" => "#"
	),
	false
);  ?>

      <!-- end social -->


      <div class="subscribe-section">
        <!-- start form -->
        <form action="" method="post">
          <fieldset>
            <div class="subscribe">
              <input type="text" name="subscribe-input" placeholder="Подпишитесь на новости" value="" />
              <input type="submit" name="submit" value="" />
            </div>
          </fieldset>
        </form>
        <!-- end of form -->
      </div>
    </div>

    <p class="copyright">© 2015 Интернет-магазин женской одежды «Donna Saggia». Все права защищены</p>
  </div>
</footer>
<!-- end of footer -->

</section>
<!-- end of wrapper -->

</body>
</html>
