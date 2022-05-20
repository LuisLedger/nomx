<template>
    <div class="card">
        <img :src="project.image_url" height="150" alt="">
        <div class="card-body m-0">
            <p class="m-0">{{project.theme_name}}</p>
            <h3 :title="project.project_name">{{project.project_name.substring(0,25)}}</h3>
            <div class="row">
                <div class="col-6 p-2">
                    <p class="m-0" :style="{color:project.status_color}">{{project.status_name}}</p>
                </div>
                <div class="col-6">
                    <a class="btn btn-outline-info btn-sm" :href="project.url_global_info" target="_blank" title="Ver link directo">
                        <i class="fa fa-link"></i>
                    </a> 
                    <a class="btn btn-outline-primary btn-sm" :href="'/detail/pp/element/'+project.id" target="_blank" title="Ver detalle">
                        <i class="fa fa-eye"></i>
                    </a> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'project'
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
</script>
