<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Models\AttributeGroup;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        
        Model::unsetEventDispatcher();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $group = AttributeGroup::firstOrCreate(
            ['code' => 'general'],
            ['is_user_defined' => 1]
        );

        $types = ['text', 'textarea', 'boolean', 'price', 'select'];

        $total = 2000;     
        $batchSize = 1000;

        $attributes = [];
        $translations = [];
        $mappings = [];

        for ($i = 1; $i <= $total; $i++) {

            $code = 'auto_attr_' . $i; 

            $type = $types[array_rand($types)];

            $attributes[] = [
                'code'              => $code,
                'type'              => $type,
                'is_required'       => 0,
                'is_unique'         => 0,
                'value_per_locale'  => 0,
                'value_per_channel' => 0,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];

            $translations[] = [
                'locale'     => 'en_US',
                'name'       => ucfirst(str_replace('_', ' ', $code)),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($attributes) === $batchSize) {

                // Insert attributes
                DB::table('attributes')->insert($attributes);

                // Calculate first inserted ID
                $lastId  = DB::getPdo()->lastInsertId();
                $firstId = $lastId - ($batchSize - 1);

                foreach ($translations as $index => $translation) {

                    $attributeId = $firstId + $index;

                    DB::table('attribute_translations')->insert([
                        'attribute_id' => $attributeId,
                        'locale'       => $translation['locale'],
                        'name'         => $translation['name'],
                    ]);

                    $mappings[] = [
                        'attribute_id'              => $attributeId,
                        'attribute_family_group_id' => $group->id,
                        'position'                  => $attributeId,
                    ];
                }

                DB::table('attribute_group_mappings')->insert($mappings);

                // Reset batch
                $attributes = [];
                $translations = [];
                $mappings = [];
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info("## {$total} attributes seeded FAST **");
    }
}
