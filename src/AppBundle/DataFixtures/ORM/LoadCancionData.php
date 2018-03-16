<?php

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadCancionData implements ORMFixtureInterface
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__.'/fixtures.yml', $manager,
            [
                'providers' => [$this]
            ]);
    }

    public function codificaPassword($textoPlano)
    {
        return $this->userPasswordEncoder->encodePassword(new Usuario(), $textoPlano);
    }
}
