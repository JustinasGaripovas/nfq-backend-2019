<?php


namespace App\Entity\Administration\Enum;



/**
 * @method static VisitationStatus NEW()
 * @method static VisitationStatus ACCEPTED()
 * @method static VisitationStatus FINISHED()
 */
class VisitationStatus extends Enum
{
    const NEW = 'new';
    const ACCEPTED = 'accepted';
    const FINISHED = 'finished';
}