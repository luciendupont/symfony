<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\entity\ingredient;
class AppFixtures extends Fixture
{
    /*
    *  @var generator
     */
    private generator $faker;
    public function __construct()
    {
        $this-> faker =factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 50; $i++) { 
              $ingredient= new ingredient();
        $ingredient->setName($this->faker->word())
                    ->setPrice(mt_rand(0,100)); 
                  $manager->persist($ingredient);  
        }
     

             

        $manager->flush();
    }
}
