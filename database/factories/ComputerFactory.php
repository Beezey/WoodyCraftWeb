<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this -> faker -> word ,
            'categrie'=> $this -> faker -> word ,
            'description '=> $this -> faker -> sentence ,
            'prix'=> $this -> faker -> randomFloat (2 , 1 , 100) ,
            'image '=> $this -> faker -> imageUrl (640 , 480 , 'puzzle ', true ) ,
        ];
    }
}
