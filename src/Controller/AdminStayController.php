<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StayRepository;
use App\Entity\Stay;
use App\Form\StayType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class AdminStayController extends AbstractController
{
    /**
     * @Route("/admin/stay", name="app_admin_stay")
     */
    public function index(StayRepository $repo): Response
    {
        return $this->render('admin_stay/index.html.twig', [
            'controller_name' => 'AdminStayController',
            'stays' => $repo->findAll()
        ]);
    }
    /**
     * @Route("/{id}/admin/stay/edit", name="app_admin_stay_edit" , methods={"GET", "POST"})
     */
    public function edit(StayRepository $repo, Stay $stay, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(StayType::class, $stay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('photo')->getData();
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            $uploads_directory = $this->getParameter('kernel.project_dir') . '/public/uploads';
            $filename = md5(uniqid()) . '.' . $photo->guessExtension();
            $photo->move(
                $uploads_directory,
                $filename
            );
            $stay->setPhoto($filename);

            $repo->add($stay);
            $this->addFlash(
                'success',
                "Stay with id <strong>{$stay->getId()}</strong> was succeffully updated ! "
            );
            #return $this->redirectToRoute('app_admin_stay', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('stay/Adminedit.html.twig', [
            'stay' => $stay, 'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**     
     * @Route("/{id}/admin/stay/delete", name="app_admin_stay_delete", methods={"GET","POST"})
     */
    public function delete(Request $request, Stay $stay, StayRepository $stayRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $stay->getId(), $request->request->get('_token'))) {
            $stayRepository->remove($stay);
            $this->addFlash(
                'Success',
                "Stay with id <strong>{$stay->getId()}</strong> was succeffully deleted ! "
            );
        }

        return $this->redirectToRoute('app_admin_stay', [], Response::HTTP_SEE_OTHER);
    }
}
