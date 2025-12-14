<?php
namespace App\Controllers;

use App\Core\Controller;

class SkillsController extends Controller {
    public function index() {
        $data = [
            'title' => 'Habilidades - Portafolio Ignacio Villanueva',
            'page' => 'skills'
        ];
        $this->view('skills/index', $data);
    }
}
?>

