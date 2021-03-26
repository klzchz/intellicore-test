<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <jet-input v-model="search" class="bg-white overflow-hidden shadow-xl sm:rounded-lg"  />
            <jet-button @click="searchMethod">Search</jet-button>

        </div>
    </div>
</template>

<script>
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";

export default {
    name: "Search",
    components:{JetInput,JetButton},
    data(){
        return{
            search:''
        }
    },
    methods:{
        searchMethod()
        {
            this.$emit('search',this.search);
        }

    }
}
</script>

<style scoped>

</style>
