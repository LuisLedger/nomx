<template>
    <div class="form-group">
        <label>{{form.alias}}</label>
        <input :type="form.type" :name="form.name" class="form-control" :value="value" :required="form.required" @keyup="setData">
    </div>
</template>

<script>
    export default {
        props: [
            'form',
            'data',
            'setData',
            'value'
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