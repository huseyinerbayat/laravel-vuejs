<template>
    <div class="container">
        <h1 class="my-5">API Dökümantasyonu</h1>
        <div class="row justify-content-center">
            <div id="accordion">
                <api-component :key="api.id" :api="api" v-for="api in apis" />
            </div>
        </div>
    </div>
</template>

<script>
    import ApiComponent from './ApiComponent.vue'
    export default {
        components: { ApiComponent },
        data(){
            return {
                apis: [
                    { id: 1, method: 'POST', url: '/api/register', description: 'Kayıt olma', 
                        parameters: [ 
                            { name: 'email', description: 'Email' , type: 'email' , is_required: true},
                            { name: 'password', description: 'Parola' , type: 'password' , is_required: true},
                            { name: 'registration_code', description: 'Öğrenci kayıt kodu' , type: 'text' , is_required: true},
                            { name: 'name', description: 'Veli Adı' , type: 'text' , is_required: true},
                            { name: 'surname', description: 'Veli Soyadı' , type: 'text' , is_required: true},
                            { name: 'phone_number', description: 'Telefon No' , type: 'text' , is_required: false},
                            { name: 'address', description: 'Adres' , type: 'text' , is_required: false},
                        ]
                    },
                    { id: 2, method: 'POST', url: '/api/login', description: 'Login / Token alma', 
                        parameters: [ 
                            { name: 'email', description: 'Email' , type: 'email' , is_required: true},
                            { name: 'password', description: 'Parola' , type: 'password' , is_required: true},
                        ]
                    },
                    { id: 3, method: 'GET', url: '/api/user', description: 'Veli bilgilerini alma', 
                        parameters: [ 
                            { name: 'token', description: 'Token' , type: 'password' , is_required: true}
                        ]
                    },
                    { id: 4, method: 'POST', url: '/api/updateinfo', description: 'Veli bilgilerini güncelleme', 
                        parameters: [ 
                            { name: 'token', description: 'Token' , type: 'password' , is_required: true},
                            { name: 'name', description: 'Veli Adı' , type: 'text' , is_required: true},
                            { name: 'surname', description: 'Veli Soyadı' , type: 'text' , is_required: true},
                            { name: 'phone_number', description: 'Telefon No' , type: 'text' , is_required: false},
                            { name: 'address', description: 'Adres' , type: 'text' , is_required: false},
                        ]
                    },
                    { id: 5, method: 'GET', url: '/api/list', description: 'Öğrencilerin veli bilgileriyle listelenmesi', 
                        parameters: []
                    }
                ]

            }
        },
        mounted() {
            console.log('Mounted')
        }
    }
</script>
