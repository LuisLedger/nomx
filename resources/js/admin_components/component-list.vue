<template>
    <div>
        <div :class="(edit_data !== null)?'collapse show':'collapse'">
            <div class="card shadow card-body mb-3">
                <div v-if="(alert !== null)"  :class="(alert!== null)?'alert '+alert.type:''" role="alert">
                    <strong>¡Atención!</strong> {{alert.message}}
                </div>
                <form accept-charset="utf-8" id="edit" v-if="edit_data">
                    <div class="row">
                        <div class="col-3" v-for="form in form_data">
                            <form-component :form="form" :data="edit_data" :setData="setData" :setValue="setValue(form)"></form-component>
                        </div>
                    </div>
                </form>
                <div class="card-actions text-center">
                    <button @click="toogleEdit" class="btn btn-outline-danger">
                        <i class="fa fa-ban"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" @click="updateData">
                        <i class="fa fa-save"></i> Actualizar
                    </button>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <table class="table" :id="component_name">
                <thead>
                    <tr>
                        <th v-for="(column,idx) in cols">{{column.alias}} <i @click="orderColumn(column)" :class="(column.order==='ASC')?'sort fa fa-caret-down':'sort fa fa-caret-up'"></i></th>
                        <th class="text-right" v-if="(actions===undefined)">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in data">
                        <td v-for="column in columns">
                            <td-table-component
                                :column="column"
                                :data="row[column.name]"
                            ></td-table-component>
                        </td>
                        <td class="text-right" v-if="(actions===undefined)">
                            <button class="btn btn-info btn-circle" @click="editItem(row.id)"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-circle" @click="deleteItem(row.id)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <admin-pagination-component
                :pagination="pagination"
                :clickPagination="clickPagination"
                :pages="pages"
            ></admin-pagination-component>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'token',
            'component_name', 
            'url_data',
            'url_detail',
            'url_update',
            'url_delete',
            'columns',
            'form_data',
            'actions'
        ],
        data(){
            return {
                is_load: false,
                data: [],
                edit_data:null,
                pagination: [],
                pages: [],
                cols:[],
                page: 1,
                limit: 10,
                alert: null
            }
        },
        mounted() {
            this.cols = this.columns
            if (this.is_load==false) {
                this.getData()
            }
        },
        computed :{
        },
        methods: {
            getData : function() {
                var t = this 
                $.ajax({
                    type: 'get',
                    url : t.url_data,
                    data : {
                        limit: t.limit,
                        page: t.page,
                        cols: t.cols,
                        order: t.orders
                    },
                    dataType: 'json'
                }).done(function(response){
                    t.is_load = true
                    if (response.http_code == 200) {
                        t.data = response.data.data
                        t.pagination = {
                            current_page : response.data.current_page,
                            last_page : response.data.last_page,
                            total : response.data.total
                        }
                        t.calculatePage()
                    } 
                })
            },
            orderColumn: function(column) {
                var t = this
                for (let index = 0; index < t.cols.length; index++) {
                    t.cols[index].sort = false;
                    if (column.name === t.cols[index].name) {
                        t.cols[index].order = (t.cols[index].order ==='ASC')?'DESC':'ASC'
                        t.cols[index].sort  = true;
                    } else {
                        t.cols[index].order = 'ASC'
                    }
                }

                t.getData()
            },
            calculatePage : function() {
                var t = this
                var current_page = t.pagination.current_page
                var last_page    = t.pagination.last_page
                var start_page   = (current_page <= 4)?1:current_page - 4
                var end_page     = ((current_page + 4)>last_page)?last_page:current_page + 4
                
                var list_pages = []
                for (var i = start_page; i <= end_page; i++) {
                    list_pages.push(i)
                }

                t.pages = list_pages;
            },
            clickPagination: function(action, page) {
                var t = this
                if (action==='first') {
                    t.page = 1
                } else if(action==='last') {
                    t.page = t.pagination.last_page
                } else if(action==='next') {
                    t.page = (((t.page+1) >= t.pagination.last_page))?t.pagination.last_page : t.page+1
                } else if(action==='forward') {
                    t.page = (((t.page-1) < 1))?1 : t.page-1
                } else if(action==='to') {
                    t.page = page
                }

                t.getData()
            },
            toogleEdit: function() {
                var t = this
                t.edit_data = null
            },
            editItem : function(item_id) {
                var t = this
                t.alert = null
                t.edit_data = t.data.find(el => el.id === item_id)
            },
            setData: function(e) {
                var t = this
                $('[name="'+e.target.name+'"]').removeClass('border-bottom-danger')
                t.edit_data[e.target.name] = e.target.value
            },
            setValue: function(form) {
                var t = this
                return (t.edit_data.hasOwnProperty(form.name))?t.edit_data[form.name]:$('[name="'+form.name+'"]').val()
            },
            updateData : function(item_id) {
                var t = this
                var required = false
                var message  = ''
                t.alert = null 

                t.edit_data._token = t.token

                t.form_data.forEach(function(form,idx){
                    if (form.required == true) {
                        if (t.edit_data[form.name] == '') {
                            $('[name="'+form.name+'"]').addClass('border-bottom-danger')
                            message = 'Algunos campos son requeridos'
                            required = true
                        }
                    }
                })

                if (t.edit_data.hasOwnProperty('password')) {
                    if (t.edit_data.password != '' || t.edit_data.password_confirm != '') {
                        if (t.edit_data.password.length <= 6) {
                            required = true
                            message = 'La contraseña tiene menos de 6 caracteres'
                            $('[name="password"]').addClass('border-bottom-danger')
                        } else if (t.edit_data.password != t.edit_data.password_confirm) {
                            required = true
                            message = 'La contraseña no coincide'
                            $('[name="password"]').addClass('border-bottom-danger')
                            $('[name="password_confirm"]').addClass('border-bottom-danger')
                        }
                    } else {
                        message = 'La contraseña debe ser actualizada'
                        $('[name="password"]').addClass('border-bottom-danger')
                        $('[name="password_confirm"]').addClass('border-bottom-danger')
                    }
                }

                if (required) {
                    t.alert = {
                        type: 'alert-warning',
                        message: message
                    }
                    return 
                }

                $.ajax({
                    type: 'PUT',
                    url: t.url_update.replace('#element_id', t.edit_data.id),
                    data: t.edit_data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.getData()
                        t.alert = {
                            type: 'alert-success',
                            message: 'El item fue agregado con éxito'
                        }
                        window.setTimeout(function(){
                            t.alert = null
                            t.edit_data = null
                        },3000) 
                    }
                })
            },
            deleteItem : function(item_id) {
                var t = this
                if (confirm('¿Estás seguro de realizar esta acción?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: t.url_delete.replace('#element_id',item_id),
                        data: {
                            _token : t.token
                        },
                        dataType: 'json' 
                    }).done(function(response){
                        if (response.http_code == 200) {
                            t.getData()
                        }
                    })
                }
            }
        }
    }
</script>