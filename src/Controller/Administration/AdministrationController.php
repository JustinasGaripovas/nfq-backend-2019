<?php

namespace App\Controller\Administration;

use App\Controller\Administration\Response\InvalidDataResponse;
use App\Controller\Administration\Response\SuccessResponse;
use App\Entity\Administration\Enum\VisitationStatus;
use App\Entity\Administration\VisitationTask;
use App\Entity\Client\Client;
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
     * @Route("/", name="index-administration")
     */
    public function index()
    {
        return $this->render('administration/index-administration.html.twig');
    }

    /**
     * @Route("/new", name="add-new-client")
     */
    public function addNewClient(Request $request, UserPasswordEncoderInterface $encoder, StorageSystem $storageSystem)
    {

        //todo: This place can only be accessed by AJAX

        $user = new Client();
        $visitation = new VisitationTask();

        $clientName = $request->request->get("clientName");
        $clientPlainPassword = $request->request->get("clientPassword");

        $encoded = $encoder->encodePassword($user, $clientPlainPassword);
        $user->setPassword($encoded);
        $user->setName($clientName);
        $user->persistTimestamps();

        $databaseResponse= $storageSystem->add_new_client($user->returnArray());

        if ($databaseResponse['error'] == "00000") {

            $visitation->setUserId($databaseResponse['lastId']);
            $visitation->persistTimestamps();
            $visitation->setStatus(VisitationStatus::NEW);

            $databaseResponse = $storageSystem->add_new_visitation_task($visitation->returnArray());

            if($databaseResponse['error'] == "00000")
                return new SuccessResponse('Client and visitation saved saved.');
            else
                return new InvalidDataResponse('Visitation task data not accepted.');

        }
        else
            return new InvalidDataResponse('Client data not accepted.');
    }


    /**
     * @Route("/jumbotron", name="index-jumbotron")
     */
    public function indexJumbotron(Request $request, StorageSystem $storageSystem)
    {
        $visitationList = [];

        $visitationList = $storageSystem->get_visitation_tasks();

        return $this->render('administration/index-jumbotron.html.twig', [
            'visitationList' => $visitationList
        ]);
    }


}
