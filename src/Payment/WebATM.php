<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Payment;

use Windwalker\Pay2Go\AbstractPayment;

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
	protected $laterPayment = false;

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
