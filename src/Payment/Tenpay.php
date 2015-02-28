<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Receiver;

/**
 * The TENPAY payment.
 *
 * @since  {DEPLOY_VERSION}
 */
class Tenpay extends Alipay
{
	/**
	 * Property laterPayment.
	 *
	 * @var  boolean
	 */
	protected $laterPayment = true;

	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'TENPAY' => null,
		'Receiver' => null,
		'Tel1' => null,
		'Tel2' => null,
		'Count' => null
	);

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
