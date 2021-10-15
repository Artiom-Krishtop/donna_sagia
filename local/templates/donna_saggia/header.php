<?php

$curPage = $APPLICATION->GetCurPage(true);

 ?>

<!DOCTYPE html>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.flexslider.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="scripts/slick.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.fancybox.js"></script>
  <script type="text/javascript" src="scripts/jquery.zoom.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.fancybox-media.js"></script>
	<script type="text/javascript" src="scripts/scripts.js"></script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->
	<? $APPLICATION->ShowHead(); ?>
</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<section id="wrapper">

  <!-- start header -->
<!-- ИЗМЕНИТЬ ССЫЛКУ -->
  <header id="header">
    <div class="inner">
			<div id="logo">
				<?php $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/logo_company_donna.php",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => ""
	),
	false
); ?>
      </div>

      <div class="search-section">
        <!-- start form -->
        <form action="" method="post">
          <fieldset>
            <div class="search">
              <input type="text" name="search-input" placeholder="Поиск по названию и номеру артикула" value="" />
              <input type="submit" name="submit" value="" />
            </div>
          </fieldset>
        </form>
        <!-- end of form -->
      </div>

      <div class="phones">
        <div class="phone">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						[
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/telephone_donna_1.php"
						],
						false
					);?>
          <span>розница (будни, 10:00-19:00)</span>
        </div>

        <div class="phone">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						[
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/telephone_donna_2.php"
						],
						false
					);?>
          <span>опт (будни, 9:00-18:00)</span>
        </div>
      </div>

			<!-- bascket -->

      <div class="acount-info">
        <!-- <div class="login">
          <a href="#">Зарегистрироваться</a>
          <a href="#">Войти</a>
        </div> -->

        <div class="bag">
					<?$APPLICATION->IncludeComponent(
						"bitrix:sale.basket.basket.line",
						"bootstrap_v4",
						array(
							"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
							"PATH_TO_PERSONAL" => SITE_DIR."personal/",
							"SHOW_PERSONAL_LINK" => "N",
							"SHOW_NUM_PRODUCTS" => "Y",
							"SHOW_TOTAL_PRICE" => "Y",
							"SHOW_PRODUCTS" => "N",
							"POSITION_FIXED" =>"N",
							"SHOW_AUTHOR" => "Y",
							"PATH_TO_REGISTER" => SITE_DIR."login/",
							"PATH_TO_PROFILE" => SITE_DIR."personal/"
						),
						false,
						array()
					);?>
          <!-- В корзине 2 товара<br/>
          на сумму 217 590 руб. -->
        </div>
      </div>

			<!-- end bascket -->

      <div class="mobile-menu"><span></span><div>МЕНЮ</div></div>
    </div>
  </header>
  <!-- end of header -->

  <!-- start navigation -->
	<nav id="navi">

		<?php $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"donna", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_THEME" => "site",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "donna"
	),
	false
); ?>

</nav>
  <!-- end of navigation -->

	<!--region breadcrumb-->
	<?if ($curPage != SITE_DIR."index.php"):?>
	<div class="breadcrumbs">

				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"universal",
					array(
						"START_FROM" => "0",
						"PATH" => "",
						"SITE_ID" => "-"
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>

	</div>
		<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>
	<?endif?>
	<!--endregion-->
</div>
