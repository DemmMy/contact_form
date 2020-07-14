<?php

namespace App\Entity;

use App\Repository\DemandesRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=DemandesRepository::class)
 */
class Demandes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Email(
     *     message = "Le format de l'email n'est pas valide."
     * )
     */

    private $email;


    /**
     * @ORM\Column(type="text", length=255)
     */
    private $details;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question): void
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }




    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $lu =false;

    /**
     * @return mixed
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom():?string
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail():?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isLu(): bool
    {
        return $this->lu;
    }

    /**
     * @param bool $lu
     */
    public function setLu(bool $lu): void
    {
        $this->lu = $lu;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getSlug() : string {
        $slugify = (new Slugify())->slugify($this->nom);
        return $slugify;
    }


}
