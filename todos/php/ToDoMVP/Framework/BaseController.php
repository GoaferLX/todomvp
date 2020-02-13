<?php
namespace GoaferLX\Framework;
class BaseController
{
    private $router;
    public function __construct (\GoaferLX\Framework\Router $router)
    {
        $this->router = $router;
        $this->routeParts = $this->router->getRequestParts();
        session_start();

    }

    public function staticRoute () {
        if($mvc=$this->router->setMVC())
            foreach($mvc as $key=>$value) {
             $$key = $value;
            }

        $currentlist = !empty($_POST['currentlist'])?unserialize(base64_decode($_POST['currentlist'])):[];
        $this->model = new $modelname($currentlist);
        $this->controller = new $controllername();
        $this->view = new $viewname();
    }


    public function callMethod ($obj, $method, $model) {
        if (!empty($obj) && !empty($method)) {
            if (method_exists($obj, $method)) {
                $model = $obj->$method($model);
            }
            return $model;
        }
    }

    public function execute()
    {
        $this->staticRoute();

        $method = !empty($this->routeParts[0]) ? $this->routeParts[0] : 'add';
        $this->model = $this->callMethod($this->controller, $method, $this->model);
        $this->callMethod($this->view, "render", $this->model);

    }
}
?>
