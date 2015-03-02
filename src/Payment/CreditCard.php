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
 * The CreditCard class.
 *
 * @method  string      getInstFlag()  getInstFlag()
 * @method  CreditCard  setInstFlag()  setInstFlag($value)
 * @method  string      getUNIONPAY()  getUNIONPAY()
 * @method  CreditCard  setUNIONPAY()  setUNIONPAY($value)
 * @method  string      getNTCB()      getNTCB()
 * @method  CreditCard  setNTCB()      setNTCB($value)
 * @method  string      getNTCBLocate()     getNTCBLocate()
 * @method  CreditCard  setNTCBLocate()     setNTCBLocate($value)
 * @method  string      getNTCBStartDate()  getNTCBStartDate()
 * @method  CreditCard  setNTCBStartDate()  setNTCBStartDate($value)
 * @method  string      getNTCBEndDate()    getNTCBEndDate()
 * @method  CreditCard  setNTCBEndDate()    setNTCBEndDate($value)
 * @method  string      getTokenTerm()      getTokenTerm()
 * @method  CreditCard  setTokenTerm()      setTokenTerm($value)
 * @method  string      getTokenBuyerCheck()  getTokenBuyerCheck()
 * @method  CreditCard  setTokenBuyerCheck()  setTokenBuyerCheck($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class CreditCard extends AbstractPayment
{
	const BUYER_CHECK_CVC_EXPIRED = 'cvcexp';
	const BUYER_CHECK_CVC = 'cvc';

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
		'InstFlag' => null,
		'UNIONPAY' => null,
		'NTCB'     => null,
		'NTCBLocate'      => null,
		'NTCBStartDate'   => null,
		'NTCBEndDate'     => null,
		'TokenTerm'       => null,
		'TokenBuyerCheck' => null
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
	 * rememberMyNumber
	 *
	 * @param string $token
	 *
	 * @return  static
	 */
	public function rememberMyNumber($token)
	{
		$this->setTokenTerm($token);

		return $this;
	}

	/**
	 * dontRememberMyNumber
	 *
	 * @return  static
	 */
	public function dontRememberMyNumber()
	{
		$this->setTokenTerm(null);

		return $this;
	}

	/**
	 * Set installment value.
	 *
	 * 0 is none.
	 * 1 is all.
	 * Available values: 3, 6, 12, 18, 24
	 *
	 * If you want to enable multiple flags, use ',' to separate every number.
	 * Example: '3,6,18'
	 *
	 * @param string|integer $value
	 *
	 * @return  void
	 */
	public function installment($value)
	{
		$this->setInstFlag($value);
	}

	/**
	 * needExpiredDate
	 *
	 * @param   boolean $value
	 *
	 * @return  boolean|static
	 */
	public function needExpiredDate($value = null)
	{
		if ($value === null)
		{
			return ($this->getTokenBuyerCheck() == static::BUYER_CHECK_CVC_EXPIRED);
		}

		$this->setNTCB($value ? static::BUYER_CHECK_CVC_EXPIRED : static::BUYER_CHECK_CVC);

		return $this;
	}

	/**
	 * Get or set National Travel Card (國民旅遊卡) enabled.
	 *
	 * @param int $value
	 *
	 * @return  static|boolean
	 */
	public function isNationalTravelCard($value = null)
	{
		if ($value === null)
		{
			return (bool) $this->getNTCB();
		}

		$this->setNTCB((int) $value);

		return $this;
	}
}
