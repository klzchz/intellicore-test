<template>
    <div>
        <jet-label>
            <i class="fa fa-building"/>
            Company Name
        </jet-label>
        <jet-input v-model="form.name"/>
        <jet-input-error  :message="errors.name ? errors.name : ''" class="mt-2" />

        <jet-label>
            <i class="fa fa-internet-explorer"/>
            Web Site
        </jet-label>
        <jet-input v-model="form.url"/>
        <jet-input-error  :message="errors.url ? errors.url : ''" class="mt-2" />

        <jet-label>
            <i class="fa fa-at"/>
            Email
        </jet-label>
        <jet-input v-model="form.email"/>
        <jet-input-error :message="errors.email ? errors.email : ''" class="mt-2" />

        <jet-label>
            <i class="fa fa-phone"/>
            Phone
        </jet-label>
        <jet-input v-model="form.phone"/>
        <jet-input-error :message="errors.email ? errors.email : ''" class="mt-2" />
    </div>
</template>

<script>
    import JetLabel from "@/Jetstream/Label";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from '@/Jetstream/InputError'
    export default {
        name: "UpdateCompany",
        components: {JetInput, JetLabel, JetInputError},
        props: {
            company: Object,
            errors:Object
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.company.name,
                    url: this.company.url,
                    email: this.company.email,
                    phone: this.company.phone
                })
            }
        },
        methods: {
            update() {
                this.form.patch(_.get(this.company, '@id'))
            }
        }
    }
</script>

<style scoped>

</style>
