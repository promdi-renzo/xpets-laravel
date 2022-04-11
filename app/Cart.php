<?php

namespace App;

class Cart
{
    public $services = null;
    public $totalCost = 0;
    public $pets = null;

    public function __construct($oldService)
    {

        if ($oldService) {
            $this->services = $oldService->services;
            $this->pets = $oldService->pets;
            $this->totalCost = $oldService->totalCost;
        }
    }

    public function add($services, $id)
    {
        $addService = ['cost' => $services->cost, 'services' => $services];
        if ($this->services) {
            if (array_key_exists($id, $this->services)) {

                $addService = array_unique($id);
            }
        }

        $addService['cost'] = $services->cost;
        $this->services[$id] = $addService;
        $this->totalCost += $services->cost;
    }

    public function addAnimal($pets, $id)
    {
        $addAnimal = ['name' => $pets->animal_name, 'pets' => $pets];
        if ($this->pets) {
            if (array_key_exists($id, $this->pets)) {

                $addAnimal = array_unique($id);
            }
        }
        $this->pets[$id] = $addAnimal;
    }

    public function removeService($id)
    {
        $this->totalCost -= $this->services[$id]['cost'];
        unset($this->services[$id]);
        unset($this->pets[$id]);
    }
}
