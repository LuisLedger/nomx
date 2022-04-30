<template>
    <section class="mb-3 mt-3">
        <h3 class="text-center">Propuestas / Proyectos del funcionario</h3>
        <div class="text-center" v-if="projects.length==0">
            <h3 class="pt-5 pb-5">No hay información relacionada</h3>
        </div>
        <div class="row" v-else>
            <div class="col-4 mb-3" v-for="project in projects">
                <project-card-component :project="project"></project-card-component>
            </div>
            <div class="col-12">
                <button @click="getProjectsByFunctionaries" class="btn btn-link btn-block">
                    Listar más proyectos...
                </button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'functionary'
        ],
        data(){
            return {
                projects : [],
                page: 1,
                last_page: 1
            }
        },
        mounted() {

            this.getProjectsByFunctionaries()
        },
        methods: {
            getProjectsByFunctionaries: function() {
                var t = this
                if (t.last_page < t.page) {
                    return 
                }

                $.ajax({
                    type: 'get',
                    url: '/functionary/'+t.functionary.id+'/projects',
                    data: {
                        page: t.page,
                        limit: 3,
                        period_ids : $('#period_id').val()
                    },
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.last_page = response.data.last_page
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.projects = [...t.projects,el]
                            })
                        }

                        t.page++    
                    }
                })
            }
        }
    }
</script>
</script>
