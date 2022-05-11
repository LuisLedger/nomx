<template>
    <section>
        <h2 class="text-center">Senado</h2>
        <p class="text-muted text-center" v-if="(schedule===null)?true:false">No hay sesión programada hoy</p>
        <p class="text-muted text-center">Discusiones hoy en la cámara federal
            <br> 
            Una ciudadanía informada ayuda a México
        </p>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <select-form-component
                    :name="'level_id'"
                    :title="'Nivel'"
                    :selected="level_id"
                    :method="getPoliticGroupByLevel"
                    :items="[{name:'Federal',id:1},{name:'Estatal',id:2}]"
                    :hide_option="true"
                ></select-form-component>
            </div>
            <div class="col-md-6">
                <select-form-component
                    :name="'politic_group_id'"
                    :title="'Partido Político'"
                    :method="getFunctionariesCameras"
                    :items="politic_groups"
                ></select-form-component>
            </div>
        </div>
        <select-form-component
            :hide_option="true"
            :name="'state_id'"
            :title="'Estado'"
            :method="getFunctionariesCameras"
            :items="states"
            v-if="level_id>1"
        ></select-form-component>
        <div class="row mb-3" v-if="functionaries.length > 0">
            <div class="col-md-3 mb-3" v-for="items in functionaries">
                <functionary-list-component :items="items" :has_schedule="(schedule==null)?false:true"></functionary-list-component>
            </div>
        </div>
        <div class="mb-3" v-else>
            <h5 class="text-center pt-5 pb-5"><b>{{(load_functionaries)?'Cargando datos...':'Sin datos para mostrar'}}</b></h5>
        </div>
        <h3><b>Propuestas / Promesas</b></h3>
        <hr>
        <div class="row" v-if="proposals.length > 0">
            <div class="col-md-4" :key="'proposal-'+proposal.id" v-for="proposal in proposals">
                <project-card-component class="mb-3" :key="'proposal-card-'+proposal.id" :project="formatLikeProject(proposal)"></project-card-component>
            </div>
        </div>
        <div v-else>
            <h5 class="text-center"><b>{{(load_proposals)?'Cargando...':'Sin datos para mostrar'}}</b></h5>
        </div>
        <h3><b>Leyes</b></h3>
        <hr>
        <div class="row" v-if="laws.length > 0">
            <div class="col-md-4" :key="'law-'+law.id" v-for="law in laws">
                <project-card-component class="mb-3" :key="'law-card-'+law.id" :project="formatLikeProject(law)"></project-card-component>
            </div>
        </div>
        <div v-else>
            <h5 class="text-center"><b>{{(load_laws)?'Cargando...':'Sin datos para mostrar'}}</b></h5>
        </div>
        <h3><b>Proyectos</b></h3>
        <hr>
        <div class="row" v-if="projects.length > 0">
            <div class="col-md-4" :key="'project-'+project.id" :project="project" v-for="project in projects">
                <project-card-component class="mb-3" :key="'project-card-'+project.id" :project="project"></project-card-component>
            </div>
        </div>
        <div v-else>
            <h5 class="text-center"><b>{{(load_projects)?'Cargando...':'Sin datos para mostrar'}}</b></h5>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'states',
            'today'
        ],
        data(){
            return {
                schedule : null,
                functionaries : [],
                load_functionaries: false,
                politic_groups: [],
                level_id : 1,
                functionary_type: 10,
                proposals : [],
                load_proposals: false,
                laws : [],
                load_laws: false,
                projects: [],
                load_projects: false,
                query_string_data: []
            }
        },
        mounted() {
            this.getPoliticGroupByLevel()
        },
        methods: {
            formatLikeProject: function(item) {
                var data = {
                    image_url: item.image_url,
                    theme_name: item.theme_name,
                    project_name: null,
                    status_name: item.status_name,
                    url_global_info: item.url_global_info
                }

                if (item.hasOwnProperty('law_name')) {
                    data.project_name = item.law_name
                } else if (item.hasOwnProperty('proposal_name')) {
                    data.project_name = item.proposal_name
                }

                return data
            },
            getPoliticGroupByLevel : function(){
                var t  = this
                t.level_id = ($('[name="level_id"]').val() != '')?$('[name="level_id"]').val():t.level_id
                if (t.level_id) {
                    $.ajax({
                        type:'get',
                        url: '/politic_groups_by_level/'+t.level_id,
                        dataType: 'json'
                    }).done(function(response){
                        if (response.http_code == 200) {
                            t.politic_groups = response.data
                            t.getFunctionariesCameras()
                        }
                    })
                }
            },
            getFunctionariesCameras : function() {
                var t = this
                var data = {
                    limit: 3,
                    votation_date : t.today
                }

                if (t.level_id != '') {
                    data.level_id = t.level_id
                }

                if (t.level_id == 2) {
                    data.functionary_type_id = 11
                } else {
                    data.functionary_type_id = 5
                }

                if ($('[name="politic_group_id"]').val() != '') {
                    data.politic_group_id = $('[name="politic_group_id"]').val()
                }

                if ($('[name="state_id"]').val() != '') {
                    data.state_id = $('[name="state_id"]').val()
                }

                t.query_string_data = data
                t.functionaries = []
                t.load_functionaries = true

                $.ajax({
                    type:'get',
                    url: 'functionary_cameras',
                    data:data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.load_functionaries = false
                        t.functionaries = response.data.functionaries
                        t.schedule = response.data.schedule
                        t.getLaws()
                        t.getProjects()
                        t.getProposals()
                    }
                })
            },
            getLaws: function(){
                var t = this
                t.load_laws = true
                $.ajax({
                    type: 'get',
                    url: '/themes/laws',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.laws = [...t.laws,el]
                            })
                        }
                        t.load_laws = false
                    }
                })
            },
            getProjects: function(){
                var t = this
                t.load_projects = true
                $.ajax({
                    type: 'get',
                    url: '/themes/projects',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.load_projects = false
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.projects = [...t.projects,el]
                            })
                        }
                    }
                })
            },
            getProposals: function(){
                var t = this
                t.load_proposals = true
                $.ajax({
                    type: 'get',
                    url: '/themes/proposals',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.load_proposals = false
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.proposals = [...t.proposals,el]
                            })
                        }
                    }
                })
            }
        }
    }
</script>
