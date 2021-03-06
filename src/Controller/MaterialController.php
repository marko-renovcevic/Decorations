<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\DropdownType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/material")
 */
class MaterialController extends Controller
{
    /**
     * @Route("/", name="material_index", methods="GET")
     */
    public function index(): Response
    {
        $materials = $this->getDoctrine()
            ->getRepository(Material::class)
            ->findAll();

        return $this->render('material/index.html.twig', ['materials' => $materials]);
    }

    /**
     * @Route("/new", name="material_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $material = new Material();
        $form = $this->createForm(DropdownType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($material);
            $em->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been added successfully');

            return $this->redirectToRoute('material_index');
        }

        return $this->render('material/new.html.twig', [
            'material' => $material,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/{id}", name="material_show", methods="GET")
//     */
//    public function show(Material $material): Response
//    {
//        return $this->render('material/show.html.twig', ['material' => $material]);
//    }

    /**
     * @Route("/{id}/edit", name="material_edit", methods="GET|POST")
     */
    public function edit(Request $request, Material $material): Response
    {
        $form = $this->createForm(DropdownType::class, $material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '<strong>Success!</strong> Item has been edited successfully');

//            return $this->redirectToRoute('material_edit', ['id' => $material->getId()]);
            return $this->redirectToRoute('material_index');
        }

        return $this->render('material/edit.html.twig', [
            'material' => $material,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="material_delete", methods="DELETE")
     */
    public function delete(Request $request, Material $material): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$material->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('material_index');
        }

        if (!$material->getBalloons()->isEmpty()) {
            $numOfBalloons = \count($material->getBalloons());
            $this->addFlash('danger', '<strong>Error!</strong> Cannot delete ' . $material->getName() . ' because it is being used by ' . $numOfBalloons . ' Balloon(s)');
            return $this->redirectToRoute('material_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($material);
        $em->flush();

        $this->addFlash('success', '<strong>Success!</strong> Item has been deleted successfully');

        return $this->redirectToRoute('material_index');
    }
}
