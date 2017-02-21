<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\Address;
use CodersLabBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    /**
     * @Route("/newAddress")
     */
    public function newAction(Request $request)
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class,$address);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $address = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
            
            return $this->redirectToRoute('coderslab_address_show', ['id' => $address->getId()]); 
        }
        return $this->render('CodersLabBundle:Address:new.html.twig', array( 'form' => $form->createView() 
        
        ));
    }
    
     /**
     * @Route("/{id}/showAddress")
     */
    public function showAction(Address $address)
    {
        return $this->render('CodersLabBundle:Address:show.html.twig', array(
            'address'=>$address   
        ));
    }

    /**
     * @Route("/showAllAddresses")
     */
    public function showAllAction()
    {
        $addresses = $this->getDoctrine()->getRepository('CodersLabBundle:Address')->findAll();
        return $this->render('CodersLabBundle:Address:show_all.html.twig', array(
            'addresses'=>$addresses
        ));
    }
    
    /**
     * @Route("/{id}/deleteAddress")
     */
    public function deleteAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();
        
        return $this->redirectToRoute('coderslab_address_showall');
        
    }
}