<template>
    <section>
        <h2 class="text-center">Cámara de Diputados</h2>
        <p class="text-muted text-center">Discusiones hoy en la cámara federal
            <br> 
            Una ciudadanía informada ayuda a México
        </p>
        <div v-if="functionaries.lenght===0">
            <h5 class="text-center">Cargando datos...</h5>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3" v-for="items in functionaries">
                <functionary-list-component :items="items"></functionary-list-component>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
        ],
        data(){
            return {
                functionaries : []
            }
        },
        mounted() {
            this.getFunctionariesCameras()

            console.log(this.functionaries.length)
        },
        methods: {
            getFunctionariesCameras : function() {
                var t = this

                $.ajax({
                    type:'get',
                    url: 'functionary_cameras',
                    data:{},
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.functionaries = response.data
                    }
                })
            }
        }
    }
</script>
