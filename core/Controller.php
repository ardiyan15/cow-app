<?php
class Controller
{
    public function renderView($view, $data = [])
    {
        // Extract data so variables are available in the view
        extract($data);

        // Start output buffering
        ob_start();
        // Include the specific view file
        include __DIR__ . '/../app/views/' . $view . '.php';
        // Capture the view content
        $content = ob_get_clean();

        // Include the main layout
        include __DIR__ . '/../app/views/layout/index.php';
    }
}
