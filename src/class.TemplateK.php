<?php
/**
 * MIT License. Copyright (c) 2018 Paulo Rodriguez
 * TemplateK is a template engine, that will make coding easy,
 * More than you think!
 * @author Paulo Rodriguez (xLaming)
 * @link https://github.com/xlaming/TemplateK
 * @version 1.0 stable
 */
class TemplateK
{
	/**
	 * Store headers
	 * @var array
	 */
	private $headers = [];

	/**
	 * Store all loaded plugins
	 * @var array
	 */
	private $plugins = [];

	/**
	 * General settings - Do not touch if you dont know
	 * @var array
	 */
	public $settings = [
		/* USER VARIABLES */
		'maintenance'  => false,
		'message'      => null,
		'minify'       => false,
		/* PRE-DEFINED VARIABLES */
		'separator'    => DIRECTORY_SEPARATOR,
		'directory'    => __DIR__
	];

	/**
	 * Store variables
	 * @var array
	 */
	public $varList  = [];

	/**
	 * Store all content. It is used to show later
	 * @var string
	 */
	public $content;

	/**
	 * Load template
	 * @param string $templateDir
	 * @param string $page
	 */
	public function __construct($templateDir, $page)
	{
		try
		{
			$path = $templateDir . '/' . $page . '.html'; // construct the path
			if (!file_exists($path))
			{
				throw new Exception('Invalid directory');
			}
			$this->content = file_get_contents($path); // get content from template
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	/**
	 * Set variables, e.g: TemplateK::setVar('a', 'b')
	 * @param string $name
	 * @param string $value
	 */
	public function setVar($name, $value)
	{
		if (!is_string($name) || !isset($value))
		{
			return false;
		}

		$this->varList[$name] = $value;
		return true;
	}

	/**
	 * Set maintenance mode, e.g: TemplateK::setMainteance(true, 'a')
	 * @param bool $value
	 * @param string $message
	 */
	public function setMaintenance($value, $message)
	{
		$this->settings['maintenace'] = (bool) $value;
		$this->settings['message'] = $message;
		return true;
	}

	/**
	 * Set minify files, e.g: TemplateK::setMinify(true)
	 * @param bool $value
	 */
	public function setMinify($value)
	{
		$this->settings['minify'] = (bool) $value;
		return true;
	}

	/**
	 * Add headers to template, e.g: TemplateK::addHeader('a', 'b')
	 * @param string $name
	 * @param string $value
	 */
	public function addHeader($name, $value)
	{
		if (!is_string($name) || empty($value))
		{
			return false;
		}

		$this->headers[$name] = $value;
		return true;
	}

	/**
	 * Display all the content
	 */
	public function show()
	{
		foreach ($this->headers as $k => $v)
		{
			header($k . ':' . $v);
		}
		ob_start();
		echo $this->parse();
		ob_get_flush();
	}

	/**
	 * Parse all plugins, files, and content
	 * @return string
	 */
	private function parse()
	{
		foreach (glob($this->getPath('plugins', '*')) as $p)
		{
			require_once($p);
			$loadPlugin    = new $className($this, $this->content);
			$this->content = $loadPlugin->parse();
			unset($loadPlugin); // just clear it
		}

		return $this->content;
	}

	/**
	 * Construct paths, used to make it sexy
	 * @param  string $folder
	 * @param  string $file
	 * @return string
	 */
	private function getPath($folder, $file)
	{
		$directory  = null; // store variable
		$directory .= $this->settings['directory'];
		$directory .= $this->settings['separator'];
		$directory .= $folder;
		$directory .= $this->settings['separator'];
		$directory .= $file;
		return $directory;
	}
}
?>
