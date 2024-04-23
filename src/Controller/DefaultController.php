<?php
namespace App\Controller;

use App\Form\TodoType;
use Assert\Lenght;
use App\Services\MyLog;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Container\ContainerInterface as ContainerContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class DefaultController extends AbstractController {
 
    // public function __construct(private Filesystem $filesystem)
    // {
        
    // }

    #[Route('/')]
    public function index(Request $request, RequestStack $requestStack){
        $session = $requestStack->getSession();

        // $session->set('myvar', 123);
        // dump($session->get('myvar'));
        // dump($session->get('test', 'defaut'));
        $session->getId();

        dd($session);

        $todo = new Todo('Je suis une todo', 'techno');

        $form = $this->createForm(TodoType::class);
            //  ->add('content', TextType::class, 
            //  [
            //     // 'data' => 'par defaut',
            //     // 'disabled'=> true,
            //     'required' => false,
            //     'label' => 'je suis un label',
            //     'attr' => [
            //         'class' => 'myclass',
            //         'placeholder' => 'entrez un contenu'
            //     ],
            //     'help' => 'le contenu est important ',
            //     'row_attr' => [
            //         'class' => 'my-row'
            //     ]
            //  ]
            //  )
            //  ->add('type', ChoiceType::class,[
            //     'choices' => [
            //        'Techno' => 'techno',
            //        'Nature' => 'nature'
            //     ],
            //      'choice_attr' => function($choice, $key, $value){
            //         return ['class' => 'my-class-option'];
            //      },

                //  'choice_filter' => function($option){
                //     return $option != 'nature';

                //  },
                //  'expanded' => true,
                //  'multiple' => true
            

                // ])
            //  ->add('pays', CountryType::class,['mapped' => false] )
            //  ->add('date', DateType::class, [
            //     'mapped' =>false,
            //     'widget' => 'choice',
            //     'input' => 'datetime',
            //     'html5'=> false,
            //     'attr'=> [
            //         'class' => 'js-picker'
            //     ],
            //     'days' => range(1,15),
                // 'months' => range(1,6),            ])
            //  ->add('done', CheckboxType::class, ['required' => false])
            //  ->add('Submit', SubmitType::class)
            //  ->setMethod('get')
            //  ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
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
        #[Email(message:'pas correcte')]
        #[NotBlank(message: 'Je ne peut pas etre vide ')] 
        #[Length(
            min: 5,
            max: 30,
            minMessage: 'Trop court',
            maxMessage: 'Trop long'

        )]
        public ?string $content,
        #[Choice(
            choices:['techno', 'nature'],
            message: 'Mauvaise valeur',
            multiple: true,
            multipleMessage:'une des valeur n\'est pas correcte'
        )]
        public string $type,
        public bool $done =  false,
    )
    {
        
    }                       
}