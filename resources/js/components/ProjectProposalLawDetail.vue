<template>
    <div class="container  mt-5">
        <h1>{{item.name}}</h1>
        <p class="m-0"><small class="text-muted"></small></p>
        <p class="m-0 pl-1 mb-3" :style="{backgroundColor:'#000',color:'#fff'}">
            Creado: <b>{{item.created}}</b>
        </p>
        <p class="text-center" v-if="item.image_url != null">
            <img :src="item.image_url" class="mb-3" height="500px">
        </p>
        <div v-html="item.description"></div>
        <hr>
        <div class="row">
            <div class="col-2" v-for="specialist in item.specialist">
                <a :href="'https:/twitter.com/'+specialist.twitter_user" :style="{textDecoration:'none',color:'black'}" target="_blank">
                    <div class="card pt-3 mb-3">
                        <div class="text-center">
                            <img :src="specialist.user.avatar_url" class="image-functionary-detail" height="30px">
                        </div>
                        <div class="card-body">
                            <p class="text-muted text-center m-0">@{{specialist.twitter_user}}</p>
                            <p class="text-center m-0"><b>{{specialist.user.name +' '+((specialist.user.last_name!=null)?specialist.user.last_name:'')}}</b></p>
                            <p class="text-center m-0" :style="{color:specialist.theme_color}">{{specialist.theme}}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-3" v-for="related in item.related">
                <div class="card">
                    <img :src="related.image_url" height="150" alt="">
                    <div class="card-body m-0 p-0">
                        <div class="card-body m-0" style="height:150px">
                            <h3 :title="related.title">{{related.title.substring(0,35)}}</h3>
                            <div class="text-right">
                                <a class="btn btn-outline-info btn-sm" :href="related.url" target="_blank" title="Ver link directo">
                                    <i class="fa fa-link"></i>
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'item'
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
