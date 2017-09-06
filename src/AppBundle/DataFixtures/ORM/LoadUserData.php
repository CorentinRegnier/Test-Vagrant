<?php

/*
 * This file is part of the TestVagrant Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var array
     */
    private $firstNames = ['Elyass', 'Clément', 'Mathieu', 'Thibault', 'David', 'Cédric', 'Yasmina', 'Jean-noël'];

    /**
     * @var array
     */
    private $lastNames = ['Messi', 'Ronaldo', 'Ozil', 'Ibrahimovic', 'LLoris', 'Balotelli', 'Rooney', 'Pogba'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $superAdmin = new User();
        $superAdmin
            ->setFirstName($this->firstNames[rand(0, 7)])
            ->setLastName($this->lastNames[rand(0, 7)])
            ->setPlainPassword('xxx')
            ->setUsername('admin')
            ->setEmail('admin@gmail.com')
            ->addRole('ROLE_SUPER_ADMIN')
            ->setEnabled(true);

        $manager->persist($superAdmin);
        $this->addReference('super-admin', $superAdmin);

        for ($i = 11; $i <= 20; $i++) {
            $user = new User();
            $user
                ->setFirstName($this->firstNames[rand(0, 7)])
                ->setLastName($this->lastNames[rand(0, 7)])
                ->setPlainPassword('xxx')
                ->setUsername('user'.$i)
                ->setEmail('user'.$i.'@gmail.com')
                ->addRole('ROLE_ADMIN')
                ->setEnabled(true);
            $manager->persist($user);
            $this->setReference('user-'.$i, $user);
        }

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user
                ->setFirstName($this->firstNames[rand(0, 7)])
                ->setLastName($this->lastNames[rand(0, 7)])
                ->setPlainPassword('xxx')
                ->setUsername('user'.$i)
                ->setEmail('user'.$i.'@gmail.com')
                ->setEnabled(true);
            $manager->persist($user);
            $this->setReference('user-'.$i, $user);
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
