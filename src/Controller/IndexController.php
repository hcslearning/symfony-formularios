<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\DespachoType;
use \App\Entity\Despacho;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $despacho = new Despacho();
        $form = $this->createForm(DespachoType::class, $despacho, []);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
        }
        
        return $this->render('index/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/steps", name="pasos")
     */
    public function pasos(Request $request)
    {
        $paso = $request->query->get('paso', 0);
        $paso = intval($paso);
        
        $despacho = new Despacho();
        $form = $this->createForm(DespachoType::class, $despacho, [
            'paso'  => $paso
        ]);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            if($paso == 1) {
                return $this->redirectToRoute('pasos', ['paso' => 2]);
            }
        }
        
        return $this->render('index/pasos.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
