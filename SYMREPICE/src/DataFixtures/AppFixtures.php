<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\entity\ingredient;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 50; $i++) { 
              $ingredient= new ingredient();
        $ingredient->setName('Ingredient ',$i)
                    ->setPrice(mt_rand(0,100)); 
                  $manager->persist($ingredient);  
        }
     

             

        $manager->flush();
    }
}
