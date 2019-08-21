<?php

namespace App\Controller;
use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

/**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
         $user = $this->getDoctrine()
         ->getRepository(User::class)
         ->findAll();

        return $this->render('admin/index.html.twig', [
            'user' => $user ,
        ]);
    }


     
}
