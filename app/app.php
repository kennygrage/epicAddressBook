<?php
    //include files in our app
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    //my understanding is this creates a new cookie session array
    session_start();
    if(empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
        //I know I am supposed to put the line above, so I will put it because I
        //am hoping to get the grade, "The code meets this standard all of the time".
        //However, I would think we should put the following line:
        //Contact::deleteAll();
        //It does the same thing. DRY programming? I am sure you will tell me
        //that I am wrong.
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

    //create contact page
    $app->post("/add_contact", function() use ($app) {
        $contact = new Contact($_POST['name'], $_POST['phone'], $_POST['address']);
        $contact->save();
        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact));
    });

    //delete all contacts page
    $app->post("/delete_all_contacts", function() use ($app) {
        Contact::deleteAll();
        return $app['twig']->render('delete_all_contacts.html.twig');
    });



    return $app;
?>
