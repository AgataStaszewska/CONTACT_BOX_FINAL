<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\Email;
use CodersLabBundle\Form\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class EmailController extends Controller
{
    /**
     * @Route("/newEmail")
     */
    public function newAction(Request $request)
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class,$email);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $email = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            
            return $this->redirectToRoute('coderslab_email_show', ['id' => $email->getId()]); 
        }
        return $this->render('CodersLabBundle:Email:new.html.twig', array( 'form' => $form->createView() 
        
        ));
    }
    
     /**
     * @Route("/{id}/showEmail")
     */
    public function showAction(Email $email)
    {
        return $this->render('CodersLabBundle:Email:show.html.twig', array(
            'email'=>$email   
        ));
    }

    /**
     * @Route("/showAllEmails")
     */
    public function showAllAction()
    {
        $emails = $this->getDoctrine()->getRepository('CodersLabBundle:Email')->findAll();
        return $this->render('CodersLabBundle:Email:show_all.html.twig', array(
            'emails'=>$emails
        ));
    }
    
    /**
     * @Route("/{id}/deleteEmail")
     */
    public function deleteAction(Email $email)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($email);
        $em->flush();
        
        return $this->redirectToRoute('coderslab_email_showall');
        
    }
}