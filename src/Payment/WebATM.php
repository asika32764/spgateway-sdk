<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway\Payment;

use Asika\Spgateway\Payment\AbstractPayment;

/**
 * The WebATM payment.
 *
 * @since  {DEPLOY_VERSION}
 */
class Webatm extends AbstractPayment
{
	/**
	 * Property laterPayment.
	 *
	 * @var  boolean
	 */
	protected $deferralPayment = false;

	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'WEBATM' => null
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'WEBATM';
	}
}
