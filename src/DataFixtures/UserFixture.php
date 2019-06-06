<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //Création de plusieurs utilisateurs de type “Theatre”
        for ($i = 1; $i <= 5; $i++) {
            $author = new User();
            $author->setEmail('theatre' . $i . '@theater.com');
            $author->setRoles(['ROLE_THEATER']);
            $author->setTheaterName('Théâtre n' . $i);
            $author->setPassword($this->passwordEncoder->encodePassword(
                $author,
                'aze'
            ));

            $manager->persist($author);
        }

        // Création d’un utilisateur de type “admin”
        $admin = new User();
        $admin->setEmail('admin@balise.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'aze'
        ));

        $manager->persist($admin);

        // Sauvegarde des 2 nouveaux utilisateurs :
        $manager->flush();
    }
}
