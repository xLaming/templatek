<?php
$className = 'Maintenance'; // set class name

/**
 * MIT License. Copyright (c) 2018 Paulo Rodriguez
 * This file is part of TemplateK.
 */
class Maintenance
{
	public $template;
	public $content;

	/**
	 * Construct and start the main function
	 * @param string $template
	 * @param string $content
	 */
	public function __construct($template, $content)
	{
		list($this->template, $this->content) =
		[
			$template,
			$content
		];
	}

	/**
	 * Parse this plugin
	 * @return string
	 */
	public function parse()
	{
		/**
		 * If it is under maintenance set content with the maintenance message.
		 */
		if ($this->template->settings['maintenance'])
		{
			$this->content = $this->template->settings['message'];
		}
		return $this->content;
	}
}
?>
