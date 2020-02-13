<?php
namespace GoaferLX\ToDo;

class ToDoView
{
	public function __construct()
	{

	}

	public function loadTemplate($template, array $params=[])
	{
			if(file_exists(__DIR__."/$template.php")) {
        	extract($params);
		    	ob_start();
					require(__DIR__."/$template.php");
					return ob_get_clean();
			} else {
					echo "Could not load Template, file $template does not exist";
			}
	}

	public function renderAddForm($list)
	{
			$item['json'] = base64_encode(serialize($list));
			return $form = $this->loadTemplate('newtodoform',$item);
	}
	public function renderToDoForm($list)
	{
			$content = '<section class="items">
				  <h2>Todo list</h2>
				  <ul>';
			foreach($list as $id=>$todo) {
					$item['item'] = $todo->getItem();
					$completed = $todo->getCompleted();
					$item['id'] = $id;
					$item['json'] = base64_encode(serialize($list));
					if($completed == true) {
					$content .= '<li class="todo done">
							<span class="item-name">
								<s>'.$item['item'].'</s>
							</span>';
						$content .= $this->loadTemplate('doneForm', $item);
						$content .= '</li>';
					} else {
						$content .= '<li class="todo">
								<span class="item-name">
									'.$item['item'].'
								</span>';
						$content .= $this->loadTemplate('notDoneForm', $item);
						$content .= '</li>';
					}
				}
				$content .=   '</ul>
				</section>';
				return $content;
	}
	public function renderErrors($errors) {
			$content = '';
			if(!empty($errors)) {
					foreach($errors as $error) {
						$content .= '<p>'.$error.'</p>';
					}
			return $content;
			}
	}
  public function render($model) {
  		$list = $model->getList();
			$errors = $model->getErrors();
			$page['title'] = 'Todo MVP';
			$page['content'] = $this->renderAddForm($list);
		  $page['content'] .= $this->renderToDoForm($list);
			$page['errors'] = $this->renderErrors($errors);
      echo $this->loadTemplate("../public/layout",$page);

    }


}
?>
