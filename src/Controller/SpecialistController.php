<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpecialistController extends AbstractController
{
    /**
     * @Route("/specialist", name="specialist")
     */
    public function index()
    {
        return $this->render('specialist/index.html.twig', [
            'controller_name' => 'SpecialistController',
        ]);
    }
}
