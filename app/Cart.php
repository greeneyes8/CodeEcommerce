<?php

namespace CodeCommerce;

class Cart {

    private $itens;

    public function __construct()
    {
        $this->itens = [];
    }

    public function add($id, $name, $price)
    {
        $this->itens += [
            $id => [
                'qtd'   => (isset($this->itens[$id])) ? $this->itens[$id]['qtd']++ : 1,
                'price' => $price,
                'name'  => $name,
            ]
        ];

        return $this->itens;
    }

    public function update($id, $qtd)
    {
        $this->itens[$id]['qtd'] = $qtd;

        return $this->itens;
    }

    public function remove($id)
    {
        unset($this->itens[$id]);
    }

    public function all()
    {
        return $this->itens;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->itens as $item)
        {
            $total += $item['qtd'] * $item['price'];
        }

        return $total;
    }

}