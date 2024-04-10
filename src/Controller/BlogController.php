<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    #[Route('/blog/{title}', name: 'app_blog')]
    public function index(): Response
    {
        return $this->json([
            'controller_name' => 'BlogController',
        ]);

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
    #[Route('last-blog-post', name: 'last-blog-post')]
    public function lastBlogPost(): Response {
        $blogPost = [
            'title' => 'Les pommes sont bonnes pour la santé'
        ];
        return $this->render('./partials/_last_blog_article.html.twig', ['blogPost' => $blogPost]);

    }

}
