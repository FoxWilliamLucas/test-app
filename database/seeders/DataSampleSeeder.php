<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Session;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $data = [
            'customers' => [
                [
                    'name' => 'Client One'
                ],
                [
                    'name' => 'Client Two'
                ]
            ],
            'users' => [
                [
                    'email'         => 'user1@mail.com',
                    'created'       => '2021-01-01',
                    'customer_id'   => '1',
                ],
                [
                    'email'         => 'user2@mail.com',
                    'created'       => '2021-01-01',
                    'customer_id'   => '1',
                ],
                [
                    'email'         => 'user3@mail.com',
                    'created'       => '2021-01-01',
                    'customer_id'   => '2',
                ],
                [
                    'email'         => 'user4@mail.com',
                    'created'       => '2021-01-15',
                    'customer_id'   => '1',
                ],
                [
                    'email'         => 'user5@mail.com',
                    'created'       => '2021-04-01',
                    'customer_id'   => '2',
                ],
                [
                    'email'         => 'user6@mail.com',
                    'created'       => '2021-05-01',
                    'customer_id'   => '2',
                ],
                [
                    'email'         => 'user7@mail.com',
                    'created'       => '2019-01-01',
                    'customer_id'   => '2',
                ],
                [
                    'email'         => 'user8@mail.com',
                    'created'       => '2021-03-03',
                    'customer_id'   => '1',
                ],    
                [
                    'email'         => 'user9@mail.com',
                    'created'       => '2020-12-22',
                    'customer_id'   => '1',
                ],
                [
                    'email'         => 'user10@mail.com',
                    'created'       => '2020-12-01',
                    'customer_id'   => '1',
                ]
            ],

            'sessions'  => [
                [
                    'user_id'       => '1',
                    'activated'     => null,
                    'appointment'   => '2021-01-22',
                ],
                [
                    'user_id'       => '2',
                    'activated'     => '2021-01-01',
                    'appointment'   => '2021-01-01',
                ],
                [
                    'user_id'       => '2',
                    'activated'     => '2021-02-01',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '4',
                    'activated'     => '2021-01-15',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '4',
                    'activated'     => '2021-01-16',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '4',
                    'activated'     => '2021-03-01',
                    'appointment'   => '2021-01-30',
                ],
                [
                    'user_id'       => '4',
                    'activated'     => null,
                    'appointment'   => '2021-01-30',
                ],
                [
                    'user_id'       => '8',
                    'activated'     => '2021-03-03',
                    'appointment'   => '2021-03-03',
                ],
                [
                    'user_id'       => '9',
                    'activated'     => null,
                    'appointment'   => '2020-12-22',
                ],
                [
                    'user_id'       => '10',
                    'activated'     => '2020-12-01',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '10',
                    'activated'     => '2020-12-02',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '10',
                    'activated'     => '2020-12-03',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '10',
                    'activated'     => null,
                    'appointment'   => '2021-01-04',
                ],
                [
                    'user_id'       => '3',
                    'activated'     => '2021-01-01',
                    'appointment'   => null,
                ],
                [
                    'user_id'       => '5',
                    'activated'     => null,
                    'appointment'   => '2021-04-01',
                ],
                [
                    'user_id'       => '5',
                    'activated'     => '2021-04-01',
                    'appointment'   => null,
                ],
            ]
        ];



        Customer::insert($data['customers']);
        User::insert($data['users']);
        Session::insert($data['sessions']);
    }
}
