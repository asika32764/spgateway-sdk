<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Receiver;

use Windwalker\Pay2Go\AbstractPayment;

/**
 * The VACC payment.
 *
 * @method  string  getBarCode_1()  getBarCode_1()
 * @method  VACC    setBarCode_1()  setBarCode_1($value)
 * @method  string  getBarCode_2()  getBarCode_2()
 * @method  VACC    setBarCode_2()  setBarCode_2($value)
 * @method  string  getBarCode_3()  getBarCode_3()
 * @method  VACC    setBarCode_3()  setBarCode_3($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class Barcode extends AbstractPayment
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
		'BarCode_1' => null,
		'BarCode_2' => null,
		'BarCode_3' => null
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'BARCODE';
	}
}
