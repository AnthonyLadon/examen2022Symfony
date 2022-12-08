<?php

namespace App\Controller;

use DateTime;
use App\Entity\Chanson;
use App\Form\ChansonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ChansonController extends AbstractController
{


    // permet d'afficher un formulaire afin d'ajouter une chanson dans la base de données
    /**
     * @Route("chanson/ajout",name="ajoutChanson")
     */
    public function ajoutChanson(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chanson = new Chanson();
        //$chanson->setDateAjout(new \DateTime('now'));

        $form = $this->createFormBuilder($chanson)
            ->getForm();

        $form = $this->createForm(ChansonType::class, $chanson);

        // si le formulaire est valide il sera envoyé dans la DB
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $chanson = $form->getData();

            // persist puis envoi dans la database
            $entityManager->persist($chanson);
            $entityManager->flush();

            // si tout se passe bien on retourne a la liste des chansons
            return $this->redirectToRoute('accueil');
        }

        // sinon on continue sur le formulaire
        return $this->renderForm('chanson/ajout.html.twig', [
            'form' => $form,
        ]);
    }


    //permet de supprimer une chanson
    /**
     * @Route("/chanson/supprimer/{id}",name="supprimerChanson")
     */
    public function supprimerChanson($id, Chanson $chanson, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Chanson::class);
        $chanson = $repository->find($id);

        // on a récupéré la chanson via l'entityManager mainteant on peut l'effacer de la DB
        $entityManager->remove($chanson);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');
    }

    // Permet de voir les details de la chanson selctionnée
    /**
     * @Route("chanson/detail/{id}",name="detailChanson")
     */

    public function detailChanson(Chanson $chanson, entityManagerInterface $entityManager)
    {
        return $this->render('chanson/detail.html.twig', [
            "chanson" => $chanson,
        ]);
    }
}
