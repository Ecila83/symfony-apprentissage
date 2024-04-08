<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController {
    #[Route('/')]
    public function index(){

        return $this->render('@emails/emails_welcome.html.twig');
        // return $this->render('@AcmeFoo/emails_welcome.html.twig');

        // $emailProvider = $this->getParameter('app.email_provider');
        // dd($emailProvider);

        // throw $this->createNotFoundException('produit non trouvé');
        // rediriger a partir d'une url generée relative
        // $url = $this->generateUrl('app_blog',['title' => 'bar']);
        // dd($url);

        // url  absolute
        // $url = $this->generateUrl('app_blog',['title' => 'bar'], UrlGeneratorInterface::ABSOLUTE_URL);
        // dd($url);


        // redirection vers une autre page 
        //    if (true){ 
        //    return $this->redirectToRoute('app_blog', ['title' => 'je suis un param']);
        // }
            
            // retourne un fichier
            // return $this->file('test.txt'); 

            // return un fichier twig
            // return $this->render("base.html.twig");
            

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

