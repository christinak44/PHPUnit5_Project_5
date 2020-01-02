
<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Classes\Entry;
return function (App $app) {
    $container = $app->getContainer();
    $app->get(/*['GET','POST'], */'/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        // Render index view
        $entries = Entry::all();
        //$entry = new Entry($this->db);
        //$entries = $entry->getEntries();
        //var_dump($entries);
        // $args = array_merge($args, $entries);
        //$args['post'] = $this->db;
        $args['entries'] = $entries;
        return $this->view->render($response, 'Blog_Home.twig', $args);
    })->SetName('Blog_Home');

    $app->map(['GET', 'POST'],'/new', function (Request $request, Response $response, array $args) use ($container) {
      if($request->getMethod() == "POST") {
          $args = array_merge($args, $request->getParsedBody());
             if (!empty($args['title']) /*&& !empty($args['date']) */&& !empty($args['body'])) {
                $entry = Entry::create([
                         'title' => $args['title'],
                         //'date' => $args['date'],
                         'body' => $args['body']
                ]);
              echo "Entry created successfully!";
              $url = $this->router->pathFor('Blog_Home');
              return $response->withStatus(302)->withHeader('Location', $url);
            }
      }
                //echo "Entry created successfully!";
        return $this->view->render($response, 'new.twig', $args);
   });

    $app->get('/entry/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        //$entry = new Entry($this->db);

        //$entries = $entry->getEntry($args['id']);

        //$entry = Entry::where('id','=', $id);
        $entry = Entry::find($args['id']);
        //$args = array_merge($args, $request->getParsedBody());
        //$args['post'] = $this->db;
        $args['details'] = $entry;
        //$args['entry'] = $entries;
        return $this->view->render($response, 'detail.twig', $args);
    });
    
};
