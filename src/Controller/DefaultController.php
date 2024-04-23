<?php

namespace App\Controller;

use App\Form\TodoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
  function __construct()
  {
  }

  #[Route('/', name: 'index')]
  public function index(Request $request, RequestStack $requestStack)
  {
    $cookie= Cookie::create('Cook',123);
    $cookie->withHttpOnly(true);
    $todo = new Todo();
    $form = $this->createForm(TodoType::class, $todo);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->addFlash('success', 'La todo est valide');
    } else if ($form->isSubmitted() && !$form->isValid()) {
      $this->addFlash('error', 'La todo n\'est pas valide');
    }

    $reponse = $this->render('page1.html.twig', [
      'myform' => $form->createView()
    ]);
    $reponse->headers->setCookie($cookie);

    return $reponse;
  }
}

class Todo
{
  function  __construct(
    public string $content = '',
    public ?string $pays = null,
  ) {
  }
}