<?php
namespace GoaferLX\ToDo;
use \GoaferLX\Framework\Routes;
class ToDoRoutes implements Routes {
    public function getRoutesTable(): array {
        $routesTable = array(
            'index' => array(
                'GET' => array (
                    'modelname'=>'GoaferLX\ToDo\ToDoModel',
                    'controllername'=>'GoaferLX\ToDo\ToDoController',
                    'viewname'=>'GoaferLX\ToDo\ToDoView',
                ),
                
            ),
         );
        return $routesTable;
    }
}
