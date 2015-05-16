# A Pay2GO PHP Package

開發中，還要一陣子才完成...

## 使用範例

``` php
$pay2go = new Pay2Go('MerchantID', 'key', 'iv');

$pay2go->setTest(true) // Use Test Platform
	->setMerchantOrderNo($orderNo)
	->setVersion('1.1')
	->setAmt((int) $price)
	->setRespondType(Pay2Go::RESPONSE_TYPE_STRING) // Use String response
	->setItemDesc($desc)
	->setEmail($email)
	->setLoginType(0)
	->setNotifyURL($notifyUrl)
	->setReturnURL($returnUrl)
	->setCustomerURL($customUrl);

$pay2go->atm->enable();
$pay2go->barcode->enable();
$pay2go->cvs->enable();
$pay2go->webATM->enable();

$pay2go->creditCard->enable()
	->setUNIONPAY(1)
	->installment('3, 6, 12');

$pay2go->alipay->enable()
	->setReceiver('Sakura')
	->setTel1('123-12312-123')
	->setTel2('123-123-123')
	->setCount(1)
	->addProduct(
		$item->id,
		$item->title,
		$desc,
		$item->price,
		1
	);

$pay2go->tenpay->enable()
	->setReceiver('Flower')
	->setTel1('123-12312-123')
	->setTel2('123-123-123')
	->setCount(1)
	->addProduct(
		$item->id,
		$item->title,
		$desc,
		(int) $price,
		1
	);

echo $pay2go->redner(); // Render HTML Form
```



