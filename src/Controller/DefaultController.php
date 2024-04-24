<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
  function __construct()
  {
  }

  #[Route('/', name: 'index')]
  public function index(Request $request)
  {
    $todo = new Todo();
    $todoForm = $this->createForm(TodoType::class, $todo);

    $todoForm->handleRequest($request);

    if($todoForm->isSubmitted() && $todoForm->isValid()) {

    }

    return $this->render('page1.html.twig',[
      'form' => $todoForm->createView()
    ]);
  }
}

