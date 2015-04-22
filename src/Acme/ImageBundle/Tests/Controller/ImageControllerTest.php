<?php

namespace Acme\ImageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/image/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /image/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'acme_imagebundle_image[name]' => 'Test',
            'acme_imagebundle_image[description]' => 'Description',
            'acme_imagebundle_image[imageUrl]' => 'http://www.google.pl/intl/en_ALL/images/srpr/logo11w.png',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'acme_imagebundle_image[name]' => 'Test Updated',
            'acme_imagebundle_image[description]' => 'Description',
            'acme_imagebundle_image[imageUrl]' => 'http://www.google.pl/intl/en_ALL/images/srpr/logo11w.png',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Test Updated"
        $this->assertGreaterThan(0, $crawler->filter('[value="Test Updated"]')->count(), 'Missing element [value="Test Updated"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Test Updated/', $client->getResponse()->getContent());
    }
}
