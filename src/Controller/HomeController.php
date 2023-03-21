<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Offre;
use App\Form\OffreType;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        /*
        // Création d'un nouveau domaine métier
        $domaineMetier = new DomaineMetier();
        $domaineMetier->setLibelle('Nouveau domaine métier');
        $domaineMetier->setDescription('Description du nouveau domaine métier');

        // Ajout du domaine métier à la base de données
        $entityManager->persist($domaineMetier);
        $entityManager->flush();

        // Utilisation de la fonction dd() pour le débogage
        //dd($domaineMetier);
        */

        $offres = $entityManager->getRepository(Offre::class)->findAll();
        return $this->render('home/index.html.twig', [
            'offres' => $offres,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/offre/{id}', name: 'app_offre')]
    public function showOffre(int $id, EntityManagerInterface $entityManager): Response
    {
        $offre = $entityManager->getRepository(Offre::class)->find($id);

        if (!$offre) {
            throw $this->createNotFoundException('L\'offre demandée n\'existe pas.');
        }
        return $this->render('home/offre.html.twig', [
            'offres' => $offre,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/create', name: 'app_home')]
    public function createOffre(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(OffreType::class);

        // handle the form submission
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // save the form data to the database
            $offre = $form->getData();
            $entityManager->persist($offre);
            $entityManager->flush();

            // redirect to the homepage or show a success message
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
