<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user=new User();
        $user->setUsername('demo')
             ->setEmail('demo@gmail.com')
             ->setPassword($this->encoder->encodePassword($user, 'demo'));
        // $product = new Product();
        $manager->persist($user);

        $manager->flush();
    }
}
