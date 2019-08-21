<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);


        
            // Gestion des réservations
            $reserver = new Reservation();
 
            $createdAt = $faker->dateTimeBetween('-6 months');
            $startDate = $faker->dateTimeBetween('-3 months');
            // Gestion de la date de fin
         
            $duration  = mt_rand(3, 10);
          
            $endDate   = (clone $startDate)->modify("+$duration days");
           
            $nombre    =  $hotel->getPrice() * $duration;
            $reserveer = $reserveer[mt_rand(0, count($reserveer) -1)];

            $reserver->setReserver($reserver);
            $reserver ->setHotel($hotel);
            $reserver  ->setStartDate($startDate);
            $reserver ->setEndDate($endDate);
            $reserver   ->setCreatedAt($createdAt);

            $reserver      ->setAmount($nombre);

            $manager->persist($reserver);
 

        $manager->flush();
    }
}

 


