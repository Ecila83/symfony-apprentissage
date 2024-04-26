<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
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
  public function index(Request $request,EntityManagerInterface $em)
  {
    $todo = new Todo();
    $todoForm = $this->createForm(TodoType::class, $todo);

    $todoForm->handleRequest($request);

    if($todoForm->isSubmitted() && $todoForm->isValid()) {
      $todo->setCreatedAt(new \DateTime());

      $em->persist($todo);
      $em->flush();
    }

    return $this->render('page1.html.twig',[
      'form' => $todoForm->createView()
    ]);
  }
}

