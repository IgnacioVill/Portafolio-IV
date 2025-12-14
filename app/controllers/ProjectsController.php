<?php
namespace App\Controllers;

use App\Core\Controller;

class ProjectsController extends Controller {
    public function index() {
        $model = new \App\Models\PortfolioModel();
        $allProjects = $model->getProjects();
        $categories = $model->getProjectCategories();
        
        // Filtrar por categoría si se especifica
        $selectedCategory = $_GET['category'] ?? 'all';
        $projects = $allProjects;
        if ($selectedCategory !== 'all') {
            $projects = array_filter($allProjects, function($project) use ($selectedCategory) {
                return strtolower($project['category']) === strtolower($selectedCategory);
            });
        }
        
        $data = [
            'title' => 'Proyectos - Portafolio Ignacio Villanueva',
            'page' => 'projects',
            'projects' => $projects,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory
        ];
        $this->view('projects/index', $data);
    }
    
    public function show() {
        $model = new \App\Models\PortfolioModel();
        $projects = $model->getProjects();
        $projectId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        
        $project = null;
        $currentIndex = -1;
        
        if ($projectId) {
            foreach ($projects as $index => $p) {
                if ($p['id'] == $projectId) {
                    $project = $p;
                    $currentIndex = $index;
                    break;
                }
            }
        }
        
        if (!$project) {
            header("HTTP/1.0 404 Not Found");
            require_once APP . '/views/errors/404.php';
            return;
        }
        
        // Obtener proyecto anterior y siguiente
        $prevProject = null;
        $nextProject = null;
        
        if ($currentIndex > 0) {
            $prevProject = $projects[$currentIndex - 1];
        }
        if ($currentIndex < count($projects) - 1) {
            $nextProject = $projects[$currentIndex + 1];
        }
        
        $data = [
            'title' => $project['title'] . ' - Portafolio Ignacio Villanueva',
            'page' => 'projects',
            'project' => $project,
            'prevProject' => $prevProject,
            'nextProject' => $nextProject
        ];
        $this->view('projects/show', $data);
    }
}
?>

