<?php

/**
 * Created by IntelliJ IDEA.
 * User: riad
 * Date: 25/10/2016
 * Time: 22:51
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity()
 * @ORM\Table(name="equipment")
 */
class Equipment
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * Encapsulation (private field)
     */
    private $id;
    /**
     * @ORM\Column(name="name", type="string", nullable=false, length=255)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
