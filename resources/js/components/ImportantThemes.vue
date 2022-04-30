<template>
    <section>
        <h2 class="text-center">Temas de interés ciudadano</h2>
        <p class="text-muted text-center">Conoce los temas de interés ciudadano que están en la agenda política
            <br> 
            Una ciudadanía informada ayuda a México
        </p>
        <div class="row">
            <div class="col-4">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action active" id="0" theme="0" @click.prevent="selectTheme">
                        <b>Todos</b>
                    </li>
                    <li class="list-group-item list-group-item-action" :id="theme.id" :theme="theme.id" v-for="theme in themes" @click.prevent="selectTheme">
                        <b>{{theme.name}}</b>
                    </li>
                </ul>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label class="sr-only" for="search-cities">
                        Búscar
                    </label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-search">
                                </i>
                            </div>
                        </div>
                        <input class="form-control" id="search" name="q" placeholder="Búscar información" type="text" v-on:keyup.13="setSearch" :value="search" autocomplete="off">
                            <button class="input-group-append btn btn-primary" @click.prevent="getDataRelated">
                                Búscar
                            </button>
                        </input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Nivel:</label>
                        <select name="level_id" class="form-control" @change.prevent="periodsByLevel">
                            <option value="">Selecciona una opción</option>
                            <option :value="level.id" v-for="level in levels">{{level.name}}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Periodos:</label>
                        <select name="period_id" class="form-control" @change.prevent="getDataRelated()">
                            <option value="">Selecciona una opción</option>
                            <option :value="period.id" v-for="period in periods">{{period.start_year}} - {{period.end_year}}</option>
                        </select>
                    </div>
                </div>
                <state-delegation-component :states="states" :method="getDataRelated"></state-delegation-component>
                <section id="laws" v-if="data_laws.laws.length > 0">
                    <h3>Leyes</h3>
                    <hr>
                    <div class="row">
                        <div class="col-4 mb-3" :key="'law-'+law.id" v-for="law in data_laws.laws">
                            <card-component :extra_class="'p-0'" :key="'law-card-'+law.id" :body="itemBody(law)"></card-component>
                        </div>
                        <div class="col-12">
                            <button @click="getLaws" class="btn btn-link btn-block">
                                Listar más...
                            </button>
                        </div>
                    </div>
                </section>
                <section id="projects" v-if="data_projects.projects.length > 0">
                    <h3>Proyectos</h3>
                    <hr>
                    <div class="row">
                        <div class="col-4 mb-3" v-bind:key="'project-'+project.id" v-for="project in data_projects.projects">
                            <project-card-component :project="project"></project-card-component>
                        </div>
                        <div class="col-12">
                            <button @click="getProjects" class="btn btn-link btn-block">
                                Listar más...
                            </button>
                        </div>
                    </div>
                </section>
                <section id="proposals" v-if="data_proposals.proposals.length > 0">
                    <h3>Propuestas y Promesas</h3>
                    <hr>
                    <div class="row">
                        <div class="col-4 mb-3" v-bind:key="'proposal-'+proposal.id" v-for="proposal in data_proposals.proposals">
                            <card-component :extra_class="'p-0'" v-bind:key="'proposal-card-'+proposal.id" :body="itemBody(proposal)"></card-component>
                        </div>
                        <div class="col-12">
                            <button @click="getProposals" class="btn btn-link btn-block">
                                Listar más...
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'themes',
            'levels',
            'states'
        ],
        data(){
            return {
                search : null,
                sel_theme : null,
                periods : [],
                data_projects : {
                    projects : [],
                    page: 1,
                    last_page: 1
                },
                data_laws : {
                    laws : [],
                    page: 1,
                    last_page: 1
                },
                data_proposals : {
                    proposals : [],
                    page: 1,
                    last_page: 1
                },
                query_string_data : null
            }
        },
        mounted() {
            this.getDataRelated()
        },
        methods: {
            itemBody : function(item) {
                var name = '' 
                var colorItem = ''
                var statusItem = ''
                if (item.hasOwnProperty('project_name')) {
                    name = item.project_name
                    colorItem = item.status_color
                    statusItem = item.status_name
                } else if (item.hasOwnProperty('law_name')) {
                    name = item.law_name
                    colorItem = item.status_color
                    statusItem = item.status_name
                } else {
                    name = item.proposal_name
                    colorItem = item.status_color
                    statusItem = item.status_name
                }

                return `<img src="${item.image_url}" height="150" alt="">
                <div class="card-body m-0 p-0">
                    <div class="card-body m-0" style="height:150px">
                        <p class="m-0">${item.theme_name}</p>
                        <h3 title="${name}">${name.substring(0,25)}</h3>
                        <div class="row">
                            <div class="col-8">
                                <p class="m-0" style="color:${colorItem}">${statusItem}</p>
                            </div>
                            <div class="col-4">
                                <a href="${item.url_global_info}" target="_blank">
                                    Ver más
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>
                `
            },
            periodsByLevel :function(e) {
                var t = this
                var id = $('[name="level_id"]').val()
                if (id) {
                    t.periods = []

                    $.ajax({
                        type: 'get',
                        url: '/periods_by_level/'+id,
                        dataType: 'json'
                    }).done(function(response){
                        if (response.http_code == 200) {
                            t.periods = response.data
                            t.getDataRelated()
                        }
                    })
                }
            },
            selectTheme: function(e){
                var t = this
                t.sel_theme = $('#'+e.target.id).attr('theme')
                $('.list-group-item').removeClass('active')
                $('#'+e.target.id).addClass('active')

                t.getDataRelated()
            },
            setSearch : function() {
                var t = this
                t.q = ($('[name="q"]').val() != '') ? $('[name="q"]').val() :''
                t.getDataRelated()
            },
            getDataRelated : function() {
                var t = this
                var data = {
                    limit : 3
                }

                t.data_laws.laws = []
                t.data_projects.projets = []
                t.data_proposals.proposals = []

                if (t.sel_theme > 0) {
                    data.theme_social_id = t.sel_theme
                }

                if (t.q != null) {
                    data.q = t.q   
                }

                if ($('[name="level_id"]').val() != '') {
                    data.level_id = $('[name="level_id"]').val()
                }

                if ($('[name="period_id"]').val() != '') {
                    data.period_id = $('[name="period_id"]').val()
                }

                t.query_string_data = data

                $.ajax({
                    type: 'get',
                    url : '/laws_projects_proposals',
                    data: data,
                    dataType:'json'
                }).done(function(response){
                    if (response.http_code==200) {

                        t.data_laws.last_page = response.data.laws.last_page
                        t.data_laws.laws = response.data.laws.data
                        t.data_laws.page++

                        t.data_projects.last_page = response.data.projects.last_page
                        t.data_projects.projects = response.data.projects.data
                        t.data_projects.page++

                        t.data_proposals.last_page = response.data.proposals.last_page
                        t.data_proposals.proposals = response.data.proposals.data
                        t.data_proposals.page++
                    }
                })
            },
            getLaws: function(){
                var t = this
                if (t.data_laws.last_page < t.data_laws.page) {
                    return 
                }

                t.query_string_data.page = t.data_laws.page

                $.ajax({
                    type: 'get',
                    url: '/themes/laws',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_laws.last_page = response.data.last_page
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.data_laws.laws = [...t.data_laws.laws,el]
                            })
                        }

                        t.data_laws.page++    
                    }
                })
            },
            getProjects: function(){
                var t = this
                if (t.data_projects.last_page < t.data_projects.page) {
                    return 
                }

                t.query_string_data.page = t.data_projects.page

                $.ajax({
                    type: 'get',
                    url: '/themes/projects',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_projects.last_page = response.data.last_page
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.data_projects.projects = [...t.data_projects.projects,el]
                            })
                        }

                        t.data_projects.page++    
                    }
                })
            },
            getProposals: function(){
                var t = this
                if (t.data_proposals.last_page < t.data_proposals.page) {
                    return 
                }

                t.query_string_data.page = t.data_proposals.page

                $.ajax({
                    type: 'get',
                    url: '/themes/proposals',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_proposals.last_page = response.data.last_page
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.data_proposals.proposals = [...t.data_proposals.proposals,el]
                            })
                        }

                        t.data_proposals.page++    
                    }
                })
            }
        }
    }
</script>
