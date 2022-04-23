<template>
    <div class="row mb-3">
        <div class="col-lg-4">
           <div class="form-group">
               <label v-if="show_labels === undefined">Estado</label>
               <select name="state_id" class="form-control" :disabled="(states.length>0)?false:true" @change="getDelegationsByState">
                   <option value="">{{(show_labels === undefined)?'Selecciona una opcion':'Estado'}}</option>
                   <option :value="state.id" :selected="(sel_state==state.id)" v-for="state in states">{{state.name}}</option>
               </select>
           </div>
        </div>
        <div class="col-md-4" v-if="(show_delegations === undefined)">
           <div class="form-group">
               <label v-if="show_labels === undefined">Municipios</label>
               <select name="delegation_id" :disabled="(delegations.length>0)?false:true" class="form-control" @change="getLocationsByDelegation">
                   <option value="">{{(show_labels === undefined)?'Selecciona una opcion':'Municipios'}}</option>
                   <option :value="delegation.id" :selected="(sel_delegation==delegation.id)" v-for="delegation in delegations">{{delegation.name}}</option>
               </select>
            </div>
        </div>
        <div class="col-md-4" v-if="(show_locations === undefined)">
           <div class="form-group">
               <label v-if="show_labels === undefined">Localidades</label>
               <select name="location_id" :disabled="(locations.length>0)?false:true" class="form-control">
                   <option value="">{{(show_labels === undefined)?'Selecciona una opcion':'Localidades'}}</option>
                   <option :value="location.id" :selected="(sel_location==location.id)" v-for="location in locations">{{location.name}}</option>
               </select>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'states',
            'sel_state', 
            'def_delegations', 
            'sel_delegation',
            'show_delegations',
            'show_locations',
            'def_locations',
            'sel_locations',
            'show_labels'
        ],
        data(){
            return {
                delegations:[],
                locations:[]
            }
        },
        mounted() {
            if (this.def_delegations) {
                this.delegations = this.def_delegations
            }

            if (this.def_locations) {
                this.locations = this.def_locations
            }
        },
        methods: {
            getDelegationsByState:function()
            {
                var t = this
                var state_id = $('[name="state_id"]').val()
                t.delegations = []
                if (state_id) {
                    $.ajax({
                        type: 'get',
                        url: '/delegations/'+state_id+'/list',
                        dataType: 'json',
                    }).done(function(response){
                        if (response.http_code == 200) {
                            t.delegations = response.data
                        }
                    })
                }
            },
            getLocationsByDelegation:function()
            {
                var t = this
                var country_id = $('[name="delegation_id"]').val()
                t.locations = []
                if (country_id) {
                    $.ajax({
                        type: 'get',
                        url: '/locations/'+country_id+'/list',
                        dataType: 'json',
                    }).done(function(response){
                        if (response.http_code == 200) {
                            t.locations = response.data
                        }
                    })
                }
            },
        },
    }
</script>