<template>
    <div class="form-group">
        <label>{{form.alias}}</label>
        <select :name="form.name" class="form-control" :required="form.required" @change="setData">
            <option>Selecciona una opción</option>
            <option :value="idx" v-for="(opt,idx) in form.catalog_related" :selected="(value==idx)?true:false">{{opt}}</option>
        </select>
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
            return {}
        },
        mounted() {
        },
        methods: {
        }
    }
</script>