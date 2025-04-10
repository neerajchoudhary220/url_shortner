<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompnaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $companies = [
                [
                    'name' => 'Apple Inc.',
                    'domain' => 'apple.com'
                ],
                [
                    'name' => 'Google (Alphabet Inc.)',
                    'domain' => 'google.com'
                ],
                [
                    'name' => 'Microsoft Corporation',
                    'domain' => 'microsoft.com'
                ],
                [
                    'name' => 'Amazon.com, Inc.',
                    'domain' => 'amazon.com'
                ],
                [
                    'name' => 'Meta Platforms, Inc. (Facebook)',
                    'domain' => 'meta.com'
                ],
                [
                    'name' => 'Tesla, Inc.',
                    'domain' => 'tesla.com'
                ],
                [
                    'name' => 'Samsung Electronics',
                    'domain' => 'samsung.com'
                ],
                [
                    'name' => 'NVIDIA Corporation',
                    'domain' => 'nvidia.com'
                ],
                [
                    'name' => 'Netflix, Inc.',
                    'domain' => 'netflix.com'
                ],
                [
                    'name' => 'IBM (International Business Machines)',
                    'domain' => 'ibm.com'
                ],
            ];
            foreach($companies as $company){
                Company::updateOrCreate(['name'=>$company['name']],$company);
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }
        
        

       
    }
}
