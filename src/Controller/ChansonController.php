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

    // permet de lister les chansons présentes en base de donnée
    /**
     * @Route("/chansons",name="liste_chansons")
     */
    public function listeChansons(EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Chanson::class);
        $chansons = $repository->findAll();
        return $this->render('chanson/liste.html.twig', [
            "chansons" => $chansons,
        ]);
    }


    /**
     * @Route("/ajout",name="ajout_chanson")
     */
    public function ajoutChanson(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chanson = new Chanson();
        //$chanson->setDateAjout(new \DateTime('now'));


        $form = $this->createFormBuilder($chanson)

            ->getForm();

        $form = $this->createForm(ChansonType::class, $chanson);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('chanson/ajout.html.twig', [
            'form' => $form,
        ]);
    }
}
