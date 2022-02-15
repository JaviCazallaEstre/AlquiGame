<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservasRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: ReservasRepository::class)]
#[ApiResource]
class Reservas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha_inicio;

    #[ORM\Column(type: 'date')]
    private $fecha_fin;

    #[ORM\Column(type: 'float')]
    private $precio;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fecha_devolucion;

    #[ORM\ManyToOne(targetEntity: Juego::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $juego;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getFechaDevolucion(): ?\DateTimeInterface
    {
        return $this->fecha_devolucion;
    }

    public function setFechaDevolucion(?\DateTimeInterface $fecha_devolucion): self
    {
        $this->fecha_devolucion = $fecha_devolucion;

        return $this;
    }

    public function getJuego(): ?Juego
    {
        return $this->juego;
    }

    public function setJuego(?Juego $juego): self
    {
        $this->juego = $juego;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
