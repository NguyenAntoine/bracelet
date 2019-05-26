<?php

namespace App\Controller;

use App\Entity\Patent;
use App\Form\PatentType;
use App\Repository\PatentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/patent")
 */
class PatentController extends AbstractController
{
    /**
     * @Route("/", name="patent_index", methods={"GET"})
     * @param PatentRepository $patentRepository
     * @return Response
     */
    public function index(PatentRepository $patentRepository): Response
    {
        return $this->render('patent/index.html.twig', [
            'patents' => $patentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="patent_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $patent = new Patent();
        $form = $this->createForm(PatentType::class, $patent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patent);
            $entityManager->flush();

            return $this->redirectToRoute('patent_index');
        }

        return $this->render('patent/new.html.twig', [
            'patent' => $patent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patent_show", methods={"GET"})
     * @param Patent $patent
     * @return Response
     */
    public function show(Patent $patent): Response
    {
        return $this->render('patent/show.html.twig', [
            'patent' => $patent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="patent_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Patent $patent
     * @return Response
     */
    public function edit(Request $request, Patent $patent): Response
    {
        $form = $this->createForm(PatentType::class, $patent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patent_index', [
                'id' => $patent->getId(),
            ]);
        }

        return $this->render('patent/edit.html.twig', [
            'patent' => $patent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patent_delete", methods={"DELETE"})
     * @param Request $request
     * @param Patent $patent
     * @return Response
     */
    public function delete(Request $request, Patent $patent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($patent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('patent_index');
    }
}
