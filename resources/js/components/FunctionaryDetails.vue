<template>
    <section>
        <div class="form-group mb-3">
            <label>Periodos de gobierno</label>
            <select name="period_id" id="period_id" class="form-control">
                <option :value="functionary_period.period_id" v-for="functionary_period in functionary_periods">{{functionary_period.full_period}}</option>
            </select>
        </div>
        <div class="row" v-if="isCameraFunctionary(functionary.functionary_type_id)">
            <div class="col-md-6">
                <functionary-laws-component
                    :functionary="functionary"
                ></functionary-laws-component>
            </div>
            <div class="col-md-6">
                <functionary-proposal-component
                    :functionary="functionary"
                ></functionary-proposal-component>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <functionary-proposal-component
                    :functionary="functionary"
                ></functionary-proposal-component>
            </div>
        </div>
        <functionary-projects-component
            :functionary="functionary"
        ></functionary-projects-component>
        <functionary-activities-component
            :functionary="functionary"
        ></functionary-activities-component>
    </section>
</template>

<script>
    export default {
        props: [
            'functionary',
            'functionary_periods'
        ],
        data(){
            return {
            }
        },
        mounted() {
        },
        methods: {
            isCameraFunctionary : function(type) {
                var res = false
                if (type == 4 || type == 5 || type == 10 || type == 11) {
                    res = true
                }

                return res;
            }
        }
    }
</script>
