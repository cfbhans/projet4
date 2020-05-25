<?php
namespace App\Controller;

/**
* Abstract Class Controller
* Main Controller, others controllers will inherit these methods.
* @package App\Controller
*/

abstract class Controller
{
	/**
     * Render
     * Used to inser calling views in the template
     */
	protected function render(string $viewName, array $args)
	{
		foreach($args as $key => $value)
		{
			$$key = $value;
		}
		ob_start();
		require('views/' . $viewName . '.php');
		$content = ob_get_clean();
		require('views/template.php');
	}

	/**
     * Purify
     * Used to purify code
     */
	protected function purify ($value)
	{
		return strip_tags($value);
	}

}