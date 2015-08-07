<?php
    //include files in our app
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    //my understanding is this creates a new cookie session array
    session_start();
    if(empty($_SESSION['list_of_contacts'])) {
        //this line is usually put here: $_SESSION['list_of_contacts'] = array();
        //although the line below does the same thing. DRY programming? I am sure
        //you will tell me that I am wrong?
        Contact::deleteAll();
    }

    //include Silex
    $app = new Silex\Application();

    //I have found setting this to true to be very useful
    $app['debug'] = true;

    //and lets not forget Twig
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        //not sure what the difference is between => and ->, but just retyping
        //the same syntax on the line below
        'twig.path' => __DIR__.'/../views'
    ));



    //***PATHS***

    //root path               use ($app) must be a twig thing?
    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig', array('contacts' => Contact::getAll()));

    });

    $app->post("/add_contacts", function() use ($app) {
        $contact = new Contact($_POST['name'], $_POST['phone'], $_POST['address']);
        $contact->save();
        return $app['twig']->render('create_contacts.html.twig', array('newcontact' => $contact));
    });

    $app->post("/delete_contacts", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('delete_tasks.html.twig');
    });



    return $app;
?>
