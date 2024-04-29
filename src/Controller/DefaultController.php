<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
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
  #[Route('/edit/{toto}', name: 'todo_edit')]
  #[Route('/edit/{toto}/{start}', name: 'todo_edit_start')]

  public function form(Request $request,EntityManagerInterface $em,?\DateTime $start, #[MapEntity(mapping:['toto' => 'id'])] ?Todo $todo){
    $edit = $todo ? true:false;

    dump($start);

    if (!$edit){
      if($request->attributes->get('_route')==="todo_edit"){
        return $this->redirectToRoute('home');
      }
      $todo = new Todo();
    }
   
    $todoForm = $this->createForm(TodoType::class, $todo);
    if ($edit){
      $todoForm->add('done', CheckboxType::class, ['required' => false]);
    }

    $todoForm->handleRequest($request);

    if($todoForm->isSubmitted() && $todoForm->isValid()) {
      if(!$edit){ 
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

  #[Route('/remove/{id}', name: 'todo_remove')]
  public function remove(int $id,TodoRepository $repo,EntityManagerInterface $em,){
    $todo = $repo->find($id);
    $em->remove($todo);
    $em->flush();

    return $this->redirectToRoute('home');
  }

}


