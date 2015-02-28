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
 * The Alipay payment.
 *
 * @method  string  getReceiver()  getReceiver()
 * @method  ALIPAY  setReceiver()  setReceiver($value)
 * @method  string  getTel1()  getTel1()
 * @method  ALIPAY  setTel1()  setTel1($value)
 * @method  string  getTel2()  getTel2()
 * @method  ALIPAY  setTel2()  setTel2($value)
 * @method  string  getCount()  getCount()
 * @method  ALIPAY  setCount()  setCount($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class Alipay extends AbstractPayment
{
	/**
	 * Property laterPayment.
	 *
	 * @var  boolean
	 */
	protected $laterPayment = true;

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'ALIPAY';
	}
}
