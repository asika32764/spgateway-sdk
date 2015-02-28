<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Renderer;

use Windwalker\Pay2Go\Pay2GoHelper;
use Windwalker\Renderer\AbstractRenderer;
use Windwalker\Renderer\PhpRenderer;

/**
 * The RendererHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class RendererHelper
{
	/**
	 * Property renderer.
	 *
	 * @var  AbstractRenderer
	 */
	protected static $renderer;

	/**
	 * Method to get property Renderer
	 *
	 * @return  AbstractRenderer
	 */
	public static function getRenderer()
	{
		if (!static::$renderer)
		{
			static::$renderer = new PhpRenderer;

			static::$renderer->addPath(Pay2GoHelper::getPay2GoRoot() . '/resources/templates');
		}

		return static::$renderer;
	}

	/**
	 * Method to set property renderer
	 *
	 * @param   mixed $renderer
	 *
	 * @return  void
	 */
	public static function setRenderer($renderer)
	{
		static::$renderer = $renderer;
	}

	/**
	 * addPath
	 *
	 * @param string $path
	 * @param int    $priority
	 *
	 * @return  void
	 */
	public static function addPath($path, $priority = 100)
	{
		static::getRenderer()->addPath($path, $priority);
	}

	/**
	 * getPaths
	 *
	 * @return  \SplPriorityQueue
	 */
	public static function getPaths()
	{
		return static::getRenderer()->getPaths();
	}
}
