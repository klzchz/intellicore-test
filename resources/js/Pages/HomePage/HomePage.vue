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
                <jet-button v-if="isAdmin == '1'"
                    @click="showModal = true"
                >
                    Add Company
                </jet-button>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <company-list
                        :errors="$attrs.errors"
                        :companies="companies"
                        :max-rating="maxRating"
                        @load="loadCompanies"
                        @refreshCompanies="refreshCompanies"
                    />
                </div>
            </div>
        </div>

        <create-company :errors="$attrs.errors" :showModal="showModal" @show-modal="changeModalStatus" />

    </app-layout>
</template>

<script>
    import AppLayout from "../../Layouts/AppLayout";
    import CompanyList from "@/Pages/HomePage/Partials/CompanyList";
    import jetInput from "@/Jetstream/Input";
    import jetLabel from "@/Jetstream/Label";
    import JetButton from'@/Jetstream/Button';
    import CreateCompany from "@/Pages/HomePage/Partials/CreateCompany";
    export default {
        name: "HomePage",
        components: {jetLabel, jetInput, CompanyList, AppLayout,JetButton,CreateCompany},
        props: {
            maxRating: Number,
        },
        data() {
            return {
                companies: null,
                dataUrl: route('companies.index'),
                showModal:false,
                isAdmin:false,





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
                        this.companies = response.data;
                            this.isAdmin = this.companies.data[0].isAdmin


                    }).catch(error => {
                    console.log(error)
                });
            },
            refreshCompanies() {
                this.loadCompanies(this.dataUrl)
            },
            changeModalStatus(param){
                this.showModal = param;
            }

        },

    }

</script>

<style scoped>

</style>
