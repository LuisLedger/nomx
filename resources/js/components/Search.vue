<template>
    <div :class="(first_load)?'container':'container mt-5'" :style="(first_load)?{marginTop:'15rem',marginBottom:'15rem'}:{}">
        <h1 class="text-center" v-if="first_load">
            ¡Bienvenido!
        </h1>
        <p class="text-center text-muted" v-if="first_load">
            Encuentra a tus funcionarios, propuestas, leyes o proyectos que y el estatus que tienen <br>
            en los distintos niveles de gobierno
        </p>
        <div :class="(first_load)?'form-group col-8 m-auto':'form-group mb-3'">
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
                        <i class="fa fa-search"></i> Búscar
                    </button>
                </input>
            </div>
        </div>
        <div v-if="data_functionaries.functionaries.length > 0">
            <h3 class="d-flex justify-content-between">
                <b>Funcionarios</b>
                <button class="btn btn-secondary ml-auto" @click="getFunctionaries">
                    <i class="fa fa-search"></i> Siguente
                </button>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-4 mb-3" v-for="functionary in data_functionaries.functionaries" >
                    <card-functionary-component :functionary="functionary"></card-functionary-component>
                </div>
            </div>
        </div>
        <div v-if="data_projects.projects.length > 0">
            <h3 class="d-flex justify-content-between">
                <b>Proyectos</b>
                <button class="btn btn-secondary ml-auto" @click="getProjects">
                    <i class="fa fa-search"></i> Siguente
                </button>
            </h3>
            <hr>
            <search-element-component
                :key="'projects-'+item.id"
                :item="formatLikeProject(item)"
                v-for="item in data_projects.projects"
            ></search-element-component>
        </div>
        <div v-if="data_projects.projects.length > 0">
            <h3 class="d-flex justify-content-between">
                <b>Leyes</b>
                <button class="btn btn-secondary ml-auto" @click="getLaws">
                    <i class="fa fa-search"></i> Siguente
                </button>
            </h3>
            <hr>
            <search-element-component
                :key="'laws-'+item.id"
                :item="formatLikeProject(item)"
                v-for="item in data_laws.laws"
            ></search-element-component>
        </div>
        <div v-if="data_proposals.proposals.length > 0">
            <h3 class="d-flex justify-content-between">
                <b>Propuestas</b>
                <button class="btn btn-secondary ml-auto" @click="getProposals">
                    <i class="fa fa-search"></i> Siguente
                </button>
            </h3>
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
                data_functionaries : {
                    functionaries : [],
                    page: 1,
                    last_page: 1,
                    loading: false
                },
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

                t.data_laws.laws           = []
                t.data_laws.loading        = true
                t.data_projects.projets    = []
                t.data_projects.loading    = true
                t.data_proposals.proposals = []
                t.data_proposals.loading   = true

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

                        t.data_functionaries.last_page = response.data.functionaries.last_page
                        t.data_functionaries.functionaries = response.data.functionaries.data
                        t.data_functionaries.loading = false
                        t.data_functionaries.page++
                    }
                })
            },
            getLaws: function() {
                var t = this
                if (t.data_laws.last_page < t.data_laws.page) {
                    return 
                }

                t.query_string_data.limit = 12
                t.query_string_data.page = t.data_laws.page

                $.ajax({
                    type: 'get',
                    url: '/themes/laws',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_laws.last_page = response.data.last_page
                        t.data_laws.laws = response.data.data
                        t.data_laws.page++    
                    }
                })
            },
            getProjects: function() {
                var t = this
                if (t.data_projects.last_page < t.data_projects.page) {
                    return 
                }

                t.query_string_data.limit = 12
                t.query_string_data.page = t.data_projects.page

                $.ajax({
                    type: 'get',
                    url: '/themes/projects',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_projects.last_page = response.data.last_page
                        t.data_projects.projects = response.data.data
                        t.data_projects.page++    
                    }
                })
            },
            getProposals: function() {
                var t = this
                if (t.data_proposals.last_page < t.data_proposals.page) {
                    return 
                }

                t.query_string_data.limit = 12
                t.query_string_data.page = t.data_proposals.page

                $.ajax({
                    type: 'get',
                    url: '/themes/proposals',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_proposals.last_page = response.data.last_page
                        t.data_proposals.proposals = response.data.data
                        t.data_proposals.page++    
                    }
                })
            },
            getFunctionaries: function() {
                var t = this
                if (t.data_functionaries.last_page < t.data_functionaries.page) {
                    return 
                }

                t.query_string_data.limit = 3

                t.query_string_data.page = t.data_functionaries.page

                $.ajax({
                    type: 'get',
                    url: '/themes/functionaries',
                    data: t.query_string_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.data_functionaries.last_page = response.data.last_page
                        t.data_functionaries.functionaries = response.data.data
                        t.data_functionaries.page++    
                    }
                })
            }
        }
    }
</script>
