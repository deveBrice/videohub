<?php
  namespace App\Controller;
 
  use App\Entity\User;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Routing\Annotation\Route;

  class HomeController extends AbstractController {
    
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('pages/home/home.html.twig');
    }

   /**
     * @Route("/user/{id}", name="user")
     */
    public function homeUser(User $user)
    {
        return $this->render('pages/account/account.html.twig', [
          'user' => $user
        ]);
    }
  }
?>