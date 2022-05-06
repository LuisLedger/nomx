<template>
    <div class="form-group">
       <label v-if="show_labels === undefined">{{title}}</label>
       <select :name="name" :disabled="disabled" class="form-control" @change.prevent="method">
           <option value="" v-if="hide_option === undefined">{{(show_labels === undefined)?'Selecciona una opcion':title}}</option>
           <option :value="item.id" :selected="(selected==item.id)" v-for="item in items">{{item.name}}</option>
       </select>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'title',
            'selected',
            'method',
            'disabled',
            'show_labels',
            'items',
            'hide_option'
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
