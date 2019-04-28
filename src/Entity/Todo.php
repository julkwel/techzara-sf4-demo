<?php
/**
 * @Author Rajerison Julien <julienrajerison5@gmail.com>
 * @Description Demo Todo Techzara du 27 - 04 - 2019
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 */
class Todo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $todo_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $todo_description;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(referencedColumnName="id",nullable=true)
     */
    private $todo_user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $todo_date_deb;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $todo_date_fin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $todo_date_fin_exact;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":0})
     */
    private $todo_is_fin;

    /**
     * Todo constructor.
     */
    public function __construct()
    {
        $this->todo_is_fin = 0;
    }

    /**
     * @var
     * @ORM\Column(type="string",nullable=true)
     */
    private $todo_status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTodoName(): ?string
    {
        return $this->todo_name;
    }

    public function setTodoName(string $todo_name): self
    {
        $this->todo_name = $todo_name;

        return $this;
    }

    public function getTodoDescription(): ?string
    {
        return $this->todo_description;
    }

    public function setTodoDescription(?string $todo_description): self
    {
        $this->todo_description = $todo_description;

        return $this;
    }

    public function getTodoDateDeb(): ?\DateTimeInterface
    {
        return $this->todo_date_deb;
    }

    public function setTodoDateDeb(?\DateTimeInterface $todo_date_deb): self
    {
        $this->todo_date_deb = $todo_date_deb;

        return $this;
    }

    public function getTodoIsFin(): ?bool
    {
        return $this->todo_is_fin;
    }

    public function setTodoIsFin(?bool $todo_is_fin): self
    {
        $this->todo_is_fin = $todo_is_fin;

        return $this;
    }

    public function getTodoDateFin(): ?\DateTimeInterface
    {
        return $this->todo_date_fin;
    }

    public function setTodoDateFin(?\DateTimeInterface $todo_date_fin): self
    {
        $this->todo_date_fin = $todo_date_fin;

        return $this;
    }

    public function getTodoStatus(): ?string
    {
        return $this->todo_status;
    }

    public function setTodoStatus(?string $todo_status): self
    {
        $this->todo_status = $todo_status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTodoDateFinExact()
    {
        return $this->todo_date_fin_exact;
    }

    /**
     * @param mixed $todo_date_fin_exact
     */
    public function setTodoDateFinExact($todo_date_fin_exact): void
    {
        $this->todo_date_fin_exact = $todo_date_fin_exact;
    }

    /**
     * @return mixed
     */
    public function getTodoUser()
    {
        return $this->todo_user;
    }

    /**
     * @param mixed $todo_user
     */
    public function setTodoUser($todo_user)
    {
        $this->todo_user = $todo_user;
    }
}
