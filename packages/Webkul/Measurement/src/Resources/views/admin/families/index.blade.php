<x-admin::layouts>
    <x-slot:title>
        {{ __('Measurement Families') }}
    </x-slot>

    <!-- Page Header -->
    <div class="flex gap-4 justify-between items-center max-sm:flex-wrap mb-4">
        <p class="text-xl text-gray-800 dark:text-white font-bold">
            {{ __('Measurement') }}
        </p>

        <div class="flex gap-x-2.5 items-center">
            <v-create-family-form />
        </div>
    </div>

    <!-- Datagrid -->
    <x-admin::datagrid
        ref="datagrid"
        src="{{ route('admin.measurement.families.index') }}">
    </x-admin::datagrid>

    @pushOnce('scripts')
        <!-- ================= CREATE FAMILY TEMPLATE ================= -->
        <script type="text/x-template" id="v-create-family-form-template">
            <div>
                <button
                    type="button"
                    class="primary-button"
                    @click="$refs.familyCreateModal.toggle()"
                >
                    {{ __('Create Measurement Family') }}
                </button>

                <!-- Modal -->
                <x-admin::modal ref="familyCreateModal">
                    <x-slot:header>
                        <h2 class="text-base text-gray-800 dark:text-white font-semibold">
                            {{ __('Create Measurement Family') }}
                        </h2>
                    </x-slot:header>

                    <x-slot:content>
                        <!-- Basic Fields -->
                        <div class="px-4 pb-4 bg-white dark:bg-cherry-900 box-shadow rounded">
                        
                            <div class="flex justify-between items-center p-1.5">
                                <p class="p-2.5 text-gray-800 dark:text-white text-base font-semibold">
                                   
                                </p>
                            </div>
                        
                           <!-- Family Code -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    {{ __('Family Code') }}
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    v-model="form.code"
                                    placeholder="{{ __('Enter family code') }}"
                                />
                            </x-admin::form.control-group>

                            <!-- Standard Unit Code -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    {{ __('Standard Unit Code') }}
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    v-model="form.standard_unit_code"
                                    placeholder="{{ __('Enter standard unit code') }}"
                                />
                            </x-admin::form.control-group>

                            <!-- Symbol -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    {{ __('Symbol') }}
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    v-model="form.symbol"
                                    placeholder="{{ __('e.g. km, m') }}"
                                />
                            </x-admin::form.control-group>
                        </div>

                        <!-- Dynamic Labels -->
                        <div class="mt-4 bg-white dark:bg-cherry-900 box-shadow rounded">
                            <div class="flex justify-between items-center p-1.5">
                                <p class="p-2.5 text-gray-800 dark:text-white text-base font-semibold">
                                    @lang('admin::app.catalog.attributes.create.label')
                                </p>
                            </div>

                            <div class="px-4 pb-4">
                                @foreach ($locales as $locale)
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            {{ $locale->name }}
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            v-model="form.labels['{{ $locale->code }}']"
                                            placeholder="{{ __('Enter label') }}"
                                        />
                                    </x-admin::form.control-group>
                                @endforeach
                            </div>
                        </div>
                    </x-slot:content>

                    <x-slot:footer>
                        <button
                            type="button"
                            class="primary-button"
                            @click="save"
                        >
                            {{ __('Save') }}
                        </button>
                    </x-slot:footer>
                </x-admin::modal>
            </div>
        </script>

        <!-- ================= VUE COMPONENT ================= -->
        <script type="module">
            app.component('v-create-family-form', {
                template: '#v-create-family-form-template',

                data() {
                    return {
                        form: {
                            code: '',
                            standard_unit_code: '',
                            symbol: '',
                            labels: {}
                        }
                    };
                },

                methods: {
                    save() {
                        axios.post(
                            "{{ route('admin.measurement.families.store') }}",
                            this.form
                        )
                        .then(response => {
                            this.$refs.familyCreateModal.close();

                            // reset form
                            this.form = {
                                code: '',
                                standard_unit_code: '',
                                symbol: '',
                                labels: {}
                            };

                            if (response.data?.data?.redirect_url) {
                                window.location.href = response.data.data.redirect_url;
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                    }
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts>
