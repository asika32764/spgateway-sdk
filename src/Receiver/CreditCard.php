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
 * The CreditCard class.
 *
 * @method  string      getRespondCode()  getRespondCode()
 * @method  CreditCard  setRespondCode()  setRespondCode($value)
 * @method  string      getAuth()  getAuth()
 * @method  CreditCard  setAuth()  setAuth($value)
 * @method  string      getCard6No()  getCard6No()
 * @method  CreditCard  setCard6No()  setCard6No($value)
 * @method  string      getCard4No()  getCard4No()
 * @method  CreditCard  setCard4No()  setCard4No($value)
 * @method  string      getInst()  getInst()
 * @method  CreditCard  setInst()  setInst($value)
 * @method  string      getInstFirst()  getInstFirst()
 * @method  CreditCard  setInstFirst()  setInstFirst($value)
 * @method  string      getInstEach()  getInstEach()
 * @method  CreditCard  setInstEach()  setInstEach($value)
 * @method  string      getECI()  getECI()
 * @method  CreditCard  setECI()  setECI($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class CreditCard extends AbstractPayment
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
		'RespondCode' => null,
		'Auth'        => null,
		'Card6No'     => null,
		'Card4No'     => null,
		'Inst'        => null,
		'InstFirst'   => null,
		'InstEach'    => null,
		'ECI'         => null
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'CREDIT';
	}

	/**
	 * getInstallment
	 *
	 * @return  string
	 */
	public function getInstallment()
	{
		return $this->getInst();
	}
}
