<template>
    <div v-if="column.type == 'color'">
        <div :style="{backgroundColor: data,height:'20px', width:'100%',textAlign:'center'}">
            {{data}}
        </div>
    </div>
    <div v-else>
        {{data}}
    </div>
</template>

<script>
    export default {
        props: [
            'column',
            'data'
        ],
        data(){
            return {
            }
        },
        mounted() {
            this.cols = this.columns
        },
        computed :{
        },
        methods: {
        }
    }
</script>