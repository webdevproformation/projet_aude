<?php 

namespace App\Entity ;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping As ORM ; 

# https://www.doctrine-project.org/projects/doctrine-orm/en/3.3/reference/basic-mapping.html#basic-mapping

#[ORM\Entity()]
class Requete {

    #[ORM\Id]  // clé primaire
    #[ORM\GeneratedValue()] // AutoIncrement
    #[ORM\Column()]
    private ?int $id = null ;

    #[ORM\Column()]
          // le champ est OBLIGATOIRE sinon la bdd la refuse =>
        // et au maximum il ya 255 caractères 
        // DATETIME NOT NULL 
    private ?\DateTime $created_at = null ;

    #[ORM\Column()]
      // le champ est OBLIGATOIRE sinon la bdd la refuse =>
        // et au maximum il ya 255 caractères 
        // VARCHAR(255) NOT NULL 
    private ?string $type = null ;

    #[ORM\Column(nullable:true )] // accepte de créer des requetes sans deadline
                                  // dans la table tu acceptes que la valeur de ce champ soit NULL 
    private  ?\DateTime $deadline = null ;

    #[ORM\Column()] 
        // le champ est OBLIGATOIRE sinon la bdd la refuse =>
        // et au maximum il ya 255 caractères 
        // VARCHAR(255) NOT NULL 
    private ?string $title = null ;

    #[ORM\Column(nullable:true , type: 'text')]
                                 // le champ accepte la valeur null (par défaut) ET si il contient du texte il a pour valeur maximum 65 000 caractères 
    private ?string $description = null ;

    /**
     * @var Collection<int, Genre>
     */
    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'requetes')]
    private Collection $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addRequete($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeRequete($this);
        }

        return $this;
    } 
}