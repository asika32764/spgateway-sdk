<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go;

use Windwalker\Pay2Go\Exception\PaymentTypeException;
use Windwalker\Pay2Go\Receiver;

/**
 * The LaterPaymentFeedback class.
 *
 * @method  string                getMerchantID()  getMerchantID()
 * @method  LaterPaymentFeedback  setMerchantID()  setMerchantID($value)
 * @method  string                getMerchantName()  getMerchantName()
 * @method  LaterPaymentFeedback  setMerchantName()  setMerchantName($value)
 * @method  string                getVersion()  getVersion()
 * @method  LaterPaymentFeedback  setVersion()  setVersion($value)
 * @method  string                getStatus()  getStatus()
 * @method  LaterPaymentFeedback  setStatus()  setStatus($value)
 * @method  string                getMessage()  getMessage()
 * @method  LaterPaymentFeedback  setMessage()  setMessage($value)
 * @method  string                getAmt()  getAmt()
 * @method  LaterPaymentFeedback  setAmt()  setAmt($value)
 * @method  string                getTradeNo()  getTradeNo()
 * @method  LaterPaymentFeedback  setTradeNo()  setTradeNo($value)
 * @method  string                getMerchantOrderNo()  getMerchantOrderNo()
 * @method  LaterPaymentFeedback  setMerchantOrderNo()  setMerchantOrderNo($value)
 * @method  string                getPaymentType()  getPaymentType()
 * @method  LaterPaymentFeedback  setPaymentType()  setPaymentType($value)
 * @method  string                getCheckCode()  getCheckCode()
 * @method  LaterPaymentFeedback  setCheckCode()  setCheckCode($value)
 * @method  string                getExpireDate()  getExpireDate()
 * @method  LaterPaymentFeedback  setExpireDate()  setExpireDate($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class LaterPaymentFeedback extends PaidReceiver
{
	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'MerchantID'  => null,
		'MerchantName' => null,
		'Version'     => '1.1',
		'Status'      => null,
		'Message'     => null,
		'Amt'         => null,
		'TradeNo'     => null,
		'MerchantOrderNo' => null,
		'CheckCode'   => null,
		'PaymentType' => null,
		'ExpireDate'  => null
	);

	/**
	 * setData
	 *
	 * @param array|object $data
	 *
	 * @return  array
	 */
	public function setData($data)
	{
		parent::setData($data);

		if ($this->getPaymentType() == AbstractPayment::CREDIT || $this->getPaymentType() == AbstractPayment::WEBATM)
		{
			throw new PaymentTypeException(sprintf('Payment %s does not support later payment feedback', $this->getPaymentType()));
		}

		return $this;
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

		$class = __NAMESPACE__ . '\Feedback\\' . ucfirst($this->getPaymentType());

		if (class_exists($class))
		{
			return $this->payment = new $class;
		}

		throw new \UnexpectedValueException(sprintf('Payment %s not exists for LaterPayment', $this->getPaymentType()));
	}
}
