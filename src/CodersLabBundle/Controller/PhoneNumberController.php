<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\PhoneNumber;
use CodersLabBundle\Form\PhoneNumberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PhoneNumberController extends Controller
{
    /**
     * @Route("/newPhoneNumber")
     */
    public function newAction(Request $request)
    {
        $phoneNumber = new PhoneNumber();
        $form = $this->createForm(PhoneNumberType::class,$phoneNumber);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $phoneNumber = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($phoneNumber);
            $em->flush();
            
            return $this->redirectToRoute('coderslab_phonenumber_show', ['id' => $phoneNumber->getId()]); 
        }
        return $this->render('CodersLabBundle:PhoneNumber:new.html.twig', array( 'form' => $form->createView() 
        
        ));
    }
    
     /**
     * @Route("/{id}/showPhoneNumber")
     */
    public function showAction(PhoneNumber $phoneNumber)
    {
        return $this->render('CodersLabBundle:PhoneNumber:show.html.twig', array(
            'phoneNumber'=>$phoneNumber   
        ));
    }

    /**
     * @Route("/showAllPhoneNumbers")
     */
    public function showAllAction()
    {
        $phoneNumbers = $this->getDoctrine()->getRepository('CodersLabBundle:PhoneNumber')->findAll();
        return $this->render('CodersLabBundle:PhoneNumber:show_all.html.twig', array(
            'phoneNumbers'=>$phoneNumbers
        ));
    }
    
    /**
     * @Route("/{id}/deletePhoneNumber")
     */
    public function deleteAction(PhoneNumber $phoneNumber)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($phoneNumber);
        $em->flush();
        
        return $this->redirectToRoute('coderslab_phonenumber_showall');
        
    }
}