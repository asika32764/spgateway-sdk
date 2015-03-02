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
 * @method  string  getPayBankCode()   getPayBankCode()
 * @method  VACC    setPayBankCode()   setPayBankCode($value)
 * @method  string  getPayerAccount5Code()  getPayerAccount5Code()
 * @method  VACC    setPayerAccount5Code()  setPayerAccount5Code($value)
 * @method  string  getBankCode()      getBankCode()
 * @method  VACC    setBankCode()      setBankCode($value)
 * @method  string  getAccount5Code()  getAccount5Code()
 * @method  VACC    setAccount5Code()  setAccount5Code($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class VACC extends AbstractPayment
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
		'PayBankCode' => null,
		'PayerAccount5Code' => null,
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'VACC';
	}
}
