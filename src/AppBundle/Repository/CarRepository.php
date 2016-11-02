<?php

/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 25/10/2016
 * Time: 22:24
 */
namespace AppBundle\Repository;
use AppBundle\Entity\Car;
use Doctrine\ORM\EntityRepository;

class CarRepository extends EntityRepository
{
    public function delete($id) {
        /** @var Car $car */
        $car = $this->findOneBy(['id' => $id]);
        if($car !== null) {
            $this->_em->remove($car);
            $this->_em->flush();
            return 'Data deleted correctly!';
        } else {
            return 'Object not found!';
        }
    }

    public function complete($id,$newPrice)
    {
        /** @var Car $car */
        $car = $this->find($id);
        if($car !== null) {
            $car->setPrice($newPrice);
            $this->_em->persist($car);
            $this->_em->flush();
            return 'Price udated correctly!';
        } else {
            return 'Object not found!';
        }
    }
}