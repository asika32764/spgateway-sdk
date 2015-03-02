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
	付款資料接收中
</p>

<table class="<?php echo $data->table_class ?>">
	<tr>
		<th width="<?php echo $data->title_width ?>">付款方式</th>
		<td><?php echo \Windwalker\Pay2Go\Pay2GoHelper::getPaymentTitle($feedback->getPaymentType()) ?></td>
	</tr>
	<tr>
		<th>金額</th>
		<td><?php echo $this->escape(number_format($feedback->getAmt(), 0)); ?></td>
	</tr>
	<tr>
		<th>訂單編號</th>
		<td><?php echo $this->escape($feedback->getMerchantOrderNo()) ?></td>
	</tr>
</table>