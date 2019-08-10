<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EditType;

class VideoController extends AbstractController
{
     /**
     * @Route("/createdVideo", name="createdVideo")
     */
    public function createdVideo(Request $request)
    {
      $video = new Video();
      $form = $this->createForm(VideoType::class, $video);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) 
      { 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($video);
        $entityManager->flush();
        return $this->redirectToRoute('home');   
      }
      return $this->render('pages/createdVideo/createdVideo.html.twig', [
        'form' => $form->createView()   
      ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $videoRepository = $this->getDoctrine()->getManager()->getRepository(Video::class);

        $videoRepository->findBy(['published' => true]);

        return $this->render('pages/home/home.html.twig', [
            'videosPublished' => $videoRepository->findBy(['published' => true]),
            'videosNotPublished' => $videoRepository->findBy(['published' => false]),
        ]);
    }

     /**
     * @Route("/editedVideo/{id}", name="edited_video")
     */
    public function editedVideo(Request $request, $id)
    {
      $video = new Video();
      $video = $this->getDoctrine()->getRepository(Video::class)->find($id);
      $form = $this->createForm(EditType::class, $video);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) 
      { 
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($video);
        $entityManager->flush();
        return $this->redirectToRoute('home');   
      }
      return $this->render('pages/editedVideo/editedVideo.html.twig', [
        'form' => $form->createView()   
      ]);
    }

  

    /**
     * @Route("/removedVideo/{id}", name="video_removed", methods="DELETE")
     * @ParamConverter("id", options={"mapping"={"id"="id"}})
     */
    public function remove(User $user, Video $video, EntityManagerInterface $entityManager)
    {
        $video = $user->getVideos();
        foreach($video as $video){
            $video->setUser(null);
        }
        $entityManager->remove($video);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
}
