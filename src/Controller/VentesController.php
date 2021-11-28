<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Voiture;
use App\Form\AddCarType;
use App\Form\ImagesType;
use App\Repository\ImageRepository;
use App\Repository\MarqueRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function addCar(Request $request, EntityManagerInterface $manager): Response
    {
        $voiture = new Voiture();

        $form = $this->createForm(AddCarType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach($voiture->getImages() as $image) {
                $image->setVoiture($voiture);
                $manager->persist($image);
            }

            $manager->persist($voiture);
            $manager->flush();

            return $this->redirectToRoute("ventes");
        }

        return $this->render('ventes/addCar.html.twig', [
            'form' => $form->createView(),
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
