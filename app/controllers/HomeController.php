<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Inicio - Portafolio Ignacio Villanueva',
            'page' => 'home'
        ];
        $this->view('home/index', $data);
    }
}
?>

