
<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Classes\Entry;
return function (App $app) {
    $container = $app->getContainer();
    $app->get('/entries', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        // Render index view
        $entry = new Entry($this->db);
        $entries = $entry->getEntries();
        //var_dump($entries);
        // $args = array_merge($args, $entries);
        //$args['post'] = $this->db;
        $args['entries'] = $entries;
        return $this->renderer->render($response, 'Blog_Home.phtml', $args);
    });
    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {

        $entry = new Entry($this->db);
        $details = $entry->getEntry(3);
        //var_dump($details);
         //$args = array_merge($args, $entries);
        //$args['post'] = $this->db;
        $args['details'] = $details;
        return $this->renderer->render($response, 'detail.phtml', $args);
    });
};
