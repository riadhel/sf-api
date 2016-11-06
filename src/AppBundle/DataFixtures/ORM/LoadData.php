<?php

/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 06/11/2016
 * Time: 21:14
 */

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Car;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 *
USAGE:
bin/console doctrine:fixtures:load -n --env=dev
 *
 * Class LoadData
 * @package AppBundle\DataFixtures\ORM
 */
class LoadData extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $car = new Car();
            $car
                ->setMaker($data['maker'])
                ->setModel($data['model'])
                ->setPrice($data['price'])
                ->setEquipments($data['equipments'])
                ->setOptions($data['options']);
            $manager->persist($car);
            $this->addReference($data['reference'], $car);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getData()
    {
        return [
            1 => ['maker' => 'peugeot', 'model' => '307', 'price' => '12530', 'equipments' => ['clim', 'radio'], 'options' => ['vitres tintées', 'couleur métalisées'], 'reference' => 'content-1'],
            2 => ['maker' => 'renault', 'model' => 'clio', 'price' => '11950', 'equipments' => ['clim', 'radio'], 'options' => ['vitres tintées', 'couleur métalisées'],  'reference' => 'content-2'],
            3 => ['maker' => 'renault', 'model' => 'megane', 'price' => '16330', 'equipments' => ['clim', 'radio'], 'options' => ['vitres tintées', 'couleur métalisées'],  'reference' => 'content-3'],
            4 => ['maker' => 'fiat', 'model' => '500', 'price' => '13500', 'equipments' => ['clim', 'radio'], 'options' => ['vitres tintées', 'couleur métalisées'],  'reference' => 'content-4'],
        ];
    }
}
