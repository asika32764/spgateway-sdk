<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Spgateway\Payment;

/**
 * The TENPAY payment.
 *
 * @since  {DEPLOY_VERSION}
 */
class Tenpay extends Alipay
{
	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'TENPAY';
	}
}
