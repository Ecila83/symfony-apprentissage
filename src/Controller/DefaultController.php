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
                "name" => "Lulu",
            ]

            )
    ]
    public function blog(){
      return new Response('Blog');
    }
}