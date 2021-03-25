<template>
    <div>
    <dialog-modal
        :show="showModal"
    >
        <template #title>
            Create Company
        </template>

        <template #content>

              <jet-label>
            <i class="fa fa-building"/>
            Company Name
        </jet-label>
            <jet-input v-model="data.name"/>


            <jet-label>
                <i class="fa fa-internet-explorer"/>
                Web Site
            </jet-label>
            <jet-input v-model="data.url"/>


            <jet-label>
                <i class="fa fa-at"/>
                Email
            </jet-label>
            <jet-input v-model="data.email"/>


            <jet-label>
                <i class="fa fa-phone"/>
                Phone
            </jet-label>
            <jet-input v-model="data.phone"/>

        </template>

        <template #footer>
            <secondary-button
                @click="emitModalStatus(false)"
                class="pr-3"
            >
                Cancel
            </secondary-button>
            <jet-button
                @click="store"
            >
                Create
            </jet-button>
        </template>
    </dialog-modal>
    </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from '@/Jetstream/InputError';
import JetButton  from '@/Jetstream/Button';
import Modal from "@/Jetstream/Modal";
import DialogModal from "@/Jetstream/DialogModal";
export default {
    name: "CreateCompany",
    components: {JetInput, JetLabel, JetInputError,JetButton,Modal,DialogModal},

    data() {
        return {
               data: {
                   name:'',
                   url:'',
                   email: '',
                   phone:'',
               },
            showModal:false
        }
    },
    props:{
        showModal:Boolean,
        errorBag: Object,

    },
    methods: {
            store() {
                console.log(this.data);
                this.$emit('show-modal',false);
                this.$inertia.post('/companies',this.data);
            },

        emitModalStatus(param){
            this.showModal = param;
            this.$emit('show-modal',false);
        }

    }
}
</script>

<style scoped>

</style>
