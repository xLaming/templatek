<?php
$className = 'InternalComments'; // set class name

/**
 * MIT License. Copyright (c) 2018 Paulo Rodriguez
 * This file is part of TemplateK.
 */
class InternalComments
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
		$this->content = preg_replace('/<!--#(.*?)#-->/', '', $this->content);
		return $this->content;
	}
}
?>
