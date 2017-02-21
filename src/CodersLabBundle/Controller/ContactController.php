<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\Contact;
use CodersLabBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/new")
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            return $this->redirectToRoute('coderslab_contact_show', ['id' => $contact->getId()]); //tu dwa returny, bo jeden się wykonuje, jak wejdzie w ifa, a drugi, jak nie wejdzie
        }
        return $this->render('CodersLabBundle:Contact:new.html.twig', array( 'form' => $form->createView() //to jest ten formularz, który stworzyliśmy wyżej
        
        ));
    }

    /**
     * @Route("/{id}/modify")
     */
    public function modifyAction(Request $request, Contact $contact)
    {

        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->redirectToRoute('coderslab_contact_show', ['id' => $contact->getId()]); //tu dwa returny, bo jeden się wykonuje, jak wejdzie w ifa, a drugi, jak nie wejdzie
        }
       
        return $this->render('CodersLabBundle:Contact:modify.html.twig', array(
           'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete")
     */
    public function deleteAction(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();
        
        return $this->redirectToRoute('coderslab_contact_showall');
        
    }

    /**
     * @Route("/{id}/show")
     */
    public function showAction(Contact $contact)
    {
        return $this->render('CodersLabBundle:Contact:show.html.twig', array(
            'contact'=>$contact   //to przekazujemy do widoku
        ));
    }

    /**
     * @Route("/showAll")
     */
    public function showAllAction()
    {
        $contacts = $this->getDoctrine()->getRepository('CodersLabBundle:Contact')->findAll();
        return $this->render('CodersLabBundle:Contact:show_all.html.twig', array(
            'contacts'=>$contacts
        ));
    }

}
