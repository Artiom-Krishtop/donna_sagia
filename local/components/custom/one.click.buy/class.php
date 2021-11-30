<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Main\Engine\Response\AjaxJson,
    Bitrix\Main\ErrorCollection,
    Bitrix\Main\Context,
    Bitrix\Main\Error,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Fuser;


class OneClickComponent extends CBitrixComponent implements Controllerable
{
  const ONE_CLICK_ID = 20;
  const PERSON_TYPE_ID = 1;

  /** @var ErrorCollection */
  protected $errorCollection;

  protected $basket;
  protected $order;

  function onPrepareComponentParams($arParams)
  {
    $arParams['ID'] = isset($arParams['ID'])?intval($arParams['ID']):'';
    $this->errorCollection = new ErrorCollection();
    return $arParams;
  }

  public function configureActions()
  {
    return [
      'createOrder' => [
        'prefilters' => []
      ],
      'getFormEnterNumber' => [
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

    global $USER;

    if (!$this->moduleSaleInclude()) {
      $this->errorCollection[] = new Error('Модуль не установлен');
    }

    $this->getInitBasket($product);

    $this->basket->refresh();

    $userId = $USER->isAuthorized()?$USER->GetID():CSaleUser::GetAnonymousUserID();
    $currency = isset($product['CURRENCY'])?$product['CURRENCY']:null;

    $this->order = Order::create(SITE_ID, $userId, $currency);

    $this->setPropertyOrder($product);

    $this->order->setPersonTypeId(self::PERSON_TYPE_ID);
    $this->order->setBasket($this->basket);

    $r = $this->order->save();
    if (!$r->isSuccess())
    {
      $this->errorCollection[] =  new Error($r->getErrorMessages());
    }

    if ($this->errorCollection->count() !== 0) {
      return AjaxJson::createError($this->errorCollection);
    }

    return AjaxJson::createSuccess();
  }

  protected function getInitBasket($product)
  {
    if ($product['EMPTY_BASKET'] === true) {
      $this->basket = Basket::create(SITE_ID);
      $this->setPropsBasketItem($product);
    }else {
      $this->basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());
    }
  }

  protected function setPropsBasketItem($product)
  {
    $item = $this->basket->createItem('catalog', $product['ID']);

    if (!empty($product['QUANTITY'])) {
      $item->setField('QUANTITY', $product['QUANTITY']);
    }else{
      $item->setField('QUANTITY', 1);
    }

    if (!empty($product['CURRENCY'])) {
      $item->setField('CURRENCY', $product['CURRENCY']);
    }

    $item->setField('PRODUCT_PROVIDER_CLASS', '\Bitrix\Catalog\Product\CatalogProvider');
  }

  protected function setPropertyOrder($product)
  {
    $collectionPropsOrder = $this->order->getPropertyCollection();

    $propsPhone = $collectionPropsOrder->getPhone();
    $propsPhone->setField('VALUE', $product['PHONE_NUMBER']);

    $propsOneClick = $collectionPropsOrder->getItemByOrderPropertyID(self::ONE_CLICK_ID);

    if (!$propsOneClick) {
      $propsOneClick = $collectionPropsOrder->createItem([
        'NAME' => 'Один клик',
        'TYPE' => 'STRING',
        'CODE' => 'ONE_CLICK',
      ]);
    }

    $propsOneClick->setField('VALUE', 'Куплено в один клик');
  }

  protected function moduleSaleInclude()
  {
    if(CModule::IncludeModule('sale'))
      return true;
  }
}
