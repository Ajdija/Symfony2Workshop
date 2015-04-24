<?php
/**
 * Created by PhpStorm.
 * User: coderslabworkshop
 * Date: 24.04.2015
 * Time: 16:51
 */

namespace Acme\ImageBundle\DataFixtures\ORM;

use Acme\ImageBundle\Entity\Image;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadImageData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setName('Nazwa obrazka z fixtury');
        $image->setDescription('Opis z fixtury');
        $image->setActive(true);
        $image->setImageUrl('http://www.google.pl/logos/doodles/2015/earth-day-2015-5638584300208128.3-hp.gif');

        $manager->persist($image);
        $manager->flush();
    }
}
