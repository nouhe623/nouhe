<?php

namespace App\Controller;
use App\Entity\Hotel;


use App\Form\HotelType;
 
use App\Repository\HotelRepository;
 use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminPropertyController extends AbstractController
{  
 

  

    /**
     * @Route("/admin1", name="admin.view")
     */
    public function view (HotelRepository $repository)
    { 
        $hotel = $repository ->findAll();
        return $this->render('admin_property/index.html.twig', compact('hotel'));
    }






     /**
       * @Route("/admin1/new", name="admin_ajout")
      */
     public function new (Request $request, ObjectManager $em)
     { 
         $hotel = new hotel;
         $form = $this-> createForm(HotelType::class, $hotel);
         $form->handleRequest($request);


         if ($form ->isSubmitted() && $form->isValid())
         {
              $em->persist($hotel);
              $em->flush();
             return $this->redirectToRoute('admin.view');
         }
 
         return $this->render('admin_property/ajout.html.twig',[
            'hotel' => $hotel,
            'form'  => $form->createView()
        ]);
 
     }

     /**
     * @Route("/admin1/{id}", name="admin_edit")
     * @param Resquest $request
     */
    public function edit (Hotel $hotel, Request $request, ObjectManager $em)
    { 
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form ->isSubmitted() && $form->isValid())
        {
             $em->flush();
            return $this->redirectToRoute('admin.view');
        }

        return $this->render('admin_property/edit.html.twig',[
            'hotel' => $hotel,
            'form'  => $form->createView()
        ]);
    }

   
    
}
