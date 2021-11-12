<?php

namespace App\Controller;

use App\Repository\StaffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker\Factory;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(StaffRepository $repository): Response
    {
        $staff = $repository->findAll();

        return $this->render('home/about.html.twig', [
            'staffs' => $staff
        ]);
    }
}
