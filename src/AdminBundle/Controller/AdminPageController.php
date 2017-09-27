<?php
namespace AdminBundle\Controller;

use BlogBundle\Entity\BlogEntry;
use BlogBundle\Form\Type\BlogEntryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminPageController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('adminPageList');
    }

    /**
     * @Route("/page", name="adminPageList")
     */
    public function adminPageListAction()
    {
        return $this->render('AdminBundle:Default:adminPageList.html.twig',
            ['blogEntries' => $this->getDoctrine()->getRepository(BlogEntry::class)->findAll()]
        );
    }

    /**
     * @Route("/page/edit/{id}", name="adminPageAdd")
     */
    public function adminPageNewAction(Request $request, $id = null)
    {
        $blogEntry = $id ? $this->getDoctrine()->getRepository('BlogBundle:BlogEntry')->find($id) : new BlogEntry();
        $form = $this->createForm(BlogEntryType::class, $blogEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            if (!$id) $em->persist($blogEntry);
            $em->flush();
            return $this->redirect($this->generateUrl('adminPageList'));
        }

        return $this->render('AdminBundle:Default:adminPageNew.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/page/destroy/{id}", name="adminPageDestroy")
     */
    public function adminPageDestroyAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $blogEntry = $em->getRepository(BlogEntry::class)->findOneById($id);
        if($blogEntry !== null){
            $em->remove($blogEntry);
            $em->flush();
        }else{
            throw $this->createNotFoundException('Entry does not exist');
        }

        return $this->redirect($this->generateUrl('adminPageList'));
    }
}
