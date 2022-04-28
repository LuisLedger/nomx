<template>
    <section class="mb-3 mt-3">
        <h3 class="text-center">Promesas campañas</h3>
        <div class="text-center" v-if="proposals.length==0">
            <h3 class="pt-5 pb-5">No hay información relacionada</h3>
        </div>
        <ul class="list-group" style="max-height:350px;overflow-y: auto;">
            <li class="list-group-item d-flex justify-content-between align-items-center" v-for="proposal in proposals">
                {{proposal.proposal_name}}
                <span class="badge badge-pill" :style="{backgroundColor:proposal.status_color}" :title="proposal.status_name"><i :class="proposal.status_icon"></i></span>
            </li>
        </ul>
    </section>
</template>

<script>
    export default {
        props: [
            'functionary'
        ],
        data(){
            return {
                proposals : [],
                page: 1,
                last_page: 1
            }
        },
        mounted() {

            this.getProposalsFromFunctionary()
        },
        methods: {
            getProposalsFromFunctionary: function() {
                var t = this
                if (t.last_page < t.page) {
                    return 
                }

                $.ajax({
                    type: 'get',
                    url: '/functionary/'+t.functionary.id+'/proposals',
                    data: {
                        page: t.page,
                        limit: 3,
                        period_ids : $('#period_id').val()
                    },
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.last_page = response.data.last_page
                        if (response.data.data.length > 0) {
                            $.each(response.data.data,function(i,el){
                                t.proposals = [...t.proposals,el]
                            })
                        }

                        t.page++    
                    }
                })
            }
        }
    }
</script>
</script>
