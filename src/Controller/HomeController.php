<?php

namespace App\Controller;

use App\Entity\Chanson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    // permet de lister les chansons présentes en base de donnée
    /**
     * @Route("/",name="accueil")
     */
    public function listeChansons(EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Chanson::class);
        $chansons = $repository->findAll();
        return $this->render('home/accueil.html.twig', [
            "chansons" => $chansons,
        ]);
    }
}
