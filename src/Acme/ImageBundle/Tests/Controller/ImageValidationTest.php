<?php
/**
 * Created by PhpStorm.
 * User: coderslabworkshop
 * Date: 23.04.2015
 * Time: 00:01
 */

namespace Acme\ImageBundle\Tests\Controller;

use Acme\ImageBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ImageValidationTest extends WebTestCase
{
    public function setUp()
    {
        static::$kernel = static::createKernel();
        self::$kernel->boot();
    }

    public function testImageInvalidDataScenario()
    {
        $image = new Image();
        $validator = self::$kernel->getContainer()->get('validator');

        $errors = $validator->validate($image, null, ['registration']);
        $this->assertEquals(3, count($errors));

        $image->setImageUrl('https://www.google.pl/images/srpr/logo11w.png');
        $image->setDescription('Test Desc');
        $errors = $validator->validate($image, null, ['registration']);
        $this->assertEquals(1, count($errors));

        $image->setName("");
        $errors = $validator->validate($image, null, ['registration']);
        $this->assertEquals(1, count($errors));

        $image->setName("Coder's Lab");
        $errors = $validator->validate($image, null, ['edit']);
        $this->assertEquals(0, count($errors));

        $image->setName("Coder's Lab");
        $errors = $validator->validate($image, null, ['registration']);
        $this->assertEquals(1, count($errors));
    }
} 