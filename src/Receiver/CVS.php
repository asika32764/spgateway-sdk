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
 * @method  string  getCodeNo()  getCodeNo()
 * @method  VACC    setCodeNo()  setCodeNo($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class CVS extends AbstractPayment
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
		'CodeNo' => null
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'CVS';
	}
}
