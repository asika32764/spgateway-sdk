# A Spgateway PHP Package

開發中，還要一陣子才完成...

## 使用範例

``` php
$spgateway = new \Asika\Spgateway\Spgateway('MerchantID', 'key', 'iv');

// Basic options
$spgateway->setTest(true) // Use Test Platform
	->setMerchantOrderNo($orderNo)
	->setVersion('1.2')
	->setAmt((int) $price)
	->setRespondType(Spgateway::RESPONSE_TYPE_STRING) // Use String response
	->setItemDesc($desc)
	->setEmail($email)
	->setLoginType(0)
	->setNotifyURL($notifyUrl)
	->setReturnURL($returnUrl)
	->setCustomerURL($customUrl);

$spgateway->atm->enable();     // 啟用 ATM
$spgateway->barcode->enable(); // 啟用條碼
$spgateway->cvs->enable();     // 啟用超商代碼
$spgateway->webATM->enable();  // 啟用 Web ATM

// 啟用信用卡
$spgateway->creditCard->enable()
	->setUNIONPAY(1)
	->installment('3, 6, 12');

// 啟用支付寶
$spgateway->alipay->enable()
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

// 啟用財富通
$spgateway->tenpay->enable()
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

// 輸出成 <form> 直接 POST 即可繳費
echo $spgateway->redner('<button>Submit</button>'); // Render HTML Form
```



