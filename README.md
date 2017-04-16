# A Spgateway PHP Package

Beta 中，因開發倉促，有錯誤請回報，或者發 PR 協助修改。

## 安裝

```bash
composer require asika/spgateway
```

如要使用 Receiver 的 render 功能，請安裝 `windwalker/renderer`

## 使用範例

```php
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

// 或是立即 POST (會印出 form 然後用 JS 立即 submit)
$spgateway->post();
```

## 獲取繳費資訊

在你的 ReturnUrl 中，直接呼叫 `PaidReceiver` 取得回應資料。

```php
$receiver = new \Asika\Spgateway\PaidReceiver('MerchantID', 'key', 'iv');
$receiver->setData($_POST);

// You can log data here

// Check transaction status 
if ($receiver->getStatus() !== \Asika\Spgateway\Payment\AbstractPayment::STATUS_SUCCESS)
{
    // SDK 會幫您自動翻譯 Status Code 成為中文
    throw new \RuntimeException($receiver->getMessage(), 400);
}

// Validate transaction
if (!$receiver->validate())
{
    throw new \RuntimeException('訂單驗證失敗', 403);
}

// 以下的 $myOrder 是模擬資料，請代換成您所用框架的寫法

// WebATM & 信用卡 屬於立即繳費完成的管道，可以直接將 order 設為成功
if ($receiver->payment->isInstantPayment())
{
    $myOrder->state = 'success';
}
// 不然就屬於 Deferral payment，將 order 設為 pending 等待使用者付費
else
{
    $myOrder->state = 'pending';
}

$myOrder->id      = $receiver->getMerchantOrderNo();
$myOrder->expired = $receiver->getExpireDate();
$myOrder->payment = $receiver->getPaymentType();
$myOrder->returned_data = json_encode($_POST); // Save return data for future use.

// Save order
$myOrder->save();
```

用相同的方法寫在 NotifyUrl 中

```php
$receiver = new \Asika\Spgateway\PaidReceiver('MerchantID', 'key', 'iv');
$receiver->setData($_POST);

// Validate transaction
if (!$receiver->validate())
{
    // Log error

    throw new \RuntimeException('訂單驗證失敗', 403);
}

if ($receiver->getStatus() !== \Asika\Spgateway\Payment\AbstractPayment::STATUS_SUCCESS)
{
    // Log error

    throw new \RuntimeException($receiver->getMessage(), 400);
}

// 直接設 order 為繳費成功
$myOrder->id      = $receiver->getMerchantOrderNo();
$myOrder->state   = 'success';
$myOrder->expired = '';
$myOrder->returned_data = json_encode($_POST); // Save return data for future use.

// Save order (Use your own framework method)
$myOrder->save();
```

## 在訂單內顯示等待繳款資訊

如果您要在尚未付款的訂單頁面中，產生一個 table 來顯示等待繳款資訊，提醒使用者目前選用的付款方式，可以用 `PendingReceiver`

```php
$receiver = new \Asika\Spgateway\PendingReceiver;

// 在 ReutnrUrl 就要存好 returned_data
$receiver->setData(json_decode($myOrder->returned_data, true));

echo $receiver->render((['table_class' => 'table table-striped', 'title_width' => '200']);
```

## 在已繳款訂單內顯示繳款資訊

如果訂單已經繳款成功，我們改用 `PaidReceiver` 來印 table

```php
$receiver = new \Asika\Spgateway\PaidReceiver; // 不需要 api key

$receiver->setData(json_decode($myOrder->returned_data, true));

echo $receiver->render((['table_class' => 'table table-striped', 'title_width' => '200']);
```
