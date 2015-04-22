<?php

namespace Acme\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Image
 * @UniqueEntity("name", groups={"edit"})
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @Assert\NotNull(groups={"edit"})
     * @var string
     */
    private $name;

    /**
     * @Assert\NotBlank(groups={"edit"})
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Description must be at least {{ limit }} characters long",
     *      maxMessage = "Description cannot be longer than {{ limit }} characters",
     *      groups = {"edit"}
     * )
     * @var string
     */
    private $description;

    /**
     * @Assert\Url(groups={"edit"})
     * @var string
     */
    private $imageUrl;

    /**
     * @Assert\True(message = "The name cannot contain 'Coder's Lab' ")
     * @return bool
     */
    public function hasNoCodersLab(){
        return strpos($this->name,"Coder's Lab") === false;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Image
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Image
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
}
