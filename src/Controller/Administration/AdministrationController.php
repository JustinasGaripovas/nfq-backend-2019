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
    public function index()
    {
        return $this->render('administration/index.html.twig');
    }

    /**
     * @Route("/new", name="add-new-client")
     */
    public function addNewClient(Request $request)
    {
        $clientName = $request->request->get("clientName");

        //TODO: Validation of the name (validation class)

        return new JsonResponse(['client'=>'wa']);
    }

}
