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
 * @method  string  getReceiver()  getReceiver()
 * @method  Tenpay  setReceiver()  setReceiver($value)
 * @method  string  getTel1()      getTel1()
 * @method  Tenpay  setTel1()      setTel1($value)
 * @method  string  getTel2()      getTel2()
 * @method  Tenpay  setTel2()      setTel2($value)
 * @method  string  getCount()     getCount()
 * @method  Tenpay  setCount()     setCount($value)
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
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'TENPAY';
	}
}
