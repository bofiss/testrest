<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\RedditPost;

class RedditController extends Controller
{
    /**
     * @Route("/list", name="list")
     */
    public function listAction(Request $request)
    {
      $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findAll();
      return $this->render(':reddit:index.html.twig', compact('posts'));
    }

    /**
     * @Route("/create/{text}", name="create")
     */
    public function createAction($text)
    {
      $em = $this->getDoctrine()->getManager();

      $post = new RedditPost();
      $post->setTitle($text);
      $em->persist($post);
      $em->flush();
      return $this->redirectToRoute('list');
    }

    /**
     * @Route("/update/{id}/{text}", name="update")
     */
    public function updateAction($id, $text)
    {
      $em = $this->getDoctrine()->getManager();

      $post = $em->getRepository('AppBundle:RedditPost')->find($id);
      if(!$post){
        throw $this->createNotFoundException('that is not a record');
      }
      /** @var $post RedditPost */
      $post->setTitle('updated title '. $text);
      $em->flush();
      return $this->redirectToRoute('list');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $post = $em->getRepository('AppBundle:RedditPost')->find($id);

      if(!$post){
        throw $this->createNotFoundException('that is not a record');
      }
      $em->remove($post);
      $em->flush();
      return $this->redirectToRoute('list');
    }
}
