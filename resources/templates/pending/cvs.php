<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Asika\Spgateway\Pending\CVS;
use Asika\Spgateway\PendingReceiver;
use Windwalker\Renderer\AbstractRenderer;

/**
 * @var  AbstractRenderer $this
 * @var  PendingReceiver  $pending
 * @var  CVS              $payment
 */
$payment  = $pending->payment;
?>
<p>
	請記錄您的付款資訊，並於付款期限內完成支付。
</p>

<p>
	您可至四大超商任意門市列印付款單並立即完成付款。
</p>

<table class="<?php echo $table_class ?>">
	<tr>
		<th width="<?php echo $title_width ?>">付款方式</th>
		<td><?php echo \Asika\Spgateway\SpgatewayHelper::getPaymentTitle($pending->getPaymentType()) ?></td>
	</tr>
	<tr>
		<th>超商代碼</th>
		<td><?php echo $this->escape($payment->getCodeNo()); ?></td>
	</tr>
	<tr>
		<th>金額</th>
		<td><?php echo $this->escape(number_format($pending->getAmt(), 0)); ?></td>
	</tr>
	<tr>
		<th>訂單編號</th>
		<td><?php echo $this->escape($pending->getMerchantOrderNo()) ?></td>
	</tr>
	<tr>
		<th>有效付款期限</th>
		<td><?php echo $this->escape($pending->getExpireDate()) ?> 23:59:59 止</td>
	</tr>
</table>