<?php

namespace ContactBoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ContactBoxBundle\Entity\Contact;

class ContactController extends Controller
{
  private function getNewForm($contact){ 
    $form = $this->createFormBuilder($contact);   
    $form->add('name');
    $form->add('surname');
    $form->add('description');
    $form->add('save','submit');
    $form->setAction($this->generateUrl('contactbox_contact_create'));
    return $form->getForm();
  }

  private function getEditForm($contact){ 
    $form = $this->createFormBuilder($contact);
    $form->add('name');
    $form->add('surname');
    $form->add('description');
    $form->add('save','submit');
    $form->setAction($this->generateUrl('contactbox_contact_update',['id'=>$contact->getId()]));
    return $form->getForm();

  }

/**
*@Route("/new")
*@Method("GET")
*@Template()
*/

  public function newAction(){
    $contact = new Contact();
    $form = $this->getNewForm($contact);
    return ['form'=>$form->createView()];
  }
/**
*@Route("/new")
*@Method("POST")
*@Template()
*/
  public function createAction(Request $request){
    $contact = new Contact();
    $form = $this->getNewForm($contact);

    $form->handleRequest($request);

    if($form->isSubmitted()){
      $em=$this->getDoctrine()->getManager();
      $em->persist($contact);
      $em->flush(); 

    }

    return $this->redirectToRoute('contactbox_contact_index');
  }

  /**
  *@Route("/{id}/modify")
  *@Method("GET")
  *@Template()
  */

  public function editAction($id){
    $contact=$this->getDoctrine()->getManager()->getRepository('ContactBoxBundle:Contact')->find($id);
    $form = $this->getEditForm($contact);
    return ['form'=>$form->createView()];

  }
  /**
  *@Route("/{id}/modify")
  *@Method("POST")
  *@Template()
  */

  public function updateAction(Request $request, $id){
    $contact=$this->getDoctrine()->getManager()->getRepository('ContactBoxBundle:Contact')->find($id);
    $form = $this->getEditForm($contact);
    $form->handleRequest($request);
    if($form->isSubmitted()){
      $this->getDoctrine()->getManager()->flush();

    }
    return $this->redirectToRoute('contactbox_contact_show', ['id'=>$contact->getId()]);
  }

  /**
  *@Route("/{id}/delete")
  *@Method("GET")
  */

  public function deleteAction($id){
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('ContactBoxBundle:Contact');
    $contact=$repository->find($id);
    $em->remove($contact);
    $em->flush();
    return $this->redirectToRoute('contactbox_contact_index');

  }

  /**
  *@Route("/{id}")
  *@Method("GET")
  *@Template()
  */

  public function showAction($id){
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('ContactBoxBundle:Contact');
    $contact=$repository->find($id);

    return ['contact'=>$contact];
  }

  /**
  *@Route("/")
  *@Method("GET")
  *@Template("ContactBoxBundle:Contact:index.html.twig")
  */

  public function indexAction(){
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('ContactBoxBundle:Contact');

    $contacts=$repository->findAll();

    return ['contacts'=>$contacts];
  }
}

