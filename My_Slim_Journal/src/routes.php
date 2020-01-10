
<?php
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Classes\Entry;
use App\Classes\Comment;
return function (App $app) {
    $container = $app->getContainer();
    // Display list of entries on Blog home page
    $app->get(/*['GET','POST'], */'/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        $entries = Entry::all();

        $args['entries'] = $entries;
        return $this->view->render($response, 'Blog_Home.twig', $args);
    })->SetName('Blog_Home');
   //create new entry for blog
    $app->map(['GET', 'POST'],'/new', function (Request $request, Response $response, array $args) use ($container) {
      if($request->getMethod() == "POST") {
          $args = array_merge($args, $request->getParsedBody());
             if (!empty($args['title']) /*&& !empty($args['date']) */&& !empty($args['body'])) {
               $entry = new Entry;
               $entry->title = $args['title'];
               $entry->body = $args['body'];
               $entry->save();
             echo "Entry created successfully!";
              $url = $this->router->pathFor('Blog_Home');
              return $response->withStatus(302)->withHeader('Location', $url);
            }
      }

        return $this->view->render($response, 'new.twig', $args);
   });
    //load single entry details
    $app->get('/entry/[{id}]', function (Request $request, Response $response, array $args) use ($container) {


        $entry = Entry::find($args['id']);

        $args['details'] = $entry;

        $comments = Comment::with('entry_id')->where('entry_id' == $args['id']);
        var_dump($comments);

        return $this->view->render($response, 'detail.twig', $args);
    })->SetName('Entry');;

    //retrieve entry in edit view
    $app->map(['GET', 'POST'],'/entry/edit/[{id}]', function (Request $request, Response $response, array $args) use ($container) {
        $entry = Entry::find($args['id']);
        $args['details'] = $entry;

      if($request->getMethod() == "POST") {
         $args = array_merge($args, $request->getParsedBody());
             if (!empty($args['title']) && !empty($args['body'])) {

               $entry->title = $args['title'];
               $entry->body = $args['body'];
               $entry->save();

             $args['message'] = "Entry updated successfully!";
             $url = "/entry/" . $args['id'];

      return $this->view->render($response, 'detail.twig', $args);
            }
      }



        return $this->view->render($response, 'edit.twig', $args);
   });

};
