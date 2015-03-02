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
 * The PaymentFeedback class.
 *
 * @method  string            getMerchantID()    getMerchantID()
 * @method  FeedbackReceiver  setMerchantID()    setMerchantID($value)
 * @method  string            getMerchantName()  getMerchantName()
 * @method  FeedbackReceiver  setMerchantName()  setMerchantName($value)
 * @method  string            getVersion()  getVersion()
 * @method  FeedbackReceiver  setVersion()  setVersion($value)
 * @method  string            getStatus()   getStatus()
 * @method  FeedbackReceiver  setStatus()   setStatus($value)
 * @method  string            getMessage()  getMessage()
 * @method  FeedbackReceiver  setMessage()  setMessage($value)
 * @method  string            getAmt()      getAmt()
 * @method  FeedbackReceiver  setAmt()      setAmt($value)
 * @method  string            getTradeNo()  getTradeNo()
 * @method  FeedbackReceiver  setTradeNo()  setTradeNo($value)
 * @method  string            getMerchantOrderNo()  getMerchantOrderNo()
 * @method  FeedbackReceiver  setMerchantOrderNo()  setMerchantOrderNo($value)
 * @method  string            getPaymentType()      getPaymentType()
 * @method  FeedbackReceiver  setPaymentType()      setPaymentType($value)
 * @method  string            getCheckCode()        getCheckCode()
 * @method  FeedbackReceiver  setCheckCode()        setCheckCode($value)
 * @method  string            getExpireDate()       getExpireDate()
 * @method  FeedbackReceiver  setExpireDate()       setExpireDate($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class FeedbackReceiver extends PaidReceiver
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
	 * @return  array
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
		$data['feedback'] = $this;

		$tmpl = $this->getPaymentType() ? : 'none';

		return Pay2GoHelper::render('feedback.' . strtolower($tmpl), $data);
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
		$data['feedback'] = $this;

		return Pay2GoHelper::render('feedback.barcode-print', $data);
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

		$class = __NAMESPACE__ . '\Feedback\\' . ucfirst(strtolower($this->getPaymentType()));

		if (!class_exists($class))
		{
			$class = __NAMESPACE__ . '\Feedback\\' . strtoupper($this->getPaymentType());
		}

		if (class_exists($class))
		{
			$this->payment = new $class;

			return $this->payment->setData($this->getData());
		}

		throw new PaymentTypeException(sprintf('Payment %s not exists for LaterPayment', $this->getPaymentType()));
	}
}
