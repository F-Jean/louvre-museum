<?php

// src/AppBundle/Entity/Order.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * Order
 *
 * @ORM\Table(name="shop_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Shop_orderRepository")
 */
class Order
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="visit_day", type="datetime")
     * @Assert\DateTime()
     */
    private $visitDay;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="ticket_quantity", type="integer", nullable=true)
     */
    private $ticketQuantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ordered_at", type="datetime", nullable=true)
     */
    private $orderedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="num", type="integer", nullable=true)
     */
    private $num;

    /**
     * @var float
     *
     * @ORM\Column(name="total_price", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(
     *    message = "L'email '{{ value }}' n'est pas un email valide.",
     *    checkMX = true
     * )
     */
    private $email;

    /**
     * @var array
     * One Order has Many Tickets.
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="order", cascade={"persist"})
     * @Assert\Valid()
     * @Assert\Count(
     *    min=1,
     *    minMessage = "Vous devez remplir au moins 1 billet"
     *)
     */
    private $tickets;

    /**
     * Set id
     *
     * @param \int $id
     *
     * @return Order
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set visitDay
     *
     * @param \DateTime $visitDay
     *
     * @return Order
     */
    public function setVisitDay($visitDay)
    {
        $this->visitDay = $visitDay;

        return $this;
    }

    /**
     * Get visitDay
     *
     * @return \DateTime
     */
    public function getVisitDay()
    {
        return $this->visitDay;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload) {
      $visitDay = new \DateTime();

      $holidays = [
          \DateTime::createFromFormat("m-d H:i:s", "5-1 00:00:00"),
          \DateTime::createFromFormat("m-d H:i:s", "11-1 00:00:00"),
          \DateTime::createFromFormat("m-d H:i:s", "12-25 00:00:00")
      ];

      if(in_array($visitDay->format("N"), [2, 7]) || in_array($visitDay, $holidays)) {
          echo "pas de commande ce jour la";
      }else{
          echo "OK";
      }
    }

    /**
     * Set ticketQuantity
     *
     * @param integer $ticketQuantity
     *
     * @return Order
     */
    public function setTicketQuantity($ticketQuantity)
    {
        $this->ticketQuantity = $ticketQuantity;

        return $this;
    }

    /**
     * Get ticketQuantity
     *
     * @return integer
     */
    public function getTicketQuantity()
    {
        return $this->ticketQuantity;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Order
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set ordered_at
     *
     * @param \DateTime $ordered_at
     *
     * @return Order
     */
    public function setOrderedAt($orderedAt)
    {
        $this->orderedAt = $orderedAt;

        return $this;
    }

    /**
     * Get ordered_at
     *
     * @return \DateTime
     */
    public function getOrderedAt()
    {
        return $this->orderedAt;
    }

    /**
     * Set num
     *
     * @param integer $num
     *
     * @return Order
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return int
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set total_price
     *
     * @param float $total_price
     *
     * @return Order
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get total_price
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Order
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tickets
     *
     * @param array $tickets
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Get tickets
     *
     * @return array
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->visitDay = new \Datetime();
    }

    /**
     * Add ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     *
     * @return Order
     */
    public function addTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\AppBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }
}
