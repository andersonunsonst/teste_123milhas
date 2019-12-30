<?php

 class estacionamento{


 	private $carro;
 	private $motorista;
 	private $placa;
 	private $dataHora;
 	private $valorHora;

 	public function __construct(
 		string $carro,
 		string $motorista,
 		string $placa,
 		DateTime $dataHora,
 		float $valorHora;
 		)
 	{
 		$this->carro = $carro;
 		$this->motorista = $motorista;
 		$this->placa = $placa;
 		$this->dataHora = $dataHora->format('d-m-Y H:i:s');
 		$this->valorHora = $valorHora;

 	}


 	public function getMotorista() {

 		return $this->motorista;
 	}

 	public function getCarro() {

 		return $this->carro; 
 	}

 	public function getPlaca() {

 		return $this->placa;
 	}

 	public function getDataHora() {

 		return $this->dataHora;
 	}

 	public function getValorHora(){

 		return $this->valorHora;
 	}

 	public function getMinutosEstacionado(){

 		$dataHoraAgora = new DateTime('now');
 		$intervalo = $this->dataHora->diff($dataHoraAgora); 
 		return $intervalo->format("%H:%I:%S");
 	}


 	public function getValoraPagar(){
 		return $this->getHorasEstacionado() * $this->getValorHora();
 	}



 }
?>