<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway;

use Asika\Spgateway\Payment;
use Asika\Spgateway\Payment\AbstractPayment;

/**
 * The Spgateway class.
 *
 * @property-read  Payment\Alipay      $alipay      The Alipay payment
 * @property-read  Payment\ATM         $atm         An alias of VACC
 * @property-read  Payment\Barcode     $barcode     The Barcode payment
 * @property-read  Payment\CreditCard  $creditCard  The CreditCard payment
 * @property-read  Payment\CVS         $cvs         The CVS payment
 * @property-read  Payment\Tenpay      $tenpay      The CreditCard payment
 * @property-read  Payment\VACC        $vacc        The VACC payment
 * @property-read  Payment\WebATM      $webATM      The WebATM payment
 *
 * @method  string  getMerchantID()       getMerchantID()
 * @method  Spgateway  setMerchantID()       setMerchantID($value)
 * @method  string  getRespondType()      getRespondType()
 * @method  Spgateway  setRespondType()      setRespondType($value)
 * @method  string  getMerchantOrderNo()  getMerchantOrderNo()
 * @method  Spgateway  setMerchantOrderNo()  setMerchantOrderNo($value)
 * @method  string  getTimeStamp()        getTimeStamp()
 * @method  Spgateway  setTimeStamp()        setTimeStamp($value)
 * @method  string  getVersion()          getVersion()
 * @method  Spgateway  setVersion()          setVersion($value)
 * @method  string  getAmt()              getAmt()
 * @method  Spgateway  setAmt()              setAmt($value)
 * @method  string  getItemDesc()         getItemDesc()
 * @method  Spgateway  setItemDesc()         setItemDesc($value)
 * @method  string  getExpireDate()       getExpireDate()
 * @method  Spgateway  setExpireDate()       setExpireDate($value)
 * @method  Spgateway  setReturnURL()        setReturnURL($value)
 * @method  string  getReturnURL()        getReturnURL()
 * @method  string  getNotifyURL()        getNotifyURL()
 * @method  Spgateway  setNotifyURL()        setNotifyURL($value)
 * @method  Spgateway  setCustomerURL()      setCustomerURL($value)
 * @method  string  getCustomerURL()      getCustomerURL()
 * @method  string  getEmail()            getEmail()
 * @method  Spgateway  setEmail()            setEmail($value)
 * @method  string  getLoginType()        getLoginType()
 * @method  Spgateway  setLoginType()        setLoginType($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class Spgateway extends AbstractDataHolder
{
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
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'MerchantID'      => null,
		'RespondType'     => 'JSON',
		'CheckValue'      => null,
		'TimeStamp'       => null,
		'MerchantOrderNo' => null,
		'Version'         => '1.2',
		'Amt'             => null,
		'ItemDesc'        => null,
		'ExpireDate'      => null,
		'ReturnURL'       => null,
		'NotifyURL'       => null,
		'CustomerURL'     => null,
		'Email'           => null,
		'LoginType'       => 1
	);

	/**
	 * Property payments.
	 *
	 * @var  AbstractPayment[]
	 */
	protected $payments = array();

	/**
	 * Property test.
	 *
	 * @var  boolean
	 */
	protected $test = false;

	/**
	 * Property prepared.
	 *
	 * @var  boolean
	 */
	protected $prepared = false;

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
	 * peekAllData
	 *
	 * @return  array
	 */
	public function peekAllData()
	{
		$data = $this->data;

		foreach ($this->payments as $payment)
		{
			$data = array_merge($data, $payment->getData());
		}

		return $data;
	}

	/**
	 * render
	 *
	 * @param string $content
	 * @param string $formId
	 *
	 * @return string
	 */
	public function render($content = '', $formId = 'pay2go-form')
	{
		$this->prepareRender();

		return sprintf(
			'<form action="%s" id="%s" method="post">%s</form>',
			$this->getPostUrl(),
			$formId,
			"\n" . $content . "\n\n" . $this->renderInputs() . "\n"
		);
	}

	/**
	 * renderInputs
	 *
	 * @return  string
	 */
	public function renderInputs()
	{
		$this->prepareRender();

		$inputs = array();

		foreach ($this as $key => $value)
		{
			if ($value === null)
			{
				continue;
			}

			$inputs[] = sprintf('<input type="hidden" name="%s" value="%s">', $key, $value);
		}

		return implode("\n", $inputs);
	}

	/**
	 * prepareRender
	 *
	 * @return  static
	 */
	public function prepareRender()
	{
		if ($this->prepared)
		{
			return $this;
		}

		if (!$this->getTimeStamp())
		{
			$this->setTimeStamp(time());
		}

		$this->set('CheckValue', $this->getCheckValue());

		foreach ($this->payments as $payment)
		{
			$this->merge($payment);
		}

		$this->prepared = true;

		return $this;
	}

	/**
	 * post
	 *
	 * @param bool $immediately
	 *
	 * @return string
	 */
	public function post($immediately = false)
	{
		$formId = 'pay2go-form';

		$output =  $this->render('', $formId);

		$output .= <<<SCRTPT
<script>
	var form = document.getElementById('{$formId}');

	form.submit();
</script>
SCRTPT;

		if ($immediately)
		{
			echo $output;

			die;
		}

		return $output;
	}

	/**
	 * reset
	 *
	 * @return  static
	 */
	public function reset()
	{
		$this->prepared = false;

		$this->setTimeStamp(null);

		return $this;
	}

	/**
	 * getCheckValue
	 *
	 * @return  string
	 */
	public function getCheckValue()
	{
		return SpgatewayHelper::createCheckValue($this->data, $this->getHashKey(), $this->getHashIV());
	}

	/**
	 * merge
	 *
	 * @param array|AbstractDataHolder $data
	 *
	 * @return  static
	 */
	public function merge($data)
	{
		if ($data instanceof \Traversable)
		{
			$data = iterator_to_array($data);
		}

		$this->data = array_merge($this->data, $data);

		return $this;
	}

	/**
	 * getPostUrl
	 *
	 * @return  string
	 */
	public function getPostUrl()
	{
		if ($this->test)
		{
			return 'https://ccore.newebpay.com/MPG/mpg_gateway';
		}

		return 'https://core.newebpay.com/MPG/mpg_gateway';
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
	 * Method to get property Test
	 *
	 * @return  boolean
	 */
	public function getTest()
	{
		return $this->test;
	}

	/**
	 * Method to set property test
	 *
	 * @param   boolean $test
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setTest($test)
	{
		$this->test = $test;

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
		if (!empty($this->payments[strtolower($name)]))
		{
			return $this->payments[strtolower($name)];
		}

		$class = __NAMESPACE__ . '\Payment\\' . ucfirst($name);

		if (!class_exists($class))
		{
			$class = __NAMESPACE__ . '\Payment\\' . strtoupper($name);
		}

		if (!class_exists($class))
		{
			throw new \UnexpectedValueException(sprintf('Property %s not exists', $name));
		}

		return $this->payments[strtolower($name)] = new $class;
	}
}
