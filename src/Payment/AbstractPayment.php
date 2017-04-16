<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway\Payment;

use Asika\Spgateway\AbstractDataHolder;

/**
 * The AbstractPayment class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractPayment extends AbstractDataHolder
{
	const ALIPAY  = 'ALIPAY';
	const BARCODE = 'BARCODE';
	const CREDIT  = 'CREDIT';
	const CVS     = 'CVS';
	const TENPAY  = 'TENPAY';
	const VACC    = 'VACC';
	const WEBATM  = 'WEBATM';

	const STATUS_SUCCESS = 'SUCCESS';

	/**
	 * Property deferralPayment.
	 *
	 * @var  boolean
	 */
	protected $deferralPayment = false;

	/**
	 * getName
	 *
	 * @return  string
	 */
	abstract public function getName();

	/**
	 * enable
	 *
	 * @return  static
	 */
	public function enable()
	{
		$this->set($this->getName(), 1);

		return $this;
	}

	/**
	 * disable
	 *
	 * @return  static
	 */
	public function disable()
	{
		$this->set($this->getName(), 0);

		return $this;
	}

	/**
	 * isEnabled
	 *
	 * @return  boolean
	 */
	public function isEnabled()
	{
		return (bool) $this->get($this->getName());
	}

	/**
	 * isDeferralPayment
	 *
	 * @return  boolean
	 */
	public function isDeferralPayment()
	{
		return $this->deferralPayment;
	}

	/**
	 * isInstantPayment
	 *
	 * @return  boolean
	 */
	public function isInstantPayment()
	{
		return !$this->deferralPayment;
	}
}
