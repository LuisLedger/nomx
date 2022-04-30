<template>
    <div :class="(extra_class)?'card '+extra_class:'card'" v-html="body">
        <div class="card-header" v-if="title">{{title}}</div>
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
