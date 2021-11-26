<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Engine\Contract\Controllerable;


class OneClickComponent extends CBitrixComponent implements Controllerable
{
  function onPrepareComponentParams($arParams)
  {
    return $arParams;
  }

  public function configureActions()
  {
    return [];
  }

  public function getFormEnterNumberAction()
  {
    $html = '<div class="contact-form" data-entity="contact-form">
        			<form action="">
        				<div class="form-line">
        					<label>Контактный телефон</label>
        					<fieldset><div class="row"><input type="tel" name="" ><p>Например, 9171234567</p></div></fieldset>
        				</div>
        				<input type="button" value="Оформить заказ">
        			</form>
        		</div>';

    return $html;
  }

  function executeComponent()
  {
    $this->includeComponentTemplate();
  }

  protected function createOrder($products, )
  {
    $products = [
      [
        'PRODUCT_ID' => 135,
        'PRODUCT_PROVIDER_CLASS' => '\Bitrix\Catalog\Product\CatalogProvider',
        'NAME' => 'Товар 1',
        'PRICE' => 500,
        'CURRENCY' => 'RUB', 
        'QUANTITY' => 5,
      ]
    ];

    $basket = Bitrix\Sale\Basket::create('s1');

    foreach ($products as $product)
    {
        $item = $basket->createItem("catalog", $product["PRODUCT_ID"]);
        unset($product["PRODUCT_ID"]);
        $item->setFields($product);
    }

    $siteId = 's1'; // код сайта
    $userId = 1; // ID пользователя
    $order = \Bitrix\Sale\Order::create($siteId, $userId);

    $order->setPersonTypeId(1); // 1 - ID типа плательщика

    $order->setBasket($basket);

    $shipmentCollection = $order->getShipmentCollection();
    $shipment = $shipmentCollection->createItem(
        Bitrix\Sale\Delivery\Services\Manager::getObjectById(1) // 1 - ID службы доставки
    );

    $shipmentItemCollection = $shipment->getShipmentItemCollection();

    foreach ($basket as $basketItem)
    {
        $item = $shipmentItemCollection->createItem($basketItem);
        $item->setQuantity($basketItem->getQuantity());
    }

    $paymentCollection = $order->getPaymentCollection();
    $payment = $paymentCollection->createItem(
        Bitrix\Sale\PaySystem\Manager::getObjectById(1) // 1 - ID платежной системы
    );

    $payment->setField("SUM", $order->getPrice());
    $payment->setField("CURRENCY", $order->getCurrency());

    $r = $order->save();
    if (!$r->isSuccess())
    {
        var_dump($r->getErrorMessages());
    }
  }
}
