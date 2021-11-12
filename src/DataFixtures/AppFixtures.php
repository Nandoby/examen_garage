<?php

namespace App\DataFixtures;

use App\Entity\Staff;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        for ($i = 0; $i < 6; $i++) {
            $faker = Factory::create();
            $staff = new Staff();
            $staff->setNom($faker->name)
                ->setEmail($faker->email)
                ->setPicture('https://randomuser.me/api/portraits/men/'.$i.'.jpg')
                ->setPrenom($faker->lastName)
                ->setStatus('test')
                ->setTelephone($faker->phoneNumber)
            ;
            $manager->persist($staff);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
