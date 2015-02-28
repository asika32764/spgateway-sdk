<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Barcode;

/**
 * The Barcode class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class BarcodeHelper
{
	/**
	 * Property handler.
	 *
	 * @var  callable
	 */
	protected static $handler = array('Windwalker\Pay2Go\Barcode\BarcodeHelper', 'barcodes4');

	/**
	 * generate
	 *
	 * @param   string  $value
	 *
	 * @return  string
	 */
	public static function generate($value)
	{
		return call_user_func(static::$handler, $value);
	}

	/**
	 * Method to get property Handler
	 *
	 * @return  callable
	 */
	public static function getHandler()
	{
		return static::$handler;
	}

	/**
	 * Method to set property handler
	 *
	 * @param   callable $handler
	 *
	 * @return  void
	 */
	public static function setHandler($handler)
	{
		if (!is_callable($handler))
		{
			throw new \InvalidArgumentException('Barcode handler should be callable.');
		}

		static::$handler = $handler;
	}

	/**
	 * barcodes4
	 *
	 * @param  string  $value
	 *
	 * @return  string
	 */
	public static function barcodes4($value)
	{
		return sprintf(
			'http://barcodes4.me/barcode/c39/%s.png?width=400&height=60&IsTextDrawn=1',
			$value
		);
	}
}
