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
            'acme_imagebundle_image[name]'  => 'Testowa nazwa',
            'acme_imagebundle_image[description]'  => 'Testowy opis',
            'acme_imagebundle_image[imageUrl]'  => 'http://www.google.pl/logos/doodles/2015/earth-day-2015-5638584300208128.3-hp.gif',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(
            0,
            $crawler->filter('td:contains("Testowa nazwa")')->count(),
            'Testowa nazwa nie istnieje: Encja nie została wyświetlona'
        );

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'acme_imagebundle_image[name]'  => 'Testowa nazwa edytowana',
            'acme_imagebundle_image[description]'  => 'Testowy opis edytowany',
            'acme_imagebundle_image[imageUrl]'  => 'http://www.google.pl/logos/doodles/2015/earth-day-2015-5638584300208128.3-hp.gif',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Testowa nazwa edytowana"]')->count(), 'Brak edytowanej encji');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Testowa nazwa edytowana/', $client->getResponse()->getContent());
    }
}
