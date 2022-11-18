<?php

namespace App\Entity;

use App\Repository\Test2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Test2Repository::class)]
class Test2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'test2s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Test1 $test1 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTest1(): ?Test1
    {
        return $this->test1;
    }

    public function setTest1(?Test1 $test1): self
    {
        $this->test1 = $test1;

        return $this;
    }
}
