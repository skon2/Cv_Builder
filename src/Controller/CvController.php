<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Form\CvTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class CvController extends AbstractController
{
    #[Route('/cv/new', name: 'cv_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $cv = new Cv();
        $form = $this->createForm(CvTypeForm::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cv);
            $em->flush();

            $this->addFlash('success', 'CV created successfully!');
            return $this->redirectToRoute('cv_preview', ['id' => $cv->getId()]);
        }

        return $this->render('cv/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/cv/{id}/edit', name: 'cv_edit')]
    public function edit(Request $request, Cv $cv, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CvTypeForm::class, $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'CV updated successfully!');
            return $this->redirectToRoute('cv_preview', ['id' => $cv->getId()]);
        }

        return $this->render('cv/edit.html.twig', [
            'form' => $form->createView(),
            'cv' => $cv,
        ]);
    }

    #[Route('/cv/{id}/preview', name: 'cv_preview')]
    public function preview(Cv $cv): Response
    {
        $template = 'cv/preview_' . $cv->getTemplate() . '.html.twig';
        
        return $this->render($template, [
            'cv' => $cv,
        ]);
    }

    #[Route('/cv/{id}/download', name: 'cv_download')]
    public function download(Cv $cv): Response
    {
        $template = 'cv/preview_' . $cv->getTemplate() . '.html.twig';
        
        // Render the HTML template
        $html = $this->renderView($template, [
            'cv' => $cv,
        ]);

        // Configure DOMPDF
        $options = new Options();
        $options->set('defaultFont', 'Segoe UI');
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        // Create DOMPDF instance
        $dompdf = new Dompdf($options);
        
        // Load HTML content
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render PDF
        $dompdf->render();
        
        // Get PDF content
        $pdfContent = $dompdf->output();

        // Return PDF response
        return new Response(
            $pdfContent,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s_cv.pdf"', 
                    preg_replace('/[^A-Za-z0-9_\-]/', '_', $cv->getFullName())
                ),
            ]
        );
    }

    #[Route('/cv/list', name: 'cv_list')]
    public function list(EntityManagerInterface $em): Response
    {
        $cvs = $em->getRepository(Cv::class)->findAll();

        return $this->render('cv/list.html.twig', [
            'cvs' => $cvs,
        ]);
    }
}