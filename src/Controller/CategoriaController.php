<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Managers\CategoriaManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/categoria")
 * @IsGranted("ROLE_USER")
 */
class CategoriaController extends AbstractController
{
    /**
     * @Route("/", name="categoria_index", methods={"GET"})
     */
    public function index(CategoriaRepository $categoriaRepository): Response
    {
        return $this->render('categoria/index.html.twig', [
            'categorias' => $categoriaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categoria_new", methods={"GET","POST"})
     */
    public function new(CategoriaManager $categoriaManager, Request $request): Response
    {

        $categorium = $categoriaManager->newObject();
        $form = $this->createForm(CategoriaType::class, $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $categorium = $categoriaManager->create($categorium);

            return $this->redirectToRoute('categoria_index');
        }

        return $this->render('categoria/new.html.twig', [
            'categorium' => $categorium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categoria_show", methods={"GET"})
     */
    public function show(Categoria $categorium): Response
    {
        return $this->render('categoria/show.html.twig', [
            'categorium' => $categorium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categoria_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categoria $categorium): Response
    {
        $form = $this->createForm(CategoriaType::class, $categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoria_index', [
                'id' => $categorium->getId(),
            ]);
        }

        return $this->render('categoria/edit.html.twig', [
            'categorium' => $categorium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categoria_delete", methods={"DELETE"})
     */
    public function delete(CategoriaManager $categoriaManager, Request $request, Categoria $categorium): Response
    {
        $categoriaManager->delete($categorium);

        return $this->redirectToRoute('categoria_index');
    }

}
