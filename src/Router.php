<?php
namespace App;

/**
 * Class Router
 * Gère l'enregistrement et la résolution des routes pour notre applivation web.
 * Permet de définir des routes HTTP et d'ex"cuté les actions correspondantes
 * en fonction des requêtes entrants
 */

class Router {
    private $routes = [];

    /**
     * Enregistre une route GET
     * 
     * @param string $url URL de la route (ex:"/home).
     * @param callable $action FOnction ou méthode à exécuter si la route correspond
     * @return void
     */

    public function get($url,$action) {
        $this->addRoute('GET', $url, $action);

    }

     /**
     * Enregistre une route POST
     * 
     * @param string $url URL de la route (ex:"/delete).
     * @param callable $action Fonction ou méthode à exécuter si la route correspond
     * @return void
     */
    public function post($url, $action) {
        $this->addRoute('POST', $url, $action);
    }

    /**
     * Ajoute une route à la liste des routes.
     * 
     * @param string $method Methode HTTP (GET, POST, etc...).
     * @param string $url URL de la route (ex:"/home).
     * @param callable $action FOnction ou méthode à exécuter si la route correspond
     * @return void
     */

    private function addRoute($method,$url, $action) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'action' => $action
        ];
    }


    /**
     * 
     * Résout la requête entrante en fonction des routes enregistrées.
     * 
     * - Compare l'URL et la méthode HTTP de la requête avec chaque route enregistrée.
     * - Si une correspondance est trouvée, l'action associée est exécutée.
     * -Sino, une erreur 404 est retournée
     * @return void
     */
    public function resolve() {

        // Récupérer l'url depuis la rerquête
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Récupérer la méthode HTTP utilisée pour la requête
        $requestMethod = parse_url($_SERVER['REQUEST_METHOD']);

        // Parcourir toutes les routes enregistrées
        foreach ($this->routes  as $route) {

            //Vérifier si l'URL et la méthode HTTP correspondent à la route actuelle.
            if ($route['url'] === $requestUrl && $route['method'] === $requestMethod) {

               //Si une correspondance est trouvée exécute l'action associée.
               call_user_func($route['action']); 
               
               return; // Termine la méthode après avoir exécuter l'action.
            }
        }
        // Si aucune correspondance n'et rouvée, retourner une erreur 404
        http_response_code(404);
        echo "404 Page non trouvée";
    }
}