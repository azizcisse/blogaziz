<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\OptionService;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    public function __construct(
        private OptionService $optionService,      
    ) {}

    #[Route('path:/user/{username}', name:'app_profil')]
function index(?User $user): Response
    {
    if (!$user) {
        return $this->redirectToRoute('app_accueil');
    }
    return $this->render('user/index.html.twig', [
        'user' => $user,
    ]);
}
#[Route('/user/register', name:'app_register')]
function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $usersCanRegister = $this->optionService->getValue('users_can_register');
        if (!$usersCanRegister) {
            return $this->redirectToRoute('appp_accueil');
        }

    $user = new User();
    $form = $this->createForm(RegistrationFormType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // encode the plain password
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            )
        );

        $entityManager->persist($user);
        $entityManager->flush();
        // do anything else you need here, like send an email

        return $this->redirectToRoute('app_accueil');
    }

    return $this->render('user/register.html.twig', [
        'registrationForm' => $form->createView(),
    ]);
}

#[Route(path:'/user/login', name:'app_login')]
function login(AuthenticationUtils $authenticationUtils): Response
    {
    if ($this->getUser()) {
        return $this->redirectToRoute('app_accueil');
    }
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('user/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
}

#[Route(path:'/user/logout', name:'app_logout')]
function logout(): void
    {
    throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
}
}
