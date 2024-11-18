<?php
namespace App;

class Router {
    private $routes = [];

    public function get() {
        $this->addRoute('GET', $url, $action);

    }
    public function post() {
        $this->addRoute('POST', $url, $action);
    }

    private function addRoute(string $method,string $url, callable $action) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'action' => $action
        ];
    }
    public function resolve() {}
}