<template>
    <section>
        <div class="row">
            <div class="col-4">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action" :id="theme.id" :theme="theme.id" v-for="theme in themes" @click.prevent="selectTheme">
                        <b>{{theme.name}}</b>
                    </li>
                </ul>
            </div>
            <div class="col-8">
                
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'themes'
        ],
        data(){
            return {
                sel_theme : null
            }
        },
        mounted() {
        },
        methods: {
            selectTheme: function(e){
                var t = this
                console.log(e.target)
                t.sel_theme = e.target
                $('.list-group-item').removeClass('active')
                $('#'+e.target.id).addClass('active')
            }
        }
    }
</script>
