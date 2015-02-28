<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Receiver;

use Windwalker\Pay2Go\AbstractPayment;

/**
 * The VACC payment.
 *
 * @method  string  getCodeNo()  getCodeNo()
 * @method  VACC    setCodeNo()  setCodeNo($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class CVS extends AbstractPayment
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
		'CodeNo' => null
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'CVS';
	}
}
