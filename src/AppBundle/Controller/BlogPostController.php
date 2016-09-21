<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BlogPost;
use AppBundle\Form\BlogPostType;

class BlogPostController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function listAction(Request $request)
    {
      $posts = $this->getDoctrine()->getRepository('AppBundle:BlogPost')->findAll();
      return $this->render(':blog:index.html.twig', compact('posts'));
    }

    /**
     * @Route("/blog/create", name="blog/create")
     */
    public function createAction(Request $request)
    {
      $form = $this->createForm(BlogPostType::class);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){

        /** @var $blogpost BlogPost */
        $blogpost = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($blogpost);
        $em->flush();
        return $this->redirectToRoute('edit', ['blogpost'=>$blogpost->getId()]);
      }
      return $this->render(':blog:create.html.twig', ['form' =>$form->createView()]);
    }

    /**
     * @Route("blog/edit/{blogPost}", name="blog/edit")
     */
    public function editAction(Request $request,  BlogPost $blogPost)
    {
      $form = $this->createForm(BlogPostType::class, $blogPost);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('blog/edit', ['blogPost'=>$blogPost->getId()]);
      }
      return $this->render(':blog:edit.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("blog/delete/{blogPost}", name="blog/delete")
     */
    public function deleteAction(Request $request,  BlogPost $blogPost)
    {
      if(!$blogPost === null){
        return $this->redirectToRoute('blog');
      }
      $em = $this->getDoctrine()->getManager();
      $em->remove($blogPost);
      $em->flush();
      return $this->redirectToRoute('blog');
    }
}
