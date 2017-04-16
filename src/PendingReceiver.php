<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Spgateway;

use Windwalker\Spgateway\Exception\PaymentTypeException;
use Windwalker\Spgateway\Payment\AbstractPayment;
use Windwalker\Spgateway\Receiver;

/**
 * The Paymentpending class.
 *
 * @method  string            getMerchantName()  getMerchantName()
 * @method  PendingReceiver  setMerchantName()  setMerchantName($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class PendingReceiver extends PaidReceiver
{
	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'MerchantID'      => null,
		'MerchantName'    => null,
		'Version'         => '1.1',
		'Status'          => null,
		'Message'         => null,
		'Amt'             => null,
		'TradeNo'         => null,
		'MerchantOrderNo' => null,
		'CheckCode'       => null,
		'PaymentType'     => null,
		'ExpireDate'      => null
	);

	/**
	 * setData
	 *
	 * @param array|object $data
	 *
	 * @return  static
	 */
	public function setData($data)
	{
		parent::setData($data);

		return $this;
	}

	/**
	 * isSupport
	 *
	 * @param string $type
	 *
	 * @return  boolean
	 */
	public function isSupport($type)
	{
		return !($type == AbstractPayment::CREDIT || $type == AbstractPayment::WEBATM);
	}

	/**
	 * render
	 *
	 * @param array $data
	 *
	 * @return  string
	 */
	public function render($data = array())
	{
		$data['pending'] = $this;

		$tmpl = $this->getPaymentType() ? : 'none';

		return SpgatewayHelper::render('pending.' . strtolower($tmpl), $data);
	}

	/**
	 * renderBarcodePage
	 *
	 * @param array $data
	 *
	 * @return  string
	 */
	public function renderBarcodePage($data = array())
	{
		$data['pending'] = $this;

		return SpgatewayHelper::render('pending.barcode-print', $data);
	}

	/**
	 * __get
	 *
	 * @param   string  $name
	 *
	 * @return  AbstractPayment|mixed
	 */
	public function __get($name)
	{
		if ($this->payment instanceof AbstractPayment)
		{
			return $this->payment;
		}

		$class = __NAMESPACE__ . '\Pending\\' . ucfirst(strtolower($this->getPaymentType()));

		if (!class_exists($class))
		{
			$class = __NAMESPACE__ . '\Pending\\' . strtoupper($this->getPaymentType());
		}

		if (class_exists($class))
		{
			$this->payment = new $class;

			return $this->payment->setData($this->getData());
		}

		throw new PaymentTypeException(sprintf('Payment %s not exists for Deferral Payment', $this->getPaymentType()));
	}
}
