<?php

namespace AppBundle\Manager;
use AppBundle\Entity\Car;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 06/11/2016
 * Time: 21:36
 */
class CarManager
{
    /**
     * Doctrine entity manager
     * @var EntityManager
     */
    private $manager;

    /**
     * ManageChannel constructor.
     *
     * @param ManagerRegistry       $doctrine   Symfony manager registery
     */
    public function __construct(
        ManagerRegistry $doctrine
    ) {
        $this->manager = $doctrine->getManager();
    } // __construct

    /**
     * The cars list
     *
     * @return array
     */
    public function getList()
    {
        // ==== Initialisation ====
        $cars = $this->manager->getRepository('AppBundle:Car')
            ->findAll();
        $data = [
            'cars' => [],
            '_links' => [
                'new_car'      => '/v1/creates/cars',
            ],
        ];

        /** @var Car $car */
        foreach ($cars as $car) {
            $data['cars'][] = [
                'id'            => $car->getId(),
                'maker'         => $car->getMaker(),
                'model'         => $car->getModel(),
                'price'         => $car->getPrice(),
                'options'       => $car->getOptions(),
                'equipments'    => $car->getEquipments(),
            ];
        }

        return $data;
    }
}