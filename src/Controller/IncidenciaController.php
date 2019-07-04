<?php

namespace App\Controller;

use App\Entity\Incidencia;
use App\Repository\IncidenciaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\IncidenciaType;
use App\Helper\MensajeIncidencia;
use App\Managers\IncidenciaManager;
use App\Form\SearchType;
use App\Security\IncidenciaVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


use Knp\Component\Pager\PaginatorInterface;
use App\Service\FileUploader;
use App\Entity\User;

/**
 * @Route("/admin/incidencia")
 * @IsGranted("ROLE_USER")
 */
class IncidenciaController extends AbstractController{

    private $mensajeIncidencia;


    /**
     * @Route("/", name="incidencia_index", methods={"GET","POST"})
     */
    public function index(IncidenciaRepository $incidenciaRepository,Request $request, PaginatorInterface $paginator){

        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted()){
            $incidencias = $incidenciaRepository->findByTitle($form->getData());
        }else{
            $incidencias = $incidenciaRepository->findAll();
        }

        $incidencias = $paginator->paginate(
            // Doctrine Query, not results
            $incidencias,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        return $this->render('incidencia/index.html.twig',[
            'incidencias' => $incidencias,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/new", name="incidencia_new", methods={"GET","POST"})
     */
    public function new(IncidenciaManager $incidenciaManager,Request $request, FileUploader $fileUploader): Response
    {
        $incidencia = $incidenciaManager->newObject();
        $form = $this->createForm(IncidenciaType::class, $incidencia);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            /*$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($incidencia);
            $entityManager->flush();*/
            
            $filename = $fileUploader->upload($form['attachment']->getData(), $this->getParameter('upload_directory'));

            $incidencia->setAttachment($filename);

            $incidencia = $incidenciaManager->create($incidencia);


            $this->addFlash('success', 'Incidencia Creada');

            return $this->redirectToRoute('incidencia_show', [
                'id' => $incidencia->getId(),
            ]);
        }

        return $this->render('incidencia/new.html.twig', [
            'incidencia' => $incidencia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incidencia_show", methods={"GET"})
     */
    public function show(Incidencia $incidencia, MensajeIncidencia $mensajeIncidencia): Response
    {
        $this->denyAccessUnlessGranted('view',$incidencia);
        $this->mensajeIncidencia = $mensajeIncidencia->getMessage();
        $buscar = $this->getParameter('buscar');

        if(strpos($incidencia->getTitle(), $buscar) !== false)
            echo $this->mensajeIncidencia;

        return $this->render('incidencia/show.html.twig', [
            'incidencia' => $incidencia,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="incidencia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Incidencia $incidencia): Response
    {
        $this->denyAccessUnlessGranted('view',$incidencia);
        $form = $this->createForm(IncidenciaType::class, $incidencia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Incidencia Editada');

            return $this->redirectToRoute('incidencia_show', [
                'id' => $incidencia->getId(),
            ]);
        }

        return $this->render('incidencia/edit.html.twig', [
            'incidencia' => $incidencia,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="incidencia_delete", methods={"GET"})
     */
    public function delete(IncidenciaManager $incidenciaManager,Request $request, Incidencia $incidencia): Response
    {

        $this->denyAccessUnlessGranted('view',$incidencia);

        $incidenciaManager->delete($incidencia);

        $this->addFlash('error', 'Incidencia borrada correctamente');

        return $this->redirectToRoute('incidencia_index');
    }


}