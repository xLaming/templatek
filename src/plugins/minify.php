<?php
$className = 'Minify'; // set class name

/**
 * MIT License. Copyright (c) 2018 Paulo Rodriguez
 * This file is part of TemplateK.
 */
class Minify
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
		 * If minify is true it will parse the content in the function minify
		 */
		if ($this->template->settings['minify'])
		{
			$this->content = $this->minify($this->content);
		}

		return $this->content;
	}

	/**
	 * Function used to minify the HTML content
	 * @param  string $content
	 * @return string
	 */
	private function minify($content)
	{
		$search = [ // Regex HTML to replace like spaces, break-lines, etc
			'/\>[^\S ]+/s',
			'/[^\S ]+\</s',
			'/(\s)+/s',
			'/<!--(.|\s)*?-->/'
		];
		$replace = [ // Regex to replace after
			'>',
			'<',
			'\\1',
			''
		];
		$content = preg_replace($search, $replace, $content);
		return $content;
	}
}
?>
