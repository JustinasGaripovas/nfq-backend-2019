<?php

namespace App\Controller;

use App\Entity\Administration\Enum\VisitationStatus;
use App\Storage\StorageSystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpecialistController extends AbstractController
{
    /**
     * @Route("/specialist", name="index-specialist")
     */
    public function index(StorageSystem $storageSystem)
    {
        $visitationList = $storageSystem->get_visitation_tasks(false );

        return $this->render('specialist/index-specialist-tasks.html.twig', [
            'visitationList' => $visitationList
        ]);
    }

    /**
     * @Route("/specialist/task/{id}/start", name="specialist-start-visitation")
     */
    public function startVisit(StorageSystem $storageSystem, $id)
    {
        $visitationList = $storageSystem->set_visitation_status($id, VisitationStatus::ACCEPTED());

        return $this->redirectToRoute('index-specialist');

    }
    /**
     * @Route("/specialist/task/{id}/end", name="specialist-end-visitation")
     */
    public function endVisit(StorageSystem $storageSystem, $id)
    {
        $visitationList = $storageSystem->set_visitation_status($id,VisitationStatus::FINISHED(), true);

        return $this->redirectToRoute('index-specialist');

    }



}
