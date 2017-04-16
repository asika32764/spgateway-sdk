<?php
/**
 * Part of spgateway project.
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Spgateway;

/**
 * The AbstractDataHolder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractDataHolder implements \IteratorAggregate
{
	const RESPONSE_TYPE_STRING = 'String';
	const RESPONSE_TYPE_JSON = 'JSON';

	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array();

	/**
	 * setData
	 *
	 * @param array|object $data
	 *
	 * @return  static
	 */
	public function setData($data)
	{
		if ($data instanceof \Traversable)
		{
			$data = iterator_to_array($data);
		}

		if (is_object($data))
		{
			$data = get_object_vars($data);
		}

		$this->data = array_merge($this->data, (array) $data);

		return $this;
	}

	/**
	 * getData
	 *
	 * @return  array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * get
	 *
	 * @param string $name
	 * @param mixed  $value
	 *
	 * @return  static
	 */
	public function set($name, $value = null)
	{
		$this->data[$name] = $value;

		return $this;
	}

	/**
	 * get
	 *
	 * @param string $name
	 * @param mixed  $default
	 *
	 * @return  mixed
	 */
	public function get($name, $default = null)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}

		return $default;
	}

	/**
	 * __call
	 *
	 * @param string $name
	 * @param array  $args
	 *
	 * @return  mixed
	 */
	public function __call($name, $args = array())
	{
		if (substr($name, 0, 3) == 'get')
		{
			$name = substr($name, 3);

			return $this->get($name);
		}

		if (substr($name, 0, 3) == 'set')
		{
			$name = substr($name, 3);

			array_unshift($args, $name);

			return call_user_func_array(array($this, 'set'), $args);
		}

		throw new \BadMethodCallException(get_called_class() . '::' . $name . '() not exists.');
	}

	/**
	 * Retrieve an external iterator
	 *
	 * @return  \Traversable  An instance of an object implementing Iterator or Traversable
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->data);
	}
}
