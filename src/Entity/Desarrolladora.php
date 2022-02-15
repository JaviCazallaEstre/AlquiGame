<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DesarrolladoraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesarrolladoraRepository::class)]
#[ApiResource]
class Desarrolladora
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\OneToMany(mappedBy: 'desarrolladora', targetEntity: Juego::class)]
    private $juegos;

    public function __construct()
    {
        $this->juegos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Juego[]
     */
    public function getJuegos(): Collection
    {
        return $this->juegos;
    }

    public function addJuego(Juego $juego): self
    {
        if (!$this->juegos->contains($juego)) {
            $this->juegos[] = $juego;
            $juego->setDesarrolladora($this);
        }

        return $this;
    }

    public function removeJuego(Juego $juego): self
    {
        if ($this->juegos->removeElement($juego)) {
            // set the owning side to null (unless already changed)
            if ($juego->getDesarrolladora() === $this) {
                $juego->setDesarrolladora(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nombre;
    }
}
