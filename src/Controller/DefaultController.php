<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DefaultController extends AbstractController
{
  function __construct()
  {
  }

  #[Route('/', name: 'home')]
  public function index(TodoRepository $repo)
  {
    // $todos =$repo->findAll();
    // $todos =[$repo->find(3)];
    $todos =$repo->findAll(
      // [
    //   'id' => [2,5],
    // ],
    // [
    //   'content' => 'DESC'
    // ],2,1
  );


    if(!$todos){
      throw $this->createNotFoundException('Pas de todos');
    }

    return $this->render('home.html.twig', ['todos' => $todos]);
  }

  #[Route('/form', name: 'todo_form')]
  #[Route('/edit/{id}', name: 'todo_edit')]
  public function form(Request $request,EntityManagerInterface $em, ?int $id, TodoRepository $repo){

    if ($id){
      $todo= $repo->find($id);
    }else{
      $todo = new Todo();
    }
   
    $todoForm = $this->createForm(TodoType::class, $todo);
    if ($id){
      $todoForm->add('done', CheckboxType::class, ['required' => false]);
    }

    $todoForm->handleRequest($request);

    if($todoForm->isSubmitted() && $todoForm->isValid()) {
      if(!$id){ 
      $todo->setCreatedAt(new \DateTime());
    }

      $em->persist($todo);
      $em->flush();
      return $this->redirectToRoute('home');
    }

    return $this->render('todo_form.html.twig',[
      'form' => $todoForm->createView()
    ]);
  }

}


