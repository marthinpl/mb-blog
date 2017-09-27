<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\BlogEntry;

class BlogController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('blogEntryList');
    }

    /**
     * @Route("/blog", name="blogEntryList")
     */
    public function blogEntryListAction()
    {
        return $this->render('BlogBundle:Default:blogEntryList.html.twig', array(
            'blogEntries' => $this->getDoctrine()->getRepository(BlogEntry::class)->findAll()
        ));
    }

    /**
     * @Route("/blog/entry/{slug}", name="blogEntryShow")
     */
    public function blogEntryShowAction($slug)
    {
        $blogEntry = $this->getDoctrine()->getRepository(BlogEntry::class)->findActiveBySlug($slug);
        if (!$blogEntry) throw $this->createNotFoundException('Entry does not exist');
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findAllByBlogEntry($blogEntry->getId());

        return $this->render('BlogBundle:Default:blogEntryShow.html.twig', array(
            'blogEntry' => $blogEntry,
            'comments' => $comments
        ));
    }
}
