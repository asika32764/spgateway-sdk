<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Pay2Go\Feedback\VACC;
use Windwalker\Pay2Go\FeedbackReceiver;
use Windwalker\Renderer\AbstractRenderer;

/**
 * @var  AbstractRenderer     $this
 * @var  FeedbackReceiver $feedback
 * @var  VACC                 $payment
 */
$feedback = $data->feedback;
$payment  = $data->feedback->payment;
?>
<p>
	您可透過自己的網路銀行或 ATM 櫃員機完成轉帳
</p>

<table class="<?php echo $data->table_class ?>">
	<tr>
		<th width="<?php echo $data->title_width ?>">付款方式</th>
		<td><?php echo \Windwalker\Pay2Go\Pay2GoHelper::getPaymentTitle($feedback->getPaymentType()) ?></td>
	</tr>
	<tr>
		<th>銀行代碼</th>
		<td><?php echo $this->escape($payment->getBankCode()); ?></td>
	</tr>
	<tr>
		<th>轉帳帳號</th>
		<td><?php echo $this->escape($payment->getCodeNo()); ?></td>
	</tr>
	<tr>
		<th>金額</th>
		<td><?php echo $this->escape(number_format($feedback->getAmt(), 0)); ?></td>
	</tr>
	<tr>
		<th>訂單編號</th>
		<td><?php echo $this->escape($feedback->getMerchantOrderNo()) ?></td>
	</tr>
	<tr>
		<th>有效付款期限</th>
		<td><?php echo $this->escape($feedback->getExpireDate()) ?> 23:59:59 止</td>
	</tr>
</table>