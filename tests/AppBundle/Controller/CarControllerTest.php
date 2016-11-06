<?php
/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 25/10/2016
 * Time: 22:10
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarControllerTest extends WebTestCase
{
    public function testGETCarsList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/v1/list/cars');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        $decoded = json_decode($content, true);
        $this->assertEquals(count($decoded), 2);
        foreach ($decoded['cars'] as $car) {
            $this->assertTrue(isset($car['maker']));
            $this->assertTrue(isset($car['model']));
            $this->assertTrue(isset($car['price']));
        }
    }

    public function testPOSTCar()
    {
        $client = static::createClient();
        $data = array(
            'maker' => 'nissan',
            'model' => 'juke',
            'price' => '14000',
            'equipments' => ['clim', 'auoradio'],
            'options' => ['vitres tintées', 'couleur métalisée'],
        );
        $crawler = $client->request('POST', '/v1/creates/cars', $data);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(
            'Car data saved correctly',
            $client->getResponse()->getContent()
        );
    }

    public function testPUTCar()
    {
        $client = static::createClient();
        $data = array(
            'maker' => 'peugeot',
            'model' => '308',
            'price' => '14000',
            'equipments' => ['clim', 'auoradio'],
            'options' => ['vitres tintées', 'couleur métalisée'],
        );
        $crawler = $client->request('PUT', '/v1/edits/1/car', $data);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(
            'Car data modified correctly',
            $client->getResponse()->getContent()
        );
    }

    public function testDELETECar()
    {
        $client = static::createClient();

        $crawler = $client->request('DELETE', '/v1/removes/2/car');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(
            'Data deleted correctly',
            $client->getResponse()->getContent()
        );
    }

    public function testPATCHCar()
    {
        $client = static::createClient();

        $crawler = $client->request('PATCH', '/v1/cars/4/prices/13450/update');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(
            'Price updated correctly',
            $client->getResponse()->getContent()
        );

        $crawler = $client->request('PATCH', '/v1/cars/15/prices/13450/update');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(
            'Object not found',
            $client->getResponse()->getContent()
        );
    }
}