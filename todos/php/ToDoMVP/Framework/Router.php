<?php
namespace GoaferLX\Framework;
class Router
{
    private $routesTable;
    private $request;
    private $requestMethod;

    public function __construct(\GoaferLX\Framework\Routes $routesTable)
    {
		    $this->routesTable = $routesTable->getRoutesTable();
	      $this->request = trim(strtok(filter_var($_SERVER['REQUEST_URI'],FILTER_SANITIZE_URL), '?'), '/');
		    $this->checkURL($this->request);
		    $this->requestMethod = $_SERVER['REQUEST_METHOD'];
	  }
    private function getRequestMethod()
    {
        return $this->requestMethod();
    }
    public function getRoutesTable()
    {
    	 return $this->routesTable;
	  }
	  public function getRequest()
    {
    	return $this->request;
    }

	private function checkURL(string $route)
  {
		if($route != strtolower($route)) {
			http_response_code(301);
			header('Location: http://localhost/'.strtolower($route));
		}
	}
	public function setMVC()
    {
        if (array_key_exists($this->requestParts[0], $this->routesTable)) {
            return $this->routesTable[$this->requestParts[0]]['GET'];
        } else {
        http_response_code(404);
        return $this->routesTable['index']['GET'];
        }
    }


	public function getRequestParts():array {
		return $this->requestParts = explode("/", $this->request);
	}
}
?>
