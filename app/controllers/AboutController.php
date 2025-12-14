<?php
namespace App\Controllers;

use App\Core\Controller;

class AboutController extends Controller {
    public function index() {
        $data = [
            'title' => 'Sobre Mí - Portafolio Ignacio Villanueva',
            'page' => 'about'
        ];
        $this->view('about/index', $data);
    }
}
?>

