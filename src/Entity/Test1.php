<?php

namespace App\Entity;

use App\Repository\Test1Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Test1Repository::class)]
class Test1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $test1 = null;

    #[ORM\OneToMany(mappedBy: 'test1', targetEntity: Test2::class, orphanRemoval: true)]
    private Collection $test2s;

    public function __construct()
    {
        $this->test2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTest1(): ?string
    {
        return $this->test1;
    }

    public function setTest1(string $test1): self
    {
        $this->test1 = $test1;

        return $this;
    }

    /**
     * @return Collection<int, Test2>
     */
    public function getTest2s(): Collection
    {
        return $this->test2s;
    }

    public function addTest2(Test2 $test2): self
    {
        if (!$this->test2s->contains($test2)) {
            $this->test2s->add($test2);
            $test2->setTest1($this);
        }

        return $this;
    }

    public function removeTest2(Test2 $test2): self
    {
        if ($this->test2s->removeElement($test2)) {
            // set the owning side to null (unless already changed)
            if ($test2->getTest1() === $this) {
                $test2->setTest1(null);
            }
        }

        return $this;
    }
}
