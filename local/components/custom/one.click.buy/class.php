<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Main\Engine\Response\Component,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket;


class OneClickComponent extends CBitrixComponent implements Controllerable
{
  function onPrepareComponentParams($arParams)
  {
    $arParams['ID'] = intval($arParams['ID']);
    return $arParams;
  }

  public function configureActions()
  {
    return [
      'createOrder' => [
        'prefilters' => []
      ]
    ];
  }

  public function getFormEnterNumberAction()
  {
    ob_start();
    $this->includeComponentTemplate('form');
    $content = ob_get_contents();
    return new \Bitrix\Main\Engine\Response\AjaxJson($content);
  }

  function executeComponent()
  {
    $this->includeComponentTemplate();
  }

  public function createOrderAction($product)
  {
    // dd($product);
    global $USER;

    if(!CModule::IncludeModule('sale'))
      return;

    $basket = Basket::create(SITE_ID);

    $item = $basket->createItem('catalog', $product['ID']);

    if (!empty($product['QUANTITY'])) {
      $item->setField('QUANTITY', $product['QUANTITY']);
    }else{
      $item->setField('QUANTITY', 1);
    }

    if (!empty($product['CURRENCY'])) {
      $item->setField('CURRENCY', $product['CURRENCY']);
    }

    if (!empty($product['PHONE_NUMBER'])) {
      $item->setField('PHONE', $product['PHONE_NUMBER']);
    }

    $item->setField('PRODUCT_PROVIDER_CLASS', '\Bitrix\Catalog\Product\CatalogProvider');

    $basket->refresh();

    $userId = $USER->isAuthorized()?$userId = $USER->GetID():null;
    $currency = isset($product['CURRENCY'])?$product['CURRENCY']:null;

    $order = Order::create(SITE_ID, $userId, $currency);
    $order->setPersonTypeId(1);
    $order->setBasket($basket);
    $r = $order->save();
    if (!$r->isSuccess())
    {
        return ($r->getErrorMessages());
    }

    return true;
  }
}
