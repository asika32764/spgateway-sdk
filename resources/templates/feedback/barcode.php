<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Pay2Go\Feedback\Barcode;
use Windwalker\Pay2Go\LaterPaymentFeedback;
use Windwalker\Renderer\AbstractRenderer;

/**
 * @var  AbstractRenderer     $this
 * @var  LaterPaymentFeedback $feedback
 * @var  Barcode              $payment
 */
$feedback = $data->feedback;
$payment  = $data->feedback->payment;
?>

<p>
	四大超商、農漁會通路 皆可代收款項。
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
	<tr>
		<th>有效付款期限</th>
		<td><?php echo $this->escape($feedback->getExpireDate()) ?></td>
	</tr>
	<?php if ($data->print_barcode_url): ?>
	<tr>
		<th>付款單</th>
		<td>
			<a href="<?php echo $data->print_barcode_url; ?>" target="_blank">
				按此列印
			</a>
		</td>
	</tr>
	<?php endif; ?>
</table>
