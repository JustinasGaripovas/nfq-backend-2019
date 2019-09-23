<?php

namespace App\Controller;

use App\Controller\Administration\Response\InvalidDataResponse;
use App\Controller\Administration\Response\SuccessResponse;
use App\Entity\Specialist\Specialist;
use App\Form\RegistrationFormType;
use App\Security\SpecialistLoginFormAuthenticator;
use App\Storage\StorageSystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(StorageSystem $storageSystem, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, SpecialistLoginFormAuthenticator $authenticator): Response
    {
        $user = new Specialist();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->persistTimestamps();

            $databaseResponse = $storageSystem->add_new_specialist($user->returnArray());

            if($databaseResponse['error'] == "00000")
                return $this->redirectToRoute('index-administration');
            else
                return new InvalidDataResponse('Specialist data not accepted.');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
