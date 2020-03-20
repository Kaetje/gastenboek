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

        /* this handles the form submit,
        checks if it is valid,
        processes it to the db,
        refreshes the pages (redirects back to it)
        and gives a friendly flash message upon success */
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var GuestbookEntry $entry */
            $entry = $form->getData();

            $em->persist($entry);
            $em->flush();

            $this->addFlash('succes', 'Bericht geplaatst!');

            return $this->redirectToRoute('index');
        }

        // this retrieves all the guestbook entries from the database, latest first, including just submitted messages, if any.
        $entries = $repository->findBy([], ['createdAt' => 'DESC']);

        //this renders the page using the twig template and the above retrieved/created entries and form.
        return $this->render('homepage.html.twig', [
            'entries' => $entries,
            'entryForm' => $form->createView(),
        ]);
    }


}