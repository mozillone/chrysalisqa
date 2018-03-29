<?php
namespace App\Helpers\FedEx\RateService\SimpleType;

use App\Helpers\FedEx\AbstractSimpleType;
/**
 * CM = centimeters, IN = inches
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Rate Service
 */
class LinearUnits
    extends AbstractSimpleType
{
    const _CM = 'CM';
    const _IN = 'IN';
}