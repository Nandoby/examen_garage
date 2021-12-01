<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Marque;
use App\Entity\Staff;
use App\Entity\User;
use App\Entity\Voiture;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        // je remplis ma bdd avec le staff
        for ($i = 0; $i < 6; $i++) {
            $faker = Factory::create('fr_FR');
            $staff = new Staff();
            $staff->setNom($faker->name)
                ->setEmail($faker->email)
                ->setPicture('https://randomuser.me/api/portraits/men/' . $i . '.jpg')
                ->setPrenom($faker->lastName)
                ->setStatus('test')
                ->setTelephone($faker->phoneNumber);
            $manager->persist($staff);
        }

        // ma base de données des voitures
        $faker = Factory::create();
        $slugify = new Slugify();

        $marques = [
            'Ferrari',
            'Mercedes',
            'Fiat',
            'Renault',
            'Alfa Romeo',
            'Audi',
            'Volkswagen',
            'Ford',
            'Toyota',
            'Jaguar'
        ];

        $modeles = [
            'Monza',
            'C 220',
            '500 Abarth',
            'Captur',
            'Stelvio',
            'A8',
            'Passat',
            'Ranger',
            'Yaris',
            'XF'
        ];
        $carburant = ['Diesel', 'GPL', 'Essence', 'Electrique', 'Hybride'];

        $coverImage = [
            'https://upload.wikimedia.org/wikipedia/commons/a/a1/Ferrari_Monza_SP1%2C_Paris_Motor_Show_2018%2C_IMG_0643.jpg',
            'https://img4.autodeclics.com/photo_article/68461/4028/1200-L-essai-mercedes-c-220-bluetec-2014.jpg',
            'https://topgear.static-vds.nl/thumbs/hd/2021/09/fiat-500-abarth-500-pk.jpg',
            'https://www.largus.fr/images/images/renault-captur-hybride-145-08_3.jpeg',
            'https://sf2.autoplus.fr/wp-content/uploads/autoplus/2021/04/alfa-romeo-stelvio-veloce-2021-avant-gauche.jpeg',
            'https://cdn.pocket-lint.com/r/s/1200x/assets/images/142623-cars-review-audi-a8-review-image1-oeorhy2mcv.jpg',
            'https://cdn.motor1.com/images/mgl/geNbP/s3/vw-passat-facelift-2019.webp',
            'https://www.sudinfo.be/sites/default/files/dpistyles_v2/ena_sp_16_9_illustration_principale/2020/01/03/node_159592/41970463/public/2020/01/03/B9722110967Z.1_20200103140807_000+GHTF7J67F.1-0.jpg?itok=UeBDgQ9Q1578056895',
            'https://cdn.motor1.com/images/mgl/AVZOV/s1/4x3/toyota-yaris-2017.webp',
            'https://i.gaw.to/vehicles/photos/40/22/402292-2021-jaguar-xf.jpg'
        ];

        $transmission = ['automatique', 'manuelle'];


        for ($i = 0; $i < 10; $i++) {
            $voiture = new Voiture();
            $marque = new Marque();


            $marque->setName($marques[$i]);

            $manager->persist($marque);

            $voiture->setMarque($marque)
                ->setKm(rand(0, 15000))
                ->setOptions("GPS, Airbag, Climatisation, Phares Xenon")
                ->setNombresProprietaires(rand(0, 5))
                ->setModele($modeles[$i])
                ->setCarburant($carburant[rand(0, 1)])
                ->setPuissance(rand(60, 360))
                ->setCylindree(rand(1200, 3000))
                ->setCoverImage($coverImage[$i])
                ->setDescription($faker->sentence())
                ->setMarque($marque)
                ->setPrix(rand(20000, 250000))
                ->setTransmission($transmission[rand(0, 1)])
                ->setSlug($slugify->slugify($marque->getName() . uniqid()))
                ->setMiseCirculation(new \DateTime());
            $manager->persist($voiture);

            for ($j = 0; $j < 6; $j++) {
                $images = new Image();
                $images->setTitle('https://picsum.photos/id/'.rand(50, 100).'/1280/720')
                    ->setCaption($faker->sentence())
                    ->setVoiture($voiture);
                $manager->persist($images);

            }


        }

        for ($u = 1; $u < 10; $u++) {
            $faker = Factory::create('fr_FR');
            $user = new User();

            $user->setEmail($faker->email)
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
            ;
            $manager->persist($user);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}