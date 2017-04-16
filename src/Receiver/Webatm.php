<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway\Receiver;

/**
 * The WebATM payment.
 *
 * @method  string  getPayBankCode()        getPayBankCode()
 * @method  WebATM  setPayBankCode()        setPayBankCode($value)
 * @method  string  getPayerAccount5Code()  getPayerAccount5Code()
 * @method  WebATM  setPayerAccount5Code()  setPayerAccount5Code($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class WebATM extends VACC
{
	/**
	 * Property laterPayment.
	 *
	 * @var  boolean
	 */
	protected $deferralPayment = false;

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
