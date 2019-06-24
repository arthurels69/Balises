<?php

namespace App\DataFixtures;

use App\Entity\Theater;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // Création de l'admin Balise
        $admin = new User();
        $admin->setEmail('admin@balise.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'aze'));

        $manager->persist($admin);
        
        // Création 1er compte utilisateur
        $user1 = new User();
        $user1->setEmail('theatre@lelysee.com');
        $user1->setRoles(['ROLE_THEATER']);
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'aze'));

        $manager->persist($user1);

        // Création 2ème compte utilisateur
        $user2 = new User();
        $user2->setEmail('mailbidon@renaissance.com');
        $user2->setRoles(['ROLE_THEATER']);
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'aze'));

        $manager->persist($user2);

        // Création 3ème compte utilisateur
        $user3 = new User();
        $user3->setEmail('mailbidon@clochardscelestes.com');
        $user3->setRoles(['ROLE_THEATER']);
        $user3->setPassword($this->passwordEncoder->encodePassword($user3, 'aze'));

        $manager->persist($user3);

        //Création 1er théâtre
        $t1 = new Theater();
        $t1->setName("Théâtre de l'Élysée");
        $t1->setEmail($user1->getEmail());
        $t1->setAddress1('14 rue Basse-Combalot');
        $t1->setAddress2('');
        $t1->setCity("Lyon");
        $t1->setZipCode(69007);
        $t1->setWebsite('www.elysee.com');
        $t1->setPhoneNumber('0478588825');
        $t1->setBaseRate(12);
        $t1->setLogo('https://via.placeholder.com/150');
        $t1->setUser($user1);

        $manager->persist($t1);

        //Création 2ème théâtre
        $t2 = new Theater();
        $t2->setName("Théâtre de la Renaissance");
        $t2->setEmail($user2->getEmail());
        $t2->setAddress1('7 rue Orsel');
        $t2->setAddress2('');
        $t2->setCity("Oullins");
        $t2->setZipCode(69600);
        $t2->setWebsite('www.renaissance.com');
        $t2->setPhoneNumber('0472397491');
        $t2->setBaseRate(25);
        $t2->setLogo('https://via.placeholder.com/150');
        $t2->setUser($user2);

        $manager->persist($t2);

        //Création 3ème théâtre
        $t3 = new Theater();
        $t3->setName("Théâtre des Clochards Célestes");
        $t3->setEmail($user3->getEmail());
        $t3->setAddress1('51 rue des Tables Claudiennes');
        $t3->setAddress2('');
        $t3->setCity("Lyon");
        $t3->setZipCode(69001);
        $t3->setWebsite('www.clochards-celestes.com');
        $t3->setPhoneNumber('0478283443');
        $t3->setBaseRate(12);
        $t3->setLogo('https://via.placeholder.com/150');
        $t3->setUser($user3);

        $manager->persist($t3);

        $manager->flush();
    }
}
