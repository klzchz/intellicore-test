<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Company List
            </h2>
        </template>

<!--        <div class="py-12">-->
<!--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">-->
<!--                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">-->
<!--                     TODO: Add Search inputs here -->
<!--                </div>-->
<!--            </div>-->
<!--        </div-->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <company-list
                        :companies="companies"
                        :max-rating="maxRating"
                        @load="loadCompanies"
                        @refreshCompanies="refreshCompanies"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";
    import CompanyList from "@/Pages/HomePage/Partials/CompanyList";
    import jetInput from "@/Jetstream/Input";
    import jetLabel from "@/Jetstream/Label";
    export default {
        name: "HomePage",
        components: {jetLabel, jetInput, CompanyList, AppLayout},
        props: {
            maxRating: Number,
        },
        data() {
            return {
                companies: null,
                dataUrl: route('companies.index'),
            }
        },
        mounted() {
            this.refreshCompanies();
        },

        methods: {
            loadCompanies(url) {
                this.dataUrl = url;
                axios.get(url)
                    .then((response) => {
                        this.companies = response.data
                    }).catch(error => {
                    console.log(error)
                });
            },
            refreshCompanies() {
                this.loadCompanies(this.dataUrl)
            },
        }
    }

</script>

<style scoped>

</style>
