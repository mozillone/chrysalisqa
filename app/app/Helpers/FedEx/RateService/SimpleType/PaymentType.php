<?php
namespace App\Helpers\FedEx\RateService\SimpleType;

use App\Helpers\FedEx\AbstractSimpleType;

/**
 * Identifies the method of payment for a service.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Rate Service
 */
class PaymentType
    extends AbstractSimpleType
{
    const _SENDER = 'SENDER';
}