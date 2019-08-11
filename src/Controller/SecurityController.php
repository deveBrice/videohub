<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginUserType;
use App\Form\RegisterUserType;
use App\Form\ProfileUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $user = new User();
        $form = $this->createForm(LoginUserType::class, $user);
        return $this->render('pages/security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form' => $form->createView()   
        ]);
    }

    /**
     * @Route("/registerUser", name="registerUser")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
      $user = new User();
      $form = $this->createForm(RegisterUserType::class, $user);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) 
      {
        $password = $passwordEncoder->encodePassword($user, $user->getPassword());
        $user->setPassword($password);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('login', [
          'id' =>$user->getId()
        ]);   
      }
      return $this->render('pages/security/registerUser.html.twig', [
        'form' => $form->createView()   
      ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $form = $this->createForm(ProfileUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('pages/security/profile.html.twig', [
          'form' => $form->createView()  
        ]);
    }

       /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
