<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DeleteAutoAttributesSeeder extends Seeder
{
    public function run()
    {
        Model::unsetEventDispatcher();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Get attribute IDs created by seeder
        $attributeIds = DB::table('attributes')
            ->where('code', 'LIKE', 'auto_attr_%')
            ->pluck('id')
            ->toArray();

        if (empty($attributeIds)) {
            $this->command->info('@@ No auto attributes found.');
            return;
        }

        // Delete mappings
        DB::table('attribute_group_mappings')
            ->whereIn('attribute_id', $attributeIds)
            ->delete();

        // Delete translations
        DB::table('attribute_translations')
            ->whereIn('attribute_id', $attributeIds)
            ->delete();

        // Delete attributes
        $deleted = DB::table('attributes')
            ->whereIn('id', $attributeIds)
            ->delete();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info("** {$deleted} auto attributes deleted successfully!");
    }
}
