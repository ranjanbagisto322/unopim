<x-admin::layouts.with-history>
    <x-slot:entityName>
        measurement_unit
    </x-slot:entityName>

    <x-slot:title>
        Edit Unit - {{ $unit['code'] }}
    </x-slot:title>

    <x-admin::form
        method="PUT"
        action="{{ route('admin.measurement.families.units.update', [
            'familyid' => $family->id,
            'code'      => $unit['code']
        ]) }}"
    >

        <!-- PAGE HEADER -->
        <div class="grid gap-2.5 mb-4">
            <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">

                <p class="text-xl text-gray-800 dark:text-slate-50 font-bold leading-6">
                    Edit Unit | {{ $unit['code'] }}
                </p>

                <div class="flex gap-x-2.5 items-center">

                    <!-- BACK BUTTON -->
                    <a
                        href="{{ route('admin.measurement.families.edit', $family->id) }}"
                        class="transparent-button"
                    >
                        Back
                    </a>

                    <!-- SAVE BUTTON -->
                    <button class="primary-button">
                        Save
                    </button>

                </div>
            </div>
        </div>

        <!-- FORM BODY -->
        <div class="relative p-4 bg-white dark:bg-cherry-900 rounded box-shadow">

            <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                Unit Information
            </p>

            {{-- Code (View only) --}}
            <x-admin::form.control-group>
                <x-admin::form.control-group.label>
                    Code
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    name="code"
                    value="{{ $unit['code'] }}"
                    disabled
                />
            </x-admin::form.control-group>


            {{-- Symbol --}}
            <x-admin::form.control-group>
                <x-admin::form.control-group.label class="required">
                    Symbol
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    name="symbol"
                    value="{{ old('symbol', $unit['symbol'] ?? '') }}"
                    rules="required"
                    placeholder="Enter unit symbol"
                />

                <x-admin::form.control-group.error control-name="symbol" />
            </x-admin::form.control-group>


                        <!-- Labels -->
                        <div class="bg-white dark:bg-cherry-900 box-shadow rounded">
                            <div class="flex justify-between items-center p-1.5">
                                <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                                    @lang('admin::app.catalog.attributes.edit.label')
                                </p>
                            </div>

                            <div class="">
                                <!-- Locales Inputs -->
                                @foreach ($locales as $locale)
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            {{ $locale->name }}
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            name="labels[{{ $locale->code }}]"
                                            value="{{ old('labels.'.$locale->code, $labels[$locale->code] ?? '') }}"
                                            placeholder="Enter {{ $locale->name }} label"
                                        />
                                    </x-admin::form.control-group>
                                @endforeach

                            </div>
                        </div>


        </div>

    </x-admin::form>

</x-admin::layouts.with-history>
