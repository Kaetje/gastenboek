<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GuestbookController extends AbstractController
{
    public function homepage()
    {
        return $this->render('homepage.html.twig', []);
    }


}