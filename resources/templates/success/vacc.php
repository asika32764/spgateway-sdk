<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Pay2Go\PaidReceiver;
use Windwalker\Pay2Go\Receiver\VACC;
use Windwalker\Renderer\AbstractRenderer;

/**
 * @var  AbstractRenderer $this
 * @var  PaidReceiver     $receiver
 * @var  VACC              $payment
 */
$receiver = $data->receiver;
$payment  = $data->receiver->payment;
?>
<table class="<?php echo $data->table_class ?>">
	<tr>
		<th width="<?php echo $data->title_width ?>">付款方式</th>
		<td><?php echo \Windwalker\Pay2Go\Pay2GoHelper::getPaymentTitle($receiver->getPaymentType()) ?></td>
	</tr>
	<tr>
		<th>金額</th>
		<td><?php echo $this->escape(number_format($receiver->getAmt(), 0)); ?></td>
	</tr>
	<tr>
		<th>訂單編號</th>
		<td><?php echo $this->escape($receiver->getMerchantOrderNo()) ?></td>
	</tr>
	<tr>
		<th>支付完成時間</th>
		<td><?php echo $this->escape($receiver->getPayTime()) ?></td>
	</tr>
	<tr>
		<th>付款銀行</th>
		<td><?php echo $this->escape($payment->getPayBankCode()) ?></td>
	</tr>
	<tr>
		<th>付款帳號末五碼</th>
		<td><?php echo $this->escape($payment->getPayerAccount5Code()) ?></td>
	</tr>
	<tr>
		<th>系統交易序號</th>
		<td><?php echo $this->escape($receiver->getTradeNo()) ?></td>
	</tr>
</table>
