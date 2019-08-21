<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function index()
    {
         $user = $this->getDoctrine()
         ->getRepository(User::class)
         ->findAll();

        return $this->render('admin/user/index.html.twig', [
            'user' => $user ,
        ]);
    }

      /**
     * @Route("/admin/user/new", name="admin_user_new")
     */
    public function new(Request $request):Response
    {
        $user = new User();
        $form= $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();              
            $em->persist($User);
            $em->flush(); 
            return $this->redirectToRoute('admin_user');
        }

     return $this->render('admin/user/create_form.html.twig',
     ['form' => $form->createView(),
        ]);
    } 

 


}
