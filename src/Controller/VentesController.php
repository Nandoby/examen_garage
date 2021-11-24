<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Voiture;
use App\Form\AddCarType;
use App\Repository\ImageRepository;
use App\Repository\MarqueRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VentesController extends AbstractController
{
    /**
     * @Route("/ventes", name="ventes")
     */
    public function index(VoitureRepository $voitureRepository): Response
    {

        return $this->render('ventes/index.html.twig', [
            'voitures' => $voitureRepository->findAll()
        ]);
    }

    /**
     * Cela permet d'afficher le formulaire pour ajouter une voiture
     * @Route("/ventes/add", name="ventes_addCar")
     */
    public function addCar(Request $request): Response
    {
        $form = $this->createForm(AddCarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // traitement
        }

        return $this->render('ventes/addCar.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Permet d'afficher les détails d'une seule voiture
     * @Route("/ventes/{slug}", name="ventes_slug")
     */
    public function show(Voiture $voiture)
    {

        return $this->render('ventes/show.html.twig', [
            'voiture' => $voiture
        ]);
    }
}
