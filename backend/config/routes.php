<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    // Routes without authenctication
    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Default', 'action' => 'home']);
        $builder->connect('/login', ['controller' => 'Default', 'action' => 'login']);
        $builder->connect('/signup', ['controller' => 'Default', 'action' => 'signup']);
        $builder->connect('/logout', ['controller' => 'Default', 'action' => 'logout']);
        $builder->fallbacks();
    });
    
    // Routes for admin
    $routes->prefix('admin', function ($routes) {
        $controllers = ['Bookings', 'Users', 'Tickets', 'Events', 'EventCategory', 'TicketCategory'];
        $rout_names = ['/bookings', '/users', '/tickets', '/events', '/event-category', '/ticket-category'];
        for ($i=0; $i < count($controllers) ; $i++) { 
            $routes->connect($rout_names[$i], ['controller' => $controllers[$i], 'action' => 'index']);
            $routes->connect($rout_names[$i].'/view/{id}', ['controller' => $controllers[$i], 'action' => 'view'], ['pass' => ['id']]);
            $routes->connect($rout_names[$i].'/add', ['controller' => $controllers[$i], 'action' => 'add']);
            $routes->connect($rout_names[$i].'/edit/{id}', ['controller' => $controllers[$i], 'action' => 'edit'], ['pass' => ['id']]);
            $routes->connect($rout_names[$i].'/delete/{id}', ['controller' => $controllers[$i], 'action' => 'delete'], ['pass' => ['id']]);
        }        
    });

    // Routes for organiser
    // $controllers = ['Events','Tickets'];
    // $rout_names = ['/events', '/tickets'];
    // for ($i=0; $i < count($controllers) ; $i++) { 
    //     $routes->connect($rout_names[$i], ['controller' => $controllers[$i], 'action' => 'index']);
    //     $routes->connect($rout_names[$i].'/view/{id}', ['controller' => $controllers[$i], 'action' => 'view'], ['pass' => ['id']]);
    //     $routes->connect($rout_names[$i].'/add', ['controller' => $controllers[$i], 'action' => 'add']);
    //     $routes->connect($rout_names[$i].'/edit/{id}', ['controller' => $controllers[$i], 'action' => 'edit'], ['pass' => ['id']]);
    //     $routes->connect($rout_names[$i].'/delete/{id}', ['controller' => $controllers[$i], 'action' => 'delete'], ['pass' => ['id']]);
    // }
    $routes->prefix('organiser', function ($routes) {

        $routes->connect('/events', ['controller' => 'Events', 'action' => 'index']);
        $routes->connect('/events/view/{id}', ['controller' => 'Events', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect('/events/add', ['controller' => 'Events', 'action' => 'add']);
        $routes->connect('/events/edit/{id}', ['controller' => 'Events', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect('/events/delete/{id}', ['controller' => 'Events', 'action' => 'delete'], ['pass' => ['id']]);

        $routes->connect('/tickets/{event_id}', ['controller' => 'Tickets', 'action' => 'index'], ['pass' => ['event_id']]);
        $routes->connect('/tickets/{event_id}/add', ['controller' => 'Tickets', 'action' => 'add'], ['pass' => ['event_id']]);
        $routes->connect('/tickets/{event_id}/view/{id}', ['controller' => 'Tickets', 'action' => 'view'], ['pass' => ['event_id','id']]);
        $routes->connect('/tickets/{event_id}/edit/{id}', ['controller' => 'Tickets', 'action' => 'edit'], ['pass' => ['event_id','id']]);
    });

    // Routes for user
    $routes->prefix('user', function ($routes) {
        $routes->connect('/bookings', ['controller' => 'Bookings', 'action' => 'index']);
        $routes->connect('/bookings/view/{id}', ['controller' => 'Bookings', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect('/bookings/add/{id}', ['controller' => 'Bookings', 'action' => 'add'], ['pass' => ['id']]);
        // $routes->connect('/bookings/edit/{id}', ['controller' => 'Bookings', 'action' => 'edit'], ['pass' => ['id']]);
        // $routes->connect('/bookings/delete/{id}', ['controller' => 'Bookings', 'action' => 'delete'], ['pass' => ['id']]);
    });
};
