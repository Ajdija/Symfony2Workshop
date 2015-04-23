<?php
namespace Acme\ImageBundle\Tests\Controller;

use Acme\ImageBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageValidationTest extends WebTestCase
{
    public function setUp()
    {
        static::$kernel = static::createKernel();
        self::$kernel->boot();
    }

    public function testImageValidation()
    {
        $image = new Image();
        $validator = self::$kernel->getContainer()->get('validator');

        $image->setName("Prawodlowa nazwa");
        $image->setDescription("Prawidlowe description");
        $image->setImageUrl("http://www.google.pl/logos/doodles/2015/earth-day-2015-5638584300208128.3-hp.gif");
        $errors = $validator->validate($image, null, ['registration']);
        $this->assertCount(0, $errors, "Mialo byc 0 bledow");
    }
}