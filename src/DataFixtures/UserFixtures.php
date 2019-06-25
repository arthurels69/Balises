<?php

namespace App\DataFixtures;

use App\Entity\ShowDate;
use App\Entity\ShowRate;
use App\Entity\Spectacle;
use App\Entity\Theater;
use App\Entity\User;
use App\Service\TheaterService;
use Faker;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    private $theaterService;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, TheaterService $theaterService)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->theaterService = $theaterService;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

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

        // Création 1er théâtre
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
        $this->theaterService->geocode($t1);

        $manager->persist($t1);

        // Création 2ème théâtre
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
        $this->theaterService->geocode($t2);

        $manager->persist($t2);

        // Création 3ème théâtre
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
        $this->theaterService->geocode($t3);

        $manager->persist($t3);

        // Création spéctacle 1
        $show1 = new Spectacle();
        $show1->setTitle('Les chevaliers');
        $show1->setImage('https://lelysee.com/wp-content/uploads/2008/10/spe1img_96.jpg');
        $show1->setAdditionalInfos('');
        $show1->setBaseRate(25.00);
        $show1->setDescription('Ils sont quatre. Ce sont des chevaliers, avec des plumes et des armures. 
        Un barde les accompagne, il sera garant de l’aspect épique du spectacle. Un narrateur est présent, il sera 
        garant de l’aspect éthique du spectacle. C’est une pièce sur l’héroïsme donc c’est une pièce sur l’impuissance.
        Pour être un héros, il faut être courageux mais pour être courageux il faut savoir où se trouve le courage, 
        où se trouve la mission. Le principal obstacle est que ces chevaliers sont tout prêts de se faire déborder par
        le monde. Ils développent un bataillon de stratégies et de parades afin de repousser le moment où ils
        constateront fatalement qu’il n’y a pas de mission. Quand ce moment arrive, poussés dans leurs derniers
        retranchements, ils en inventent l’apocalypse. On pourrait dire que c’est du théâtre absurdo comique
        involontairement engagé ou plutôt une farce politique malencontreusement divertissante.');
        $show1->setIsBalise(true);
        $show1->setDistribution('texte et mise en scène : Guillaume Bailliart
        jeu : Guillaume Bailliart, Mélanie Bestel, Mélanie Bourgeois, Laurent Dratler, Pierre-Jean Etienne, Aurélie
        Pitrat, Gérald Robert-Tissot');
        $show1->setMandatoryInfos('');
        $show1->setMapadoLink('');
        $show1->setPhotoCredits('');
        $show1->setTheater($t1);
        $show1->setOfferType(1);

        $manager->persist($show1);

        // Création spéctacle 2
        $show2 = new Spectacle();
        $show2->setTitle('La première ville de l’histoire de l’humanité');
        $show2->setImage('https://lelysee.com/wp-content/uploads/2009/11/spe1img_76.jpg');
        $show2->setAdditionalInfos('');
        $show2->setBaseRate(12.00);
        $show2->setDescription('Au centre de ce texte, il y a le personnage de Jennifer, femme opaque, 
        volatile, somme vide de tous les silences. Autour d’elle, un monde s’agite, et met tout en œuvre pour la sauver.
        La sauver de quoi ? La sauver pourquoi ? Aucun de ses preux chevaliers ne le sait exactement, mais considère
        simplement que prendre possession d’elle suffira à assurer son bonheur. La première ville de l’histoire de
        l’Humanité raconte cette guerre pour la possession, une guerre qui se cache derrière une surenchère de bonnes
        intentions et de sentiments purs. C’est une histoire de couple, et donc une histoire de pouvoir mais la plus
        grande aliénation ne vient pas des hommes, elle réside en eux, sans même qu’ils s’en aperçoivent, instruments 
        et victimes de leur propre tyrannie. Il y a un peu plus de 10,000 ans, les Hommes se sédentarisaient et 
        construisaient les premières villes, autour de leur foyer. Ils matérialisaient, en élevant des murs, un carcan
        de domination qui n’a pas été abattu depuis. Circonscrite pendant des siècles dans une unité de lieu hermétique,
        Jennifer, la Femme, est la victime consentante de cette dictature domestique, surtout parce que toutes les 
        options proposées par ses sauveurs ne sont finalement que d’autres cellules de sa même prison intime.');
        $show2->setIsBalise(true);
        $show2->setDistribution('texte et mise en scène : Guillaume Bailliart
        jeu : Guillaume Bailliart, Mélanie Bestel, Mélanie Bourgeois, Laurent Dratler, Pierre-Jean Etienne, Aurélie
        Pitrat, Gérald Robert-Tissot');
        $show2->setMandatoryInfos('');
        $show2->setMapadoLink('');
        $show2->setPhotoCredits('');
        $show2->setTheater($t2);
        $show2->setOfferType(1);

        $manager->persist($show2);

        // Création spéctacle 3
        $show3 = new Spectacle();
        $show3->setTitle('Éloge de la motivation');
        $show3->setImage('https://lelysee.com/wp-content/uploads/2009/11/spe1img_34.jpg');
        $show3->setAdditionalInfos('');
        $show3->setBaseRate(12.00);
        $show3->setDescription('Trois spécialistes du travail viennent nous faire l\'apologie de la réussite
        par le travail à tout prix. C\'est à travers une conférence où se mêleront entretiens, simulations, discours et
        invités surprises.... qu\'ils tenteront de nous convaincre que pour s\'en sortir, il faut travailler et pour 
        travailler il faut tout donner... Il s\'agit d\'essayer encore de tenter de rire de l\'insupportable en abordant
        le thème délicat et paradoxal qu\'est le travail par la forme burlesque. Les sources littéraires qui ont inspiré
        ce projet sont idéologiquement opposées. En effet il y a d\'un côté toute une littérature faisant l\'apologie
        des méthodes de management et de coaching radicales ; on y apprend notamment à licencier en douceur , à 
        travailler son leadership, à maitriser ses émotions... De l\'autre côté on trouve des écrits dénonçant la
        souffrance au travail.');
        $show3->setIsBalise(false);
        $show3->setDistribution('mise en scène, Agnès Larroque ; avec Frédérique Moreau de Bellaing, 
        Laure Seguette et Chritian Scelles ; décors : Audrey Gonod');
        $show3->setMandatoryInfos('');
        $show3->setMapadoLink('');
        $show3->setPhotoCredits('');
        $show3->setTheater($t3);
        $show3->setOfferType(1);

        $manager->persist($show3);

        for ($j = 0; $j < mt_rand(5, 10); $j++) {
            $showDate1 = new ShowDate();
            $showDate1->setDateShow($faker->dateTimeBetween('now', '+ 2 weeks'));
            $showDate1->setShowId($show1);
            $manager->persist($showDate1);
            $showRate1 = new ShowRate();
            $showRate1->setDiscountedRate(2);
            $showRate1->setfreePlacesNumber(40);
            $showRate1->setShowDate($showDate1);
            $manager->persist($showRate1);
        }

        for ($j = 0; $j < mt_rand(4, 8); $j++) {
            $showDate2 = new ShowDate();
            $showDate2->setDateShow($faker->dateTimeBetween('now', '+ 2 weeks'));
            $showDate2->setShowId($show2);
            $manager->persist($showDate2);
            $showRate2 = new ShowRate();
            $showRate2->setDiscountedRate(2);
            $showRate2->setfreePlacesNumber(50);
            $showRate2->setShowDate($showDate2);
            $manager->persist($showRate2);
        }

        for ($j = 0; $j < mt_rand(8, 15); $j++) {
            $showDate3 = new ShowDate();
            $showDate3->setDateShow($faker->dateTimeBetween('now', '+ 2 weeks'));
            $showDate3->setShowId($show3);
            $manager->persist($showDate3);
            $showRate3 = new ShowRate();
            $showRate3->setDiscountedRate(1);
            $showRate3->setfreePlacesNumber(20);
            $showRate3->setShowDate($showDate3);
            $manager->persist($showRate3);
        }
        $manager->flush();
    }
}
