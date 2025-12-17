@php

 use Webkul\Measurement\Repository\AttributeMeasurementRepository;

    // Get saved measurement for this attribute
    $measurement = null;
    if ($attribute) {
        $measurement = app(AttributeMeasurementRepository::class)
            ->getByAttributeId($attribute->id);
    }
@endphp

@if ($attribute && $attribute->type === 'measurement')

<v-measurement
    old-family="{{ $measurement->family_code ?? '' }}"   
    old-unit="{{ $measurement->unit_code ?? '' }}"
></v-measurement>


@pushOnce('scripts')
<script type="text/x-template" id="v-measurement-template">

    <div class="p-4 bg-white dark:bg-cherry-900 rounded shadow-sm mt-4">

        <!-- Measurement Family -->
        <x-admin::form.control-group>
            <x-admin::form.control-group.label class="required">
                Measurement Family
            </x-admin::form.control-group.label>

            <x-admin::form.control-group.control
                type="select"
                name="measurement_family"
                id="measurement_family"
                ::options="familyOptions"
                v-model="measurementFamily"
                rules="required"
                track-by="id"
                label-by="label"
            />
        </x-admin::form.control-group>

        <!-- Measurement Unit -->
        <x-admin::form.control-group class="mt-4">
            <x-admin::form.control-group.label class="required">
                Measurement Unit
            </x-admin::form.control-group.label>

            <x-admin::form.control-group.control
                type="select"
                name="measurement_unit"
                id="measurement_unit"
                ::options="unitsList"
                v-model="measurementUnit"
                rules="required"
                track-by="id"
                label-by="label"
            />
        </x-admin::form.control-group>

    </div>

</script>


<script type="module">
app.component('v-measurement', {
    template: '#v-measurement-template',

    props: ['oldFamily', 'oldUnit'],

    data() {
        return {
            familyOptions: [],
            measurementFamily: "",
            measurementUnit: "", 
            unitsList: [],
            isInitialLoad: true,
        };
    },

    async mounted() {
        await this.loadFamilies();

        console.log('Loaded families:', this.familyOptions);
        console.log('Old family code:', this.oldFamily);
        console.log('Old unit code:', this.oldUnit);
        
        if (this.oldFamily) {
            const family = this.familyOptions.find(f => f.id == this.oldFamily);
            if (family) {
                this.measurementFamily = JSON.stringify(family);
                this.unitsList = family.units;
                this.measurementUnit = this.oldUnit;
            }
            console.log('view:', this.unitsList);
        }

        this.isInitialLoad = false;
    },



    watch: {
        measurementFamily(newValue) {
            const selectedFamily = JSON.parse(newValue);
            this.unitsList = selectedFamily ? selectedFamily.units : [];

            if (!this.isInitialLoad) {
                this.measurementUnit = '';
            }
        }
    },

    methods: {
        async loadFamilies() {
            const response = await axios.get("{{ route('measurement.families') }}");
            this.familyOptions = response.data.familyOptions; 
        }
    }
});
</script>

@endpushOnce

@endif
