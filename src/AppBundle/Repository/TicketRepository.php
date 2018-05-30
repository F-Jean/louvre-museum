<?php

namespace AppBundle\Repository;

/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends \Doctrine\ORM\EntityRepository
{
  countTicketByVisitDay(datime $visitDay) {
    return $this->createQueryBuilder("ticket")
      ->select("COUNT(ticket.id)")
      ->join("ticket.order", "order")
      ->where("order.visitDay = :visitDay")
      ->setParameter("visitDay", $visitDay)
      ->getQuery()
      ->getSingleScalarResult();
  }
}
