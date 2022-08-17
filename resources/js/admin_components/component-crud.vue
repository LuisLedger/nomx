<template>
    <div>
        <admin-create-component
            :title="title"
            :description="description"
            :url_store="url_store"
            :token="token"
            :form_data="form_data"
        >
        </admin-create-component>
        <admin-list-component
            :token="token"
            :component_name="component_name"
            :url_data="url_data"
            :url_detail="url_detail"
            :url_update="url_update"
            :url_delete="url_delete"
            :columns="columns"
            :actions="actions"
            :form_data="form_data"
        ></admin-list-component>
    </div>
</template>

<script>
    export default {
        props: [
            'token',
            'title', 
            'description',
            'component_name', 
            'url_data',
            'url_store',
            'url_detail',
            'url_update',
            'url_delete',
            'columns',
            'actions',
            'form_data'
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