<template>
    <a :href="functionary.url_detail" :title="functionary.full_name" class="card-link">
        <div :class="(extra_class)?'card mt-3 '+extra_class:'card mt-3'">
            <div class="card-body m-0" style="height:202px">
                <div class="row">
                    <div class="col-4 m-auto">
                        <img :src="functionary.profile_url" alt="" class="image-functionary">
                    </div>
                    <div class="col-8 pt-0 pb-0">
                        <p class="m-0 text-muted"><small>{{functionary.functionary_type_name}}</small></p>
                        <h4 class="m-0 text-left">{{functionary.full_name}}</h4>
                        <p class="m-0 text-left">{{functionary.level_name}} - {{formatDate(functionary.start_time)}}</p>
                        <p class="m-0 text-left">{{functionary.politic_group_name}}</p>
                        <p class="m-0 text-left text-muted">{{functionary.state_name}}, {{functionary.delegation_name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
    export default {
        props: [
            'functionary',
            'extra_class'
        ],
        data(){
            return {
            }
        },
        mounted() {
        },
        methods: {
            formatDate: function(date) {
                var months = [
                    'Ene',
                    'Feb',
                    'Mar',
                    'Abr',
                    'May',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dic'
                ]
                var date = new Date(date);

                return date.getFullYear()+' '+months[date.getMonth()]
            }
        }
    }
</script>
