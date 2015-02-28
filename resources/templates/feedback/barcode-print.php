<?php
/**
 * Part of asukademy project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Pay2Go\Barcode\BarcodeHelper;
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
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asukademy Barcode Page</title>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries
        [if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif] -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<style>
		body {
			line-height: 1.25;
			font-size: 15px;
		}

		/* Table */
		table.table {
			border-spacing: 0;
			border-collapse: collapse;
		}

		table.table > tbody > tr > td,
		table.table > thead > tr > th,
		table.table > tbody > tr > th {
			vertical-align : middle;
			border: 1px solid #ccc;
			padding: 5px;
		}

		table.full-table {
			width: 100%;
		}

		input, textarea {
			color : #000;
		}

		body {
			font-family : '微軟正黑體';
		}

		@media print
		{
			.mobile, .hide-print {
				display: none;
			}
		}

		@media screen and (min-width : 1024px) and (max-width : 2000px) {
			.pc {
				display : block;
			}

			.mobile {
				display : none;
			}
		}

		@media screen and (max-device-width : 640px) {
			.pc {
				display : none;
			}

			.mobile {
				display : block;
			}
		}

		@media screen and (min-width : 640px) and (max-width : 1024px) {
			.paycard2 tr td {
				line-height : 30px;
			}

			.pc {
				display : none;
			}

			.mobile {
				display : block;
			}

		}
	</style>
	<script>

	</script>
</head>

<body>

<div class="mobile">
	<div>
		<a href="<?php echo $data->site_url ? : '#' ?>" style="margin-top:30px">
			<img id="logo" src="<?php echo $data->logo_img ?>" style="max-width: 100%;">
		</a>
	</div>
	<h3 style="margin-top:10px; text-align: center">條碼繳費</h3>
	<div style=" border: #000 solid 2px;text-align: center">
		<p>
			<img src="<?php echo BarcodeHelper::generate($payment->getBarcode_1()) ?>" style=" margin-top:20px;width:100%">
		</p>
		<p>
			<img src="<?php echo BarcodeHelper::generate($payment->getBarcode_2()) ?>" style=" margin-top:20px;width:100%">
		</p>
		<p>
			<img src="<?php echo BarcodeHelper::generate($payment->getBarcode_3()) ?>" style=" margin-top:20px;width:100%">
		</p>
	</div>
	<div style="margin-top: 20px; ">
		<?php echo $this->load('feedback.barcode', array('table_class' => 'table full-table')); ?>
	</div>
	<div id="order_data" style="margin-top: 20px; margin-bottom: 10px;display: none">
		<?php $this->load('feedback.barcode'); ?>
	</div>
</div>

<!--電腦版-->
<div style="text-align:center; " class="pc hide-print">
	<button class="print-button" onclick="window.print()" style="margin-top:10px">
		列印條碼繳款單
	</button>
</div>
<div class="pc">
	<div id="print_here" style="width: 800px; margin: 0 auto;">
		<div class="print_area" id="block" style=" margin-top: 10px; ">
			<div style="text-align: center">
				<img src="<?php echo $data->logo_img ?>" style="max-height: 80px; max-width: 300px;">
			</div>
			<div class="main_title" style="text-align:center">
				<h1>條碼繳款單</h1>
				<h4>(四大超商、農漁會通路 皆可代收款項)</h4>
			</div>
			<div class="second_title" style="text-align:right; margin-top:5px">
				<h3>付款截止日： <?php echo $feedback->getExpireDate(); ?></h3>
			</div>
			<!---第一排開始-->
			<div class="table_content" style="margin-top: 10px;">
				<div class="content_table">
					<table class="table table-bordered"
						style="border:1px solid #ccc; width: 800px; margin-left: 10px; margin-bottom:10px;">

						<tbody>
						<tr>
							<th style="text-align: center">付款資訊</th>
							<th style="text-align: center">付款金額</th>
							<th style="text-align: center">代收通路商用印處</th>
							<th rowspan="2" style="width:20px;">本聯為客戶留存聯</th>
						</tr>

						<tr>
							<td align="left">
								<div>商店代號： <?php echo $this->escape($feedback->getMerchantID()); ?></div>
								<div>商店中文名稱： <?php echo $this->escape($feedback->getMerchantName()); ?></div>
								<div>商店訂單編號： <?php echo $this->escape($feedback->getMerchantOrderNo()); ?></div>
								<div>交易序號： <?php echo $this->escape($feedback->getTradeNo()); ?></div>
							</td>
							<td align="center">
								NT$ <?php echo number_format($feedback->getAmt(), 0) ?>
							</td>
							<td align="center" style="width:230px">

							</td>
						</tr>
						</tbody>
					</table>
				</div>

			</div>

			<!---第二排開始-->
			<div class="table_content">
				<div class="content_table">
					<table class="table table-bordered"
						style="border:1px solid #ccc; width: 800px; margin-left: 10px; margin-bottom:10px;">
						<thead>
						<tr>
							<th style="text-align: center">
								注意說明
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td align="left" style="width: 315px">
								<ul style=" list-style: decimal outside; padding-left:25px; font-size:16px  ">
									<li>本條碼單可至四大超商、農漁會通路繳款。</li>
									<li>您完成付款後如有交易或退款問題，請洽原交易商店，繳款通路不提供退款服務。</li>
									<li>您完成付款後，商店約需3~4個工作天確認付款成功。</li>
								</ul>
							</td>

						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!---第三排開始-->
			<div class="table_content">
				<div class="content_table">
					<table class="table"
						style="border:1px solid #ccc; width: 800px; margin-left: 10px;margin-bottom: 1px;">
						<thead>
						<tr style=" font-weight: bolder;border-bottom:1px solid #ccc;">
							<th style="text-align: center">
								商店聯絡資訊
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td align="left" style="middle; width: 215px">
								<table style="width: 100%">
									<tbody>
									<tr>
										<td width="50%">商店中文名稱： <?php echo $feedback->getMerchantName(); ?></td>
										<?php if ($data->service_tel): ?>
										<td width="50%">
											商店客服電話： <?php echo $data->service_tel; ?>
										</td>
										<?php endif; ?>
									</tr>
									<?php if ($data->service_email): ?>
									<tr>
										<td colspan="2">
											商店客服信箱： <?php echo $data->service_email; ?>
										</td>
									</tr>
									<?php endif; ?>
									</tbody>
								</table>
							</td>
						</tr>

						</tbody>
					</table>
				</div>
			</div>
			<!---第4排虛線-->
			<div class="table_content" style=" margin-left: 10px;margin-right: 10px">
				<table width="100%">
					<tbody>
					<tr>
						<td width="40%">
							<hr size="1" style="border:1px #cccccc dashed;">
						</td>
						<td align="center">
							裁　　剪　　線
						</td>
						<td width="40%">
							<hr size="1" style="border:1px #cccccc dashed;">
						</td>
					</tr>
					</tbody>
				</table>
			</div>

			<!---第5排開始-->
			<div class="table_content" style=" ">
				<div class="content_table" style="display: inline-block">
					<table class="table table-bordered  " style="border:1px solid #ccc; width: 800px; margin-left: 10px;margin-bottom:0px;">
						<thead>
						<tr style=" font-weight: bolder">
							<th style="text-align: center">
								代收款通路注意事項
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td align="left">
								<ul style=" list-style: decimal outside; padding-left:25px; font-size:16px;">
									<li><b>請確實收到足額現金時再登打收銀機結帳</b>，以免不肖人士詐騙。</li>
									<li>請您完成收款後，務必將上方客戶留存聯歸還付款人。</li>
									<li>謝謝您的協助。祝您順心愉快！</li>
								</ul>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!---第6排開始-->
			<div class="table_content" style="margin-top: 10px; ">
				<div class="content_table" style="display: inline-block; ">
					<table class="table table-bordered"
						style="border:1px solid #ccc; margin-left: 10px; margin-bottom:0; width: 800px;">
						<tbody>
						<tr style=" font-weight: bolder">
							<th style="text-align: center">條碼資訊</th>
							<th style="text-align: center" width="200px">收款通路商用印處</th>
							<th style="text-align: center; word-break: break-all;" width="10px" rowspan="3">
								本聯為　代收款通路　收執聯
							</th>
						</tr>

						<tr>
							<td align="left">
								總收款金額：新臺幣 <?php echo number_format($feedback->getAmt(), 0) ?> 元
							</td>
							<td rowspan="2">
								<!-- 用印空間 -->
							</td>
						</tr>
						<tr>
							<td align="center">
								<p>
									<img src="<?php echo BarcodeHelper::generate($payment->getBarcode_1()) ?>" style=" margin-top:20px;width:100%">
								</p>
								<p>
									<img src="<?php echo BarcodeHelper::generate($payment->getBarcode_2()) ?>" style=" margin-top:20px;width:100%">
								</p>
								<p>
									<img src="<?php echo BarcodeHelper::generate($payment->getBarcode_3()) ?>" style=" margin-top:20px;width:100%">
								</p>
							</td>
						</tr>
						</tbody>
					</table>
				</div>

			</div>
			<div style="margin-left:10px;">
				<div style="float: left">
					<?php echo $data->site_url; ?>
				</div>
				<div style="float: right">
					<?php echo $data->copyright; ?>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>