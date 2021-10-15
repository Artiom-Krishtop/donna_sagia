<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
?><section>
<div class="carousel">
	<ul class="slides">
		<li style="background-image: url(images/slide.jpg);"></li>
		<li style="background-image: url(images/slide.jpg);"></li>
	</ul>
</div>
<div class="right-side">
 <a href="#" class="image" style="background-image: url(images/image.jpg);"> <span class="image-title">
	Платья Выберите ваш образ </span> </a> <a class="sale-home" href="#" style="background-image: url(images/sale.jpg);"></a>
</div>
 </section>
<!-- start container -->
<section id="container">
<!-- start categories -->
<section class="categories">
<div class="inner">
	<div class="cat-item">
 <a class="first" href="#"> <img src="images/cat-1.jpg" alt=""> <span class="cat-title">Платья</span> </a> <a class="last" href="#"> <img src="images/cat-1.jpg" alt=""> <span class="cat-title">Платья</span> </a>
	</div>
	<div class="cat-item">
 <a class="first" href="#"> <img src="images/cat-2.jpg" alt=""> <span class="cat-title">Нарядные платья</span> </a> <a class="last" href="#"> <img src="images/cat-2.jpg" alt=""> <span class="cat-title">Нарядные платья</span> </a>
	</div>
	<div class="cat-item">
 <a class="first" href="#"> <img src="images/cat-3.jpg" alt=""> <span class="cat-title">Блузки и топы</span> </a> <a class="last" href="#"> <img src="images/cat-3.jpg" alt=""> <span class="cat-title">Блузки и топы</span> </a>
	</div>
	<div class="cat-item">
 <a class="first" href="#"> <img src="images/cat-4.jpg" alt=""> <span class="cat-title">Юбки</span> </a> <a class="last" href="#"> <img src="images/cat-4.jpg" alt=""> <span class="cat-title">Юбки</span> </a>
	</div>
	<div class="cat-item">
 <a class="first" href="#"> <img src="images/cat-5.jpg" alt=""> <span class="cat-title">Кардиганы</span> </a> <a class="last" href="#"> <img src="images/cat-5.jpg" alt=""> <span class="cat-title">Кардиганы</span> </a>
	</div>
</div>
 </section>
<!-- end of categories -->


 </section>

 <!-- start news -->

<section class="news">
		<div class="inner">
			<div class="title-section">Новости</div>

			<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"donna", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "#SITE_DIR#/company/news/detail.php?ID=#ELEMENT_ID#",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "donna"
	),
	false
);?>

			<div class="button-section">
				<a class="see-all" href="/company/news/">Все новости</a>
			</div>
		</div>
	</section>

	<section id="container">

<!-- end of news --> <section class="description">
<div class="inner">
	<div class="title-section">
		 Интернет магазин женской одежды «Donna Saggia»
	</div>
	<p>
		 Спасибо, что посетили интернет магазин одежды «Donna Saggia». Наша компания будет очень рада представить вам на выбор наряды и платья оптом от российского производителя женской одежды, специализирующегося на продаже молодежных моделей и стильных фасонов для ценителей последних веяний в мировой моде.
	</p>
	<p>
		 Наш интернет магазин женской одежды рассчитан на группу людей разного возраста и общественного статуса, посетив наш магазин, Вы обязательно найдете то, что подходит именно Вам, а так же приглядеть подарки для близких людей. Поскольку это интернет, то шопинг можно осуществлять в любое удобное для Вас время: дома, в кафе, во время обеденного перерыва на работе или находясь в дороге.
	</p>
	<p>
		 Но так как менеджеры тоже живые люди, то получить полную консультацию по интересующему Вас вопросу или подтвердить Ваш заказ можно только в установленные рабочие часы. Выбрав вечернее платье именно в нашем магазине, Вы никогда не усомнитесь в своем выборе, поскольку у нас работает высококвалифицированная команда профессионалов, которая держит под контролем весь технологический процесс изготовления женской одежды, начиная от эскиза (неважно будь это трикотажное изделие, юбка - карандаш или летний сарафан) и заканчивая готовым изделием, уже на витрине сайта. Мы предоставляем большой выбор готовых решений, учитывая пожелания и потребности обслуживаемых нами клиентов.
	</p>
	<div class="button-section">
 <a class="see-all" href="#">Галерея</a>
	</div>
</div>
 </section> </section>
<!-- end of container --><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
