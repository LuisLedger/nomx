<template>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <p class="text-left">Página {{pagination.current_page}} de {{pagination.last_page}}, Total de {{pagination.total}}</p>
            </div>  
            <div class="col-8 text-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button @click="clickPagination('first',1)" class="btn btn-light"><i class="fa fa-angle-double-left"></i></button>
                    <button @click="clickPagination('forward',1)" class="btn btn-light"><i class="fa fa-angle-left"></i></button>
                    <button @click="clickPagination('to',page)" :class="(page===pagination.current_page)?'btn btn-light active':'btn btn-light'" v-for="page in pages">{{page}}</button>
                    <button @click="clickPagination('next',1)" class="btn btn-light"><i class="fa fa-angle-right"></i></button>
                    <button @click="clickPagination('last',1)" class="btn btn-light"><i class="fa fa-angle-double-right"></i></button>
                </div>
            </div>  
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'pagination', 
            'pages',
            'clickPagination'
        ],
        data(){
            return {
            }
        },
        mounted() {
        },
        methods: {
        }
    }
</script>