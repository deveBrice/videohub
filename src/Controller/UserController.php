<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UserRepository;

class UserController extends AbstractController 
{
  
     /**
     * @Route("/user", name="user")
     */
    public function register(Request $request)
    {
      $user = new User();
      $form = $this->createForm(UserType::class, $user);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) 
      {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $this->redirectToRoute('security');   
    }
    return $this->render('pages/user/index.html.twig', array(
        'form' => $form->createView()
     ));
    }

    /*** 
     * @Route("/user/{id}", name="user_id")
     */
    public function user(Request $request, UserRepository $userRepository, int $id)
    {
    }
    /**
     * @Route("/userAccount", name="userAccount")
     */
    public function userAccount()
    {
        return $this->render('pages/account/user_account.html.twig');
    }

}
 

?>