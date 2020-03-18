<?php


namespace App\Controller;


use App\Repository\GuestbookEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GuestbookController extends AbstractController
{
    public function homepage(GuestbookEntryRepository $repository)
    {
        $entries = $repository->findBy( [], ['createdAt' => 'DESC'] );

        return $this->render('homepage.html.twig', [
            'entries' => $entries,
        ]);
    }


}