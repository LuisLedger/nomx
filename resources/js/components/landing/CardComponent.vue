<template>
    <div :class="(extra_class)?'card mt-3 '+extra_class:'card mt-3'">
        <div class="card-header" v-if="title">{{title}}</div>
        <div class="card-body m-0" v-html="body">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'body', 'extra_class'],
        data(){
            return {
            }
        },
        mounted() {
        },
        methods: {
        }
    }
</script>
