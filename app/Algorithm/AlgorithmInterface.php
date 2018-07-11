<?php
/**
 * Created by PhpStorm.
 * User: riveng
 * Date: 2018. 07. 10.
 * Time: 18:39
 */

namespace Homework\Algorithm;


interface AlgorithmInterface
{
    public function generateNumber($partialValue): int;
}