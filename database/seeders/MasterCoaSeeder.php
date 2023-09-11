<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MasterCoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code_name' => 100,
                'account_name' => 'Aset',
                'parent_id' => null,
            ],
            [
                'code_name' => 200,
                'account_name' => 'Utang',
                'parent_id' => null,
            ],
            [
                'code_name' => 300,
                'account_name' => 'Piutang',
                'parent_id' => null,
            ],
            [
                'code_name' => 400,
                'account_name' => 'Pendapatan',
                'parent_id' => null,
            ],
            [
                'code_name' => 500,
                'account_name' => 'Beban',
                'parent_id' => null,
            ],
            [
                'code_name' => 110,
                'account_name' => 'Aset Lancar',
                'parent_id' => 1,
            ],
            [
                'code_name' => 120,
                'account_name' => 'Aset Tetap',
                'parent_id' => 1,
            ],
            [
                'code_name' => 510,
                'account_name' => 'Beban Operasional',
                'parent_id' => 5,
            ],
            [
                'code_name' => 520,
                'account_name' => 'Beban Tenaga Kerja',
                'parent_id' => 5,
            ],
            [
                'code_name' => 530,
                'account_name' => 'Overhead Pabrik',
                'parent_id' => 5,
            ],
        ];

        foreach ($data as $coa) {
            DB::table('accounts')->insert([
                'code_name' => $coa['code_name'],
                'account_name' => $coa['account_name'],
                'parent_id' => $coa['parent_id'],
            ]);
        }
    }
    }

