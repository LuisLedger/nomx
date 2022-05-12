<template>
    <div class="container" style="margin-top:15rem; margin-bottom: 15rem;" v-if="first_load">
        <h1 class="text-center">
            ¡Bienvenido!
        </h1>
        <p class="text-center text-muted">
            Encuentra a tus funcionarios, propuestas, leyes o proyectos que y el estatus que tienen <br>
            en los distintos niveles de gobierno
        </p>
        <div class="form-group col-8 m-auto">
            <label class="sr-only" for="search">
                Búscar
            </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-search">
                        </i>
                    </div>
                </div>
                <input class="form-control" id="search" name="search" placeholder="Búscar información general" type="text" autocomplete="off" :value="search" @keyup.13="setSearchValue">
                    <button class="input-group-append btn btn-primary" @click="setSearchValue">
                        Búscar
                    </button>
                </input>
            </div>
        </div>
    </div>
    <div class="container mt-5" v-else>
        <div class="form-group mb-3">
            <label class="sr-only" for="search">
                Búscar
            </label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-search">
                        </i>
                    </div>
                </div>
                <input class="form-control" id="search" name="search" placeholder="Búscar información general" type="text" autocomplete="off" :value="search" @keyup.13="setSearchValue">
                    <button class="input-group-append btn btn-primary" @click="setSearchValue">
                        Búscar
                    </button>
                </input>
            </div>
        </div>
        <div v-if="data_projects.projects.length > 0">
            <h3><b>Proyectos</b></h3>
            <hr>
            <search-element-component
                :key="'projects-'+item.id"
                :item="formatLikeProject(item)"
                v-for="item in data_projects.projects"
            ></search-element-component>
        </div>
        <div v-if="data_projects.projects.length > 0">
            <h3><b>Leyes</b></h3>
            <hr>
            <search-element-component
                :key="'laws-'+item.id"
                :item="formatLikeProject(item)"
                v-for="item in data_laws.laws"
            ></search-element-component>
        </div>
        <div v-if="data_proposals.proposals.length > 0">
            <h3><b>Propuestas</b></h3>
            <hr>
            <search-element-component
                :key="'proposals-'+item.id"
                :item="formatLikeProject(item)"
                v-for="item in data_proposals.proposals"
            ></search-element-component>
        </div>
    </div>
</template>

<script>
    export default {
        props: [],
        data(){
            return {
                first_load : true,
                search: null,
                data_projects : {
                    projects : [],
                    page: 1,
                    last_page: 1,
                    loading: false
                },
                data_laws : {
                    laws : [],
                    page: 1,
                    last_page: 1,
                    loading: false
                },
                data_proposals : {
                    proposals : [],
                    page: 1,
                    last_page: 1,
                    loading: false
                },
                query_string_data: null
            }
        },
        mounted() {
        },
        methods: {
            formatLikeProject: function(item) {
                var data = {
                    image_url: item.image_url,
                    theme_name: item.theme_name,
                    project_name: item.project_name,
                    status_name: item.status_name,
                    url_global_info: item.url_global_info,
                    created_at : item.created_at,
                    description: item.description
                }

                if (item.hasOwnProperty('law_name')) {
                    data.project_name = item.law_name
                } else if (item.hasOwnProperty('proposal_name')) {
                    data.project_name = item.proposal_name
                }

                return data
            },
            setSearchValue: function() {
                var t = this
                t.first_load = false
                if ($('[name="search"]').val() != '') {
                    t.search = $('[name="search"]').val()
                } else {
                    t.search = null
                }

                t.getDataRelated()
            },
            getDataRelated : function() {
                var t = this
                var data = {
                    limit : 12
                }

                t.data_laws.laws = []
                t.data_laws.loading = true
                t.data_projects.projets = []
                t.data_projects.loading = true
                t.data_proposals.proposals = []
                t.data_proposals.loading = true

                if (t.search != null) {
                    data.q = t.search
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
                        t.data_laws.loading = false
                        t.data_laws.page++

                        t.data_projects.last_page = response.data.projects.last_page
                        t.data_projects.projects = response.data.projects.data
                        t.data_projects.loading = false
                        t.data_projects.page++

                        t.data_proposals.last_page = response.data.proposals.last_page
                        t.data_proposals.proposals = response.data.proposals.data
                        t.data_proposals.loading = false
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
