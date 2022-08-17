<template>
    <div>
        <div class="row">
            <div class="col-9">
                <h2 class="h3 mb-2 text-gray-800">{{title}}</h2>
                <p class="mb-4">{{description}}</p>
            </div>
            <div class="col-3 text-right">
                <button class="btn btn-primary" @click="togglePanel">
                    <i :class="(create_form)?'fa fa-ban':'fa fa-plus'"></i> {{ (create_form)?'Cancelar':'Crear'}}
                </button>
            </div>
        </div>
        <div :class="(create_form)?'collapse show':'collapse'">
            <div class="card shadow card-body mb-3">
                <div v-if="(alert !== null)"  :class="(alert!== null)?'alert '+alert.type:''" role="alert">
                    <strong>¡Atención!</strong> {{alert.message}}
                </div>
                <form accept-charset="utf-8" id="create">
                    <div class="row">
                        <div class="col-3" v-for="form in form_data">
                            <form-component :form="form" :data="data" :setData="setData"></form-component>
                        </div>
                    </div>
                </form>
                <div class="card-actions text-center">
                    <button @click="togglePanel" class="btn btn-outline-danger">
                        <i class="fa fa-ban"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" @click="saveData">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'title', 
            'description',
            'url_store',
            'form_data',
            'token'
        ],
        data(){
            return {
                alert: null,
                create_form: false,
                data: {}
            }
        },
        mounted() {
            
        },
        methods: {
            togglePanel: function() {
                var t = this
                t.data = {}
                t.alert = null
                $('.form-control').removeClass('border-bottom-danger')
                t.create_form = (t.create_form == true)?false:true
            },
            setData: function(e) {
                var t = this
                $('[name="'+e.target.name+'"]').removeClass('border-bottom-danger')
                t.data[e.target.name] = $('[name="'+e.target.name+'"]').val()
            },
            saveData: function() {
                var t = this
                var required = false
                var message  = ''
                t.alert = null

                t.data._token = t.token

                t.form_data.forEach(function(form,idx){
                    if (form.required == true && $('[name="'+form.name+'"]').val() == '') {
                        $('[name="'+form.name+'"]').addClass('border-bottom-danger')
                        message = 'Algunos campos son requeridos'
                        required = true
                    }
                })

                if (t.data.hasOwnProperty('password')) {
                    if (t.data.password.length <= 6) {
                        required = true
                        message = 'La contraseña tiene menos de 8 caracteres'
                        $('[name="password"]').addClass('border-bottom-danger')
                    } else if (t.data.password != t.data.password_confirm) {
                        required = true
                        message = 'La contraseña no coincide'
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
                    type: 'POST',
                    url: t.url_store,
                    data: t.data,
                    dataType: 'json'
                }).done(function(response){
                    if (response.http_code == 200) {
                        t.$root.$emit('admin-list-component')
                        $('#create').trigger("reset");
                        t.data = {}
                        t.alert = {
                            type: 'alert-success',
                            message: 'El item fue agregado con éxito'
                        }
                    }
                })
            }
        }
    }
</script>