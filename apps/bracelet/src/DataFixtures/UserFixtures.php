<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';
    public const USER_REFERENCE = 'user';

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //Admin
        $userAdmin = new User();

        $passwordUserAdmin = $this->encoder->encodePassword($userAdmin, 'admin');
        $userAdmin
            ->setUsername('admin')
            ->setPassword($passwordUserAdmin)
            ->setEmail('antoine.nguyen3@epsi.com')
            ->setEmailCanonical('antoine.nguyen3@epsi..com')
            ->setSuperAdmin(true)
            ->setEnabled(true)
            ->setConfirmationToken(null)
            ->addRole('ROLE_ADMIN');
        $this->setReference(self::ADMIN_USER_REFERENCE, $userAdmin);

        $manager->persist($userAdmin);

        $user = new User();

        $passwordUser = $this->encoder->encodePassword($user, 'test');
        $user
            ->setUsername('test')
            ->setPassword($passwordUser)
            ->setEmail('test@gmail.com')
            ->setEmailCanonical('test@gmail.com')
            ->setSuperAdmin(false)
            ->setEnabled(true)
            ->setConfirmationToken(null)
            ->addRole('ROLE_MANAGER');
        $this->setReference(self::USER_REFERENCE, $user);

        $manager->persist($user);

        $manager->flush();
    }
}
