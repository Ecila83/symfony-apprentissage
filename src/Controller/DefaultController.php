<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



class DefaultController extends AbstractController {
    #[Route('/')]
    public function index(){
        // retourne un fichier
        // return $this->file('test.txt'); 

        // return un fichier twig
        return $this->render("base.html.twig");
        

    }


    // #[
    //     Route(
    //         path: '/{name}',
    //         name: 'blog',
    //         methods: ["GET"],
    //         schemes:["HTTPS"],
    //         defaults: [
    //             "name" => "",
    //             "foo" => "bar"
    //         ],
    //         // requirements: [
    //         //     'name' => '[a-zA-Z]'
    //         // ]

    //         )
    // ]
    // public function blog(Request $request){
    //     $title = $request->attributes->get('id');
    //     // $allRouteparams = $request->attributes->all();
    //     // $allparam = $request->attributes->get('_route_params');
    //     dd($request);
    //     return new Response('Blog');
    // }

    
    // #[
    //     Route(
    //         path: '/homepage',
    //         name: 'homepage',
    //         methods: ["GET"],
    //         priority: 1
    //         )
    // ]

    // public function blogHomePage(){
    //     return new Response('blog homepage');
    // }

}