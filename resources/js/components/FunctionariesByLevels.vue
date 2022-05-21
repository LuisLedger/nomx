<template>
    <section>
        <h2 class="text-center">Conoce más de tu gobierno <br><small class="text-muted">Por nivel de gobierno</small></h2>
        <hr>
        <div class="row mb-5">
            <div class="col-md-4 mb-3" v-for="level in levels">
                <a @click.prevent="getFunctionaryTypes(level.id)" href="#functionary_types" class="card-link">
                    <card-component :body="levelBody(level.name)" :class="(level.id == selected_level)?'selected':''"></card-component>
                </a>
            </div>
        </div>
        <h2 class="text-center">Encuentra a tus representantes <br><small class="text-muted">Por tipo de cargo</small></h2>
        <hr>
        <div class="row" v-if="functionary_types.length > 0" id="types-functionaries">
            <div class="col-2 mb-3" v-for="functionary_type in functionary_types" >
                <a @click.prevent="getFunctionariesByTypesAndLocations" :data-type="functionary_type.id" :id="'type-'+functionary_type.id" href="#functionaries" class="card-link">
                    <card-component :body="functionaryTypeBody(functionary_type)" :class="(functionary_type.id == selected_functionary_type)?'selected':''"></card-component>
                </a>
            </div>
        </div>
        <div v-if="selected_level > 1">
            <h2 class="text-center">¿En dondé? <br><small class="text-muted">Por estado y municipios</small></h2>
            <state-delegation-component :states="states" :method="getFunctionariesData"></state-delegation-component>
        </div>
        <hr>
        <p class="text-right">
            <small>Existen {{total_list}} funcionario(s)</small>
        </p>
        <div class="row" v-if="functionaries.length > 0" id="list-functionaries">
            <div class="col-md-4 mb-3" v-for="functionary in functionaries" >
                <card-functionary-component :functionary="functionary"></card-functionary-component>
            </div>
            <button class="btn btn-link btn-block" @click="getFunctionariesData" v-if="(last_page > page)?true:false">
                Listar más...
            </button>
        </div>
        <div v-else>
            <h3 class="text-center">Las opciones no devuelven resultados, intenta con otros datos...</h3>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'levels',
            'states'
        ],
        data(){
            return {
                selected_level: 1,
                selected_functionary_type: 1,
                page: 1,
                last_page: 1,
                total_list: 0,
                functionary_types: [],
                functionaries: [],
                last_query_string: {}
            }
        },
        mounted() {
            this.getFunctionaryTypes(1)
            this.getFunctionariesData()
        },
        methods: {
            levelBody: function(text) {
                return `<div class="card-body m-0"><h3 class="text-center">${text}</h3></div>`
            },
            functionaryTypeBody: function(functionary_type) {
                var level = this.levels.find(el => el.id == functionary_type.level_id)
                
                return `<div class="card-body m-0" style="height:100.23px">
                    <h5 class="m-0">${functionary_type.name}</h5>
                    <p class="text-muted m-0">${level.name}</p>
                </div>
                `
            },
            getFunctionaryTypes: function(level_id = null){
                var t = this
                var url = '/functionary_types'
                t.selected_level = (level_id==null)?1:level_id
                t.selected_functionary_type = (t.selected_level==1)?1:null

                if (level_id != null) {
                    url += '?level_id='+t.selected_level
                }

                t.functionaries = []
                $.get(url).done(function(response){
                    if (response.http_code == 200) {
                        t.functionary_types = response.data
                        // window.scrollTo(0, document.body.scrollHeight);
                    }
                })
            },
            getFunctionariesByTypesAndLocations: function(e) {
                var t = this
                var type = $(e.target).closest('a').attr('data-type')
                t.selected_functionary_type = type
                t.getFunctionariesData()
            },
            getFunctionariesData: function() {
                var t = this
                var valid_search = false
                var data = {
                    limit: 6,
                    functionary_type_id: t.selected_functionary_type,
                    level_id: t.selected_level,
                }

                if ($('[name="state_id"]').val() !== '') {
                    valid_search  = true
                    data.state_id = $('[name="state_id"]').val()
                }

                if ($('[name="delegation_id"]').val() !== '') {
                    valid_search  = true
                    data.delegation_id = $('[name="delegation_id"]').val()
                }

                if (data.level_id > 1 ) {
                    if (valid_search == false) {
                        return
                    }
                }
                
                if (t.last_query_string.functionary_type_id !== t.selected_functionary_type) {
                    t.page = 1
                    t.last_page = 1
                    t.functionaries = []
                }

                if (t.last_query_string.level_id !== t.selected_level) {
                    t.page = 1
                    t.last_page = 1
                    t.functionaries = []
                }

                data.page = t.page

                t.last_query_string = data
                t.total_list = 0
                $.ajax({
                    type: 'get',
                    url: '/functionaries_search',
                    data: data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.total_list = response.data.total                        
                        t.last_page = response.data.last_page
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.functionaries = [...t.functionaries,el]
                            })
                            t.page++
                        }
                    }
                })
            }
        }
    }
</script>
