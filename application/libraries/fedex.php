<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * CI-FedEx Library
 *
 * Copyright (c) 2013-2014 Robert Evans
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// Support legacy drivers which extend the CI_Driver class
// All drivers should be updated to extend Merchant_driver instead
// This will be removed in a future version!
if ( ! class_exists('CI_Driver')) get_instance()->load->library('driver');

define('FEDEX_CONFIG_PATH', realpath(dirname(__FILE__).'/../config'));
define('FEDEX_DRIVER_PATH', realpath(dirname(__FILE__).'/fedex'));
define('FEDEX_VENDOR_PATH', realpath(dirname(__FILE__).'/../vendor'));

/**
 * Fedex Class
 *
 * Fedex Shipping for CodeIgniter
 */
class Fedex
{

	private $_driver;

	public function __construct($driver = NULL)
	{
		if ( ! empty($driver))
		{
			$this->load($driver);
		}
	}

	public function __call($function, $arguments)
	{
		if ( ! empty($this->_driver))
		{
			return call_user_func_array(array($this->_driver, $function), $arguments);
		}
	}

	/**
	 * Load the specified driver
	 */
	public function load($driver)
	{
		$this->_driver = $this->_create_instance($driver);
		return $this->_driver !== FALSE;
	}

	/**
	 * Returns the name of the currently loaded driver
	 */
	public function active_driver()
	{
		$class_name = get_class($this->_driver);
		if ($class_name === FALSE) return FALSE;
		return str_replace('Fedex_', '', $class_name);
	}

	/**
	 * Load and create a new instance of a driver.
	 * $driver can be specified either as a class name (Fedex_address_validation) or a short name (address_validation)
	 */
	private function _create_instance($driver)
	{
		if (stripos($driver, 'fedex_') === 0)
		{
			$driver_class = ucfirst(strtolower($driver));
		}
		else
		{
			$driver_class = 'Fedex_'.strtolower($driver);
		}

		if ( ! class_exists($driver_class))
		{
			// attempt to load driver file
			$driver_path = FEDEX_DRIVER_PATH.'/'.strtolower($driver_class).'.php';
			if ( ! file_exists($driver_path)) return FALSE;
			require_once($driver_path);

			// did the driver file implement the class?
			if ( ! class_exists($driver_class)) return FALSE;
		}

		// ensure class is not abstract
		$reflection_class = new ReflectionClass($driver_class);
		if ($reflection_class->isAbstract()) return FALSE;

		return new $driver_class();
	}

	public function valid_drivers()
	{
		static $valid_drivers = array();

		if (empty($valid_drivers))
		{
			foreach (scandir(FEDEX_DRIVER_PATH) as $file_name)
			{
				$driver_path = FEDEX_DRIVER_PATH.'/'.$file_name;
				if (stripos($file_name, 'fedex_') === 0 AND is_file($driver_path))
				{
					require_once($driver_path);

					// does the file implement an appropriately named class?
					$driver_class = ucfirst(str_replace('.php', '', $file_name));
					if ( ! class_exists($driver_class)) continue;

					// ensure class is not abstract
					$reflection_class = new ReflectionClass($driver_class);
					if ($reflection_class->isAbstract()) continue;

					$valid_drivers[] = str_replace('Fedex_', '', $driver_class);
				}
			}
		}

		return $valid_drivers;
	}

}

abstract class Fedex_driver
{
	protected $CI;
	protected $END_POINT = "https://wsbeta.fedex.com:443/web-services";
	protected $API_KEY = "dOtB32I5YShJ6YZX";
	protected $API_PASSWORD = "Sb6LKkZbg2sL0zH9bsSFcrBmZ";
	protected $API_ACCOUNT = "510087763";
	protected $API_METER = "118583810";
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}

}

class Fedex_exception extends Exception {}

class Fedex_response
{
	
}

/* End of file ./libraries/fedex.php */