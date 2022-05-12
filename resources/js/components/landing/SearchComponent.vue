<template>
    <div class="mb-3 p-0">
        <p class="m-0"><a :href="item.url_global_info" style="color:black;text-decoration:none;">{{item.url_global_info}}</a></p>
        <a :href="item.url_global_info">
            <h5 class="m-0">{{item.project_name}}</h5>
        </a>
        <small>{{formatDateDay(item.created_at)}} - {{item.description.substring(0,250)}}</small>
        <br>
        <p class="m-0 text-muted">{{item.theme_name}}</p>
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
            formatDateDay: function(date) {
                const options = {  weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
                return new Date(date).toLocaleDateString('en-us', options)
            }
        }
    }
</script>
</script>
