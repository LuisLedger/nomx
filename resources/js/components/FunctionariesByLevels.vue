<template>
    <section>
        <h2 class="text-center">Conoce más de tu gobierno <br><small class="text-muted">Por nivel</small></h2>
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
            <div class="col-md-3 mb-3" v-for="functionary_type in functionary_types" >
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
        <div class="row" v-if="functionaries.length > 0" id="list-functionaries">
            <div class="col-md-4 mb-3" v-for="functionary in functionaries" >
                <card-functionary-component :functionary="functionary"></card-functionary-component>
            </div>
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
                functionary_types: [],
                functionaries: [],
            }
        },
        mounted() {
            this.getFunctionaryTypes(1)
        },
        methods: {
            levelBody: function(text) {
                return `<div class="card-body m-0"><h3>${text}</h3></div>`
            },
            functionaryTypeBody: function(functionary_type) {
                var level = this.levels.find(el => el.id == functionary_type.level_id)
                
                return `<div class="card-body m-0">
                    <h3>${functionary_type.name}</h3>
                    <p class="text-muted">${level.name}</p>
                </div>
                `
            },
            getFunctionaryTypes: function(level_id = null){
                var t = this
                var url = '/functionary_types'
                t.selected_level = level_id
                t.selected_functionary_type = null

                if (level_id != null) {
                    url += '?level_id='+level_id
                }

                $.get(url).done(function(response){
                    if (response.http_code == 200) {
                        t.functionary_types = response.data
                        window.scrollTo(0, document.body.scrollHeight);
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

                var data = {
                    functionary_type_id : t.selected_functionary_type,
                    level_id : t.selected_level,
                }

                if ($('[name="state_id"]').val() !== '') {
                    data.state_id = $('[name="state_id"]').val()
                }

                if ($('[name="delegation_id"]').val() !== '') {
                    data.delegation_id = $('[name="delegation_id"]').val()
                }

                $.ajax({
                    type: 'get',
                    url: '/functionaries_search',
                    data: data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.functionaries = response.data
                        window.scrollTo(0, document.body.scrollHeight);
                    }
                })
            }
        }
    }
</script>
