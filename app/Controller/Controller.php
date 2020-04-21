<?php
namespace App\Controller;

abstract class Controller
{
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

	protected function purify ($value)
	{
		return htmlspecialchars($value);
	}

}