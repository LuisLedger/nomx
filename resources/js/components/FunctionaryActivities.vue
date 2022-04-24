<template>
    <div class="row">
        <div class="col-4 mb-3" v-for="activity in activities">
            <div class="card">
                <img :src="activity.image_url" height="150" alt="">
                <div class="card-body m-0">
                    <h3>{{activity.name}}</h3>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button @click="getActivitiesFromFunctionary" class="btn btn-link btn-block">
                Ver más...
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'functionary'
        ],
        data(){
            return {
                activities : [],
                page: 1,
                last_page: 1
            }
        },
        mounted() {

            this.getActivitiesFromFunctionary()
        },
        methods: {
            getActivitiesFromFunctionary: function() {
                var t = this
                if (t.last_page < t.page) {
                    return 
                }

                $.ajax({
                    type: 'get',
                    url: '/functionary/'+t.functionary.id+'/activities',
                    data: {
                        page: t.page,
                        limit: 3
                    },
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.last_page = response.data.last_page

                        $.each(response.data.data,function(i,el){
                            t.activities = [...t.activities,el]
                        })

                        t.page++    
                    }
                })
            }
        }
    }
</script>
</script>
