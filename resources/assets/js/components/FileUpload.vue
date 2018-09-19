<template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <img :src="image" class="img-responsive uploaded-image">
            </div>
            <div class="col-md-8">
                <input type="file" v-on:change="onFileChange" class="input" name="image">
            </div>
            <div class="col-md-2 m-t-5">
                <button class="button is-success button-block" @click="upload">Upload</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload(){
                axios.post("/user/change-profile-picture",{image: this.image}).then(response => {
                    //Do the uploads
                });
            }
        }
    }
</script>
