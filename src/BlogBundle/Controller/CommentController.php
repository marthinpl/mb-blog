<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Comment;
use BlogBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\BlogEntry;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @Route("/blog/entry/{slug}/comment", name="commentBlogEntry")
     */
    public function commentNewAction(Request $request, $slug)
    {
        $blogEntry = $this->getDoctrine()->getRepository(BlogEntry::class)->findActiveBySlug($slug);
        if (!$blogEntry) throw $this->createNotFoundException('Entry does not exist');

        $comment = new Comment();
        $comment->setBlogEntry($blogEntry);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('blogEntryShow', array(
                'slug' => $slug
            )));
        }

        return $this->render('BlogBundle:Default:commentNew.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
