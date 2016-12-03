<?php

namespace Payzen\Base;

class StoreBase
{
    public function asArray() {
        $data = array();

        foreach (get_object_vars($this) as $key => $value) {
            if (!is_null($value)) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}