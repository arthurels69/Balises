<?php

namespace App\DataFixtures;

use App\Entity\Spectacle;
use App\Entity\ShowDate;
use App\Entity\ShowRate;
use App\Entity\Theater;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TheaterFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $admin = new User();
        $admin->setEmail('admin@balise.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->encodePassword($admin, 'aze'));

        $manager->persist($admin);

        $user = new User();
        $user->setEmail('mailbidon@renaissance.com');

        
//        // Liste user à ajouter :
//        $tab1 = array(

//                'email' => "theatre@lelysee.com",
//                'role' => array("[ROLE_THEATER]"),
//                'password' => "aze");
//
//
//
//        // Liste théatres à ajouter :
//        $tab = array(
//            array('user' => "",
//                'name' => "Théâtre de l'Élysée",
//                'email' => "theatre@lelysee.com",
//                'adresse1' => "14 rue Basse-Combalot",
//                'adresse2' => "",
//                'zipcode' => "69007",
//                'city' => "LYON",
//                'phonenumber' => "04 78 58 88 25",
//                'logo' => "https://user-images.githubusercontent.com/34077099/
//                    59409777-566c9900-8db7-11e9-9da7-be10b566797f.png",
//                'website' => "",
//                'baserate' => "12.00",
//                'lat' => "45.755340",
//                'lont' => "4.842107",
//                'picture' => "http://scenedecouvertes.com/wp-content/uploads
//                /2016/10/2016-Come%CC%81dies-tragiques.jpg"),
//
//            array('user' => "",
//                'name' => "Théâtre de la Renaissance",
//                'email' => "mailbidon@renaissance.com",
//                'adresse1' => "7 rue Orsel",
//                'adresse2' => "",
//                'zipcode' => "69600",
//                'city' => "OULLINS",
//                'phonenumber' => "04 72 39 74 91",
//                'logo' => "https://www.theatrelarenaissance.com/wp-content/themes/
//                renaissance/images/logo-la-renaissance-cercle.png",
//                'website' => "",
//                'baserate' => "25.00",
//                'lat' => "45.716693",
//                'lont' => "4.810657",
//                'picture' => "https://media.lyon-france.com/1200x857/61953/931656.jpg"),
//
//            array('user' => "",
//                'name' => "Théâtre des Clochards Célestes",
//                'email' => "mailbidon@clochardscelestes.com",
//                'adresse1' => "51 rue des Tables Claudiennes",
//                'adresse2' => "",
//                'zipcode' => "69001",
//                'city' => "LYON",
//                'phonenumber' => "04 78 28 34 43",
//                'logo' => "http://s425263860.onlinehome.fr/wp-content/uploads/2017/08/logo-header.png",
//                'website' => "",
//                'baserate' => "12.00",
//                'lat' => "45.771298",
//                'lont' => "4.834049",
//                'picture' => "https://www.le-tout-lyon.fr/content/images/2018/05/31/9336/clochards-ceilestes.jpg"),
//                );
//
//
//        foreach ($tab as $row) {
//            $theater = new Theater();
//            {
//                $user = new User();
//
//                $user->setEmail($tab1['email']);
//                $user->setRoles($tab1['role']);
//                $user->setPassword($this->encoder->encodePassword($user, $tab1['password']));
//
//                $theater->setUser($user);
//                $theater->setName($row['name']);
//                $theater->setEmail($row['email']);
//                $theater->setAddress1($row['adresse1']);
//                $theater->setAddress2($row['adresse2']);
//                $theater->setZipCode($row['zipcode']);
//                $theater->setCity($row['city']);
//                $theater->setPhoneNumber($row['phonenumber']);
//                $theater->setLogo($row['logo']);
//                $theater->setWebsite($row['website']);
//                $theater->setBaseRate($row['baserate']);
//                $theater->setLat($row['lat']);
//                $theater->setLongitude($row['lont']);
//                $theater->setPicture($row['picture']);
//
//                $manager->persist($theater);
//            }
//        }
//            $manager->flush();
    }
}
