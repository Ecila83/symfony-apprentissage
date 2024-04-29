<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Todo;
use App\Entity\Author;
use App\Form\TodoType;
use App\Repository\TagRepository;
use App\Repository\TodoRepository;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    $todos =$repo->findAllWithPriorityMoreThan(1);


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

  #[Route('/test', name: 'test')]
  public function test(EntityManagerInterface $em,TodoRepository $todoRepo, AuthorRepository $authorRepo, TagRepository $tagRepo){
    // $author = new Author();
    // $author->setName('Jean');
    // $em->persist($author);
    // $em->flush();
    $todo = $todoRepo->find(1);
    // dump($todo->getAuthor()->getName());
    // $author = $authorRepo->find(1);
    // $todo = $author->getTodos()[0];
    $tag= $tagRepo->find(2);
    // foreach ($tag->getTodos() as $todo){
    //   dump($todo);
    // }
    $tag->addTodo($todo);

    // $todo->addTag($tag)
    // $tag = new Tag();
    // $tag->setName('politique');
    // $em->persist($tag);
    $em->flush();


    // $author->addTodo($todo);
    // dump($author->getTodos());
    // $todo->setAuthor($author);
    // $em->persist($todo);
    // $em->flush();

    // foreach($author->getTodos()as $todo){
    //   dump($todo);
    // }

    return $this->render('base.html.twig');

  }

}


