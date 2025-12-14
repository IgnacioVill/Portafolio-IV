<?php
namespace App\Controllers;

use App\Core\Controller;

class ExperienceController extends Controller {
    public function index() {
        $data = [
            'title' => 'Experiencia - Portafolio Ignacio Villanueva',
            'page' => 'experience'
        ];
        $this->view('experience/index', $data);
    }
}
?>

