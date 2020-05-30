<?php
namespace App\Router;

/**
 * 
 */
class Router
{
	private $url;
	private $route = [];
	private $namedRoutes = [];

	public function __construct($url)
	{
		$this->url = $url;
	}


	public function get($path, $callable, $name = null){
		return $this->add($path, $callable, $name, 'GET');
	}

	public function post($path, $callable, $name = null){
		return $this->add($path, $callable, $name, 'POST');
	}

	private function add($path, $callable, $name, $method) {
		$route = new Route($path, $callable);
		$this->route[$method][] = $route;

		if($name){
			$this->namedRoutes[$name] = $route;
		}

		return $route;
	}

	public function run()
	{
		if(!isset($this->route[$_SERVER['REQUEST_METHOD']])){
			throw new RouterException("REQUEST_METHOD does not exist");
			
		}
		foreach($this->route[$_SERVER['REQUEST_METHOD']] as $route) {
			if($route->match($this->url)){
				return $route->call();
			}
		}

		throw new RouterException("No matching route");
	}


	public function url($name, $params= []){
		if(!isset($this->namedRoutes[$name])){
			throw new RouterException("No route matches this name");
		}

		return $this->namedRoutes[$name]->getUrl($params);
	}
}