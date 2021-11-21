<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
?>
<?//return; ?>
<section id="container">
  <section class="categories">
    <div class="inner">
      <?php foreach ($arResult['SECTIONS'] as $key => $section): ?>
      <div class="cat-item">
        <a class="first" href="<?=$section['SECTION_PAGE_URL'] ?>">
          <img src="<?=$section['PICTURE']['SRC'] ?>">
          <span class="cat-title"><?=$section['NAME'] ?></span>
        </a>

        <a class="last" href="<?=$section['SECTION_PAGE_URL'] ?>">
          <img src="<?=$section['PICTURE']['SRC'] ?>">
          <span class="cat-title"><?=$section['NAME'] ?></span>
        </a>
      </div>
    <?php endforeach; ?>
    </div>
  </section>
</section>
