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
        
        <div class="grid gap-2.5">
            <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
                <div class="grid gap-1.5">
                    <p class="text-xl text-gray-800 dark:text-slate-50 font-bold leading-6">
                        {{ __('Edit Measurement Family') }} | Name: {{ $family->name }}
                    </p>
                </div>

                <div class="flex gap-x-2.5 items-center">

                   
                    <a
                        href="{{ route('admin.measurement.families.index') }}"
                        class="transparent-button"
                    >
                        {{ __('Back') }}
                    </a>

                   
                    <button class="primary-button">
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </div>


        
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">

           
            <div class="left-column flex flex-col gap-2 flex-1 max-xl:flex-auto">

                <div class="relative p-4 bg-white dark:bg-cherry-900 rounded box-shadow">

                    <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                        {{ __('General Information') }}
                    </p>

                    {{-- Name --}}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            {{ __('Code') }}
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="code"
                            value="{{ old('code', $family->code) }}"
                            rules="required"
                            placeholder="{{ __('Enter family name') }}"
                            disabled
                        />

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                  

                  
                        <div class="bg-white dark:bg-cherry-900 box-shadow rounded">
                            <div class="flex justify-between items-center p-1.5">
                                <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                                    @lang('admin::app.catalog.attributes.edit.label')
                                </p>
                            </div>

                            <div class="">
                               
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
            </div>

        </div> 

      

 
 
    </x-admin::form>

<!-- UNIT LIST SECTION -->

<!-- ================= UNITS LIST ================= -->
<div class="mt-4 p-4 bg-white dark:bg-cherry-900 box-shadow rounded">

    <div class="flex justify-between items-center mb-4">
        <h2 class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
            Options
        </h2>

        <!-- ADD UNIT BUTTON & MODAL -->
        <v-create-unit-form
            family-id="{{ $family->id }}"
            datagrid="unitDatagrid"
        />
    </div>

    <!-- DATA GRID -->
    <x-admin::datagrid
        ref="unitDatagrid"
        src="{{ route('admin.measurement.families.units', $family->id) }}">
    </x-admin::datagrid>

</div>

<!-- EDIT UNIT MODAL COMPONENT -->
<v-edit-unit-form
    family-id="{{ $family->id }}"
    datagrid="unitDatagrid"
/>

@pushOnce('scripts')

<!-- ================= CREATE UNIT TEMPLATE ================= -->
<script type="text/x-template" id="v-create-unit-form-template">
    <div>
        <button
            type="button"
            class="secondary-button text-sm"
            @click="$refs.addUnitModal.toggle()"
        >
            Add Unit
        </button>

        <!-- CREATE MODAL -->
        <x-admin::modal ref="addUnitModal">
            <x-slot:header>
                <h2 class="text-base font-semibold">
                    Add Unit
                </h2>
            </x-slot:header>

            <x-slot:content>
                <x-admin::form.control-group>
                    <x-admin::form.control-group.label class="required">
                        Code
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="text"
                        v-model="form.code"
                        rules="required"
                        placeholder="Enter unit code"
                    />
                </x-admin::form.control-group>

                <div class="mt-4">
                    @foreach ($locales as $locale)
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                {{ $locale->name }}
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                v-model="form.labels['{{ $locale->code }}']"
                                placeholder="Enter {{ $locale->name }} label"
                            />
                        </x-admin::form.control-group>
                    @endforeach
                </div>

                <x-admin::form.control-group class="mt-4">
                    <x-admin::form.control-group.label>
                        Symbol
                    </x-admin::form.control-group.label>

                    <x-admin::form.control-group.control
                        type="text"
                        v-model="form.symbol"
                        placeholder="e.g. m, km, g"
                    />
                </x-admin::form.control-group>
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

<!-- ================= EDIT UNIT TEMPLATE ================= -->
<script type="text/x-template" id="v-edit-unit-form-template">
    <x-admin::modal ref="editUnitModal">
        <x-slot:header>
            <h2 class="text-base font-semibold">
                Edit Unit
            </h2>
        </x-slot:header>

        <x-slot:content>

            <x-admin::form.control-group>
                <x-admin::form.control-group.label>
                    Code
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    v-model="form.code"
                    disabled
                />
            </x-admin::form.control-group>

            <div class="mt-4">
                @foreach ($locales as $locale)
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            {{ $locale->name }}
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            v-model="form.labels['{{ $locale->code }}']"
                        />
                    </x-admin::form.control-group>
                @endforeach
            </div>

            <x-admin::form.control-group class="mt-4">
                <x-admin::form.control-group.label>
                    Symbol
                </x-admin::form.control-group.label>

                <x-admin::form.control-group.control
                    type="text"
                    v-model="form.symbol"
                />
            </x-admin::form.control-group>

        </x-slot:content>

        <x-slot:footer>
            <button class="primary-button" @click="update">
                Update
            </button>
        </x-slot:footer>
    </x-admin::modal>
</script>

<!-- ================= CREATE UNIT COMPONENT ================= -->
<script type="module">
app.component('v-create-unit-form', {
    template: '#v-create-unit-form-template',

    props: ['familyId', 'datagrid'],

    data() {
        return {
            form: { code: '', labels: {}, symbol: '' },
            storeUnitUrl: "{{ route('admin.measurement.families.units.store', ':id') }}"
        };
    },

    methods: {
        save() {
            const url = this.storeUnitUrl.replace(':id', this.familyId);

            axios.post(url, this.form)
                .then(() => {
                    this.$refs.addUnitModal.close();
                    this.form = { code: '', labels: {}, symbol: '' };
                    this.$refs[this.datagrid].reload();
                });
        }
    }
  });
</script>

<!-- ================= EDIT UNIT COMPONENT ================= -->
<script type="module">
app.component('v-edit-unit-form', {
    template: '#v-edit-unit-form-template',

    props: ['familyId', 'datagrid'],

    data() {
        return {
            unitCode: null,
            form: { code: '', labels: {}, symbol: '' },
            updateUrl: "{{ route('admin.measurement.families.units.update', [':family', ':code']) }}"
        };
    },

    mounted() {
        window.addEventListener('edit-unit', e => {
            this.open(e.detail);
        });
    },

    methods: {
        open(unit) {
            this.unitCode = unit.code;
            this.form = {
                code: unit.code,
                labels: JSON.parse(unit.labels || '{}'),
                symbol: unit.symbol,
            };
            this.$refs.editUnitModal.toggle();
        },

        update() {
            const url = this.updateUrl
                .replace(':family', this.familyId)
                .replace(':code', this.unitCode);

            axios.put(url, this.form).then(() => {
                this.$refs.editUnitModal.close();
                this.$refs[this.datagrid].reload();
            });
        }
    }
});
</script>

<!-- ================= DATAGRID EDIT HANDLER ================= -->
<script>
function openEditUnitModal(row) {
    window.dispatchEvent(new CustomEvent('edit-unit', { detail: row }));
}

</script>

@endPushOnce



</x-admin::layouts.with-history>
