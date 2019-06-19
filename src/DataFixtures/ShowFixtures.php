<?php

namespace App\DataFixtures;

use App\Entity\Spectacle;
use App\Entity\ShowDate;
use App\Entity\ShowRate;
use App\Entity\Theater;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ShowFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 40; $i++) {
            $user = new User();
            $user->setEmail('theatre' . $i . '@theater.com');
            $user->setRoles(['ROLE_THEATER']);
            //$user->setTheaterName('Théâtre n' . $i);
            $user->setPassword($this->encoder->encodePassword($user, 'aze'));

            $manager->persist($user);

            $theater = new Theater();

            //$theater->setName($user->getTheaterName());
            $theater->setEmail($user->getEmail());
            $theater->setAddress1($faker->address);
            $theater->setAddress2('');
            $theater->setCity($faker->city);
            $theater->setZipCode(69007);
            $theater->setLongitude(null);
            $theater->setLat(null);
            $theater->setWebsite($faker->url);
            $theater->setPhoneNumber($faker->phoneNumber);
            $theater->setBaseRate($faker->randomFloat(2, 5, 50));
            $theater->setLogo('https://via.placeholder.com/150');
            $theater->setUser($user);

            $manager->persist($theater);

            for ($j = 0; $j < 5; $j++) {
                $show = new Spectacle();
                $show->setTitle($faker->sentence(4, true));
                $show->setImage('https://via.placeholder.com/150');
                $show->setAdditionalInfos($faker->text(240));
                $show->setBaseRate(25.00);
                $show->setDescription($faker->text(240));
                $show->setIsBalise(true);
                $show->setDistribution($faker->lastName.' '.$faker->firstName.', '.$faker->lastName.' '
                    .$faker->firstName.', '.$faker->lastName.' '.$faker->firstName);
                $show->setMandatoryInfos($faker->text(240));
                $show->setMapadoLink($faker->url);
                $show->setPhotoCredits($faker->lastName.' '.$faker->firstName);
                $show->setTheater($theater);
                $show->setOfferType(1);


                $manager->persist($show);


                $showDate = new ShowDate();
                $showDate->setDateShow($faker->dateTimeBetween('now', '+ 3 months'));
                $showDate->setShowId($show);
                $manager->persist($showDate);
                $showRate = new ShowRate();
                $showRate->setDiscountedRate(2);
                $showRate->setfreePlacesNumber(40);
                $showRate->setShowDate($showDate);
                $manager->persist($showRate);
            }
        }
        // Création d’un utilisateur de type “admin”
        $admin = new User();
        $admin->setEmail('admin@balise.com');
        //$admin->setTheaterName('balise');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->encoder->encodePassword($admin, 'aze'));

        $manager->persist($admin);

        $manager->flush();
    }
}
