<?php

class Flight {

    private $flightNumber;
    private $cia;
    private $departureAirport;
    private $arrivalAirport;
    private $departureTime;
    private $arrivalTime;
    private $valorTotal;

    public function __construct(
        string $flightNumber,
        string $cia,
        string $departureAirport,
        string $arrivalAirport,
        DateTime $departureTime,
        DateTime $arrivalTime,
        float $valorTotal,
        string $baggage,
        float $baggagePrice,
        string $liveLoad,
        string $liveLoadPrice
    )
    {
        $this->flightNumber = $flightNumber;
        $this->cia = $cia;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
        $this->departureTime = $departureTime;
        $this->arrivalTime = $arrivalTime;
        $this->valorTotal = $valorTotal;
        $this->baggage = $baggage;
        $this->baggagePrice = $baggagePrice;
        $this->liveLoad = $liveLoad;
        $this->liveLoadPrice = $liveLoadPrice;

    }

    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    public function getCia()
    {
        return $this->cia;
    }

    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    public function getArrivalAirport()
    {
        return $this->arrivalAirport;
    }

    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    public function getBaggage(){
        return $this->baggage;
    }

    public function getLiveload(){
        return $this->liveLoad;
    }


    public function getBaggagePrice(){
        return $this->baggagePrice;
    }


    public function getLiveloadPrice(){
        return $this->liveLoadPrice;
    }
}


class Checkout
{
    private $flightOutbound;
    private $flightInbound;

    public function __construct(Flight $flightOutbound, Flight $flightInbound = null)
    {
        $this->flightOutbound = $flightOutbound;
        $this->flightInbound = $flightInbound;
    }

    public function generateExtract()
    {
        $valorTotal = $this->flightOutbound->getValorTotal();
        $flightDetailsOutbound = [
            'De' => $this->flightOutbound->getDepartureAirport(),
            'Para' => $this->flightOutbound->getArrivalAirport(),
            'Embarque' => $this->flightOutbound->getDepartureTime()->format('d/m/Y H:i'),
            'Desembarque' => $this->flightOutbound->getArrivalTime()->format('d/m/Y H:i'),
            'Cia' => $this->flightOutbound->getCia(),
            'Bagagem' => $this->flightOutbound->getBaggage(),
            'Preço da Bagagem' => $this->flightOutbound->getBaggagePrice(),
            'Carga Viva' => $this->flightOutbound->getLiveload(),
            'Preço da Carga' => $this->flightOutbound->getLiveloadPrice(),
            'Valor' => $this->flightOutbound->getValorTotal(),
        ];

        $flightDetailsInbound = [];
        if (! is_null($this->flightInbound)) {
            $valorTotal += $this->flightInbound->getValorTotal();
            $valorTotal += $this->flightInbound->getBaggagePrice();
            $valorTotal += $this->flightInbound->getLiveloadPrice(); 
            $valorTotal += $this->flightOutbound->getBaggagePrice();
            $valorTotal += $this->flightOutbound->getLiveloadPrice(); 
            $flightDetailsInbound = [
                'De' => $this->flightInbound->getDepartureAirport(),
                'Para' => $this->flightInbound->getArrivalAirport(),
                'Embarque' => $this->flightInbound->getDepartureTime()->format('d/m/Y H:i'),
                'Desembarque' => $this->flightInbound->getArrivalTime()->format('d/m/Y H:i'),
                'Cia' => $this->flightInbound->getCia(),
                'Bagagem' => $this->flightInbound->getBaggage(),
                'Preço da Bagagem' => $this->flightInbound->getBaggagePrice(),
                'Carga Viva' => $this->flightInbound->getLiveload(),
                'Preço da Carga' => $this->flightInbound->getLiveloadPrice(),
                'Valor' => $this->flightInbound->getValorTotal(),
            ];
        }

        return (object) [
            'flightOutbound' => $flightDetailsOutbound,
            'flightInbound' => $flightDetailsInbound,
            'valorTotal' => $valorTotal
        ];
    }
}


$partida = new DateTime('now');
$chegada = new DateTime('now');
$vooIda = new Flight('voo do amor', 'cia unsonst', 'guarulhos', 'pampulha', $partida, $chegada, 200.0, 'caixa',20.0, 'Pug', 200.0);
$vooVolta = new Flight('voo do amor 2', 'cia unsonst', 'bahia', 'pampulha', $partida, $chegada, 120.0, 'caixa',20.0, 'Vaca', 4000.0);
$check = new Checkout($vooIda, $vooVolta);

echo '<pre>';
print_r($check->generateExtract());