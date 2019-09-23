<?php

namespace App\Controller\Administration;

use App\Controller\Administration\Response\InvalidDataResponse;
use App\Controller\Administration\Response\SuccessResponse;
use App\Entity\Client\Client;
use App\Entity\VisitationTask;
use App\Storage\StorageSystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function addNewClient(Request $request, UserPasswordEncoderInterface $encoder, StorageSystem $storageSystem )
    {
        $user = new Client();
        $visitation = new VisitationTask();

        $clientName = $request->request->get("clientName");
        $clientPlainPassword = $request->request->get("clientPassword");

        $encoded = $encoder->encodePassword($user, $clientPlainPassword);
        $user->setPassword($encoded);
        $user->setName($clientName);
        $user->persistTimestamps();

        $errorCode = $storageSystem->add_new_client($user->returnArray());

        if ($errorCode != "00000")
            return new SuccessResponse('Client saved.');
        else
            return new InvalidDataResponse('Client data not accepted.');
    }

}
