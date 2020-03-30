<?php

use Illuminate\Database\Seeder;

class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $data = [
                ['title'=>'Demo Event1', 'start'=>'2020-01-05', 'end'=>'2020-01-15'],
                ['title'=>'Demo Event2', 'start'=>'2020-01-08', 'end'=>'2020-01-20'],
                ['title'=>'Demo Event3', 'start'=>'2020-01-15', 'end'=>'2020-01-19'],
                ['title'=>'Demo Event4', 'start'=>'2020-01-01', 'end'=>'2020-01-28']
        ];
        //loop through $data
        foreach ($data as $key => $value) {
            Event::create($value);
        }
    }
}
