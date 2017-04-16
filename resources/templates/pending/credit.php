<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Asika\Spgateway\Pending\VACC;
use Asika\Spgateway\PendingReceiver;
use Windwalker\Renderer\AbstractRenderer;

/**
 * @var  AbstractRenderer $this
 * @var  PendingReceiver  $pending
 * @var  VACC             $payment
 */
$payment  = $pending->payment;
?>
<p>
	付款資料接收中
</p>

<table class="<?php echo $table_class ?>">
	<tr>
		<th width="<?php echo $title_width ?>">付款方式</th>
		<td><?php echo \Asika\Spgateway\SpgatewayHelper::getPaymentTitle($pending->getPaymentType()) ?></td>
	</tr>
	<tr>
		<th>金額</th>
		<td><?php echo $this->escape(number_format($pending->getAmt(), 0)); ?></td>
	</tr>
	<tr>
		<th>訂單編號</th>
		<td><?php echo $this->escape($pending->getMerchantOrderNo()) ?></td>
	</tr>
</table>