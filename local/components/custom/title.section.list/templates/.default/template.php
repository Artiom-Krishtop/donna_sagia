<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<section class="categories">
      <div class="inner">
        <?php foreach ($arResult['SECTIONS'] as $key => $section): ?>
<?php echo $key ?>
        <div class="cat-item">
          <a class="first" href="<?=$section['SECTION_PAGE_URL'] ?>">
            <img src="<?=$section['PICTURE']['SRC'] ?>">
            <span class="cat-title"><?=$section['NAME'] ?></span>
          </a>

          <!-- <a class="last" href="#">
            <img src="images/cat-1.jpg" alt="" >
            <span class="cat-title">Платья</span>
          </a> -->
        </div>
      <?php endforeach; ?>
      </div>
    </section>
