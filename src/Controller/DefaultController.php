<?php
namespace App\Controller;

use App\Services\MyLog;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController {
 
    // public function __construct(private Filesystem $filesystem)
    // {
        
    // }

    #[Route('/')]
    public function index(Request $request){

        $todo = new Todo('Je suis une todo');

        $form = $this->createFormBuilder($todo)
             ->add('content', TextType::class, [
                // 'data' => 'par defaut',
                // 'disabled'=> true,
                'required' => false,
                'label' => 'je suis un label',
                'attr' => [
                    'class' => 'myclass',
                    'placeholder' => 'entrez un contenu'
                ],
                'help' => 'le contenu est important ',
                'row_attr' => [
                    'class' => 'myrow'
                ]
             ])
             ->add('type', TextType::class,['mapped'=> false])
             ->add('done', CheckboxType::class, ['required' => false])
             ->add('Submit', SubmitType::class)
            //  ->setMethod('get')
             ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            dd($todo);
        }
        return $this->render('page1.html.twig', ['myform'=>$form->createView()]);
      
    }
    // #[Route('/')]
    // public function index(string $adminEmail, ContainerInterface $container){
    //     $mylog = $container->get('App\\Services\\MyLog');
       
    //     $mylog->writenLog('un message');
    //     return $this->render('page1.html.twig');
      
    // }
    // public function index(LoggerInterface $log ){
// creer un dosssier
        // $this->filesystem->mkdir('photos');
// creer un fichier   
        // $this->filesystem->touch('photos/Text.txt');
// ecrire dans le fichier 
        // $this->filesystem->appendToFile('photos/Text.txt', 'Je suis un contenut ');
        // $log->info("je suis un message de log");
        // $user = [
        //     'name' => 'Noémie',
        //     'email' => 'noémie@fd.com'
        // ];
        // $product = [
        //     'name' => 'voiture Tesla',
        //     'price' => 50000,
        //     'lastUpdate' => strtotime('yesterday')
        // ];
        // return $this->render('test.html.twig', [
        //     'product' => $product, 
        //     'h1' => '<h1>hello</h1>',
        //     'author' => $user
        // ]);

 

    #[Route(path:'about/list/{name}', name:'about')]
    public function aboutList($name) {
        dd($name);
        return $this->render('base.html.twig');

    }
        // return $this->render('@emails/emails_welcome.html.twig');
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

class Todo {
    public function __construct(
        public string $content,
        public bool $done =  false,
    )
    {
        
    }                       
}