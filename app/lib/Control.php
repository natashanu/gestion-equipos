<?php
class Control
{
  public function load_model($model)
  {
    require_once '../app/models/' . $model . '.php';

    return new $model;
  }

  public function load_view($view, $datos = [], $template = 'templates/layout')
  {
    $path = '../app/views/pages/' . $view . '.php';

    if(file_exists($path))
    {
        $slot = $path;
        extract($datos);
        require_once '../app/views/' . $template . '.php';

    }
    else
    {
      die("404 NOT FOUND");
    }
  }
}

