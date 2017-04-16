<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway\Payment;

use Asika\Spgateway\Payment\AbstractPayment;

/**
 * The Alipay payment.
 *
 * @method  string  getReceiver()  getReceiver()
 * @method  Alipay  setReceiver()  setReceiver($value)
 * @method  string  getTel1()      getTel1()
 * @method  Alipay  setTel1()      setTel1($value)
 * @method  string  getTel2()      getTel2()
 * @method  Alipay  setTel2()      setTel2($value)
 * @method  string  getCount()     getCount()
 * @method  Alipay  setCount()     setCount($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class Alipay extends AbstractPayment
{
	/**
	 * Property laterPayment.
	 *
	 * @var  boolean
	 */
	protected $deferralPayment = true;

	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'ALIPAY' => null,
		'Receiver' => null,
		'Tel1' => null,
		'Tel2' => null,
		'Count' => null
	);

	/**
	 * Property products.
	 *
	 * @var  array
	 */
	protected $products = array();

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'ALIPAY';
	}

	/**
	 * addProduct
	 *
	 * @param string $pid
	 * @param string $title
	 * @param string $desc
	 * @param int    $price
	 * @param int    $qty
	 *
	 * @return  void
	 */
	public function addProduct($pid, $title, $desc, $price, $qty)
	{
		$this->products[] = array(
			'Pid'   => $pid,
			'Title' => $title,
			'Desc'  => $desc,
			'Price' => $price,
			'Qty'   => $qty
		);
	}

	/**
	 * getData
	 *
	 * @return  array
	 */
	public function getData()
	{
		$data = $this->data;

		foreach ($this->products as $k => $product)
		{
			foreach ($product as $name => $value)
			{
				$data[$name . ($k + 1)] = $value;
			}
		}

		if (!$this->getCount())
		{
			$data['Count'] = count($this->products);
		}

		return $data;
	}

	/**
	 * getIterator
	 *
	 * @return  \ArrayIterator
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->getData());
	}
}
