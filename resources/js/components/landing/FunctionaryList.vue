<template>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center p-1">
            <p class="m-0" style="font-size:9px;"><b>NOMBRE</b></p>
            <span class="badge badge-pill assistance" :style="{backgroundColor: 'white',color:'black',marginLeft:'auto !important'}" title="¿Asistió el funcionario a la cámara?">
                <i class="fa fa-check"></i>
            </span>
            <span class="badge badge-secondary badge-pill ml-1" :style="{backgroundColor: 'white',color:'black'}" title="Votó del funcionario">
                <i class="fa fa-hand-paper-o"></i>
            </span>
        </li>
        <a :href="item.url_detail" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-1" v-for="item in items">
            <p class="m-0" style="font-size:9px;"><img :src="item.politic_group_image" height="12px" class="mr-1" alt=""> {{item.full_name}}</p>
            <span class="badge badge-pill assistance" :style="{backgroundColor: item.assistance_today.color,marginLeft:'auto !important'}" :title="item.assistance_today.assitance"><i :class="item.assistance_today.icon"></i></span>
            <span class="badge badge-secondary badge-pill badge-secondary ml-1"><i class="fa fa-remove"></i></span>
        </a>
    </ul>
</template>
<script>
    export default {
        props: [
            'items'
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
</script>
