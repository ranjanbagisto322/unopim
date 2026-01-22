<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Attribute\Models\AttributeGroup;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        $attributeRepo = app(AttributeRepository::class);

        $group = AttributeGroup::firstOrCreate(
            ['code' => 'general'],
            ['is_user_defined' => 1]
        );

        $types = ['text', 'textarea', 'boolean', 'price', 'select'];

        for ($i = 1; $i <= 990; $i++) {

            $code = 'auto_attr_' . Str::random(10);

            if ($attributeRepo->findOneByField('code', $code)) {
                continue;
            }

            Event::dispatch('catalog.attribute.create.before');

            $attribute = $attributeRepo->create([
                'code'              => $code,
                'type'              => $types[array_rand($types)],
                'is_required'       => 0,
                'is_unique'         => 0,
                'value_per_locale'  => 0,
                'value_per_channel' => 0,
            ]);

            $name = ucfirst(str_replace('_', ' ', $code));

            $attribute->translations()->create([
                'locale' => 'en_US',
                'name'   => $name,
            ]);

            Event::dispatch('catalog.attribute.create.after', $attribute);

            $exists = \DB::table('attribute_group_mappings')
                ->where('attribute_id', $attribute->id)
                ->where('attribute_family_group_id', $group->id)
                ->exists();

            if (! $exists) {
                \DB::table('attribute_group_mappings')->insert([
                    'attribute_id'              => $attribute->id,
                    'attribute_family_group_id' => $group->id,
                    'position'                  => $i,
                ]);
            }
        }

        $this->command->info('990 Attributes created and mapped to General Group!');
    }
}
