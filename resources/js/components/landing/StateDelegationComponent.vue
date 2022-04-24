<template>
    <div class="row mb-3">
        <div class="col-md-6">
           <div class="form-group">
               <label v-if="show_labels === undefined">Estado</label>
               <select name="state_id" class="form-control" :disabled="(states.length>0)?false:true" @change="getDelegationsByState">
                   <option value="">{{(show_labels === undefined)?'Selecciona una opcion':'Estado'}}</option>
                   <option :value="state.id" :selected="(sel_state==state.id)" v-for="state in states">{{state.name}}</option>
               </select>
           </div>
        </div>
        <div class="col-md-6" v-if="(show_delegations === undefined)">
           <div class="form-group">
               <label v-if="show_labels === undefined">Municipios</label>
               <select name="delegation_id" :disabled="(delegations.length>0)?false:true" class="form-control">
                   <option value="">{{(show_labels === undefined)?'Selecciona una opcion':'Municipios'}}</option>
                   <option :value="delegation.id" :selected="(sel_delegation==delegation.id)" v-for="delegation in delegations">{{delegation.name}}</option>
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
            'show_labels'
        ],
        data(){
            return {
                delegations:[],
            }
        },
        mounted() {
            if (this.def_delegations) {
                this.delegations = this.def_delegations
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
            }
        },
    }
</script>