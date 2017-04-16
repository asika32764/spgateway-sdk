<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asika\Spgateway;

use Asika\Spgateway\Renderer\RendererHelper;
use Asika\Renderer\PhpRenderer;

/**
 * The Pay2GoHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class SpgatewayHelper
{
	/**
	 * Property languages.
	 *
	 * @var  array
	 */
	protected static $languages = array();

	/**
	 * createCheckValue
	 *
	 * @param array  $data
	 * @param string $key
	 * @param string $iv
	 *
	 * @return  string
	 */
	public static function createCheckValue(array $data, $key, $iv)
	{
		$require = array(
			'MerchantID',
			'TimeStamp',
			'MerchantOrderNo',
			'Version',
			'Amt',
		);

		foreach ($require as $name)
		{
			if (empty($data[$name]))
			{
				throw new \InvalidArgumentException(sprintf('Missing %s value.', $name));
			}
		}

		$merArray = array(
			'MerchantID'     => $data['MerchantID'],
			'TimeStamp'      => $data['TimeStamp'],
			'MerchantOrderNo'=> $data['MerchantOrderNo'],
			'Version'        => $data['Version'],
			'Amt'            => $data['Amt'],
		);

		ksort($merArray);

		$checkMerstr = http_build_query($merArray);

		$CheckValueSTR = "HashKey=$key&$checkMerstr&HashIV=$iv";

		return strtoupper(hash("sha256", $CheckValueSTR));
	}

	/**
	 * createCheckCode
	 *
	 * @param array  $data
	 * @param string $key
	 * @param string $iv
	 *
	 * @return  string
	 */
	public static function createCheckCode(array $data, $key, $iv)
	{
		$require = array(
			'MerchantID',
			'MerchantOrderNo',
			'TradeNo',
			'Amt',
		);

		foreach ($require as $name)
		{
			if (empty($data[$name]))
			{
				throw new \InvalidArgumentException(sprintf('Missing %s value.', $name));
			}
		}

		$merArray = array(
			'MerchantID'     => $data['MerchantID'],
			'MerchantOrderNo'=> $data['MerchantOrderNo'],
			'TradeNo'        => $data['TradeNo'],
			'Amt'            => $data['Amt'],
		);

		ksort($merArray);

		$checkMerstr = http_build_query($merArray);

		$CheckValueSTR = "HashIV=$iv&$checkMerstr&HashKey=$key";

		return strtoupper(hash("sha256", $CheckValueSTR));
	}

	/**
	 * getErrorTitle
	 *
	 * @param   string  $code
	 *
	 * @return  string
	 */
	public static function getErrorTitle($code)
	{
		return static::translate('ERROR', $code);
	}

	/**
	 * getPaymentTitle
	 *
	 * @param string $code
	 *
	 * @return  string
	 */
	public static function getPaymentTitle($code)
	{
		return static::translate('PAYMENT', $code);
	}

	/**
	 * translate
	 *
	 * @param string $category
	 * @param string $code
	 *
	 * @return  mixed
	 */
	public static function translate($category, $code)
	{
		static::loadLanguage();

		$category = strtoupper($category);
		$code = strtoupper($code);

		if (!empty(static::$languages[$category][$code]))
		{
			return static::$languages[$category][$code];
		}

		return $code;
	}

	/**
	 * loadErrorCodeMapping
	 *
	 * @return  array
	 */
	protected static function loadLanguage()
	{
		if (static::$languages)
		{
			return static::$languages;
		}

		return static::$languages = parse_ini_file(static::getPay2GoRoot() . '/resources/languages/zh-TW.ini', true);
	}

	/**
	 * render
	 *
	 * @param string $template
	 * @param array  $data
	 *
	 * @return  string
	 */
	public static function render($template, $data = array())
	{
		$renderer = RendererHelper::getRenderer();

		return $renderer->render($template, (object) $data);
	}

	/**
	 * getPay2GoRoot
	 *
	 * @return  string
	 */
	public static function getPay2GoRoot()
	{
		return realpath(__DIR__ . '/..');
	}
}
