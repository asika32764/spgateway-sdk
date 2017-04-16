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
 * The PaidReceiver class.
 *
 * @method  string          getMerchantID()  getMerchantID()
 * @method  PaidReceiver  setMerchantID()  setMerchantID($value)
 * @method  string          getVersion()  getVersion()
 * @method  PaidReceiver  setVersion()  setVersion($value)
 * @method  string          getStatus()  getStatus()
 * @method  PaidReceiver  setStatus()  setStatus($value)
 * @method  string          getMessage()  getMessage()
 * @method  PaidReceiver  setMessage()  setMessage($value)
 * @method  string          getResult()  getResult()
 * @method  PaidReceiver  setResult()  setResult($value)
 * @method  string          getAmt()  getAmt()
 * @method  PaidReceiver  setAmt()  setAmt($value)
 * @method  string          getTradeNo()  getTradeNo()
 * @method  PaidReceiver  setTradeNo()  setTradeNo($value)
 * @method  string          getMerchantOrderNo()  getMerchantOrderNo()
 * @method  PaidReceiver  setMerchantOrderNo()  setMerchantOrderNo($value)
 * @method  string          getPaymentType()  getPaymentType()
 * @method  PaidReceiver  setPaymentType()  setPaymentType($value)
 * @method  string          getRespondType()  getRespondType()
 * @method  PaidReceiver  setRespondType()  setRespondType($value)
 * @method  string          getCheckCode()  getCheckCode()
 * @method  PaidReceiver  setCheckCode()  setCheckCode($value)
 * @method  string          getPayTime()  getPayTime()
 * @method  PaidReceiver  setPayTime()  setPayTime($value)
 * @method  string          getIP()  getIP()
 * @method  PaidReceiver  setIP()  setIP($value)
 * @method  string          getEscrowBank()  getEscrowBank()
 * @method  PaidReceiver  setEscrowBank()  setEscrowBank($value)
 * @method  string          getExpireDate()  getExpireDate()
 * @method  PaidReceiver  setExpireDate()  setExpireDate($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class PaidReceiver extends AbstractDataHolder
{
	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'MerchantID'  => null,
		'Version'     => '1.2',
		'Status'      => null,
		'Message'     => null,
		'Result'      => null,
		'Amt'         => null,
		'TradeNo'     => null,
		'MerchantOrderNo'  => null,
		'PaymentType' => null,
		'RespondType' => null,
		'CheckCode'   => null,
		'PayTime'     => null,
		'IP'          => null,
		'EscrowBank'  => null,
	);

	/**
	 * Property hashKey.
	 *
	 * @var  string
	 */
	protected $hashKey;

	/**
	 * Property hashIV.
	 *
	 * @var  string
	 */
	protected $hashIV;

	/**
	 * Property payment.
	 *
	 * @var  AbstractPayment
	 */
	protected $payment;

	/**
	 * Class init
	 *
	 * @param string $MerchantID
	 * @param string $hashKey
	 * @param string $hashIV
	 */
	public function __construct($MerchantID = null, $hashKey = null, $hashIV = null)
	{
		$this->hashKey = $hashKey;
		$this->hashIV = $hashIV;
		$this->setMerchantID($MerchantID);
	}

	/**
	 * setData
	 *
	 * @param array|object $data
	 *
	 * @return  static
	 */
	public function setData($data)
	{
		if ($data instanceof \Traversable)
		{
			$data = iterator_to_array($data);
		}

		if (is_object($data))
		{
			$data = get_object_vars($data);
		}

		if (!empty($data['JSONData']))
		{
			$jsonData = json_decode($data['JSONData'], true);

			if (!$jsonData)
			{
				throw new \InvalidArgumentException('Not a valid JSON returned data.');
			}

			if (empty($jsonData['Result']))
			{
				throw new \InvalidArgumentException('Returned JSON data has no Result.');
			}

			$result = json_decode($jsonData, true);

			$data = array_merge($data, $jsonData, $result);
		}

		parent::setData($data);
	}

	/**
	 * validate
	 *
	 * @return  boolean
	 */
	public function validate()
	{
		$code = SpgatewayHelper::createCheckCode($this->data, $this->getHashKey(), $this->getHashIV());

		return $code == $this->getCheckCode();
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
		$data['receiver'] = $this;

		$tmpl = $this->getPaymentType() ? : 'none';

		return SpgatewayHelper::render('success.' . strtolower($tmpl), $data);
	}

	/**
	 * getPayment
	 *
	 * @return  AbstractPayment
	 */
	public function getPayment()
	{
		$payment = $this->getPaymentType();

		return $this->$payment;
	}

	/**
	 * Method to get property HashKey
	 *
	 * @return  string
	 */
	public function getHashKey()
	{
		return $this->hashKey;
	}

	/**
	 * Method to set property hashKey
	 *
	 * @param   string $hashKey
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setHashKey($hashKey)
	{
		$this->hashKey = $hashKey;

		return $this;
	}

	/**
	 * Method to get property HashIV
	 *
	 * @return  string
	 */
	public function getHashIV()
	{
		return $this->hashIV;
	}

	/**
	 * Method to set property hashIV
	 *
	 * @param   string $hashIV
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setHashIV($hashIV)
	{
		$this->hashIV = $hashIV;

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

		$class = __NAMESPACE__ . '\Receiver\\' . ucfirst(strtolower($this->getPaymentType()));

		if (!class_exists($class))
		{
			$class = __NAMESPACE__ . '\Receiver\\' . strtoupper($this->getPaymentType());
		}

		if (class_exists($class))
		{
			$this->payment = new $class;

			return $this->payment->setData($this->getData());
		}

		throw new PaymentTypeException(sprintf('Payment %s not exists', $this->getPaymentType()));
	}
}
