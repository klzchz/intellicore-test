<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <jet-input v-model="form.search" class="bg-white overflow-hidden shadow-xl sm:rounded-lg"  />
            <jet-button @click="searchMethod">Search</jet-button><br/>

            <jet-input type="radio" id="none" v-model="form.radio" name="searcR" class="bg-white overflow-hidden shadow-xl sm:rounded-lg"  value="none" />
            <jet-label>No Filter</jet-label>
            <jet-input type="radio" id="min" v-model="form.radio" name="searcR" class="bg-white overflow-hidden shadow-xl sm:rounded-lg"  value="min" />
            <jet-label>Min Rating</jet-label>
            <jet-input type="radio" id="max" v-model="form.radio" name="searcR" class="bg-white overflow-hidden shadow-xl sm:rounded-lg"  value="max" />
            <jet-label>Max Rating</jet-label>


        </div>
    </div>
</template>

<script>
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label";

export default {
    name: "Search",
    components:{JetInput,JetButton,JetLabel},
    data(){
        return{
           form:{
               search:'',
               radio:'',
           }



        }
    },
    methods:{
        searchMethod()
        {
            this.$emit('search',this.form);
        }

    }
}
</script>

<style scoped>

</style>
