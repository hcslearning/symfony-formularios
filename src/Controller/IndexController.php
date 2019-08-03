<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DespachoType;
use App\Form\ClienteType;
use App\Form\ProveedorType;
use App\Form\SucursalType;
use \App\Entity\Despacho;
use App\Entity\Cliente;
use App\Entity\Proveedor;
use App\Entity\Sucursal;

class IndexController extends AbstractController {

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request) {

        return $this->render('index/index.html.twig', [
        ]);
    }

    /**
     * @Route("/cliente", name="index_cliente")
     */
    public function cliente(Request $request) {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente, []);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();
        }

        return $this->render('index/index.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/d1", name="index_despacho")
     */
    public function despacho(Request $request) {
        $despacho = new Despacho();
        $form = $this->createForm(DespachoType::class, $despacho, []);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
        }

        return $this->render('index/despacho.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/proveedor", name="index_proveedor")
     */
    public function proveedor(Request $request) {
        $proveedor = new Proveedor();
        $proveedor
                ->addSucursale(new Sucursal())
        ;
        $form = $this->createForm(ProveedorType::class, $proveedor, []);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proveedor);
            $entityManager->flush();

            $this->addFlash('success', 'Se creo correctamente el proveedor');
            //return $this->redirectToRoute('categoria_index');
        }

        return $this->render('index/proveedor.html.twig', [
                    'form' => $form->createView(),
                    'proveedor' => $proveedor,
        ]);
    }

    /**
     * @Route("/proveedor/{id}", name="index_proveedor_edit")
     */
    public function proveedorEdit(Request $request, Proveedor $proveedor) {
        $add = $request->query->get('add', false);
        if ($add) {
            $proveedor->addSucursale(new Sucursal());
        }
        $form = $this->createForm(ProveedorType::class, $proveedor, []);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Se modificó correctamente el proveedor');
            //return $this->redirectToRoute('categoria_index');
        }

        return $this->render('index/proveedor.html.twig', [
                    'form' => $form->createView(),
                    'proveedor' => $proveedor,
        ]);
    }

    /**
     * @Route("/sucursal/{id}/remove", name="index_sucursal_remove")
     */
    public function sucursalRemove(Request $request, Sucursal $sucursal) {
        $id = $sucursal->getId();
        $proveedor = $sucursal->getProveedor();
        $proveedorId = $proveedor->getId();
        $proveedor->removeSucursale($sucursal);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($sucursal);
        $entityManager->flush();

        $this->addFlash('success', 'Se quitó correctamente la sucursal ' . $id);
        return $this->redirectToRoute('index_proveedor_edit', ['id' => $proveedorId]);
    }

    /**
     * @Route("/steps", name="pasos")
     */
    public function pasos(Request $request) {
        $paso = $request->query->get('paso', 0);
        $paso = intval($paso);

        $despacho = new Despacho();
        $form = $this->createForm(DespachoType::class, $despacho, [
            'paso' => $paso
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($paso == 1) {
                return $this->redirectToRoute('pasos', ['paso' => 2]);
            }
        }

        return $this->render('index/pasos.html.twig', [
                    'form' => $form->createView()
        ]);
    }

}
