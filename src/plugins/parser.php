<?php
$className = 'Parser'; // set class name

/**
 * MIT License. Copyright (c) 2018 Paulo Rodriguez
 * This file is part of TemplateK.
 * TODO: Create statements ELSE and ELSEIF
 * TODO: Create foreach()'s method
 * TODO: Create while()'s method
 */
class Parser
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
		 * Set variables {VAR} to $var
		 */
		foreach ($this->template->varList as $k => $v)
		{
			$this->content = preg_replace('/{' . $k . '}/', $v, $this->content);
		}

		/**
		 * Replace IF statement for the new one
		 */
		preg_replace_callback('/\[IF (.*?)](.*?)\[\/END]/is', array($this, 'StatementIF'), $this->content);

		return $this->content;
	}

	/**
	 * Parse statement IF
	 * @param array $arr
	 */
	private function StatementIF($arr)
	{
		$toReplace = eval("return ({$arr[1]});") ? $arr[2] : null;
	  $this->content = preg_replace('/\[IF ' . $arr[1] .  '](.*?)\[\/END]/is', $toReplace, $this->content);
	}
}
?>
