<?php


namespace App\Controller;


use App\Entity\GuestbookEntry;
use App\Form\EntryFormType;
use App\Repository\GuestbookEntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GuestbookController extends AbstractController
{
    public function homepage(GuestbookEntryRepository $repository, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(EntryFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var GuestbookEntry $entry */
            $entry = $form->getData();

            $em->persist($entry);
            $em->flush();

            #$this->addFlash('succes', 'Bericht geplaatst!');

            return $this->redirectToRoute('index');
        }

        $entries = $repository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('homepage.html.twig', [
            'entries' => $entries,
            'entryForm' => $form->createView(),
        ]);
    }


}