<?php

namespace gestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use gestionBundle\Entity\patient;
use gestionBundle\Entity\sejours;
use gestionBundle\Entity\chambre;
use gestionBundle\Entity\service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DefaultController extends Controller
{
    public function indexAction()
    {



        return $this->render('gestionBundle:Default:index.html.twig');
    }
	public function ajouterpatientAction(Request $request)
	{
		$unpatient = new patient();

		$formBuilder=$this->createFormBuilder($unpatient);

		$formBuilder->add('numerosecu','number',array('label'=>'Saisir votre numero de securité social  : '));
		$formBuilder->add('nom','text',array('label'=>'Saisir le nom : '));
		$formBuilder->add('prenom','text',array('label'=>'Saisir le prenom : '));
		$formBuilder->add('codepostal','number',array('label'=>'Saisir votre code postal : '));
		$formBuilder->add('datenaiss','date',array('label'=>'Saisir votre date de naissance : ','placeholder' => array(
        'year' => 'Annee', 'month' => 'Mois', 'day' => 'Jour'
    )));
		$formBuilder->add('mail','text',array('label'=>'Saisir votre mail : '));
		$formBuilder->add('assurer',CheckboxType::class,array('label'=>'Saisir vi vous ete assurer ou ayan-droit : ','required' => false));
		$formBuilder->add('save','submit');


		$form = $formBuilder->getForm();

		if($request->getMethod()=='POST')
		{
			$form->bind($request);
			if($form->isValid())
			{
				$em = $this->getDoctrine()->getManager();
				$em->persist($unpatient);
				$em->flush();
			}

		}

		return $this->render('gestionBundle:Default:ajouterpatient.html.twig',array('form'=>$form->createView()));
	}
	public function afficherpatientAction()
	{
		$doctrine=$this->getDoctrine();
		$entityManager=$doctrine->getManager();
		$repository = $entityManager->getRepository('gestionBundle:patient');
		$lespatients = $repository->findAll();

		return $this->render('gestionBundle:Default:afficherpatient.html.twig',array('lespatients'=>$lespatients));
	}

	    public function modifierpatientAction(Request $request)
    {

        $id=$request->query->get('id');
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository('gestionBundle:patient');
        $unpatient=$repository->find($id);

        $formBuilder=$this->createFormBuilder($unpatient);

        $formBuilder->add('numerosecu','number',array('label'=>'Saisir votre numero de securité social  : '));
        $formBuilder->add('nom','text',array('label'=>'Saisir le nom : '));
        $formBuilder->add('prenom','text',array('label'=>'Saisir le prenom : '));
        $formBuilder->add('codepostal','number',array('label'=>'Saisir votre code postal : '));
        $formBuilder->add('datenaiss','date',array('label'=>'Saisir votre date de naissance : ','placeholder' => array(
        'year' => 'Annee', 'month' => 'Mois', 'day' => 'Jour'
    )));
        $formBuilder->add('mail','text',array('label'=>'Saisir votre mail : '));
        $formBuilder->add('assurer',CheckboxType::class,array('label'=>'Saisir vi vous ete assurer ou ayan-droit : ','required' => false));
        $formBuilder->add('save','submit');

        $form = $formBuilder->getForm();

    		if($request->getMethod()=='POST')
    		{
    			$form->bind($request);
    			if($form->isValid())
    			{
    				$em = $this->getDoctrine()->getManager();
    				$em->persist($unpatient);
    				$em->flush();
    			}

    		}

        return $this->render('gestionBundle:Default:modifierpatient.html.twig',array('form'=>$form->createView()));

    }
    public function modifierchambreAction(Request $request)
    {
      $id=$request->query->get('id');
      $em=$this->getDoctrine()->getManager();
      $repository=$em->getRepository('gestionBundle:chambre');
      $unechambre=$repository->find($id);

      $formBuilder=$this->createFormBuilder($unechambre);
      $formBuilder->add('service','entity',array('class'=>'gestionBundle:service','property'=>'libelle'));

      $formBuilder->add('save','submit');
      $form = $formBuilder->getForm();

      if($request->getMethod()=='POST')
      {
        $form->bind($request);
        if($form->isValid())
        {
          $em = $this->getDoctrine()->getManager();
          $em->persist($unechambre);
          $em->flush();
        }

      }

      return $this->render('gestionBundle:Default:ajouterchambre.html.twig',array('form'=>$form->createView()));
    }

    public function supprimerpatientAction(Request $request)
    {
       $id=$request->query->get('id');
       $em=$this->getDoctrine()->getManager();
       $repository=$em->getRepository('gestionBundle:patient');
       $unpatient=$repository->find($id);

       $query = $em->createQuery('DELETE FROM gestionBundle:sejours C WHERE C.patient = :id');
       $query->setParameter('id',$id);
       $query->execute();

       $em->remove($unpatient);
       $em->flush();

       return $this->render('gestionBundle:Default:supprimerpatient.html.twig');
    }

	public function consulterSejourAction()
	{
		$doctrine=$this->getDoctrine();
		$entityManager=$doctrine->getManager();
		$repository=$entityManager->getRepository('gestionBundle:sejours');
		$lesSejours=$repository->findAll();
		return $this->render('gestionBundle:default:consulterSejour.html.twig',array('lesSejours'=>$lesSejours));
	}

	public function ajouterSejourAction(Request $request)
	{
		$unSejour = new sejours();
		$formBuilder=$this->createFormBuilder($unSejour);
		$formBuilder->add('dateDebut','date');
		$formBuilder->add('dateFin','date');
		$formBuilder->add('Patient','entity',array('class'=>'gestionBundle:patient','property'=>'nom'));
    $formBuilder->add('leschambres','entity',array('class'=>'gestionBundle:chambre','property'=>'id'));
    $formBuilder->add('numlit','number');

		$formBuilder->add('save','submit');

		$form=$formBuilder->getForm();

		$form->bind($request);
		if($form->isValid())
		{
		$em=$this->getDoctrine()->getManager();
		$em->persist($unSejour);
		$em->flush();
		}
		return $this->render('gestionBundle:Default:ajouterSejour.html.twig',array('form'=>$form->createView()));
	}

  public function afficherchambreAction()
  {
    $doctrine=$this->getDoctrine();
    $entityManager=$doctrine->getManager();
    $repository=$entityManager->getRepository('gestionBundle:chambre');
    $leschambres=$repository->findAll();
    return $this->render('gestionBundle:default:afficherchambre.html.twig',array('leschambres'=>$leschambres));
  }

  public function ajouterchambreAction(Request $request)
  {
    $unechambre=new chambre();
    $formBuilder=$this->createFormBuilder($unechambre);
    $formBuilder->add('service','entity',array('class'=>'gestionBundle:service','property'=>'libelle'));

    $formBuilder->add('save','submit');
    $form = $formBuilder->getForm();

    if($request->getMethod()=='POST')
    {
      $form->bind($request);
      if($form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($unechambre);
        $em->flush();
      }

    }

    return $this->render('gestionBundle:Default:ajouterchambre.html.twig',array('form'=>$form->createView()));


  }

  public function supprimerchambreAction(Request $request)
  {
     $id=$request->query->get('id');
     $em=$this->getDoctrine()->getManager();
     $repository=$em->getRepository('gestionBundle:chambre');
     $unechambre=$repository->find($id);
     $query = $em->createQuery('DELETE FROM gestionBundle:sejours C WHERE C.leschambres = :id');
     $query->setParameter('id',$id);
     $query->execute();

     $em->remove($unechambre);
     $em->flush();

     return $this->render('gestionBundle:Default:supprimerchambre.html.twig');
  }


  public function afficherServiceAction(Request $request){

    $doctrine=$this->getDoctrine();
    $entityManager=$doctrine->getManager();
    $repository=$entityManager->getRepository('gestionBundle:service');

    $lesServices=$repository->findAll();

    return $this->render('gestionBundle:Default:afficherService.html.twig',array('lesServices'=>$lesServices));
  }

  public function ajouterServiceAction(Request $request){

    $unService = new service();
    $formBuilder=$this->createFormBuilder($unService);
    $formBuilder->add('libelle','text',array('label'=>'Saisir le service : '));
    $formBuilder->add('save','submit');
    $form = $formBuilder->getForm();

    if($request->getMethod()=='POST')
    {
      $form->bind($request);
      if($form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($unService);
        $em->flush();
      }

    }

    return $this->render('gestionBundle:Default:ajouterService.html.twig',array('form'=>$form->createView()));

  }

  public function modifierServiceAction(Request $request){

    $id=$request->query->get('id');
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('gestionBundle:service');
    $unService=$repository->find($id);

    $formBuilder=$this->createFormBuilder($unService);
    $formBuilder->add('libelle','text',array('label'=>'Saisir le service : '));
    $formBuilder->add('save','submit');
    $form = $formBuilder->getForm();

    if($request->getMethod()=='POST')
     {
      $form->bind($request);
      if($form->isValid())
     {
        $em = $this->getDoctrine()->getManager();
        $em->persist($unService);
        $em->flush();
     }

     }

      return $this->render('gestionBundle:Default:modifierService.html.twig',array('form'=>$form->createView()));

  }

  public function supprimerServiceAction(Request $request){

    $id=$request->query->get('id');
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('gestionBundle:service');
    $unservice=$repository->find($id);
    //$query2 = $em->createQuery('DELETE FROM gestionBundle:sejours S WHERE S.chambre = (SELECT id FROM gestionBundle:chambre C WHERE C.service = :id)');
    //$query2->setParameter('id',$id);
    //$query2->execute();
    $query = $em->createQuery('DELETE FROM gestionBundle:chambre C WHERE C.service = :id');
    $query->setParameter('id',$id);
    $query->execute();




    $em->remove($unservice);
    $em->flush();

    return $this->render('gestionBundle:Default:supprimerService.html.twig');

  }


  public function supprimmerSejourAction(Request $request){

    $id=$request->query->get('id');
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('gestionBundle:sejours');
    $unsejour=$repository->find($id);


    $em->remove($unsejour);
    $em->flush();

    return $this->render('gestionBundle:Default:supprimmerSejour.html.twig');

  }

  public function modifierSejourAction(Request $request){

    $id=$request->query->get('id');
    $em=$this->getDoctrine()->getManager();
    $repository=$em->getRepository('gestionBundle:sejours');
    $unSejour=$repository->find($id);

    $formBuilder=$this->createFormBuilder($unSejour);
    $formBuilder->add('dateDebut','date');
    $formBuilder->add('dateFin','date');
    $formBuilder->add('Patient','entity',array('class'=>'gestionBundle:patient','property'=>'nom'));
    $formBuilder->add('leschambres','entity',array('class'=>'gestionBundle:chambre','property'=>'id'));
    $formBuilder->add('numlit','number');

    $formBuilder->add('save','submit');
    $form = $formBuilder->getForm();

    if($request->getMethod()=='POST')
     {
      $form->bind($request);
      if($form->isValid())
     {
        $em = $this->getDoctrine()->getManager();
        $em->persist($unSejour);
        $em->flush();
     }

     }

      return $this->render('gestionBundle:Default:modifierSejour.html.twig',array('form'=>$form->createView()));

  }




}
