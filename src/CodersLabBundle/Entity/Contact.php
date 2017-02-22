<?php

namespace CodersLabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collection\ArrayCollection;
/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="CodersLabBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="contact")
     */
    
     private $addresses;
     

     
    /**
     * @ORM\OneToMany(targetEntity="Email", mappedBy="contact")
     */
    
     private $emails;
    // ...
     
    /**
     * @ORM\OneToMany(targetEntity="PhoneNumber", mappedBy="contact")
     */
    
     private $phoneNumbers;
    // ...


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


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
     * @return Contact
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
     * Set surname
     *
     * @param string $surname
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contact
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
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phoneNumbers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add addresses
     *
     * @param \CodersLabBundle\Entity\Address $addresses
     * @return Contact
     */
    public function addAddress(\CodersLabBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;

        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \CodersLabBundle\Entity\Address $addresses
     */
    public function removeAddress(\CodersLabBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add emails
     *
     * @param \CodersLabBundle\Entity\Email $emails
     * @return Contact
     */
    public function addEmail(\CodersLabBundle\Entity\Email $emails)
    {
        $this->emails[] = $emails;

        return $this;
    }

    /**
     * Remove emails
     *
     * @param \CodersLabBundle\Entity\Email $emails
     */
    public function removeEmail(\CodersLabBundle\Entity\Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add phoneNumbers
     *
     * @param \CodersLabBundle\Entity\PhoneNumber $phoneNumbers
     * @return Contact
     */
    public function addPhoneNumber(\CodersLabBundle\Entity\PhoneNumber $phoneNumbers)
    {
        $this->phoneNumbers[] = $phoneNumbers;

        return $this;
    }

    /**
     * Remove phoneNumbers
     *
     * @param \CodersLabBundle\Entity\PhoneNumber $phoneNumbers
     */
    public function removePhoneNumber(\CodersLabBundle\Entity\PhoneNumber $phoneNumbers)
    {
        $this->phoneNumbers->removeElement($phoneNumbers);
    }

    /**
     * Get phoneNumbers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }
    public function getNameAndSurname(){
        
        return $this->getName().' '.$this->getSurname();
    }
}
