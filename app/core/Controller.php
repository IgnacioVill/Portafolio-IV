<?php
namespace App\Core;

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $viewFile = APP . '/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once APP . '/views/layout/header.php';
            require_once $viewFile;
            require_once APP . '/views/layout/footer.php';
        } else {
            die("Vista no encontrada: $view");
        }
    }
    
    protected function model($model) {
        require_once APP . '/models/' . $model . '.php';
        $modelClass = 'App\\Models\\' . $model;
        return new $modelClass();
    }
}
?>

