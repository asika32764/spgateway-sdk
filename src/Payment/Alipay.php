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
 * The Alipay payment.
 *
 * @method  string  getReceiver()  getReceiver()
 * @method  ALIPAY  setReceiver()  setReceiver($value)
 * @method  string  getTel1()  getTel1()
 * @method  ALIPAY  setTel1()  setTel1($value)
 * @method  string  getTel2()  getTel2()
 * @method  ALIPAY  setTel2()  setTel2($value)
 * @method  string  getCount()  getCount()
 * @method  ALIPAY  setCount()  setCount($value)
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
	protected $laterPayment = true;

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
