<?php

class AppController
{
    private $request;
    protected ?string $tabName = null;

    public function __construct() {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool {
        return $this->request === 'GET';
    }

    protected function isPost(): bool {
        return $this->request === 'POST';
    }

    public function index() {
        throw new Exception('Not implemented');
    }

    protected function redirect($url) {
        $main_url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$main_url}/{$url}");
    }

    protected function render(string $template = null, $viewData=array()) {
        $templatePath = "public/views/{$template}.php";
        $output = 'File not found';

        if ($this->tabName != null)
            ViewSupport::setActiveTab($this->tabName);

        if (file_exists($templatePath)) {
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }
}