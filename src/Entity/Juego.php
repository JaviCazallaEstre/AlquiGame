<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\JuegoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 *
 * @Vich\Uploadable()
 */
#[ORM\Entity(repositoryClass: JuegoRepository::class)]
#[ApiResource]
class Juego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\Column(type: 'float')]
    private $precio;

    #[ORM\Column(type: 'string', length: 255)]
    private $foto;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $video;

    /**
     * @Vich\UploadableField(mapping="product_videos", fileNameProperty="video")
     *
     * @Assert\File(
     *      mimeTypes = {"video/mp4"},
     *      mimeTypesMessage = "El archivo debe de ser vídeo MP4",
     *      maxSize = "30M",
     *      maxSizeMessage = "El máximo de peso del archivo no puede superer los 30MB"
     * )
     * 
     * @var File
     */
    private $videoFile;

    #[ORM\ManyToOne(targetEntity: Desarrolladora::class, inversedBy: 'juegos')]
    #[ORM\JoinColumn(nullable: false)]
    private $desarrolladora;

    #[ORM\ManyToOne(targetEntity: Plataforma::class, inversedBy: 'juegos')]
    #[ORM\JoinColumn(nullable: false)]
    private $plataforma;

    #[ORM\ManyToOne(targetEntity: RangoEdad::class, inversedBy: 'juegos')]
    #[ORM\JoinColumn(nullable: false)]
    private $RangoEdad;

    #[ORM\OneToMany(mappedBy: 'juego', targetEntity: Reservas::class)]
    private $reservas;

    #[ORM\ManyToMany(targetEntity: Genero::class, inversedBy: 'juegos')]
    private $generos;

    #[ORM\Column(type: 'datetime')]
    private $actualizado;


    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->generos = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getActualizado(): ?DateTime
    {
        return $this->actualizado;
    }

    public function setActualizado(DateTime $actualizado): self
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getDesarrolladora(): ?desarrolladora
    {
        return $this->desarrolladora;
    }

    public function setDesarrolladora(?desarrolladora $desarrolladora): self
    {
        $this->desarrolladora = $desarrolladora;

        return $this;
    }

    public function getPlataforma(): ?plataforma
    {
        return $this->plataforma;
    }

    public function setPlataforma(?plataforma $plataforma): self
    {
        $this->plataforma = $plataforma;

        return $this;
    }

    public function getRangoEdad(): ?rangoedad
    {
        return $this->RangoEdad;
    }

    public function setRangoEdad(?rangoedad $RangoEdad): self
    {
        $this->RangoEdad = $RangoEdad;

        return $this;
    }

    public function getVideoFile(){
        return $this->videoFile;
    }

    public function setVideoFile(File $videoFile = null)
    {
        $this->videoFile = $videoFile;

        if ($videoFile) {
            $this->actualizado = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return Collection|Reservas[]
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reservas $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setJuego($this);
        }

        return $this;
    }

    public function removeReserva(Reservas $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getJuego() === $this) {
                $reserva->setJuego(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * @return Collection|Genero[]
     */
    public function getGeneros(): Collection
    {
        return $this->generos;
    }

    public function addGenero(Genero $genero): self
    {
        if (!$this->generos->contains($genero)) {
            $this->generos[] = $genero;
        }

        return $this;
    }

    public function removeGenero(Genero $genero): self
    {
        $this->generos->removeElement($genero);

        return $this;
    }
}
