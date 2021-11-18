<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Voiture;
use App\Repository\ImageRepository;
use App\Repository\MarqueRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
