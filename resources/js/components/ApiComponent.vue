<template>
<div class="card" v-if="api">
    <div class="card-header" :id="'heading' + api.id">
        <div class="row">
            <div class="col-md-12">
                <button class="btn w100 btnApi" data-toggle="collapse" :data-target="'#collapse' + api.id" 
                :aria-expanded="(api.id == 1 ? 'true' : '')" :aria-controls="'collapse' + api.id">
                <div :class="api.method.toLowerCase()"><span>{{api.method}}</span></div> 
                <div class="m-2 display-inline api-url"> {{api.url}} </div> ({{api.description}})
                </button>
            </div>
        </div>
    </div>
        <div :id="'collapse' + api.id" :class="'collapse' + (api.id == 1 ? 'show' : '')" 
                :aria-labelledby="'heading' + api.id" data-parent="#accordion">
        <div class="card-body">
            <form @submit.prevent="runApi" :id="'requestform' + api.id ">
            <div :key="param_index" v-for="(parameter, param_index) in api.parameters">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" :id="'basic-addon' + param_index">{{parameter.name}} {{ parameter.is_required ? '*': '' }}</span>
                    </div>
                    <input :type="parameter.type" class="form-control" v-model="formFields[parameter.name]"
                            :name="parameter.name" :id="parameter.name" 
                            :placeholder="parameter.description" :aria-label="parameter.name" :aria-describedby="'basic-addon' + param_index" :required="parameter.is_required ? true: false">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <span :class="'p-1 statu-' + responseStatuCode" v-if="responseStatuCode">Response Statu: {{responseStatuCode}}</span>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <div class="spinner-border text-primary m-1" role="status" v-if="showSpinner"></div>
                    <button type="submit" class="btn btn-success">Çalıştır</button>
                </div>
            </div>
            </form>
          
            <h4>Response</h4>
            <textarea name="requestresult" v-html="responseStr" id="requestresult" cols="30" rows="10" class="form-control my-2"></textarea>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props : {
            api : { 
                type: Object,
                default: () => {scope: null},
                required: true  
            }
        },
        methods:{
            runApi(){
                this.showSpinner = true
                
                const fields = Object.assign({}, this.formFields)
                //this.$refs.my_input.value
                
                var config = null
                if(fields.hasOwnProperty('token')){
                    config = {
                        headers: { Authorization: `Bearer ${fields.token}` }
                    };
                }
                
                
                if(this.api.method == 'POST')
                    axios.post(this.api.url, fields, config)
                        .then( (res) => {
                            this.responseStr = res.data
                            this.showSpinner = false
                            this.responseStatuCode = res.status
                        }).catch( (err) => {
                            this.responseStr = err.response.data
                            this.responseStatuCode = err.response.status
                            this.showSpinner = false
                        })
                else if(this.api.method == 'GET')
                    axios.get(this.api.url, config)
                        .then( (res) => {
                            this.responseStr = res.data
                            this.showSpinner = false
                            this.responseStatuCode = res.status
                        }).catch( (err) => {
                            this.responseStatuCode = err.response.status
                            this.responseStr = err.response.data
                            this.showSpinner = false
                        })
            },
            
        },
        data() {
            return {
                formFields: [],
                responseStr : '',
                responseStatuCode : 0,
                showSpinner : false
            }
        }, 
    }
</script>

<style scoped>
    .get{
        background-color: rgb(9, 87, 223);
        color: white;
        padding: 5px;
        display: inline;
        border-radius: 3px;
    }
    .post{
        background-color: rgb(0, 117, 0);
        color: white;
        padding: 5px;
        display: inline;
        border-radius: 3px;
    }
    .display-inline{
        display: inline;
    }
    .api-url{
        font-weight: bold;
        font-size: 16px;
    }
    .w100{
        width: 100%;
    }
    .btnApi{
        text-align: start;
    }
    .statu-200{
        background-color: rgb(6, 99, 1);
        color: white;
    }
    .statu-404{
        background-color: rgb(251, 78, 51);
        color: white;
    }
    .statu-401{
        background-color: rgb(172, 41, 21);
        color: white;
    }
</style>