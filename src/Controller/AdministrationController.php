<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    /**
     * @Route("/", name="administration")
     */
    public function index(Request $request)
    {
        dump($request);

        return $this->render('administration/index.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }

    /**
     * @Route("/new", name="add-new-client")
     */
    public function addNewVisitor(Request $request)
    {
        $clientName = $request->request->get("clientName");

        //TODO: Validation of the name (validation class)


        return new JsonResponse(['client'=>'wa']);
    }

}
