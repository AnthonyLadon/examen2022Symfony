<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    /**
     * @Route("/genres",name="listeGenre")
     */
    public function ListeGenres(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Genre::class);
        $genres = $repository->findAll();
        return $this->render('genre/liste.html.twig', [
            "genres" => $genres,
        ]);
    }


    // pas eu le temps de finir l'ajout de catégorie


    // permet d'afficher un formulaire afin d'ajouter un genre dans la base de données
    /**
     * @Route("genre/ajout",name="ajoutGenre")
     */
    // public function ajoutChanson(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $genre = new Genre();
    //     //$chanson->setDateAjout(new \DateTime('now'));

    //     $form = $this->createFormBuilder($genre)
    //         ->getForm();

    //     $form = $this->createForm(GenreType::class, $genre);

    //     // si le formulaire est valide il sera envoyé dans la DB
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $genre = $form->getData();

    //         // persist puis envoi dans la database
    //         $entityManager->persist($genre);
    //         $entityManager->flush();

    //         // si tout se passe bien on retourne a la liste des chansons
    //         return $this->redirectToRoute('listeGenre');
    //     }

    //     // sinon on continue sur le formulaire
    //     return $this->renderForm('genre/ajout.html.twig', [
    //         'form' => $form,
    //     ]);
    // }
}
