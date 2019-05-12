<?php
/**
 * Created by PhpStorm.
 * User : Antoine
 * Date : 11/04/2019
 * Time : 16:07
 */

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;

trait Timestamp
{
    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * Set createdAt
     *
     * @param DateTimeInterface|null $date
     * @return self
     * @throws Exception
     */
    public function setCreatedAt(DateTimeInterface $date = null): self
    {
        $this->created_at = empty($date) ? new DateTime() : $date;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param DateTimeInterface|null $date
     * @return self
     * @throws Exception
     */
    public function setUpdatedAt(?DateTimeInterface $date = null): self
    {
        $this->created_at = $date;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }
}
