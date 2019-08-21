<?php

namespace App\Controller\Site;
use App\Entity\Hotel;

use App\Repository\HotelRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="Home")
     */


  
    public function index( HotelRepository $repository)
    {   
        $hotel = $repository ->findAll();
        return $this->render('site/front/home.html.twig', [
            'hotel' => $hotel
        ]);
    } 
    
}
