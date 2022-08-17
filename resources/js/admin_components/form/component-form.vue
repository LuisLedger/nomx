<template>
    <div>
        <form-text-component v-if="(form.type=='text')" :form="form" :data="data" :value="setValue" :setData="setData"></form-text-component>
        <form-text-component v-if="(form.type=='password')" :form="form" :data="data" :value="setValue" :setData="setData"></form-text-component>
        <form-text-component v-if="(form.type=='url')" :form="form" :data="data" :value="setValue" :setData="setData"></form-text-component>
        <form-text-component v-if="(form.type=='color')" :form="form" :data="data" :value="setValue" :setData="setData"></form-text-component>
        <form-select-component v-if="(form.type=='select')" :form="form" :data="data" :value="setValue" :setData="setData"></form-select-component>
    </div>
</template>

<script>
    export default {
        props: [
            'form',
            'data',
            'setData',
            'setValue'
        ],
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