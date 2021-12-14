class oneClickBuy {
  constructor(arParams)
  {
    this.params = arParams;
    this.init();
  }

  init()
  {
    this.obOneClickButton = BX('oneClickButton');
    this.obContactFormArea = BX('contact-form-area');

    if (this.obOneClickButton) {
      BX.bind(this.obOneClickButton, 'click', BX.proxy(this.getForm, this));
    }
  }

  getForm()
  {
    let self = this;

    BX.ajax.runComponentAction('custom:one.click.buy', 'getFormEnterNumber', {
      mode:'class',
      }).then(function(response){
        self.obContactFormArea.innerHTML = response.data;
    });
  }

  createOrder()
  {
    let self = this;

    this.setParams();

    BX.ajax.runComponentAction('custom:one.click.buy', 'createOrder', {
      mode:'class',
      data: {
        'product' : this.params
      },
      }).then(function(response){
        console.log(response);
        if (response.status === 'success') {
          BX.cleanNode(self.obContactFormArea);
          self.obContactFormArea.innerHTML = '<div style="color:green;"><h2>Заказ создан</h2></div>';
        }else{
          BX.cleanNode(self.obContactFormArea);
          self.obContactFormArea.innerHTML = '<div style="color:red;"><h2>Ошибка создания заказа</h2></div>';
        }
    });
  }

  setParams()
  {
    let number = this.obContactFormArea.querySelector('input');

    this.params['PHONE_NUMBER'] = number.value;

    if (typeof this.params.ID !== 'undefined') {
      let quantity = document.querySelector('input.quantity-value');
      this.params['QUANTITY'] = quantity.value;
    }
  }
}
