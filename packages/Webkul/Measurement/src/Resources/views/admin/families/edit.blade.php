<x-admin::layouts.with-history>
    <x-slot:entityName>
        measurement_family
    </x-slot:entityName>

    <x-slot:title>
        {{ __('Edit Measurement Family') }}
    </x-slot:title>

    <x-admin::form
        method="PUT"
        action="{{ route('admin.measurement.families.update', $family->id) }}"
    >
        <!-- Page Header -->
        <div class="grid gap-2.5">
            <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
                <div class="grid gap-1.5">
                    <p class="text-xl text-gray-800 dark:text-slate-50 font-bold leading-6">
                        {{ __('Edit Measurement Family') }} | Name: {{ $family->name }}
                    </p>
                </div>

                <div class="flex gap-x-2.5 items-center">

                    <!-- Back Button -->
                    <a
                        href="{{ route('admin.measurement.families.index') }}"
                        class="transparent-button"
                    >
                        {{ __('Back') }}
                    </a>

                    <!-- Save Button -->
                    <button class="primary-button">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </div>


        <!-- PAGE BODY -->
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">

            <!-- LEFT COLUMN (MAIN FORM) -->
            <div class="left-column flex flex-col gap-2 flex-1 max-xl:flex-auto">

                <div class="relative p-4 bg-white dark:bg-cherry-900 rounded box-shadow">

                    <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                        {{ __('General Information') }}
                    </p>

                    {{-- Name --}}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            {{ __('Name') }}
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="name"
                            value="{{ old('name', $family->name) }}"
                            rules="required"
                            placeholder="{{ __('Enter family name') }}"
                        />

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                  

                    <p class="text-base text-gray-800 dark:text-white font-semibold mt-6 mb-2">
                        {{ __('Label Translations') }}
                    </p>

                    {{-- English --}}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            English (en_US)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="labels[en_US]"
                            value="{{ old('labels.en_US', $labels['en_US'] ?? '') }}"
                            placeholder="Enter English label"
                        />
                    </x-admin::form.control-group>

                    {{-- French --}}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            French (fr_FR)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="labels[fr_FR]"
                            value="{{ old('labels.fr_FR', $labels['fr_FR'] ?? '') }}"
                            placeholder="Enter French label"
                        />
                    </x-admin::form.control-group>

                    {{-- German --}}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            German (de_DE)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="labels[de_DE]"
                            value="{{ old('labels.de_DE', $labels['de_DE'] ?? '') }}"
                            placeholder="Enter German label"
                        />
                    </x-admin::form.control-group>


                </div> <!-- box -->
            </div>

        </div> <!-- columns -->

      

 
 
    </x-admin::form>

<!-- UNIT LIST SECTION -->

    <!-- units list -->
    <div class="mt-4 p-4 bg-white dark:bg-cherry-900 box-shadow rounded">

        <div class="flex justify-between items-center mb-4">
            <h2 class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                Options
            </h2>

            <v-create-unit-form 
                family-id="{{ $family->id }}"
                datagrid="unitDatagrid"
            />
        </div>

        <x-admin::datagrid 
            ref="unitDatagrid" 
            src="{{ route('admin.measurement.families.units', $family->id) }}">
        </x-admin::datagrid>
        <x-admin::modal ref="unitEditModal" width="600px"></x-admin::modal>

    </div>

@pushOnce('scripts')

    <!-- Vue Template -->
    <script type="text/x-template" id="v-create-unit-form-template">
        <div>
            <button 
                type="button" 
                class="secondary-button text-sm"
                @click="$refs.addUnitModal.toggle()"
            >
                Add Unit
            </button>

            <!-- Modal -->
            <x-admin::modal ref="addUnitModal">
                <x-slot:header>
                    <h2 class="text-lg font-bold">Add Unit</h2>
                </x-slot:header>

                <x-slot:content>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Code
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control 
                            type="text" 
                            name="code" 
                            v-model="form.code"
                            rules="required"
                            placeholder="Enter unit code"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Label
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control 
                            type="text" 
                            name="label" 
                            v-model="form.label"
                            rules="required"
                            placeholder="Enter unit label"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Symbol
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control 
                            type="text" 
                            name="symbol" 
                            v-model="form.symbol"
                            placeholder="e.g. m, km, g"
                        />
                    </x-admin::form.control-group>

                        <!-- @php
                            $operationOptions = json_encode([
                                ['label' => 'Select',   'value' => ''],
                                ['label' => 'Multiply', 'value' => 'multiply'],
                                ['label' => 'Divide',   'value' => 'divide'],
                                ['label' => 'Divide',   'value' => 'divide'],
                            ]);;
                        @endphp

                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                Conversion Operation
                            </x-admin::form.control-group.label>

                            <div class="flex gap-4">

                                {{-- Operation type --}}
                                <x-admin::form.control-group.control
                                    type="select"
                                    name="operation_type"
                                    v-model="form.operation_type"
                                    :options="$operationOptions"
                                    label-by="label"
                                    track-by="value"
                                    rules="required"
                                />

                                {{-- Operation value --}}
                                <x-admin::form.control-group.control 
                                    type="number" 
                                    name="operation_value" 
                                    v-model="form.operation_value"
                                    rules="required|min_value:0"
                                    placeholder="Value"
                                />
                            </div>

                            <x-admin::form.control-group.error control-name="operation_type" />
                            <x-admin::form.control-group.error control-name="operation_value" />
                        </x-admin::form.control-group> -->



                </x-slot:content>

                <x-slot:footer>
                    <button 
                        type="button" 
                        class="primary-button"
                        @click="save"
                    >
                        Save
                    </button>
                </x-slot:footer>
            </x-admin::modal>
        </div>
    </script>


    <!-- Vue Component -->
    <script type="module">
        app.component('v-create-unit-form', {
            template: '#v-create-unit-form-template',

            props: ['familyId', 'datagrid'],

            data() {
                return {
                    form: {
                        code: '',
                        label: '',
                        symbol: '',
                    },
                    storeUnitUrl: "{{ route('admin.measurement.families.units.store', ':id') }}",
                };
            },

            methods: {
                save() {

                    // Dynamic route replace :id
                    let url = this.storeUnitUrl.replace(':id', this.familyId);

                    axios.post(url, this.form)
                        .then(() => {

                            // close modal
                            this.$refs.addUnitModal.close();

                            // reset form
                            this.form.code   = '';
                            this.form.label  = '';
                            this.form.symbol = '';

                            // reload grid
                            this.$refs[this.datagrid].reload();
                        })
                        .catch(err => {
                            console.error(err);
                        });
                }
            }
        });
    </script>

    <script type="text/javascript">
        function editUnit(url) {
            let modal = $refs.unitEditModal;

            modal.open();
            modal.loading = true;

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    modal.content = html;
                    modal.loading = false;
                });
        }
    </script>

@endPushOnce


</x-admin::layouts.with-history>
