<?php

namespace GM\ProjetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use GM\ProjetBundle\Entity\Mission;

use GM\ProjetBundle\Entity\Frais;
use GM\ProjetBundle\Form\FraisType;

use Symfony\Component\HttpFoundation\Request;


class DepenseController extends Controller
{
    public function indexAction()
    {
        return $this->render('GMProjetBundle:Depense:index.html.twig');
    }
//*************************************************************SEMAINE DU 28 MARS   

    
 
//*************************************************************AJOUT FRAIS    
//*************************************************************AJOUT FRAIS
//*************************************************************AJOUT FRAIS
        public function ajoutfraisAction(Request $request)
    {
    $f= new Frais();
    $form = $this->createForm(FraisType::class, $f);
    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    if($form->isValid() && $form->isValid()){
      $miss= new Mission();
      $miss=$em->getRepository('GMProjetBundle:Mission')->find('1');
      $f->setMission($miss);
            $em->persist($f);
            $em->flush();
            $file = $f->getPiece();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/brochures';
            $file->move($brochuresDir, $fileName);  
            $f->setPiece($fileName);
    }
       
            $lf=$em->getRepository('GMProjetBundle:Frais')->findAll();
        return $this->render('GMProjetBundle:Depense:ajout.html.twig', array('f' => $form->createView(), 'Frais' => $lf));
    } 
    

//*************************************************************AFFICHER FRAIS
        public function listefraisAction()
    {
              $em= $this->getDoctrine()->getEntityManager();
      $lf=$em->getRepository('GMProjetBundle:Frais')->findAll();

      return $this->render('GMProjetBundle:Depense:liste.html.twig', array('Frais' => $lf));   
    }
    
    
    //*************************************************************MODIFIER FRAIS
        public function modificationfraisAction(Request $request, $id)
    {
    $mess = "Modifier un frais";
    $em = $this->getDoctrine()->getManager();
    $f= $em->getRepository('GMProjetBundle:Frais')->find($id);
    $form = $this->createForm(FraisType::class, $f);
    $form->handleRequest($request);
    if($form->isValid() && $form->isValid()){
      $miss= new Mission();
      $miss=$em->getRepository('GMProjetBundle:Mission')->find('1');
      $f->setMission($miss);
            $em->flush();
            $mess = "VALIDD Modifier un frais";
            return $this->redirectToRoute('gm_projet_liste');
    }
            $lf=$em->getRepository('GMProjetBundle:Frais')->findAll();
        return $this->render('GMProjetBundle:Depense:ajout.html.twig', array('f' => $form->createView(), 'Frais' => $lf));
    }
    
 //*************************************************************SUPPRIMER FRAIS    
 //*************************************************************SUPPRIMER FRAIS
        public function suppressionfraisAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $f= $em->getRepository('GMProjetBundle:Frais')->find($id);
        if(!$f){
            throw $this->createNotFoundException('Le frais numéro '. $id. ' n\'existe pas dans la base');
        }
        $em->remove($f);
        $em->flush();
        return $this->redirectToRoute('gm_projet_liste');
    }



    
}
