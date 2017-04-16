<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Asika\Spgateway\Pending\Barcode;
use Asika\Spgateway\PendingReceiver;
use Windwalker\Renderer\AbstractRenderer;

/**
 * @var  AbstractRenderer $this
 * @var  PendingReceiver  $pending
 * @var  Barcode          $payment
 */
$payment  = $pending->payment;
?>

<p>
	四大超商、農漁會通路 皆可代收款項。
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
	<tr>
		<th>有效付款期限</th>
		<td><?php echo $this->escape($pending->getExpireDate()) ?></td>
	</tr>
	<?php if ($print_barcode_url): ?>
	<tr>
		<th>付款單</th>
		<td>
			<a href="<?php echo $print_barcode_url; ?>" target="_blank">
				按此列印
			</a>
		</td>
	</tr>
	<?php endif; ?>
</table>
