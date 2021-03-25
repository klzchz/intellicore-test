<template>
    <!-- This example requires Tailwind CSS v2.0+ -->

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company Name/Web Site
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phone/Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rating
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <company
                                v-for="company in companyList"
                                :errors="errors"
                                :max-rating="maxRating"
                                :company="company"
                                @refreshCompanies="$emit('refreshCompanies')"
                                :can-rate="canRate"
                                :key="company['@id']"
                            />
                        </tbody>
                    </table>
                    <pagination
                        :meta="meta"
                        :links="links"
                        @load="$emit('load', $event)"
                    />
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Company from "@/Pages/HomePage/Partials/Company";
    import Pagination from "@/Components/Pagination";
    export default {
        name: "CompanyList",
        components: {Pagination, Company},
        props: {
            companies: Object,
            maxRating: Number,
            canRate: Boolean,
            errors:Object
        },
        data(){
          return{
              showModal:false,
          }
        },
        computed: {
            companyList() {
                return _.get(this.companies, 'data')
            },
            meta() {
                return _.get(this.companies, 'meta')
            },
            links() {
                return _.get(this.companies, 'links')
            },
            canCreate(){
                return _.get(this.companies, '@canCreate')
            }
        },

    }
</script>

<style scoped>

</style>
