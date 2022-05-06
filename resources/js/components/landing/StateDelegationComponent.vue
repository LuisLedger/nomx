<template>
    <div class="row mb-3">
        <div class="col-md-6">
            <select-form-component
                :name="'state_id'"
                :title="'Estados'"
                :selected="sel_state"
                :method="getDelegationsByState"
                :show_labels="show_labels"
                :items="states"
            ></select-form-component>
        </div>
        <div class="col-md-6" v-if="(show_delegations === undefined)">
            <select-form-component
                :name="'delegation_id'"
                :title="'Municipios'"
                :selected="sel_delegation"
                :method="method"
                :disabled="(delegations.length>0)?false:true"
                :show_labels="show_labels"
                :items="delegations"
            ></select-form-component>
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
            'show_labels',
            'method'
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
                            t.method()
                        }
                    })
                }
            }
        },
    }
</script>