<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway\Receiver;

use Asika\Spgateway\Payment\AbstractPayment;

/**
 * The VACC payment.
 *
 * @method  string  getBarcode_1()  getBarcode_1()
 * @method  VACC    setBarcode_1()  setBarcode_1($value)
 * @method  string  getBarcode_2()  getBarcode_2()
 * @method  VACC    setBarcode_2()  setBarcode_2($value)
 * @method  string  getBarcode_3()  getBarcode_3()
 * @method  VACC    setBarcode_3()  setBarcode_3($value)
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
	protected $deferralPayment = true;

	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'Barcode_1' => null,
		'Barcode_2' => null,
		'Barcode_3' => null
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
