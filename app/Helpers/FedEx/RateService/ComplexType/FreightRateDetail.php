<?php
namespace FedEx\RateService\ComplexType;

use FedEx\AbstractComplexType;

/**
 * Rate data specific to FedEx Freight or FedEx National Freight services.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Rate Service
 */
class FreightRateDetail
    extends AbstractComplexType
{

    /**
     * Name of this complex type
     * 
     * @var string
     */
    protected $_name = 'FreightRateDetail';

    /**
     * A unique identifier for a specific rate quotation.
     *
     * @param string $quoteNumber
     * return FreightRateDetail
     */
    public function setQuoteNumber($quoteNumber)
    {
        $this->QuoteNumber = $quoteNumber;
        return $this;
    }
    
    /**
     * Specifies how total base charge is determined.
     *
     * @param \FedEx\RateService\SimpleType\FreightBaseChargeCalculationType|string $baseChargeCalculation
     * return FreightRateDetail
     */
    public function setBaseChargeCalculation($baseChargeCalculation)
    {
        $this->BaseChargeCalculation = $baseChargeCalculation;
        return $this;
    }
    
    /**
     * Freight charges which accumulate to the total base charge for the shipment.
     *
     * @param FreightBaseCharge[] $baseCharges
     * return FreightRateDetail
     */
    public function setBaseCharges(array $baseCharges)
    {
        $this->BaseCharges = $baseCharges;
        return $this;
    }
    
    /**
     * Human-readable descriptions of additional information on this shipment rating.
     *
     * @param FreightRateNotation[] $notations
     * return FreightRateDetail
     */
    public function setNotations(array $notations)
    {
        $this->Notations = $notations;
        return $this;
    }
    

    
}