<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController {
    public function index(Request $request){
        // dd($request);
        $response = new Response('<h1>Hello World</h1>');
        return $response;
    }


    #[
        Route(
            path: '/blog/{name}',
            name: 'blog',
            methods: ["GET"],
            schemes:["HTTPS"],
            defaults: [
                "name" => "",
                "foo" => "bar"
            ],
            // requirements: [
            //     'name' => '[a-zA-Z]'
            // ]

            )
    ]
    public function blog(Request $request){
        $title = $request->attributes->get('id');
        // $allRouteparams = $request->attributes->all();
        // $allparam = $request->attributes->get('_route_params');
        dd($request);
        return new Response('Blog');
    }

    
    #[
        Route(
            path: '/blog/homepage',
            name: 'homepage',
            methods: ["GET"],
            priority: -1
            )
    ]

    public function blogHomePage(){
        return new Response('blog homepage');
    }

}